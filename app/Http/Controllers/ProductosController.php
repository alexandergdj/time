<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Req;

use Request;
use File;
use App\Productos;
use App\Categorias;
use App\Subcategorias;
use App\Imagenes;
use Redirect;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $data = [
        'productos' => Productos::all()
      ];
      foreach ($data['productos'] as $producto) {
        $producto->categoria;
        $producto->subcategoria;
        $producto->imagenes;
      }
      // return $data;
      return view('Plataforma.Productos.index')->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $datos = new Productos();
      $pos = [];
      for ($i=1; $i <= count(Productos::all()) + 1 ; $i++) {
        $pos[$i] = $i;
      }
      $data = [
        'producto' => $datos,
        'categorias' => Categorias::all()->pluck('nombre','id_categoria'),
        'subcategorias' => Subcategorias::all()->pluck('nombre','id_subcategoria'),
        'posiciones' => $pos,
        'categoriasWP' => Categorias::all()
      ];
      foreach (Categorias::all() as $categoria) {
        $data = array_add($data, "sub_".$categoria['id_categoria'], Subcategorias::where("id_categoria",(int)$categoria['id_categoria'])->orderBy('nombre','asc')->pluck('nombre', 'id_subcategoria'));
      }
      // return $data;
      return view('Plataforma.Productos.save')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(){
      $inputs = request()->validate([
        'codigo' => 'required|min:3',
        'nombre' => 'required|min:4',
        'precio' => 'required|numeric',
        'descripcion' => 'required|min:5',
        'id_categoria' => 'required|numeric',
        'id_subcategoria' => 'required|numeric',
        'mostrar' => 'required',
        'imagenes.*' => 'image|mimes:jpeg,png,jpg|required'
      ]);
      $files=request()->file('imagenes');
      $productPath='images/productos/';
      if($files && count($files)>0){
        $producto = Productos::create($inputs);

        $productSamePos = Productos::where('orden', $inputs['orden'])->get();
        if(count($productSamePos) > 0){
          foreach ($productSamePos as $prod) {
            $prod->orden = count(Productos::all()) + 1 ;
            $prod->save();
          }
        }

        foreach ($files as $file) {
          $pic['src']="";
          $pic['id_producto']=$producto->id_producto;
          $imagen = Imagenes::create($pic);

          $fileName = $imagen->id."imagen.".$file->getClientOriginalExtension();
          if($file->move($productPath, $fileName)){
            $photo_name=$productPath.$fileName;
            $imagen->src = $photo_name;
            $imagen->save();
          }
        }
        session()->flash('success','Product created!');
        return Redirect::to('Plataforma/Productos');
      }else{
        Redirect::back()->withErrors(['imagenes', 'You must upload an image!']);
      }
    }

    public function changeVisibility($id){//Método que cambia la visibilidad del producto
      $producto = Productos::findOrFail($id);
      if($producto->mostrar == "1"){
        $producto->mostrar = "0";
      }else{
        $producto->mostrar = "1";
      }
      if($producto->save()){
        return ['save' => true];
      }else{
        return ['save' => false];
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
      $datos = Productos::findOrFail($id);
      $pos = [];
      for ($i=1; $i <= count(Productos::all()); $i++) {
        $pos[$i] = $i;
      }
      $data = [
        'producto' => $datos,
        'categorias' => Categorias::all()->pluck('nombre','id_categoria'),
        'subcategorias' => Subcategorias::all()->pluck('nombre','id_subcategoria'),
        'posiciones' => $pos,
        'categoriasWP' => Categorias::all()
      ];
      $data['producto']->imagenes;
      foreach (Categorias::all() as $categoria) {
        $data = array_add($data, "sub_".$categoria['id_categoria'], Subcategorias::where("id_categoria",(int)$categoria['id_categoria'])->orderBy('nombre','asc')->pluck('nombre', 'id_subcategoria'));
      }
      // return $data;
      return view('Plataforma.Productos.save')->with($data);
    }

    public function deleteImage($id){
      $imagen = Imagenes::findOrFail($id);
      if(File::exists($imagen['src']) && (File::delete($imagen['src'])) ){
        if($imagen->delete()){
          return ['delete' => 'true'];
        }else{
          return ['delete' => 'false'];
        }
      }else{
        return ['delete' => 'false'];
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $producto = Productos::findOrFail($id);
      $inputs = request()->validate([
        'codigo' => 'required|min:3',
        'nombre' => 'required|min:4',
        'precio' => 'required|numeric',
        'descripcion' => 'required|min:5',
        'id_categoria' => 'required|numeric',
        'id_subcategoria' => 'required|numeric',
        'mostrar' => 'required',
        'imagenes.*' => 'image|mimes:jpeg,png,jpg'
      ]);
      $files=request()->file('imagenes');
      $productPath='images/productos/';
      $producto->fill($inputs)->save();

      
      if($files && count($files)>0){

        foreach ($files as $file) {
          $pic['src']="";
          $pic['id_producto']=$producto->id_producto;
          $imagen = Imagenes::create($pic);

          $fileName = $imagen->id."imagen.".$file->getClientOriginalExtension();
          if($file->move($productPath, $fileName)){
            $photo_name=$productPath.$fileName;
            $imagen->src = $photo_name;
            $imagen->save();
          }
        }
      }
      session()->flash('success','Product updated!');
      return Redirect::to('Plataforma/Productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $producto = Productos::findOrFail($id);
      $producto->imagenes;
      if(count($producto['imagenes'])>0){
        $bandera = true;
        foreach ($producto['imagenes'] as $imagen) {
          if(File::exists($imagen['src']) && (File::delete($imagen['src'])) ){
            $img = Imagenes::findOrFail($imagen['id']);
            $img->delete();
          }else{
            $bandera = false;
          }
        }
        if($producto->delete()){
          if($bandera){
            session()->flash('success','Product deleted!');
          }else{
            session()->flash('success','Product deleted! An error occurred when deleting some images!');
          }
        }else{
          session()->flash('notice','An error occurred when deleting the product, try again!');
        }
      }
      return Redirect::to('Plataforma/Productos');
    }
}
