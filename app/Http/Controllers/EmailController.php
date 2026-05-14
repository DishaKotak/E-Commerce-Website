<?php

namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $toEmail = "dishakotak29@gmail.com";
        $message = "hello";
        $subject = "welcome to email";

        $response = Mail::to($toEmail)
            ->send(new welcomeemail($message, $subject));

        dd($response);
    }
}
