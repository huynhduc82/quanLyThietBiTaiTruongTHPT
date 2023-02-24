<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function test()
    {
        $name = 'Đức';
        Mail::send('emails.test', compact('name'), function ($email) use($name){
            $email->subject('Test Mail');
            $email->to('danghuynhduc123@gmail.com','Tố Vân');
        });
    }
}
