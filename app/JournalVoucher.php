<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalVoucher extends Model
{
    protected $fillable = ['date', 'description', 'amount'];
}