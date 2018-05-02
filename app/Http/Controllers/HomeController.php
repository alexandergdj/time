<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use App\User;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $data = [
        'productos' => count(Productos::all()),
        'categorias' => count(Categorias::all()),
        'subcategorias' => count(Subcategorias::all()),
        'usuarios' => count(User::all())
      ];
      // return $data;
      return view('Plataforma.dashboard')->with($data);
    }
}
