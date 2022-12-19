<?php

namespace App\Http\Livewire\User\Steps;

use App\Enums\Roles;
use Illuminate\Support\Facades\DB;
use Spatie\LivewireWizard\Components\StepComponent;

class RegisterInformation extends StepComponent
{
    public $role;

    public function mount()
    {
        $this->role = session("profile.role");
    }

    public function save()
    {

        DB::beginTransaction();

        if (session("profile.role") == Roles::EMPLOEE->value) :

            $this->registerProfile([
                ...session("profile.education"),
                ...session("profile.personal-info"),
                ...session("profile.job"),

            ]);

            $this->registerUser([
                ...session("profile.personal-info"),
                "image" => session("profile.image"),
            ]);

            $this->registerUserSkills(session("profile.skills"));

            auth()->user()->assignRole(Roles::EMPLOEE->value);

        else :

            $this->registerProfile([
                ...session("profile.personal-info"),
            ]);
            $this->registerUser([
                ...session("profile.personal-info"),
                "image" => session("profile.image"),
            ]);

            auth()->user()->assignRole(Roles::ENTREPRENEUR->value);

        endif;

        Db::commit();

        session()->forget("profile");

        return $this->redirect("/");
    }

    private function registerProfile(array $data): void
    {
        auth()->user()->profile()->updateOrCreate(["id" => auth()->id()], [
            "country" => $data['country'] ?? null,
            "job" => $data['job'] ?? null,
            'birthday' => $data['birthday'] ?? null,
            'experience_years' => $data['years_of_expe'] ?? null,
            "degree" => $data["degree"] ?? null,
            "school" => $data["school"] ?? null,
            "degree_year" => $data['degree_year'] ?? null,
        ]);
    }

    private function registerUser($data)
    {
        auth()->user()->update([
            "name" => $data['name'] ?? null,
            "photo" => $data['image'] ?? null,
            "is_complete" => true
        ]);
    }


    private function registerUserSkills($data)
    {
        if (!empty($data)) auth()->user()->skills()->sync($data);
    }
}
