<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Functions that states the relationship of Type with Project
    // and create the connection between this entity data
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
