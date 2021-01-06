<?php

namespace App\Http\Controllers;

use App\Models\DataSupplierModel;
use App\Models\HakAksesModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class User extends Controller
{
    public function list(){
        session(["active_menu"=>"user"]);
        $data = array(
            "user" => UserModel::leftJoin("hak_akses","hak_akses.id_hak_akses","=","user.id_hak_akses")->get()
        );
        return view('page.user.list',$data);
    }
    public function form($id=0){
        $data = array(
            'post' => 'insert',
            'hak_akses' => HakAksesModel::all()
        );

        if(!empty($id)){
            $data["data_user"] = UserModel::find($id);
            $data["post"] = 'update';
        }

        return view('page.user.form',$data);
    }
    public function profile(){
        $data = array(
            'post' => 'update',
            'data_user' => UserModel::where("id_user",session("id_user"))->first()
        );

        return view('page.user.profile',$data);
    }
    public function profile_update(Request $request){
        $request->validate([
            'username' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $check = UserModel::where("username", $request->post("username"))->where("username","!=",$request->post("username_old"))->first();
            if($check->username??""){
                $status = "error";
                $message = "Username Sudah Ada";
                return redirect(route("cpanel.user"))
                    ->with("status", $status)
                    ->with("message", $message);
            }

            $data_post = array(
                'username' =>  $request->post("username")
            );
            if(!empty($request->post("password"))){
                $data_post["password"] = md5($request->post("password"));
            }

            $insert = UserModel::where("id_user",session("id_user"))->update($data_post);
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
        return redirect(route("cpanel.user"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function insert(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'id_hak_akses' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $check = UserModel::where("username", $request->post("username"))->first();
            if($check->username??""){
                $status = "error";
                $message = "Username Sudah Ada";
                return redirect(route("cpanel.user"))
                    ->with("status", $status)
                    ->with("message", $message);
            }

            $data_post = array(
                'username' =>  $request->post("username"),
                'password' =>  md5($request->post("password")),
                'id_hak_akses' =>  $request->post("id_hak_akses"),
                'active' =>  $request->post("active")??0
            );
            $insert = UserModel::create($data_post);
            $insert->save();
            if(!empty($insert->id_user)){
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
        return redirect(route("cpanel.user"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function update(Request $request){
        $request->validate([
            'username' => 'required',
            'id_user' => 'required',
            'id_hak_akses' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $check = UserModel::where("username", $request->post("username"))->where("username","!=",$request->post("username_old"))->first();
            if($check->username??""){
                $status = "error";
                $message = "Username Sudah Ada";
                return redirect(route("cpanel.user"))
                    ->with("status", $status)
                    ->with("message", $message);
            }

            $data_post = array(
                'username' =>  $request->post("username"),
                'id_hak_akses' =>  $request->post("id_hak_akses"),
                'active' =>  $request->post("active")??0
            );
            if(!empty($request->post("password"))){
                $data_post["password"] = md5($request->post("password"));
            }

            $insert = UserModel::where("id_user",$request->post("id_user"))->update($data_post);
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
        return redirect(route("cpanel.user"))
            ->with("status", $status)
            ->with("message", $message);
    }
    public function delete($id=0){
        DB::beginTransaction();
        try {
            $insert = UserModel::where("id_user",$id)->delete();
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
        return redirect(route("cpanel.user"))
            ->with("status", $status)
            ->with("message", $message);
    }
}
