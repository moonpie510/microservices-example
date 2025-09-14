<?php

use App\Mail\CustomerCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/mail', function () {
    Mail::to('test@example.com')->send(new CustomerCreated());
});
