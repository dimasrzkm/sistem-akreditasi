<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public const IS_REVIEWER = 1;
    public const IS_DEPARTEMENT_HEAD = 2;
    public const IS_LPPPM = 3;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
