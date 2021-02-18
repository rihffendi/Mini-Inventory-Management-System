<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_date', 'supplier_id', 'payment_type','paid','details',
    ];
}
