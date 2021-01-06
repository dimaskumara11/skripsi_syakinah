<?php

namespace App\Http\Controllers;

use App\Models\DataSupplierModel;
use App\Models\RequestOrderModel;
use App\Models\RequestProductModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Request_Order extends Controller
{
    public function list(){
        session(["active_menu"=>"request_order"]);
        $data = array(
            "request_order_0" => RequestOrderModel::leftJoin("supplier","supplier.id_supplier","=","request_order.id_supplier")->orderBy("id_request_order","DESC")->where("status",0)->get(),
            "request_order_1" => RequestOrderModel::leftJoin("supplier","supplier.id_supplier","=","request_order.id_supplier")->orderBy("id_request_order","DESC")->where("status",1)->get()
        );
        return view('page.request_order.list',$data);
    }
    public function form($id=0){
        $data = array(
            'post' => 'insert',
            'data_supplier' => DataSupplierModel::all(),
            'data_request_product' => array()
        );

        if(!empty($id)){
            $data["data_request_order"] = RequestOrderModel::find($id);
            $data["data_request_product"] = RequestProductModel::where("id_request_order",$id)->get();
            $data["post"] = 'update';
        }

        return view('page.request_order.form',$data);
    }
    public function insert(Request $request){
        $request->validate([
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
            $insert = RequestOrderModel::create($data_post);
            $insert->save();
            if(!empty($insert->id_request_order)){
                $desc = $request->post('description');
                $qty = $request->post('qty');
                if(!empty($desc)){
                    $data_array = [];
                    foreach ($desc as $key => $value) {
                        $data_array[] = array(
                            "description" => $desc[$key],
                            "qty" => $qty[$key]??0,
                            "id_request_order" => $insert->id_request_order
                        );
                    }

                    if(!empty($data_array)){
                        RequestProductModel::insert($data_array);
                        $status = "success";
                        $message = "Tambah data berhasil";
                        DB::commit();
                    }else{
                        $status = "error";
                        $message = "Tambah data gagal, cek inputan data kamu";
                        DB::rollBack();
                    }
                }else{
                    $status = "error";
                    $message = "Tambah data gagal, cek inputan data kamu";
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
        return redirect(route("cpanel.request_order"))
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
}
