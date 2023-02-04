<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function faculties()
    {
        return $this->hasMany(Facultie::class);
    }
    public function departments()
    {
        return $this->hasManyThrough(Department::class, Facultie::class, 'college_id', 'facultie_id',);
    }
}
