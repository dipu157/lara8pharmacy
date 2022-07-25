<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    use HasFactory;

    protected $table= 'sales_details';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'sales_id',
        'medicine_id',
        'qty',
        'mrp',
        'discount',
        'sales_rate',
        'total_price',
        'user_id',
    ];
}
