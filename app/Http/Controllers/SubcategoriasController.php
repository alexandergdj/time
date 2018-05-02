<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategorias;
use App\Categorias;
use Redirect;

class SubcategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $data = [
        'subcategorias' => Subcategorias::all()
      ];
      foreach ($data['subcategorias'] as $sub) {
        $sub->categoria;
        $sub->productos;
      }
      // return $data;
      return view('Plataforma.Subcategorias.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $pos = [];
      for ($i=1; $i <= count(Subcategorias::all()) + 1 ; $i++) {
        $pos[$i] = $i;
      }
      $data = [
        'subcategoria' => new Subcategorias(),
        'posiciones' => $pos,
        'categorias' => Categorias::pluck('nombre','id_categoria')
      ];
      return view('Plataforma.Subcategorias.save')->with($data);
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
        'id_categoria' => 'required',
        'mostrar' => 'required'
      ]);
      $subcategoriesSamePos = Subcategorias::where('orden', $inputs['orden'])->get();
      if(count($subcategoriesSamePos) > 0){
        foreach ($subcategoriesSamePos as $sub) {
          $sub->orden = count(Subcategorias::all()) + 1 ;
          $sub->save();
        }
      }
      if(Subcategorias::create($inputs)){
        session()->flash('success','Subcategory created!');
        return Redirect::to('Plataforma/Subcategorias');
      }else{
        session()->flash('notice','An error occurred when creating the category, try again!');
        return Redirect::to('Plataforma/Subcategorias');
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
      for ($i=1; $i <= count(Subcategorias::all()) ; $i++) {
        $pos[$i] = $i;
      }
      $data = [
        'subcategoria' => Subcategorias::findOrFail($id),
        'posiciones' => $pos,
        'categorias' => Categorias::pluck('nombre','id_categoria')
      ];
      return view('Plataforma.Subcategorias.save')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $subcategoria = Subcategorias::findOrFail($id);
      $inputs = request()->validate([
        'nombre' => 'required|min:3',
        'orden' => 'required',
        'mostrar' => 'required',
        'id_categoria' => 'required'
      ]);
      $subcategoriesSamePos = Subcategorias::where('orden', $inputs['orden'])->get();
      if(count($subcategoriesSamePos) > 0){
        foreach ($subcategoriesSamePos as $sub) {
          $sub->orden = $subcategoria['orden'];
          $sub->save();
        }
      }
      if($subcategoria->update($inputs)){
        session()->flash('success','Subcategory updated!');
        return Redirect::to('Plataforma/Subcategorias');
      }else{
        session()->flash('notice','An error occurred when updating the subcategory, try again!');
        return Redirect::to('Plataforma/Subcategorias');
      }
    }

    public function changeVisibility($id){//Método que cambia la visibilidad de la categoria
      $subcategoria = Subcategorias::findOrFail($id);
      if($subcategoria->mostrar == "1"){
        $subcategoria->mostrar = "0";
      }else{
        $subcategoria->mostrar = "1";
      }
      if($subcategoria->save()){
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
      $subcategoria = Subcategorias::findOrFail($id);
      $subcategoria->productos;
      $subcategoria->subcategorias;
      if(count($subcategoria['productos'])>0){
        session()->flash('success','Subcategory deleted, There are still products assigned to the category eliminated!');
      }else{
        session()->flash('success','Subcategory deleted!');
      }
      $subcategoria->delete();
      return Redirect::to('Plataforma/Subcategorias');
    }
}
