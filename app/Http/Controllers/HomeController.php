<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * Classe que controla as operações relacionadas à view principal, criada automaticamente pelo Bootstrap Auth Scaffolding
 *
 */
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
        return view('home');
    }
}
