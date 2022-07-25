<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table= 'sales';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'sale_code',
        'customer_id',
        'refd_doctor_id',
        'payment_type_id',
        'total_amount',
        'p_discount',
        'total_discount',
        'net_amount',
        'paid_amount',
        'due_amount',
        'invoice_no',
        'sale_date',
        'counter',
        'user_id',
    ];
}
