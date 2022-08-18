<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier\Supplier;
use App\Models\Supplier\SupplierPayment;

class Purchase extends Model
{
    use HasFactory;

    protected $table= 'purchase';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'purchase_code',
        'supplier_id',
        'invoice_no',
        'purchase_date',
        'details',
        'total_amount',
        'total_vat',
        'total_discount',
        'net_payable',
        'user_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

}
