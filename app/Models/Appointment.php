<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'course',
        'purpose',
        'department',
        'meeting_mode',
        'online_preference',
        'schedule',
        'time', // Add this line
        'status',
    ];
}    
