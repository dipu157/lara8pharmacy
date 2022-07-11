<?php

namespace App\Models\Medicine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine_Type extends Model
{
    use HasFactory;

    protected $table= 'medicine_types';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'code',
        'name',
        'short_name',
        'status',
        'user_id',
    ];
}
