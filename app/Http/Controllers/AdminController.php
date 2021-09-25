<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller


{
    //set middleware permission

    public function __construct()
    {
        $this->middleware('guest')->except('showAdminDashboard');
    }

    function showAdminLogin(){

        return view('admin.login');
    }
    function showAdminRegister(){

        return view('admin.register');
    }
    function showAdminDashboard(){

        return view('admin.dashboard');
    }
}
