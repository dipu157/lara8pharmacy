<?php

namespace App\Models\Sales;

use App\Models\Medicine\Medicine;
use App\Models\Sales\Sales;
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
        'sale_rate',
        'total_price',
        'user_id',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'medicine_id','id');
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class,'sales_id','id');
    }
}
