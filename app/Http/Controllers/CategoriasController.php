<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use Redirect;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $data = [
        'categorias' => Categorias::orderBy('orden')->get()
      ];
      // return $data;
      return view('Plataforma.Categorias.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $datos = new Categorias();
      $pos = [];
      for ($i=1; $i <= count(Categorias::all()) + 1 ; $i++) {
        $pos[$i] = $i;
      }
      $data = [
        'categoria' => $datos,
        'posiciones' => $pos,
      ];
      // return $data;
      return view('Plataforma.Categorias.save')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      $inputs = request()->validate([
        'nombre' => 'required|min:3',
        'orden' => 'required',
        'mostrar' => 'required'
      ]);
      $categoriesSameOrder = Categorias::where('orden', $inputs['orden'])->get();
      if(count($categoriesSameOrder) > 0){
        foreach ($categoriesSameOrder as $cat) {
          $cat->orden = count(Categorias::all()) + 1 ;
          $cat->save();
        }
      }
      if(Categorias::create($inputs)){
        session()->flash('success','Category created!');
        return Redirect::to('Plataforma/Categorias');
      }else{
        session()->flash('notice','An error occurred when creating the category, try again!');
        return Redirect::to('Plataforma/Categorias');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
      return "Jedis trabajando, la fuerza está contigo! {{show}}";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
      $pos = [];
      for ($i=1; $i <= count(Categorias::all()) ; $i++) {
        $pos[$i] = $i;
      }
      $data = [
        'categoria' => Categorias::findOrFail($id),
        'posiciones' => $pos,
      ];
      return view('Plataforma.Categorias.save')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $categoria = Categorias::findOrFail($id);
      $inputs = request()->validate([
        'nombre' => 'required|min:3',
        'orden' => 'required',
        'mostrar' => 'required'
      ]);
      $categoriesSameOrder = Categorias::where('orden', $inputs['orden'])->get();
      if(count($categoriesSameOrder) > 0){
        foreach ($categoriesSameOrder as $cat) {
          $cat->orden = $categoria['orden'];
          $cat->save();
        }
      }
      if($categoria->update($inputs)){
        session()->flash('success','Category updated!');
        return Redirect::to('Plataforma/Categorias');
      }else{
        session()->flash('notice','An error occurred when updating the category, try again!');
        return Redirect::to('Plataforma/Categorias');
      }
    }

    public function changeVisibility($id){//Método que cambia la visibilidad de la categoria
      $categoria = Categorias::findOrFail($id);
      if($categoria->mostrar == "1"){
        $categoria->mostrar = "0";
      }else{
        $categoria->mostrar = "1";
      }
      if($categoria->save()){
        return ['save' => true];
      }else{
        return ['save' => false];
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $categoria = Categorias::findOrFail($id);
      $categoria->productos;
      $categoria->subcategorias;
      if(count($categoria['productos'])>0 || count($categoria['subcategorias'])> 0){
        session()->flash('success','Category deleted, There are still products or subcategories assigned to the category eliminated!');
      }else{
        session()->flash('success','Category deleted!');
      }
      $categoria->delete();
      return Redirect::to('Plataforma/Categorias');
    }
}
