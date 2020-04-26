<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestNotification;

class NotifyController extends Controller
{
    public function create(){
        return view('notifiers.create');
    }

    public function store(){
        request()->validate(['email' => 'required|email']);
        $email = request('email');
        //Since I'm not using auth, I had to make my notification this way
        Notification::route('mail', $email)->notify(new TestNotification($email));

        return redirect('/');
    }
}
