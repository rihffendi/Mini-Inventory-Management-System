<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'payment_date', 'payment_type','paid','details',
    ];
}
