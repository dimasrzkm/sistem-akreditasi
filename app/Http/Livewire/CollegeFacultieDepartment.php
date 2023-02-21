<?php

namespace App\Http\Livewire;

use App\Models\College;
use App\Models\Department;
use App\Models\Facultie;
use Livewire\Component;

class CollegeFacultieDepartment extends Component
{
    public $colleges;
    public $faculties;
    public $departments;

    public $typeDropdowns;

    public $selectedCollege = NULL;
    public $selecteFacultie = NULL;

    public function mount($type = null)
    {
        $this->colleges = College::all();
        $this->faculties = collect();
        $this->departments = collect();

        $this->typeDropdowns = $type;
    }

    public function render()
    {
        return view('livewire.college-facultie-department');
    }

    public function updatedSelectedCollege($college)
    {
        $this->faculties = Facultie::where('college_id', $college)->get();
        $this->selecteFacultie = NULL;
    }

    public function updatedSelecteFacultie($facultie)
    {
        if(!is_null($facultie) && !is_null($this->typeDropdowns)) {
            $this->departments = Department::query()
                                ->whereNull('assignment_at')
                                ->where('facultie_id', $facultie)
                                ->get();
        } else {
            $this->departments = Department::query()
                                ->where('facultie_id', $facultie)
                                ->get();
        }
    }
}
