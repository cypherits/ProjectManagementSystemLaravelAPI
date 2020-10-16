<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGoals extends Model
{
    use HasFactory;
    protected $table = 'project_goals';
    protected $fillable = [
        'project_id', 
        'goal'
    ];
}
