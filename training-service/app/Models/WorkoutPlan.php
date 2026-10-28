<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    protected $primaryKey = 'plan_id';

    protected $fillable = ['member_id', 'trainer_id', 'title', 'goal', 'exercises', 'start_date'];
}
