<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        "customer_id",
        "block",
        "sector",
        "plot_no",
        "amount",
        "description",
        "inv",
        "receipt_date",
        "registration_no",
        "marla",
        "account_id",
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}