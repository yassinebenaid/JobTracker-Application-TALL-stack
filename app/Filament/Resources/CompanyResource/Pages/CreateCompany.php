<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Enums\Roles;
use App\Filament\Resources\CompanyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {

            $user = static::getModel()::create($data);

            $user->profile()->create($data['profile']);

            $user->assignRole(Roles::ENTREPRENEUR->value);

            return $user;
        });
    }
}
