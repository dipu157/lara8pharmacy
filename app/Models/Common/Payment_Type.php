<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_Type extends Model
{
    use HasFactory;

    protected $table= 'payment_types';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'payment_method',
        'status',
        'user_id',
    ];
}
