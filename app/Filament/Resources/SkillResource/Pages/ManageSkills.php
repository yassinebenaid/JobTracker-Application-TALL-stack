<?php

namespace App\Filament\Resources\SkillResource\Pages;

use App\Filament\Resources\SkillResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSkills extends ManageRecords
{
    protected static string $resource = SkillResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
