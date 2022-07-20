<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $table= 'purchase_details';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'purchase_id',
        'supplier_id',
        'medicine_id',
        'qty',
        'supplier_price',
        'vat',
        'total_amount',
        'discount',
        'net_amount',
        'expire_date',
        'user_id',
    ];
}
