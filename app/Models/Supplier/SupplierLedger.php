<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier\Supplier;

class SupplierLedger extends Model
{
    use HasFactory;

    protected $table= 'supplier_ledger';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'supplier_id',
        'total_amount',
        'paid',
        'due',
        'user_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
}
