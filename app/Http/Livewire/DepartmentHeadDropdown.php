<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Role;
use Livewire\Component;

class DepartmentHeadDropdown extends Component
{
    public $roles;
    public $departments;

    public $selectedRole = NULL;

    public function mount()
    {
        $this->roles = Role::get();
        $this->departments = collect();
    }

    public function render()
    {
        return view('livewire.department-head-dropdown');
    }
}
