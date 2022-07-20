<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;

    protected $table= 'supplier_payment';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'purchase_id',
        'supplier_id',
        'payment_type__id',
        'bank_id',
        'check_no',
        'issue_date',
        'receiver_name',
        'receiver_contact',
        'paid_amount',
        'user_id',
    ];
}
