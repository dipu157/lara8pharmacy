<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer\Customers;

class Customer_ledger extends Model
{
    use HasFactory;

    protected $table= 'customer_ledger';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'customer_id',
        'total_balance',
        'paid',
        'due',
        'user_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class,'customer_id','id');
    }
}
