<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleTime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schedule_time';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time', 'schedule_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the description from the time
     */
    public function descriptions()
    {
        return $this->hasMany('App\ScheduleDescription');
    }

    /**
     * Get the schedule from the time
     */
    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }
}
