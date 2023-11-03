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
        $receiverEmail= $req->input('receiverEmail');
    
        $data = ['message' => 'Merhaba, bu bir örnek e-postadır.'];
        Mail::to($receiverEmail)->send(new SendMail($data));

        
        
    }

}
