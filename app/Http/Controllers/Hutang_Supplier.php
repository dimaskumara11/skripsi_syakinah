<?php

namespace App\Http\Controllers;

use App\Models\DataSupplierModel;
use App\Models\HakAksesModel;
use App\Models\HutangSupplierModel;
use App\Models\UserModel;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hutang_Supplier extends Controller
{
    public function list(){
        session(["active_menu"=>"hutang_supplier"]);
        $data = array(
            "hutang_supplier" => HutangSupplierModel::leftJoin("supplier","supplier.id_supplier","=","hutang_supplier.id_supplier")->get()
        );
        return view('page.hutang_supplier.list',$data);
    }
    public function form($id=0){
        $data = array(
            'post' => 'insert',
            'supplier' => DataSupplierModel::all()
        );

        if(!empty($id)){
            $data["data_hutang_supplier"] = HutangSupplierModel::find($id);
            $data["post"] = 'update';
        }

        return view('page.hutang_supplier.form',$data);
    }
    public function insert(Request $request){
        $request->validate([
            'no_invoice' => 'required',
            'tgl_invoice' => 'required',
            'tgl_terima_invoice' => 'required',
            'total_tagihan' => 'required',
            'jatuh_tempo' => 'required',
            'supplier' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $data_post = array(
                'no_invoice' => $request->post("no_invoice"),
                'tgl_invoice' => $request->post("tgl_invoice"),
                'tgl_terima_invoice' => $request->post("tgl_terima_invoice"),
                'total_tagihan' => $request->post("total_tagihan"),
                'jatuh_tempo' => $request->post("jatuh_tempo"),
                'status_pembayaran' => $request->post("status_pembayaran")??0,
                'id_supplier' => $request->post("supplier")
            );
            $insert = HutangSupplierModel::create($data_post);
            $insert->save();
            if(!empty($insert->id_hutang_supplier)){
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
            $message = "Tambah data gagal, cek source code kamu". $th->getMessage();
        }
        return redirect(route("cpanel.hutang_supplier"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function update(Request $request){
        $request->validate([
            'no_invoice' => 'required',
            'tgl_invoice' => 'required',
            'tgl_terima_invoice' => 'required',
            'total_tagihan' => 'required',
            'jatuh_tempo' => 'required',
            'supplier' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $data_post = array(
                'no_invoice' => $request->post("no_invoice"),
                'tgl_invoice' => $request->post("tgl_invoice"),
                'tgl_terima_invoice' => $request->post("tgl_terima_invoice"),
                'total_tagihan' => $request->post("total_tagihan"),
                'jatuh_tempo' => $request->post("jatuh_tempo"),
                'status_pembayaran' => $request->post("status_pembayaran")??0,
                'id_supplier' => $request->post("supplier")
            );
            $insert = HutangSupplierModel::where("id_hutang_supplier",$request->post("id_hutang_supplier"))->update($data_post);
            if($insert){
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
        return redirect(route("cpanel.hutang_supplier"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function delete($id=0){
        DB::beginTransaction();
        try {
            $insert = HutangSupplierModel::where("id_hutang_supplier",$id)->delete();
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
        return redirect(route("cpanel.hutang_supplier"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function export_pdf(PDF $dompdf,$id=0)
    {
        $data_supplier = HutangSupplierModel::leftJoin("supplier","supplier.id_supplier","=","hutang_supplier.id_supplier")->where("id_hutang_supplier",$id)->get();

        $pdf = $dompdf->loadview('page.hutang_supplier.pdf',['supplier'=>$data_supplier]);
        return $pdf->stream();
    }
}
