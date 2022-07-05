<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table= 'companies';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
        'name',
        'title',
        'description',
        'address',
        'city',
        'country',
        'website',
        'email',
        'phone',
    ];
}
