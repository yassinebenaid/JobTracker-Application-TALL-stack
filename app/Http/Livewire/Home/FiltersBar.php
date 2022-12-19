<?php

namespace App\Http\Livewire\Home;

use App\Services\SkillService;
use Livewire\Component;

class FiltersBar extends Component
{
    public $filters = [
        'keywords' => '',
        "date" => '',
        "types" => [],
        "location" => [
            "country" => '',
            "city" => ''
        ],
        "skills" => [],
        "salary" => [
            "min" => '',
            "max" => '',
        ],
    ];

    public function filter()
    {
        $this->emitTo("home.jobs-list", "filter-mode:on", $this->filters);
    }


    public function getSkillsProperty()
    {
        return SkillService::applyListOfSkills();
    }



    public function render()
    {
        return view('livewire.home.filters-bar');
    }
}
