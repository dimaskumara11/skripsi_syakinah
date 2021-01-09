<?php

namespace App\Http\Controllers;

use App\Models\DataSupplierModel;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Data_Supplier extends Controller
{
    public function list(){
        session(["active_menu"=>"data_supplier"]);
        $data = array(
            "data_supplier" => DataSupplierModel::all()
        );
        return view('page.data_supplier.list',$data);
    }
    public function form($id=0){
        $data = array(
            'post' => 'insert'
        );

        if(!empty($id)){
            $data["data_supplier"] = DataSupplierModel::find($id);
            $data["post"] = 'update';
        }

        return view('page.data_supplier.form',$data);
    }
    public function insert(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'fax' => 'required',
            'no_telp' => 'required',
            'up' => 'required',
            'alamat' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $data_post = array(
                'nama' =>  $request->post("nama"),
                'email' =>  $request->post("email"),
                'fax' =>  $request->post("fax"),
                'no_telp' =>  $request->post("no_telp"),
                'up' =>  $request->post("up"),
                'alamat' =>  $request->post("alamat")
            );
            $insert = DataSupplierModel::create($data_post);
            $insert->save();
            if(!empty($insert->id_supplier)){
                $status = "success";
                $message = "Tambah data berhasil";
                DB::commit();
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
        return redirect(route("cpanel.data_supplier"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function update(Request $request){
        $request->validate([
            'id_supplier' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'fax' => 'required',
            'no_telp' => 'required',
            'up' => 'required',
            'alamat' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $data_post = array(
                'nama' =>  $request->post("nama"),
                'email' =>  $request->post("email"),
                'fax' =>  $request->post("fax"),
                'no_telp' =>  $request->post("no_telp"),
                'up' =>  $request->post("up"),
                'alamat' =>  $request->post("alamat")
            );
            $insert = DataSupplierModel::where("id_supplier",$request->post("id_supplier"))->update($data_post);
            if(!empty($insert)){
                $status = "success";
                $message = "Update data berhasil";
                DB::commit();
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
        return redirect(route("cpanel.data_supplier"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function delete($id=0){
        DB::beginTransaction();
        try {
            $insert = DataSupplierModel::where("id_supplier",$id)->delete();
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
        return redirect(route("cpanel.data_supplier"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function export_pdf(PDF $dompdf,$id=0)
    {
        $data_supplier = DataSupplierModel::where("id_supplier",$id)->get();

        $pdf = $dompdf->loadview('page.data_supplier.pdf',['supplier'=>$data_supplier]);
        return $pdf->stream();
    }
}
