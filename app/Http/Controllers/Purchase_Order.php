<?php

namespace App\Http\Controllers;

use App\Models\DataSupplierModel;
use App\Models\PurchaseOrderModel;
use App\Models\PurchaseProductModel;
use App\Models\RequestOrderModel;
use App\Models\RequestProductModel;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Purchase_Order extends Controller
{
    public function list(){
        session(["active_menu"=>"purchase_order"]);
        $data = array(
            "request_order_0" => RequestOrderModel::leftJoin("supplier","supplier.id_supplier","=","request_order.id_supplier")->where("status",0)->orderBy("id_request_order","DESC")->get(),
            "request_order_1" => RequestOrderModel::leftJoin("supplier","supplier.id_supplier","=","request_order.id_supplier")->where("status",1)->orderBy("id_request_order","DESC")->get()
        );
        return view('page.purchase_order.list',$data);
    }
    public function form($id=0){

        if(!empty($id)){
            $data = array(
                'post' => 'insert',
                'data_request_product' => array()
            );
            $data["data_request_product"] = RequestProductModel::where("id_request_order",$id)->get();
            $data["post"] = 'insert';
            $data["id"] = $id;
            return view('page.purchase_order.form',$data);
        }else{
            return redirect(route('cpanel.purchase_order'));
        }

    }
    public function insert(Request $request){
        $request->validate([
            'no_purchase_order' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $data_post = array(
                'no_purchase_order' =>  $request->post("no_purchase_order"),
                'tanggal_purchase_order' => Carbon::now()
            );
            $insert = PurchaseOrderModel::create($data_post);
            $insert->save();
            if(!empty($insert->id_purchase_order)){
                $id = $request->post('id_request_order');
                $unit_price = $request->post('unit_price');
                $amount = $request->post('amount');
                $productRequest = RequestProductModel::where("id_request_order",$id)->get();
                $data_array = [];
                foreach ($productRequest as $key => $value) {
                    $data_array[] = array(
                        "unit_price" => $unit_price[$value->id_request_product],
                        "amount" => $amount[$value->id_request_product]??0,
                        'id_purchase_order' =>  $insert->id_purchase_order,
                        "id_request_product" => $value->id_request_product
                    );
                }

                if(!empty($data_array)){
                    PurchaseProductModel::insert($data_array);
                    $productRequest = RequestOrderModel::where("id_request_order",$id)->update(array("status"=>1));
                    $status = "success";
                    $message = "Tambah data berhasil";
                    DB::commit();
                }else{
                    $status = "error";
                    $message = "Tambah data gagal 1, cek inputan data kamu";
                    DB::rollBack();
                }
            }else{
                $status = "error";
                $message = "Tambah data gagal, cek inputan data kamu";
                DB::rollBack();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = "error";
            $message = "Update data gagal, cek source code kamu". $th->getMessage();
        }
        return redirect(route("cpanel.purchase_order"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function update(Request $request){
        $request->validate([
            'id_request_order' => 'required',
            'no_request_order' => 'required',
            'supplier' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $data_post = array(
                'no_request_order' =>  $request->post("no_request_order"),
                'id_supplier' =>  $request->post("supplier"),
                'status' => 0,
                'tanggal_request' => Carbon::now()
            );
            $insert = RequestOrderModel::where("id_request_order",$request->post("id_request_order"))->update($data_post);
            if($insert){
                $desc = $request->post('description');
                $qty = $request->post('qty');
                if(!empty($desc)){
                    $data_array = [];
                    foreach ($desc as $key => $value) {
                        $data_array[] = array(
                            "description" => $desc[$key],
                            "qty" => $qty[$key]??0,
                            "id_request_order" => $request->post("id_request_order")
                        );
                    }

                    if($data_array)
                        RequestProductModel::insert($data_array);

                    $status = "success";
                    $message = "Update data berhasil";
                    DB::commit();
                }else{
                    $status = "error";
                    $message = "Update data gagal, cek inputan data kamu";
                    DB::rollBack();
                }
            }else{
                $status = "error";
                $message = "Update data gagal, cek inputan data kamu";
                DB::rollBack();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = "error";
            $message = "Update data gagal, cek source code kamu". $th->getMessage();
        }
        return redirect(route("cpanel.request_order"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function delete($id=0){
        DB::beginTransaction();
        try {
            $insert = RequestOrderModel::where("id_request_order",$id)->delete();
            if(!empty($insert)){
                $status = "success";
                $message = "Hapus data berhasil";
                DB::commit();
            }else{
                $status = "error";
                $message = "Hapus data gagal";
                DB::rollBack();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = "error";
            $message = "Hapus data gagal, cek source code kamu". $th->getMessage();
        }
        return redirect(route("cpanel.request_order"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function export_pdf(PDF $dompdf,$id=0)
    {
        $data_purchase          = PurchaseOrderModel::where("request_order.id_request_order",$id)
                                            ->leftJoin("request_order","request_order.id_request_order","=","purchase_order.id_request_order")
                                            ->first();
        $data_purchase_product  = PurchaseProductModel::where("purchase_order.id_purchase_order",$data_purchase->id_purchase_order)
                                            ->leftJoin("purchase_order","purchase_order.id_purchase_order","=","purchase_product.id_purchase_order")
                                            ->leftJoin("request_product","request_product.id_request_product","=","purchase_product.id_request_product")
                                            ->get();

        $pdf = $dompdf->loadview('page.purchase_order.pdf',['purchase'=>$data_purchase,'purchase_product'=>$data_purchase_product]);
        return $pdf->stream();
    }
}
