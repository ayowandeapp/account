<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name'];

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'customer_id');
    }
}