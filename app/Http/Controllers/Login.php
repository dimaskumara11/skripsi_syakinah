<?php

namespace App\Http\Controllers;

use App\Models\AksesMenuModel;
use App\Models\UserModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function index(){
        return view('login');
    }

    public function post(Request $request, Session $sess){
        $request->validate([
            'username' => 'required|max:100',
            'password' => 'required|max:100'
        ]);

        $data_post = array(
            "username" => $request->post("username"),
            "password" => md5($request->post("password")),
        );
        $check  = UserModel::leftJoin("hak_akses","hak_akses.id_hak_akses","=","user.id_hak_akses")->where($data_post)->first();

        $status = "";
        $message = "";
        if(empty($check)){
            $status = "error";
            $message = "username dan password tidak benar";
            return redirect(route("login"))
                ->with("status", $status)
                ->with("message", $message);
        }elseif($check->active == 0){
            $status = "error";
            $message = "username tidak aktif";
            return redirect(route("login"))
                ->with("status", $status)
                ->with("message", $message);
        }else{
            $sess->flush();
            
            $data = array(
                "id_user" => $check->id_user,
                "username" => $check->username,
                "hak_akses" => $check->nama_hak_akses,
            );
            session($data);
            AksesMenuModel::set_akses($check->id_hak_akses);
            return redirect(route("cpanel.dashboard"));
        }
    }
}
