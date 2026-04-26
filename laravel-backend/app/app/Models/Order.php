<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'date',
        'time',
        'customer_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
