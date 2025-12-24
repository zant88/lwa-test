<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-email', function(){
    Mail::raw('Test email content', function ($message) {
        $message->to('merahputihnus@gmail.com')
                ->subject('Test Email');
    });
    
    return 'Email sent!';
});
