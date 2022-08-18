<?php

namespace App\Models\Supplier;

use App\Models\Purchase\Purchase;
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
        'total_amount',
        'paid_amount',
        'due',
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
