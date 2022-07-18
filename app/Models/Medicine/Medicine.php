<?php

namespace App\Models\Medicine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Shelf;
use App\Models\Medicine\Generic;
use App\Models\Medicine\Medicine_Type;
use App\Models\Medicine\Strength;

class Medicine extends Model
{
    use HasFactory;

    protected $table= 'medicine';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'medicine_code',
        'name',
        'shelf_id',
        'supplier_id',
        'batch_no',
        'generic_id',
        'strength_id',
        'medicine_type_id',
        'box_size',
        'box_price',
        'mrp',
        'trade_price',
        'vat',
        'p_discount',
        'u_purchase',
        'details',
        'side_effect',
        'in_stock',
        'short_stock',
        'favourite',
        'is_discount',
        'status',
        'user_id',
    ];

    public function shelf()
    {
        return $this->belongsTo(Shelf::class,'shelf_id','id');
    }

    public function generic()
    {
        return $this->belongsTo(Generic::class,'generic_id','id');
    }

    public function medicine_type()
    {
        return $this->belongsTo(Medicine_Type::class,'medicine_type_id','id');
    }

    public function strength()
    {
        return $this->belongsTo(Strength::class,'strength_id','id');
    }
}
