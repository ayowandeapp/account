<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = ['account_id', 'sub_category_id', 'description', 'payment_date', 'amount', 'type','paycat_id'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}