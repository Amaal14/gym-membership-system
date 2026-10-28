<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $primaryKey = 'membership_id';

    protected $fillable = ['user_id', 'type', 'start_date', 'end_date', 'status'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // how many months each type gives
    public static $months = ['monthly' => 1, 'quarterly' => 3, 'yearly' => 12];
}
