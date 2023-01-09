<?php

namespace App\Http\Livewire\User\Steps;

use App\Enums\Roles;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Spatie\LivewireWizard\Components\StepComponent;

class RegisterInformation extends StepComponent
{
    /**
     * typically we use this in views to show the exact view
     *
     * @var [type]
     */
    public $role;


    public function mount()
    {
        $this->role = session("profile.role");
    }

    /**
     * save the whole data from the session
     *
     * @return void
     */
    public function save()
    {
        DB::beginTransaction();

        if (Roles::isEmploee($this->data("role"))) :

            $this->registerProfileFromSession();

            $this->registerUserFromSession();

            $this->registerUserSkillsFromSession();

            auth()->user()->assignRole(Roles::EMPLOEE->value);

        else :

            $this->registerCompanyProfileFromSession();

            $this->registerUserFromSession();

            auth()->user()->assignRole(Roles::ENTREPRENEUR->value);

        endif;

        Db::commit();

        session()->forget("profile");

        return $this->redirect(RouteServiceProvider::HOME);
    }

    /**
     * register the profile data
     *
     * @return void
     */
    private function registerProfileFromSession(): void
    {
        auth()->user()->profile()->updateOrCreate(["id" => auth()->id()], [
            "country" => $this->data("country"),
            "job" => $this->data("job"),
            'birthday' => $this->data("birthday"),
            'experience_years' => $this->data('years_of_expe'),
            "degree" => $this->data("degree"),
            "school" => $this->data("school"),
            "degree_year" => $this->data('degree_year'),
        ]);
    }

    /**
     * register the profile data
     *
     * @return void
     */
    private function registerCompanyProfileFromSession(): void
    {
        auth()->user()->profile()->updateOrCreate(["id" => auth()->id()], [
            "country" => $this->data("country"),
            "job" => $this->data("specification"),
            "bio" => $this->data("about"),
        ]);
    }

    /**
     * register the needed data
     *
     * @return void
     */
    private function registerUserFromSession()
    {
        auth()->user()->update([
            "name" => $this->data('name'),
            "photo" => $this->data('image'),
        ]);
    }

    /**
     * register the skills
     *
     * @return void
     */
    private function registerUserSkillsFromSession()
    {
        if (!empty($this->data("skills")))
            auth()->user()->skills()->sync($this->data('skills'));
    }

    /**
     * get the data from the session to avoid the noice
     *
     * @param string $name
     * @return void
     */
    private function data(string $name)
    {
        if ($data = session("profile.personal-info.{$name}")) return $data;
        if ($data = session("profile.company-info.{$name}")) return $data;
        if ($data = session("profile.education.{$name}")) return $data;
        if ($data = session("profile.job.{$name}")) return $data;
        if ($data = session("profile.{$name}")) return $data;

        return null;
    }
}
