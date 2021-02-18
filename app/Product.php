<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_name','sub_category_name','product_code','alert_quantity','product_cost','product_price','tax','product_details',
    ];

}
