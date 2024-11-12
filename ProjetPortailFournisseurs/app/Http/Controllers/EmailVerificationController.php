<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function show(){
        return view('auth.verify-email');
    }
}
