<?php

namespace App\Http\Controllers;

use App\Mail\PDMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Mailcontroller extends Controller
{
    //
    public function sendemail(){
        $details=[
            'title'=>'Mail from pizza Delivery',
            'body'=>'Your Pizza order is ordered successfully.'
        ];
        Mail::to("payalkushwah19@gmail.com")->send(new PDmail($details));
        return "Email Sent";
    }
}
