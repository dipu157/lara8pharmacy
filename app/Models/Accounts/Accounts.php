<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $table= 'accounts';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'opening_balance',
        'cash_in_hand',
        'cash_in',
        'cash_out',
        'closing_balance',
        'other_income_id',
        'other_expense_id',
        'user_id',
    ];
}
