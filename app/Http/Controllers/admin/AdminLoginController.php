<?php

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/'; 

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }



    protected function guard()
    {
        return Auth::guard('admin'); // separate guard for admin authentication
    }
}