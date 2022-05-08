<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'receive';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '*'
    ];

    public $timestamps = false;


}
