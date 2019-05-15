<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleDescription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schedule_descriptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'schedule_time_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the time from the description
     */
    public function schedule()
    {
        return $this->belongsTo('App\ScheduleTime');
    }
}
