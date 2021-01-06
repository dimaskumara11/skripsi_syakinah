<?php

namespace App\Http\Controllers;

use App\Models\DataSupplierModel;
use Illuminate\Http\Request;
use App\Models\PurchaseProductModel;

class Laporan_PO extends Controller
{
    public function list(Request $request){
        session(["active_menu"=>"laporan_po"]);
        
        $supplier   = DataSupplierModel::all();
        if(!empty($request->post("id_supplier"))){
            $purchase   = PurchaseProductModel::where("id_supplier",$request->post("id_supplier"))
                            ->leftJoin("purchase_order","purchase_order.id_purchase_order","=","purchase_product.id_purchase_order")
                            ->leftJoin("request_order","request_order.id_request_order","=","purchase_order.id_request_order")
                            ->leftJoin("request_product","request_product.id_request_product","=","purchase_product.id_request_product")
                            ->get();
        }
        
        $data = array(
            "supplier" => $supplier,
            "data_purchase" => $purchase??array()
        );
        return view('page.laporan_po.list',$data);
    }
}
