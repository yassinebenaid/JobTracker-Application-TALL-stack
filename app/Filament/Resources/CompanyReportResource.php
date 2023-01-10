<?php

namespace App\Filament\Resources;

use App\Filament\ComponentProvider;
use App\Filament\Resources\CompanyReportResource\Pages;
use App\Filament\Resources\CompanyReportResource\RelationManagers;
use App\Models\Report;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class CompanyReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $modelLabel = "Companies Reports";

    protected static ?string $navigationGroup = 'Reports';

    protected static ?string $slug = "company-reports";

    protected static ?string $navigationIcon = 'heroicon-o-collection';


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereReportableType(User::class);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make("Report")->schema([
                    Tab::make("Report")->schema(
                        JobReportResource::getReportSection(),
                    ),

                    Tab::make("Company")->schema([
                        Forms\Components\TextInput::make("company.id"),
                        Forms\Components\TextInput::make("company.name"),
                        Forms\Components\TextInput::make("company.email"),
                        Forms\Components\TextInput::make("company.created_at")
                            ->label('Joined at')
                            ->formatStateUsing(fn ($state) => Carbon::make($state)->format("D d-M-Y  H:i")),
                    ]),
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reporter.name'),
                Tables\Columns\TextColumn::make("reported_company.name")->label('Reported Company Name'),
                ComponentProvider::ReportReasonColumn("company"),
                Tables\Columns\TextColumn::make('info')->label("Message"),
                ComponentProvider::DateColumn("created_at", "Reported at"),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCompanyReports::route('/'),
            'view' => Pages\ViewCompanyReport::route('/{record}'),
        ];
    }
}
