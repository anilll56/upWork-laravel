<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class EmailController extends Controller
{

    public function sendEmail(Request $req ){
        $jobId= $req->input('jobId');
        $receiverEmail= $req->input('receiverEmail');
        
        $result = DB::table('client-work-table')->where('id', $jobId)->get();
        $data = ['message' => 'Merhaba, bu bir örnek e-postadır.'];
        $title = "Login";
        Mail::to($receiverEmail)->send(new SendMail($title , $result , $data));

    }

    
    public function signUpEmail(Request $req ){
        $email= $req->input('email');
        $userType = $req->input('userType');
        if($userType==="freelancer"){
            $result = DB::table('freelancer-users')->where('email', $email)->get();
        }
        else if($userType==="client"){
            $result = DB::table('client-users')->where('email', $email)->get();
        }

        $data = ['message' => 'Kayıt işlemi başarıyla gerçekleşti .'];
        $title = "Kayıt İşlemi";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }

    public function HiredUser(Request $req ){
        $jobId= $req->input('jobId');
        $result = DB::table('freelancer-work-table')->where('id', $jobId)->get();
        if ($result->count() > 0) {
            $email = $result[0]->email;
        }
        $data = ['message' => 'İşe Alındınız , Tebrikler .'];
        $title = "İş Başvurusu";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }

    public function JobAccepted(Request $req ){
        $jobId= $req->input('jobId');
        $result = DB::table('client-work-table')->where('id', $jobId)->get();
        if ($result->count() > 0) {
            $email = $result[0]->email;
        }
        $data = ['message' => 'İş başvurunuz kabul edildi .'];
        $title = "İş Başvurusu Kabul Edildi";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }

    public function JobRejected(Request $req ){
        $jobId= $req->input('jobId');
        $result = DB::table('client-work-table')->where('id', $jobId)->get();
        if ($result->count() > 0) {
            $email = $result[0]->email;
            
            // Şimdi $email değişkeni içinde email verisine sahipsiniz
        }
        $data = ['message' => 'İş başvurunuz reddedildi .'];
        $title = "İş Başvurusu Reddedildi";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }

    public function JobComplated(Request $req ){
        $jobId= $req->input('jobId');
        $result = DB::table('client-work-table')->where('id', $jobId)->get();
        if ($result->count() > 0) {
            $email = $result[0]->email;
        }
        $data = ['message' => 'İş başarıyla tamamlandı .'];
        $title = "İş Tamamlandı";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }

    public function PasswordChanged(Request $req ){
        $jobId= $req->input('jobId');
        $result = DB::table('client-work-table')->where('id', $jobId)->get();

        if ($result->count() > 0) {
            $email = $result[0]->email;
        }

        $data = ['message' => 'Şifreniz başarıyla değiştirildi .'];
        $title = "Şifre Değiştirildi";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }

    public function PasswordReset(Request $req ){
        $email= $req->input('email');
        $result = DB::table('client-work-table')->where('email', $email)->get();

        $data = ['message' => 'Şifreniz başarıyla sıfırlandı .'];
        $title = "Şifre Sıfırlandı";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }
    public function JobInvitation(Request $req ){
        $jobId= $req->input('jobId');
        $result = DB::table('client-work-table')->where('id', $jobId)->get();
        if ($result->count() > 0) {
            $email = $result[0]->email;
        }
        $data = ['message' => 'İş davetiyesi gönderildi .'];
        $title = "İş Davetiyesi";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }

    public function waitingForApproval(Request $req ){
        $jobId= $req->input('jobId');
        $result = DB::table('client-work-table')->where('id', $jobId)->get();
        if ($result->count() > 0) {
            $email = $result[0]->email;
        }
        $data = ['message' => 'Kabul etmenizi bekleyen iş başvurusu var'];
        $title = "İş Başvurusu Onay Bekliyor";
        Mail::to($email)->send(new SendMail($title, $data , $result));

    }

}
