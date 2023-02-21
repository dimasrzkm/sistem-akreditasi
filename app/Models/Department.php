<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = [
        'apply_at',
        'assignment_at',
    ];
    public function facultie()
    {
        return $this->belongsTo(Facultie::class);
    }
    
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'assignments');
    }
}
