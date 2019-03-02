<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberFunction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'function';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
