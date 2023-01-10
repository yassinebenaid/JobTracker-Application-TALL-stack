<?php

namespace App\Filament\Resources;

use App\Enums\ReportReasons;
use App\Filament\ComponentProvider;
use App\Filament\Resources\JobReportResource\Pages;
use App\Filament\Resources\JobReportResource\RelationManagers;
use App\Models\Job;
use App\Models\Report;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationGroup = "Reports";

    protected static ?string $modelLabel = "Jobs reports";

    protected static ?string $slug = "job-reports";

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereReportableType(Job::class);
    }


    public static function form(Form $form): Form
    {
        return  $form
            ->schema([
                Tabs::make("Report")->schema([
                    Tab::make('Report')->schema(
                        self::getReportSection(),
                    ),
                    Tab::make('Job')->schema([
                        TextInput::make('job.id')->label("Job id"),
                        TextInput::make('job.title'),
                        TextInput::make('job.country'),
                        TextInput::make('job.city'),
                        TextInput::make('job.type'),
                        TextInput::make('job.salary'),
                        Textarea::make('job.description'),
                        DateTimePicker::make('job.created_at')->label('Posted at'),
                    ]),

                    Tab::make("Job Owner")->schema([
                        Forms\Components\TextInput::make("job-owner.id"),
                        Forms\Components\TextInput::make("job-owner.name"),
                        Forms\Components\TextInput::make("job-owner.email"),
                        ComponentProvider::DateInput("job-owner.created_at"),
                    ])
                ])

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reporter.name'),
                Tables\Columns\TextColumn::make("reported_job.title")->label('Reported job title'),
                ComponentProvider::ReportReasonColumn("job"),
                Tables\Columns\TextColumn::make('info')->label("Message"),
                ComponentProvider::DateColumn("created_at", "Reported at"),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListJobReports::route('/'),
            'view' => Pages\ViewJobReport::route('/{record}'),
        ];
    }

    public static function getReportSection(): array
    {
        return [
            Forms\Components\TextInput::make("reporter")->label('Reporter'),
            Forms\Components\TextInput::make('reason')->label("Report reason"),
            Forms\Components\Textarea::make('info')->label("Details"),
            ComponentProvider::DateInput("created_at", "Reported at")

        ];
    }
}
