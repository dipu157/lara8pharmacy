<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table= 'customers';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'customer_code',
        'name',
        'email',
        'address',
        'phone',
        'customer_code',
        'barcode',
        'regular_discount',
        'special_discount',
        'status',
        'user_id',
    ];
}
