<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturn extends Model
{
    use HasFactory;

    protected $table= 'sales_return';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'sales_id',
        'customer_id',
        'invoice_no',
        'return_date',
        'total_deduction',
        'counter',
        'user_id',
    ];
}
