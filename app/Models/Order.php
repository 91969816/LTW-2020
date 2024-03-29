<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps =false;

    protected $fillable = [
        'customer_id','shipping_name','payment_id','order_total','order_status'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';
}
