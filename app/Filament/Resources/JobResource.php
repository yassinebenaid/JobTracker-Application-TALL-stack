<?php

namespace App\Filament\Resources;

use App\Enums\JobTypes;
use App\Filament\ComponentProvider;
use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $recordTitleAttribute = "title";
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                self::getFormAsWizard()->hiddenOn("view"),
                self::getFormAsSection()->visibleOn("view")
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label("Company name"),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('salary'),
                Tables\Columns\TextColumn::make('description')->words(6),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make("type")->multiple()->options(JobTypes::getCases()),

                Tables\Filters\Filter::make("salary")->form([
                    Forms\Components\TextInput::make("min")->numeric(),
                    Forms\Components\TextInput::make("max")->numeric(),
                ])->query(fn (Builder $query, array $data) => $query->filter(["salary" => $data])),

                Tables\Filters\SelectFilter::make("posting date")->options([
                    "today" => "Today",
                    "week" => "This Week",
                    "month" => "This Month",
                    "year" => "This Year"
                ])->query(fn (builder $query, array $data) => $query->filter(["date" => $data['value']]))
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'view' => Pages\ViewJob::route('/{record}'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            "company" => $record->user->name
        ];
    }

    private static function getFormAsWizard()
    {
        return Forms\Components\Wizard::make([
            Step::make("Ownership and location")->schema([

                Forms\Components\Select::make('company')
                    ->required()
                    ->relationship("user", "name"),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
            ]),
            Step::make('job Information')->schema([

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),


                Forms\Components\Select::make('type')
                    ->required()
                    ->options(JobTypes::getCases()),
                Forms\Components\TextInput::make('salary')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('criteria')->label("criteria (seperated by coma)"),
            ]),
            Step::make("Job required skills")->schema([
                Forms\Components\Select::make("skills")->relationship("skills", "name")->multiple()
            ])
        ]);
    }

    private static function getFormAsSection()
    {
        return Tabs::make("job")->schema([

            Tab::make('job Information')->schema([

                TextInput::make('title')
                    ->maxLength(255),

                TextInput::make('type'),

                TextInput::make('salary'),

                TextInput::make('country'),

                TextInput::make('city'),

                Select::make("skills")->relationship("skills", "name")->multiple(),

                Textarea::make('criteria'),

                Textarea::make('description'),

            ]),
            Tab::make("Owner information")->schema([

                TextInput::make('company.id'),
                TextInput::make('company.name'),
                TextInput::make('company.email'),
                TextInput::make('company.profile.country'),
                TextInput::make('company.profile.job')->label("Industry"),

                ComponentProvider::formatedDate(TextInput::make('company.created_at')->label("Joined at")),


            ]),
        ])->visibleOn("view");
    }
}
