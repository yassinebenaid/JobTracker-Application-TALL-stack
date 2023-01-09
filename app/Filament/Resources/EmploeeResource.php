<?php

namespace App\Filament\Resources;

use App\Enums\Roles;
use App\Filament\ComponentProvider;
use App\Filament\Resources\EmploeeResource\Pages;
use App\Filament\Resources\EmploeeResource\RelationManagers;
use App\Models\Emploee;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid as ComponentsGrid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class EmploeeResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = "users";

    protected static ?string $modelLabel = "emloees";

    protected static ?string $slug = "emloees";

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->role(Roles::EMPLOEE->value);
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
                            ->maxLength(255),

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
                            ->visibleOn("view")
                            ->default(null)
                            ->hidden(fn (?User $record) => !$record?->is_verified),
                    ]),
                    Tab::make("more")->schema([
                        Forms\Components\TextInput::make('profile.job')
                            ->required()
                            ->maxLength(255)
                            ->label("job title"),

                        Forms\Components\TextInput::make('profile.country')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\DatePicker::make('profile.birthday')
                            ->required(),

                        Forms\Components\TextInput::make('profile.degree')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\DatePicker::make('profile.degree_year')
                            ->required(),

                        Forms\Components\TextInput::make('profile.experience_years')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('profile.school')
                            ->required()
                            ->maxLength(255),


                        Forms\Components\Select::make('skills')
                            ->multiple()
                            ->relationship("skills", "name"),

                        Forms\Components\Textarea::make('profile.bio')
                            ->label("bio"),

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
            ->filters([])
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
            'index' => Pages\ListEmploees::route('/'),
            'create' => Pages\CreateEmploee::route('/create'),
            'view' => Pages\ViewEmploee::route('/{record}'),
            'edit' => Pages\EditEmploee::route('/{record}/edit'),
        ];
    }
}
