<?php

namespace App\Filament;

use App\Enums\ReportReasons;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class ComponentProvider
{
    public static function DateColumn($name, $label = null)
    {
        return  TextColumn::make($name)
            ->dateTime()
            ->label($label ?? ucfirst(str_replace('_', ' ', $name)))
            ->formatStateUsing(fn ($state) => Carbon::make($state)->format("d-M-Y H:i"));
    }

    public static function DateInput($name, $label = null)
    {
        return  TextInput::make($name)
            ->label($label ?? ucfirst(str_replace('_', ' ', $name)))
            ->formatStateUsing(fn ($state) => Carbon::make($state)->format("d-M-Y H:i"));
    }


    public static function ReportReasonColumn($reported)
    {
        return match ($reported) {

            "job" => TextColumn::make('reason')
                ->formatStateUsing(fn ($state) => ReportReasons::getCase($state)->forJob()),

            "company" => TextColumn::make('reason')
                ->formatStateUsing(fn ($state) => ReportReasons::getCase($state)->forCompany()),
        };
    }

    public static function getDefaultUserColumns(): array
    {
        return ([
            TextColumn::make('id')->label("#")->sortable(),
            TextColumn::make('name')->sortable(),
            TextColumn::make('email'),
            IconColumn::make('is_verified')->boolean(),
            self::DateColumn("created_at", "Joined at")->sortable(),
            self::DateColumn("updated_at", "Last update")->sortable()
        ]);
    }

    public static function getEmailVeificationPageAction($record)
    {
        return match ($record->is_verified) {
            true => Action::make("unverify email")->color("warning")->action(fn () => $record->markEmailAsUnverified()),
            false => Action::make("verify email")->color("success")->action(fn () => $record->markEmailAsVerified()),
        };
    }
}
