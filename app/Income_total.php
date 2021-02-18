<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income_total extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'customer_id', 'outstanding',
    ];
}
