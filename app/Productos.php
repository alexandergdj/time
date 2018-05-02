<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model{
    protected $table = 'Productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = ['codigo', 'nombre', 'precio', 'id_categoria', 'id_subcategoria', 'descripcion', 'medidas', 'orden', 'mostrar'];

    public function categoria(){
      return $this->belongsTo('App\Categorias','id_categoria','id_categoria');
    }

    public function subcategoria(){
      return $this->belongsTo('App\Subcategorias','id_subcategoria','id_subcategoria');
    }

    public function imagenes(){
      return $this->hasMany('App\Imagenes','id_producto','id_producto');
    }

}
