<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_no', 'supplier_id', 'status','date','grand_total',
    ];
}
