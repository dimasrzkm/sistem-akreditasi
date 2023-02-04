<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultie extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function college()
    {
        return $this->belongsTo(College::class);
    }
    public function departements()
    {
        return $this->hasMany(Department::class);
    }
}
