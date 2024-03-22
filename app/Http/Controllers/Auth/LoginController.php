<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    public function authenticated()
    {
        if(Auth::user()->role=='admin')
        {
            return redirect('admin/');
        }
        else if(Auth::user()->role=='po')
        {
            return redirect('po/');
        }
        else if(Auth::user()->role=='dpo')
        {
            return redirect('dpo/');
        }
        else
        {
            return redirect(Auth::user()->role);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
