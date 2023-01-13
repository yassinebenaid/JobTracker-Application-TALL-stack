<?php

namespace App\Filament\Resources;

use App\Filament\ComponentProvider;
use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers;
use App\Models\Application;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
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

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationGroup = 'others';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make("Application")->schema([
                    Tab::make("Cover")->schema([
                        Forms\Components\TextInput::make('expected_salary')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('cover_letter')
                            ->required()
                            ->maxLength(65535),
                    ])->registerActions([
                        Action::make("test")
                    ]),
                    Tab::make('Job')->schema([
                        TextInput::make("job.id"),
                        TextInput::make("job.title"),
                        TextInput::make("job.salary"),
                        TextInput::make("job.type"),
                        TextInput::make("job.criteria"),
                        Textarea::make("job.description"),
                        ComponentProvider::DateInput("job.created_at", "Posted at"),
                    ]),
                    Tab::make("Emploee")->schema([
                        TextInput::make("emploee.id"),
                        TextInput::make("emploee.name"),
                        TextInput::make("emploee.email"),
                        ComponentProvider::DateInput("emploee.created_at", "Joined at"),
                    ]),
                    Tab::make("Company")->schema([
                        TextInput::make("company.id"),
                        TextInput::make("company.name"),
                        TextInput::make("company.email"),
                        ComponentProvider::DateInput("company.created_at", "Joined at"),
                    ])
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label("#"),
                Tables\Columns\TextColumn::make('emploee.name')->label("From"),
                Tables\Columns\TextColumn::make('company.name')->label("To"),
                Tables\Columns\TextColumn::make('job.title')->label("Job"),
                Tables\Columns\TextColumn::make('expected_salary'),
                ComponentProvider::DateColumn("created_at", "Applied at"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListApplications::route('/'),
            'view' => Pages\ViewApplication::route('/{record}'),
        ];
    }
}
