<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect([
            [
               'name' => 'reviewer'
            ],
            [
               'name' => 'kepala prodi'
            ],
            [
               'name' => 'lpppm'
            ],
        ]);
   
        $roles->map(function($role) {
            Role::create($role);
        });
    }
}
