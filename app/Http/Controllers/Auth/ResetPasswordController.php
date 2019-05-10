<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo;

    public function __construct()
    {
        if (Auth::check() && Auth::user()->role->id == 1) {
            $this->redirectTo = route('admin.dashboard');
        } else {
            $this->redirectTo = route('user.dashboard');
        }
        $this->middleware('guest');
    }
}
