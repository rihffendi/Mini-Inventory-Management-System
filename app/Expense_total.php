<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense_total extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'supplier_id', 'outstanding',
    ];
}
