<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'project_id';

    // public function todos()
    // {
    //     return $this->hasMany(Todo::class, 'project_project_id', 'project_id');
    // }
}
