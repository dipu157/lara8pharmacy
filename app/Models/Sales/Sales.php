<?php

namespace App\Models\Sales;

use App\Models\Common\Doctor;
use App\Models\Common\Payment_Type;
use App\Models\Customer\Customers;
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

    public function customer()
    {
        return $this->belongsTo(Customers::class,'customer_id','id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'refd_doctor_id','id');
    }

    public function payment_type()
    {
        return $this->belongsTo(Payment_Type::class,'payment_type_id','id');
    }
}
