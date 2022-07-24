<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturnDetails extends Model
{
    use HasFactory;

    protected $table= 'purchase_return_details';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'return_code',
        'purchase_id',
        'supplier_id',
        'medicine_id',
        'return_qty',
        'deduction_amount',
        'purchase_return_id',
        'user_id',
    ];
}
