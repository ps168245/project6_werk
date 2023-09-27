<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->hasRole('klant')) {
                return redirect(route('home'));

            } else {
                return $next($request);
            }
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard');
    }
}
