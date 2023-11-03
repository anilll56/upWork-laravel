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
            'work-type' => implode(', ', $workType),
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
            'work-type' => implode(', ', $workType),
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

    function getTheClientJobByEmail(Request $req){
        $email = $req->input('email');
        $customUserTable = 'client-work-table';
        $data = DB::table($customUserTable)->where('email', $email)->get();
        if($data){
            return response()->json(['message' => 'başarıyla getirildi', 'data' => $data], 200);
        }
        else{
            return response()->json(['message' => 'getirilemedi'], 404);
        }
    }

    function  getTheFreelancerJobByEmail(Request $req){
        $email = $req->input('email');
        $customUserTable = 'freelancer-work-table';
        $data = DB::table($customUserTable)->where('email', $email)->get();
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
    
        // Veritabanından mevcut veriyi al
        $existingData = DB::table('client-work-table')->where('id', $id)->first();
    
        // Değişiklik yapılacak verileri belirle
        $data = [];
        if (!empty($name)) {
            $data['name'] = $name;
        }
        if (!empty($workType)) {
            $data['work-type'] = $workType;
        }
        if (!empty($email)) {
            $data['email'] = $email;
        }
        if (!empty($workDescription)) {
            $data['work-description'] = $workDescription;
        }
        if (!empty($workPrice)) {
            $data['work-price'] = $workPrice;
        }
    
        // Verileri güncelle
        if (!empty($data)) {
            DB::table('client-work-table')->where('id', $id)->update($data);
            return response()->json(['message' => 'Başarıyla güncellendi'], 200);
        } else {
            return response()->json(['message' => 'Değişiklik yapılmadı'], 200);
        }
    }

    function updateFreelancerWork(Request $req) {
        $id = $req->input('id');
        $name = $req->input('name');
        $workType = $req->input('work-type');
        $email = $req->input('email');
        $workDescription = $req->input('work-description');
        $workPrice = $req->input('work-price');
    
        // Veritabanından mevcut veriyi al
        $existingData = DB::table('freelancer-work-table')->where('id', $id)->first();
    
        // Değişiklik yapılacak verileri belirle
        $data = [];
    
        if (!empty($name)) {
            $data['name'] = $name;
        }
    
        if (!empty($workType)) {
            $data['work-type'] = $workType;
        }
    
        if (!empty($email)) {
            $data['email'] = $email;
        }
    
        if (!empty($workDescription)) {
            $data['work-description'] = $workDescription;
        }
    
        if (!empty($workPrice)) {
            $data['work-price'] = $workPrice;
        }
    
        // Verileri güncelle
        if (!empty($data)) {
            DB::table('freelancer-work-table')->where('id', $id)->update($data);
            return response()->json(['message' => 'Başarıyla güncellendi'], 200);
        } else {
            return response()->json(['message' => 'Değişiklik yapılmadı'], 200);
        }
    }

    public function HireFreelancer(Request $request)
    {
        // Formdan gelen verileri al
        $jobId = $request->input('jobId');
        $name = $request->input('name');
        $email = $request->input('email');
        $freelancerInfo = $request->input('freelancerInfo');
        
        // Verileri job-applications tablosuna kaydet
        DB::table('job-applications')->insert([
            'jobId' => $jobId,
            'name' => $name,
            'email' => $email,
            'freelancerInfo' => $freelancerInfo,
            'status' => 'pending',
        ]);
        
        DB::table('freelancer-work-table')->where('id', $jobId)->update([
            'hire' => 'true',
        ]);
        
        // Başvuru başarılı bir şekilde eklendiyse kullanıcıyı yönlendirme yapabilirsiniz
        return response()->json(['message' => 'Başarıyla başvuru yapıldı'], 200);
    }

    public function applyForTheJob(Request $request)
    {
        // Formdan gelen verileri al
        $jobId = $request->input('jobId');
        $name = $request->input('name');
        $email = $request->input('email');
        $requesterInfo = $request->input('requesterInfo');
        
        // Verileri job-applications tablosuna kaydet
        DB::table('job-applications')->insert([
            'jobId' => $jobId,
            'name' => $name,
            'email' => $email,
            'requesterInfo' => $requesterInfo,
            'status' => 'pending',
        ]);
        
        DB::table('client-work-table')->where('id', $jobId)->update([
            'work-status' => 'pending',
            "apployed-freelancersInfo" => $requesterInfo,
        ]);
        
        // Başvuru başarılı bir şekilde eklendiyse kullanıcıyı yönlendirme yapabilirsiniz
        return response()->json(['message' => 'Başarıyla başvuru yapıldı'], 200);
    }

    public function pendingJobs(Request $request)
    {
        $email = $request->input('email');
        $status = $request->input('status');
        
        $jobs = DB::table('client-work-table')
        ->where('email', $email)
        ->where('work-status', $status) // Statüye göre filtreleme ekledik
        ->get();    
        
        return response()->json(['message' => 'Başarıyla  getirildi' , $jobs], 200);
    }
    
    
}
