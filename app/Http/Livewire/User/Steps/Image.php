<?php

namespace App\Http\Livewire\User\Steps;

use Livewire\WithFileUploads;
use Spatie\LivewireWizard\Components\StepComponent;


class Image extends StepComponent
{
    use WithFileUploads;

    public $image;
    public $username = '';


    protected $rules = [
        "image" => "image|max:5000"
    ];

    public function mount()
    {
        $this->username =  session("profile.personal-info.name");
    }

    public function updatedImage()
    {
        $this->validate();
    }

    public function save()
    {

        $image = $this->image?->store("images", "public");

        session()->put("profile.image", $image);

        $this->nextStep();
    }




    public function render()
    {
        return view('livewire.user.steps.image');
    }
}
