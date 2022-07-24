<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;

    protected $table= 'purchase_return';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'return_code',
        'purchase_id',
        'supplier_id',
        'invoice_no',
        'return_date',
        'total_deduction',
        'user_id',
    ];
}
