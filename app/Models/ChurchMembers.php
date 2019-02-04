<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChurchMembers extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'church_members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'born_at', 'image', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['born_at'];

}
