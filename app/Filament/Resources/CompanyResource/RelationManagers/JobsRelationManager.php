<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use App\Filament\ComponentProvider;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobsRelationManager extends RelationManager
{
    protected static string $relationship = 'jobs';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),

                TextColumn::make('type'),

                TextColumn::make('salary'),

                TextColumn::make('country'),

                TextColumn::make('city'),

                ComponentProvider::DateColumn('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make("view")->url(fn (Job $record) => route('filament.resources.jobs.view', $record->id))->color("secondary")->icon("heroicon-s-eye")
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
