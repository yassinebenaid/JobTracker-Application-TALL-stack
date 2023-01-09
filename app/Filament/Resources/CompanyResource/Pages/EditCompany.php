<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

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
        $this->getRecord()->profile->fill($data['profile'])->save();
        return $data;
    }
}
