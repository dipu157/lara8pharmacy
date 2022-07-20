<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAccount extends Model
{
    use HasFactory;

    protected $table= 'supplier_account';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'purchase_id',
        'supplier_id',
        'qty',
        'total_amount',
        'paid_amount',
        'due',
        'user_id',
    ];
}
