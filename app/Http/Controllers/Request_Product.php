<?php

namespace App\Http\Controllers;

use App\Models\RequestProductModel;
use Illuminate\Http\Request;

class Request_Product extends Controller
{
    public function get_request_order($id=0){
        return RequestProductModel::leftJoin("purchase_product","purchase_product.id_request_product","=","request_product.id_request_product")->where("id_request_order",$id)->get();
    }
    public function get_by_id($id=0){
        return RequestProductModel::where("id_request_product",$id)->first();
    }
    public function update(Request $request){
        $data_input = array(
            "description" => $request->get("description_edit"),
            "qty" => $request->get("qty_edit")??0,
        );
        return RequestProductModel::where("id_request_product",$request->get("id_edit"))->update($data_input);
    }
    public function delete($id=0){
        return RequestProductModel::where("id_request_product",$id)->delete();
    }
}
