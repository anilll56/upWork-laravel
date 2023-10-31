<?php

namespace App\Http\Controllers;
namespace App\Models;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\FreelancerUser;



    
class UserController extends Controller
{
    /**
* The customer implementation.
*
* @var FreelancerUser
*/
protected FreelancerUser $freelancerUser;

/**
* Create a new controller instance.
*
* @param FreelancerUser  $freelancerUser
* @return void
*/
public function __construct(FreelancerUser $freelancerUser)
{
$this-> freelancerUser = $freelancerUser;
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
    


}
