<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    protected $primaryKey = 'attendance_id';

    protected $fillable = ['member_id', 'check_in', 'check_out'];
}
