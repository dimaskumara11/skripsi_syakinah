<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestProductModel extends Model
{
    use HasFactory;
    protected $table = "request_product";
    protected $fillable  = ["id_request_order","description","qty"];
    protected $primaryKey = "id_request_product";
}
