<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOrderModel extends Model
{
    use HasFactory;
    protected $table = "request_order";
    protected $fillable  = ["id_supplier","no_request_order","tanggal_request","status"];
    protected $primaryKey = "id_request_order";
}
