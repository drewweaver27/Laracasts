<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class ContactController extends Controller
{
    public function show(){
        return view ('contact');
    }

    public function store(){
        //send email
        request()->validate(['email' => 'required|email']);

        // Mail::raw('It works!', function ($message){
        //     $message->to(request('email'))
        //             ->subject("Hello There");
        // });

        Mail::to(request('email'))
            ->send(new Contact);

        return redirect('/contact')
            ->with('message', 'Email Sent');
    }
}
