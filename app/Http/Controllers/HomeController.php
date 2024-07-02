<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();
         // Check user role and redirect accordingly
         switch ($user->role) {
            case 'admin':
                return redirect('admin/');
            case 'po':
                return redirect('po/');
            case 'dpo':
                return redirect('dpo/');
            default:
                return redirect()->route('login');
        }
    }
}
