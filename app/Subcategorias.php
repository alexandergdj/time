<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model{
    protected $table = 'Subcategorias';
    protected $primaryKey = 'id_subcategoria';
    protected $fillable = ['nombre', 'id_categoria' ,'orden', 'mostrar'];

    public function productos(){
      return $this->hasMany('App\Productos','id_subcategoria','id_subcategoria');
    }

    public function categoria(){
        return $this->belongsTo('App\Categorias', 'id_categoria');
    }
}
