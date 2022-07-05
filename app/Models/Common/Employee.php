<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table= 'employees';

    protected $guarded = ['id', 'created_at','updated_at'];

    protected $fillable = [
    	'company_id',
        'first_name',
        'last_name',
        'full_name',
        'photo',
        'email',
        'address',
        'city',
        'state',
        'post_code',
        'mobile',
        'dob',
        'gender',
        'blood_group',
        'last_education',
        'national_id',
    ];
}
