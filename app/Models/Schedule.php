<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'startTime',
        'endTime',
        'location',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
