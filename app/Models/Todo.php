<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $primaryKey = 'todo_id';
    protected $guarded = [];


    public function getStatusTextAttribute()
    {
        if ($this->status == 1) {
            return 'Pending';
        } else {
            return 'Completed';
        }
    }

    //Defining Status 

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
}
