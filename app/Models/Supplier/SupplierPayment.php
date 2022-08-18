<?php

namespace App\Models\Supplier;

use App\Models\Purchase\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;

    protected $table= 'supplier_payment';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'purchase_id',
        'supplier_id',
        'payment_type_id',
        'bank_id',
        'check_no',
        'issue_date',
        'receiver_name',
        'receiver_contact',
        'paid_amount',
        'user_id',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class,'purchase_id','id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
}
