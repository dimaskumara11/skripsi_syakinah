<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesMenuModel extends Model
{
    use HasFactory;
    static function set_akses($variable=0){
        switch ($variable) {
            case 1:
                $data_sess = array(
                    "data_supplier_menu" => 1,
                    "request_order_menu" => 1,
                    "purchase_order_menu" => 1,
                    "hutang_supplier_menu" => 1,
                    "laporan_po_menu" => 1,
                    "atur_user_menu" => 1
                );
                session($data_sess);
                break;
            case 2:
                $data_sess = array(
                    "purchase_order_menu" => 1,
                    "hutang_supplier_menu" => 1,
                    "laporan_po_menu" => 1
                );
                session($data_sess);
                break;
            case 3:
                $data_sess = array(
                    "data_supplier_menu" => 1,
                    "request_order_menu" => 1
                );
                session($data_sess);
                break;
            case 4:
                $data_sess = array(
                    "hutang_supplier_menu" => 1,
                    "laporan_po_menu" => 1,
                );
                session($data_sess);
                break;
            
            default:
                break;
        }
    }
}
