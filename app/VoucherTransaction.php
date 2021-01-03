<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherTransaction extends Model
{
    protected $fillable = ['journal_voucher_id', 'account_id_debit', 'account_id_credit'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }


    public function voucher()
    {
        return $this->belongsTo(JournalVoucher::class, 'journal_voucher_id');
    }

    public function debitAccount()
    {
        return $this->belongsTo(Account::class, 'account_id_debit');
    }
    public function creditAccount()
    {
        return $this->belongsTo(Account::class, 'account_id_credit');
    }
}