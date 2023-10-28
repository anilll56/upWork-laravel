<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserWorkController extends Controller
{
    function OpenClientWork(Request $req){
        $name = $req->input('name');
        $email = $req->input('email');
        $workType = $req->input('work-type');
        $workDescription = $req->input('work-description');
        $workPrice = $req->input('work-price');

        $customUserTable = 'client-work-table';
        $data = [
            'name' => $name,
            'email' => $email,
            'work-type' => $workType,
            'work-description' => $workDescription,
            'work-price' => $workPrice,
        ];
        
        DB::table($customUserTable)->insert($data);
        if($data){
            return response()->json(['message' => 'başarıyla oluşturuldu'], 200);
        }
        else{
            return response()->json(['message' => 'oluşturulamadı'], 404);
        }
    }

    function deleteClientWork(Request $req){
        $id = $req->input('id');
        $customUserTable = 'client-work-table';
        $data = [
            'id' => $id,
        ];
        DB::table($customUserTable)->where('id', $id)->delete();
        if($data){
            return response()->json(['message' => 'başarıyla silindi'], 200);
        }
        else{
            return response()->json(['message' => 'silinemedi'], 404);
        }

    }

    function openFreelancerWork(Request $req){
        $name = $req->input('name');
        $email = $req->input('email');
        $workType = $req->input('work-type');
        $workDescription = $req->input('work-description');
        $workPrice = $req->input('work-price');

        $customUserTable = 'freelancer-work-table';
        $data = [
            'name' => $name,
            'email' => $email,
            'work-type' => $workType,
            'work-description' => $workDescription,
            'work-price' => $workPrice,
        ];
        
        DB::table($customUserTable)->insert($data);
        if($data){
            return response()->json(['message' => 'başarıyla oluşturuldu'], 200);
        }
        else{
            return response()->json(['message' => 'oluşturulamadı'], 404);
        }
    }

    function deleteFreelancerWork(Request $req){
        $id = $req->input('id');
        $customUserTable = 'freelancer-work-table';
        $data = [
            'id' => $id,
        ];
        DB::table($customUserTable)->where('id', $id)->delete();
        if($data){
            return response()->json(['message' => 'başarıyla silindi'], 200);
        }
        else{
            return response()->json(['message' => 'silinemedi'], 404);
        }

    }

    function getTheClientJob(Request $req){
        $customUserTable = 'client-work-table';
        $data = DB::table($customUserTable)->get();
        if($data){
            return response()->json(['message' => 'başarıyla getirildi', 'data' => $data], 200);
        }
        else{
            return response()->json(['message' => 'getirilemedi'], 404);
        }
    }

    function getTheFreelancerJob(Request $req){
        $customUserTable = 'freelancer-work-table';
        $data = DB::table($customUserTable)->get();
        if($data){
            return response()->json(['message' => 'başarıyla getirildi', 'data' => $data], 200);
        }
        else{
            return response()->json(['message' => 'getirilemedi'], 404);
        }
    }

    function getTheClientJobById(Request $req){
        $id = $req->input('id');
        $customUserTable = 'client-work-table';
        $data = DB::table($customUserTable)->where('id', $id)->get();
        if($data){
            return response()->json(['message' => 'başarıyla getirildi', 'data' => $data], 200);
        }
        else{
            return response()->json(['message' => 'getirilemedi'], 404);
        }
    }

    function  getTheFreelancerJobById(Request $req){
        $id = $req->input('id');
        $customUserTable = 'freelancer-work-table';
        $data = DB::table($customUserTable)->where('id', $id)->get();
        if($data){
            return response()->json(['message' => 'başarıyla getirildi', 'data' => $data], 200);
        }
        else{
            return response()->json(['message' => 'getirilemedi'], 404);
        }
    }

    function updateClientWork(Request $req){
        $id = $req->input('id');
        $name = $req->input('name');
        $email = $req->input('email');
        $workType = $req->input('work-type');
        $workDescription = $req->input('work-description');
        $workPrice = $req->input('work-price');

        $customUserTable = 'client-work-table';
        $data = [
            'name' => $name,
            'email' => $email,
            'work-type' => $workType,
            'work-description' => $workDescription,
            'work-price' => $workPrice,
        ];
        DB::table($customUserTable)->where('id', $id)->update($data);
        if($data){
            return response()->json(['message' => 'başarıyla güncellendi'], 200);
        }
        else{
            return response()->json(['message' => 'güncellenemedi'], 404);
        }
    }

    function updateFreelancerWork(Request $req){
        $id = $req->input('id');
        $name = $req->input('name');
        $email = $req->input('email');
        $workType = $req->input('work-type');
        $workDescription = $req->input('work-description');
        $workPrice = $req->input('work-price');

        $customUserTable = 'freelancer-work-table';
        $data = [
            'name' => $name,
            'email' => $email,
            'work-type' => $workType,
            'work-description' => $workDescription,
            'work-price' => $workPrice,
        ];
        DB::table($customUserTable)->where('id', $id)->update($data);
        if($data){
            return response()->json(['message' => 'başarıyla güncellendi'], 200);
        }
        else{
            return response()->json(['message' => 'güncellenemedi'], 404);
        }
    }

    
}
