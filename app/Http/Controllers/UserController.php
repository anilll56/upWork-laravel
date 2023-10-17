<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function freelancerUserRegister(Request $req){
        $name = $req->input('name');
        $email = $req->input('email');
        $password = $req->input('password');
        $talent = $req->input('talent');
        $price = $req->input('price');

        $customUserTable = 'freelancer-users';
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'talent' => $talent,
            'stars' => $price,
        ];
        
        DB::table($customUserTable)->insert($data);
        if($data){
            return "başarılı";
        }
        else{
            return "başarısız";
        }
    }

    function clientUserRegister(Request $req){
        $name = $req->input('name');
        $email = $req->input('email');
        $password = $req->input('password');

        $customUserTable = 'client-users';
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];
        
        DB::table($customUserTable)->insert($data);
        if($data){
            return "başarılı";
        }
        else{
            return "başarısız";
        }
    }

    function freelancerUserlogin(Request $req) {
        $email = $req->input('email');
        $password = $req->input('password');
        $customUserTable = 'freelancer-users';
        $user = DB::table($customUserTable)->where('email', $email)->first();
        
        if (!$user) {
            return response()->json(['message' => 'Kullanıcı bulunamadı'], 404);
        }
        
        if (!password_verify($password, $user->password)) {
            return response()->json(['message' => 'Şifre uyuşmuyor', $user], 401);
        }
        
        return response()->json(['message' => 'Giriş başarılı'], 200);
    }

    function clienUserLogin(Request $req) {
        $email = $req->input('email');
        $password = $req->input('password');
        $customUserTable = 'client-users';
        $user = DB::table($customUserTable)->where('email', $email)->first();
        
        if (!$user) {
            return response()->json(['message' => 'Kullanıcı bulunamadı'], 404);
        }
        
        if (!password_verify($password, $user->password)) {
            return response()->json(['message' => 'Şifre uyuşmuyor', $user], 401);
        }
        
        return response()->json(['message' => 'Giriş başarılı'], 200);
    }


}
