<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HutangSupplierModel extends Model
{
    use HasFactory;
    protected $table = "hutang_supplier";
    protected $fillable  = ["id_supplier","no_invoice","tgl_invoice","total_tagihan","tgl_terima_invoice","jatuh_tempo","status_pembayaran"];
    protected $primaryKey = "id_hutang_supplier";
}
