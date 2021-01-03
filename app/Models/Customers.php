<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    public $timestamps =false;

    protected $fillable = [
        'customers_email','customers_password','customers_name','customers_phone'
    ];

    protected $primaryKey = 'customers_id';
    protected $table = 'tbl_customers';
}
