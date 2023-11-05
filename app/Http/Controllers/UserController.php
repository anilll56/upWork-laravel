<?php

namespace App\Http\Controllers;
namespace App\Models;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\FreelancerUser;
use App\Models\ClientUser;



    
class UserController extends Controller
{
/**
* The freelancer user implementation.
*
* @var FreelancerUser
*/
protected FreelancerUser $freelancerUser;

/**
* The client user implementation.
*
* @var ClientUser
*/
protected ClientUser $clientUser;

/**
* Create a new controller instance.
*
* @param FreelancerUser  $freelancerUser
* @param ClientUser  $clientUser
* @return void
*/
public function __construct(FreelancerUser $freelancerUser, ClientUser $clientUser)
{
    $this->freelancerUser = $freelancerUser;
    $this->clientUser = $clientUser;
}

    function getFreelancerUserWorkById(Request $req){
        $id = $req->input('id');
        $customUserTable = 'freelancer-work-table';
        $data = [
            'id' => $id,
        ];
        $user = DB::table($customUserTable)->where('id', $id)->get();
        if($data){
            return response()->json(['message' => 'başarıyla silindi', 'user' => $user], 200);
        }
        else{
            return response()->json(['message' => 'silinemedi'], 404);
        }
} 
function freelancerUserRegister(Request $req) {
    try {
        $name = $req->input('name');
        $email = $req->input('email');
        $password = $req->input('password');
        $talent = $req->input('talent');
        $price = $req->input('price');
        
        $customUserTable = 'freelancer-users';

        // Insert the data into the database
        DB::table($customUserTable)->insert([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'talent' => implode(', ', $talent),
            'price' => $price,
        ]);

        // Attempt to retrieve the newly inserted record
        $freelancerUser = DB::table($customUserTable)->where('email', $email)->first();

        if ($freelancerUser) {
            return "başarılı";
        } else {
            return "başarısız";
        }
    } catch (\Exception $e) {
        return $e->getMessage();
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

    function loginUser (Request $req) {
        $email = $req->input('email');
        $password = $req->input('password');
        $userType = $req->input('userType');

        if($userType == 'freelancer'){
            $user = $this->freelancerUser->findFreelancerUser($email, $password);
        }
        else if($userType == 'client'){
            $user = $this->clientUser->clientUserLogin($email, $password);
        }
        if (!$user) {
            return response()->json(['message' => 'Kullanıcı bulunamadı'], 404);
        }
        else if ($user) {
            return response()->json(['message' => 'Giriş başarılı' , $user ], 200); 
        }
        else{
            return response()->json(['message' => 'Oturum açma başarısız'], 401);
        }
    }

    function freelancerUserlogin(Request $req) {
        $email = $req->input('email');
        $password = $req->input('password');
        $customUserTable = 'freelancer-users';

    
        $freelancerUser = $this->freelancerUser->findFreelancerUser($email, $password);
        
        if (!$freelancerUser) {
            return response()->json(['message' => 'Kullanıcı bulunamadı'], 404);
        }
        
        if (!password_verify($password, $freelancerUser->password)) {
            return response()->json(['message' => 'Şifre uyuşmuyor'], 401);

        } if ($freelancerUser) {
            return response()->json(['message' => 'Giriş başarılı' , $freelancerUser ], 200); 

        }else{
            return response()->json(['message' => 'Oturum açma başarısız'], 401);
        }
    }

    public function clientUserLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $customUserTable = 'client-users';
        $user = DB::table($customUserTable)->where('email', $email)->first();
        $userWorks = DB::table('client-work-table')->where('email', $email)->get();
    
        if (!$user) {
            return response()->json(['message' => 'Kullanıcı bulunamadı'], 404);
        }
    
        if (!password_verify($password, $user->password)) {
            return response()->json(['message' => 'Şifre uyuşmuyor'], 401);
        }
    
        return response()->json(['message' => 'Giriş başarılı'  , $user,  $userWorks], 200);
    }

    public function updateUser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $talent = $request->input('talent');
        $price = $request->input('price');
        $userType = $request->input('userType');
        $customUserTable = 'freelancer-users';
        $ClientTable= 'client-users';
        $data = [];
        if (!empty($name)) {
            $data['name'] = $name;
        }
        if (!empty($email)) {
            $data['email'] = $email;
        }
        if (!empty($talent)) {
            $data['talent'] =  implode(', ', $talent);
        }
        if (!empty($price)) {
            $data['price'] = $price;
        }
        if ($userType == 'freelancer') {
            $user = DB::table($customUserTable)->where('email', $email)->update($data);
            return response()->json(['message' => 'Güncelleme başarılı' , $user], 200);
        } else if ($userType == 'client') {
            $user = DB::table('client-users')->where('email', $email)->update($data);
            return response()->json(['message' => 'Güncelleme başarılı' , $user], 200);
        }
    }

    public function changePassword(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $newPassword = $request->input('newPassword');
        $userType = $request->input('userType');
        $customUserTable = 'freelancer-users';
        $clientTable= 'client-users';
        $data = [];
        if ($userType == 'freelancer') {
            $user = DB::table($customUserTable)->where('email', $email)->first();
            if (!password_verify($password, $user->password)) {
                return response()->json(['message' => 'Şifre uyuşmuyor'], 401);
            } else{
                $data['password'] = Hash::make($newPassword);
                $user = DB::table($customUserTable)->where('email', $email)->update($data);
                return response()->json(['message' => 'Şifre değiştirme başarılı' , $user], 200);
            }
        } else if ($userType == 'client') {
            $user = DB::table('client-users')->where('email', $email)->first();
            if (!password_verify($password, $user->password)) {
                return response()->json(['message' => 'Şifre uyuşmuyor'], 401);
            }
            $data['password'] = Hash::make($newPassword);
            $user = DB::table($clientTable)->where('email', $email)->update($data);
            return response()->json(['message' => 'Şifre değiştirme başarılı' , $user], 200);
        }
    }
    


}
