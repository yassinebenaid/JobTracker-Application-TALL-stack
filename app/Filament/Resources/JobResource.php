<?php

namespace App\Filament\Resources;

use App\Enums\JobTypes;
use App\Filament\ComponentProvider;
use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Filament\Resources\JobResource\Widgets\JobStatsOverview;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
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
    protected static ?string $navigationGroup = 'others';
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static  $record;

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
                Tables\Columns\TextColumn::make('id')->label("#"),
                Tables\Columns\TextColumn::make('user.name')->label("Company name"),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('salary'),
                ComponentProvider::DateColumn("created_at"),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make("type")->multiple()->options(JobTypes::getTypes()),

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
        return
            Card::make([

                Forms\Components\Wizard::make([

                    Step::make('job Information')->schema([

                        Select::make("company")->relationship("user", "name")
                            ->visibleOn("create")
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),


                        Forms\Components\Select::make('type')
                            ->required()
                            ->options(JobTypes::getTypes()),

                        Forms\Components\TextInput::make('salary')
                            ->required()
                            ->numeric()
                            ->mask(fn (Mask $mask) => $mask->pattern("000.000.000")),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(65535),
                        Forms\Components\Textarea::make('criteria')->label("Conditions (seperated by coma)"),
                    ]),

                    Step::make("location")->schema([

                        Forms\Components\TextInput::make('country')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                    ]),

                    Step::make("Job required skills")->schema([
                        Forms\Components\Select::make("skills")->relationship("skills", "name")->multiple()
                    ])
                ])
            ]);
    }


    private static function getFormAsSection()
    {
        return Tabs::make("job")->schema([

            Tab::make('job Information')->schema([

                TextInput::make('id')->label("#"),

                TextInput::make('title'),

                TextInput::make('type'),

                TagsInput::make("skills")->label("Required skills"),

                TextInput::make('salary'),

                TextInput::make('country'),

                TextInput::make('city'),

                KeyValue::make("criteria")
                    ->keyLabel("#")
                    ->valueLabel("condition"),

                Textarea::make('description'),

                ComponentProvider::DateInput('created_at'),

            ]),
            Tab::make("Owner information")->schema([

                TextInput::make('company.id'),
                TextInput::make('company.name'),
                TextInput::make('company.email'),
                TextInput::make('company.profile.country'),
                TextInput::make('company.profile.job')->label("Industry"),

                ComponentProvider::DateInput('company.created_at'),


            ]),
        ])->visibleOn("view");
    }

    public static function getWidgets(): array
    {
        return [
            JobStatsOverview::class
        ];
    }
}
