<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Categorias extends Model{
    protected $table = 'Categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nombre', 'orden', 'mostrar'];

    public function productos(){
      return $this->hasMany('App\Productos','id_categoria','id_categoria');
    }

    public function subcategorias(){
      return $this->hasMany('App\Subcategorias','id_subcategoria');
    }
}
