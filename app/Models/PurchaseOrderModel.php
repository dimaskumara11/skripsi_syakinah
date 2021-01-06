<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderModel extends Model
{
    use HasFactory;
    protected $table = "purchase_order";
    protected $fillable  = ["no_purchase_order","tanggal_purchase_order"];
    protected $primaryKey = "id_purchase_order";
}
