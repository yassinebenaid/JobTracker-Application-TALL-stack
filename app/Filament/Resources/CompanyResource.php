<?php

namespace App\Filament\Resources;

use App\Enums\Roles;
use App\Filament\ComponentProvider;
use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Filament\Resources\CompanyResource\RelationManagers\JobsRelationManager;
use App\Filament\Resources\CompanyResource\RelationManagers\ReviewsRelationManager;
use App\Models\Company;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = "users";

    protected static ?string $modelLabel = "companies";

    protected static ?string $slug = "companies";

    protected static ?int $navigationSort = 2;

    protected static ?int $navigationGroupSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->role(Roles::ENTREPRENEUR->value);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make("Emploee info")->tabs([

                    Tab::make("Main Info")->schema([

                        Forms\Components\FileUpload::make('photo')
                            ->avatar(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->unique("users", "name"),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make("password")
                            ->required()
                            ->maxLength(255)
                            ->password()
                            ->visibleOn("create"),

                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->hidden(fn (?User $record) => !$record?->is_verified)
                            ->default(null)
                            ->visibleOn("view"),


                    ]),
                    Tab::make("more")->schema([
                        Forms\Components\TextInput::make('profile.job')
                            ->required()
                            ->maxLength(255)
                            ->label("Industry"),

                        Forms\Components\TextInput::make('profile.country')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('profile.bio')
                            ->required()
                            ->label("About"),
                    ])
                ])

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                ComponentProvider::getDefaultUserColumns()
            )
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ReviewsRelationManager::class,
            JobsRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
