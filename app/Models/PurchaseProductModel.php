<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProductModel extends Model
{
    use HasFactory;
    protected $table = "purchase_product";
    protected $fillable  = ["id_purchase_order","id_request_product","unit_price","amount"];
    protected $primaryKey = "id_purchase_product";
}
