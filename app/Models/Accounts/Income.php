<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table= 'other_incomes';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'purpose',
        'payment_type_id',
        'description',
        'amount',
        'user_id',
    ];
}
