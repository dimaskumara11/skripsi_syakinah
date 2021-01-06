<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSupplierModel extends Model
{
    use HasFactory;
    protected $table = "supplier";
    protected $fillable  = ["nama","email","fax","no_telp","up","alamat"];
    protected $primaryKey = "id_supplier";
}
