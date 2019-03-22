<?php

namespace App\Http\Controllers;

use App\Estado;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Oferta;
use App\Necessidade;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->pessoa == null) {
            return redirect('/user/edit')->with('register', 'Para prosseguir é necessário concluir seu cadastro!');;
        }

        $user = Auth::user();
        $ofertas = Oferta::getRecomendacoes($user->cidade_id);
        $necessidades = Necessidade::getRecomendacoes($user->cidade_id);
        return view('home', ['ofertas' => $ofertas, 'necessidades' => $necessidades]);
    }



}
