<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Enums\JobTypes;
use App\Filament\Resources\JobResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJob extends EditRecord
{
    protected static string $resource = JobResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data["criteria"] =  is_array($data["criteria"])
            ? json_encode($data["criteria"])
            : json_encode(explode(",", $data['criteria']));

        $data["type"] = JobTypes::getDefiner($data['type']);

        return  $data;
    }
}
