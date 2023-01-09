<?php

namespace App\Filament\Resources\EmploeeResource\Pages;

use App\Filament\Resources\EmploeeResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmploee extends EditRecord
{
    protected static string $resource = EmploeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['profile'] = $this->getRecord()->profile;
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->getRecord()->profile->fill($data["profile"])->save();
        return $data;
    }
}
