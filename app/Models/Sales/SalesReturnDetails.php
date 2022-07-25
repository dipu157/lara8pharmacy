<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturnDetails extends Model
{
    use HasFactory;

    protected $table= 'sales_return_details';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'sales_return_id',
        'medicine_id',
        'qty',
        'deduct_amount',
        'user_id',
    ];
}
