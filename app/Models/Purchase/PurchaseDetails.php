<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medicine\Medicine;
use App\Models\Supplier\Supplier;

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
        'net_vat',
        'net_tp',
        'net_discount',
        'net_amount',
        'expire_date',
        'user_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'medicine_id','id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class,'purchase_id','id');
    }
}
