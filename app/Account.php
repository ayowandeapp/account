<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['acc_name', 'acc_type_id'];

    public function accountType()
    {
        return $this->belongsTo(AccountType::class, 'acc_type_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'account_id');
    }
    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'account_id');
    }
}