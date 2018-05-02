<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Imagenes extends Model{
    protected $table = 'Imagenes';
    protected $primaryKey = 'id';
    protected $fillable = ['id_producto', 'src'];

    public function producto(){
      return $this->belongsTo('App\Productos','id_producto','id_producto');
    }
}
