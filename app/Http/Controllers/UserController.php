<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use App\User;
use Hash;
use Redirect;
use File;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $data = [
        'users' => User::all()
      ];
      // return $data;
      return view('Plataforma.Usuarios.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $data = [
        'user' => new User()
      ];
      // return $data;
      return view('Plataforma.Usuarios.save')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
      $inputs = request()->validate([
        'name' => 'required|min:4',
        'email' => 'unique:users,email|required',
        'password' => 'required|min:6',
        'imagen' => 'required|mimes:jpeg,jpg,png| max:5000'
      ]);
      $inputs['password'] = Hash::make($inputs['password']);
      if ($request->hasFile('imagen')) {
        if($usuario = User::create($inputs)){
          $file = $request->file('imagen');
          $archive = "";
          $extension = $file->getClientOriginalExtension();
          $id = $usuario->id;
          $archive = "images/usuarios/usuario".$id.".".$extension;
          if($file->move("images/usuarios", $archive)){
            $usuario->imagen = $archive;
            $usuario->save();
            session()->flash('success','Usuario creado.');
          }else{
            session()->flash('notice','Usuario creado, la imagen no cargó.');
          }
          return Redirect::to('Plataforma/Usuarios');
        }else{
          session()->flash('notice','Un error ha surgido creando esta categoria, intenta de nuevo!');
          return Redirect::to('Plataforma/Usuarios');
        }
      }else{
        session()->flash('notice','Es necesario una imagen.');
        return Redirect::to('Plataforma/Usuarios');
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
      $data = [
        'user' => User::findOrFail($id)
      ];
      // return $data;
      return view('Plataforma.Usuarios.save')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $inputs = $request->all();
      $rules = [
        'name' => 'required|min:4',
        'email' => 'required|email'
      ];
      $validar = Validator::make($inputs, $rules);
      if($validar->fails()){
        return Redirect::back()->withInput(request())->withErrors($validar);
      }else{
        $file = $request->file('imagen');
        $usuario = User::findOrFail($id);
        if($file){
          $archive = "";
          $extension = $file->getClientOriginalExtension();
          $id = $usuario->id;
          $archive = "images/usuarios/usuario".$id.".".$extension;
          if($file->move("images/usuarios", $archive)){
            if(strlen($inputs['password']) == 0){
              $dataUser = [
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'imagen' => $archive,
              ];
              $usuario->fill($dataUser)->save();
            }else{
              $dataUser = [
                'name' => $inputs['name'],
                'password' => Hash::make($inputs['password']),
                'email' => $inputs['email'],
                'imagen' => $archive,
              ];
              $usuario->fill($dataUser)->save();
            }
            session()->flash('success','Usuario actualizado.');
            return Redirect::to('Plataforma/Usuarios');
          }else{
            if(strlen($inputs['password']) == 0){
              $dataUser = [
                'name' => $inputs['name'],
                'email' => $inputs['email'],
              ];
              $usuario->fill($dataUser)->save();
            }else{
              $dataUser = [
                'name' => $inputs['name'],
                'password' => Hash::make($inputs['password']),
                'email' => $inputs['email'],
              ];
              $usuario->fill($dataUser)->save();
            }
            session()->flash('notice','Un error ha ocurrido subiendo la imagen.');
            return Redirect::to('Plataforma/Usuarios');
          }
        }else{
          if(strlen($inputs['password']) == 0){
            $dataUser = [
              'name' => $inputs['name'],
              'email' => $inputs['email'],
            ];
            $usuario->fill($dataUser)->save();
          }else{
            $dataUser = [
              'name' => $inputs['name'],
              'password' => Hash::make($inputs['password']),
              'email' => $inputs['email'],
            ];
            $usuario->fill($dataUser)->save();
          }
          session()->flash('success','Usuario actualizado.');
          return Redirect::to('Plataforma');
        }
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $user = User::findOrFail($id);
      if(File::exists($user->imagen) && (File::delete($user->imagen)) ){
        if($user->delete()){
          session()->flash('success','User deleted!');
        }else{
          session()->flash('notice','There was a problem removing the user, try again!');
        }
      }else{
        if($user->delete()){
          session()->flash('success','Usuario eliminado.');
        }else{
          session()->flash("notice","There was a problem removing user's image");
        }
      }
      return Redirect::to('Plataforma/Usuarios');
    }
}
