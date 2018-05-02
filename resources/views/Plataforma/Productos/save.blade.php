@extends('Plataforma.layout') @section('title') PRODUCTS @stop @section('content')

<div class="col-md-6 col-xs-6">

    <section class="box ">
        <header class="panel_header">
              <h2 class="title pull-left">Agregar Promoción</h2>

        </header>
        <div class="content-body">

            <div class="row">
                <?php $lectura = ""?>
                    @if($producto->id_producto)
                      <?php $lectura = "disabled"?>
                    @endif

                    {{ Form::open( array('url' => 'Plataforma/Productos/'.$producto->id_producto, 'method' => 'POST', 'id' => 'icon_validate', 'class' => 'formular', 'enctype' => 'multipart/form-data') ) }}

                        <div class="form-group">
                            {{ Form::label ('codigo', 'Code *', ['class' => 'form-label']) }}
                            <div class="controls">
                                <i class="">  </i>
                                {{ Form::hidden('codigo', $producto->codigo) }}
                                {{ Form::text ('codigo', $producto->codigo, ['class' => 'form-control', 'required' => 'required']) }}
                                @if($errors->first('codigo'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('codigo') }}
                                  </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label ('nombre', 'Nombre *', ['class' => 'form-label']) }}
                            <div class="controls">
                                <i class=""></i>
                                {{ Form::hidden('nombre', $producto->nombre) }}
                                {{ Form::text ('nombre', $producto->nombre, ['class' => 'form-control', 'required' => 'required']) }}
                                @if($errors->first('nombre'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('nombre') }}
                                  </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                          {{ Form::label ('precio', 'Precio *', ['class' => 'form-label']) }}
                          <div class="input-group">
                              <span class="input-group-addon">$</span>
                              {{ Form::number ('precio', $producto->precio, ['class' => 'form-control', 'step'=>'any', 'required' => 'required' ,'id' => 'price']) }}
                              @if($errors->first('precio'))
                                <div class="alert alert-error alert-dismissible fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    {{ $errors->first('precio') }}
                                </div>
                              @endif
                          </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label ('descripcion', 'Descripcion', ['class' => 'form-label']) }}
                            <div class="controls">
                                <i class=""></i>
                                {{ Form::hidden('descripcion', $producto->descripcion) }}
                                {{ Form::textarea('descripcion', $producto->descripcion, ['class' => 'form-control', 'size' => '30x3']) }}
                                 @if($errors->first('descripcion'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{$errors->first('descripcion')}}
                                  </div>
                                @endif
                            </div>
                        </div>

                        

                        

                        <div class="form-group">
                            {{ Form::label ('id_categoria', 'Categoria *', ['class' => 'form-label']) }}
                            <div class="controls">
                                {{ Form::hidden('id_categoria', $producto->id_categoria) }}
                                {{ Form::select('id_categoria', $categorias , $producto->id_categoria,  ['id' => 's2example-2', 'class' => 'id_categoria']) }}
                                @if($errors->first('id_categoria'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('id_categoria') }}
                                  </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group" id="subcategoria">
                            {{ Form::label ('id_subcategoria', 'Tipo de Promo *', ['class' => 'form-label']) }}
                            <div class="controls">
                                <select name="id_subcategoria" class="subcategorias" id="s2example-3">
                                  @foreach($subcategorias as $key => $value)
                                    @if($key == $producto->id_subcategoria)
                                      <option class="option" value="{{ $key }}" selected>{{ $value }}</option>
                                    @else
                                      <option class="option" value="{{ $key }}">{{ $value }}</option>
                                    @endif
                                  @endforeach
                                </select>
                                @if($errors->first('id_subcategoria'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('id_subcategoria') }}
                                  </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                <div class="checkbox" style='margin-left:-20px; margin-top:30px;'>
                                    {{ Form::label ('mostrar', '¿Mostrar? *', ['class' => 'form-label']) }}
                                    {{ Form::hidden('mostrar', 0) }}
                                    {{ Form::checkbox('mostrar', 1, $producto->mostrar, ['class' => 'iCheck']) }}
                                </div>
                                @if($errors->first('mostrar'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('mostrar') }}
                                  </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            @if($producto->id_producto)
                              {!! Form::label ('imagenes', 'Agregar imagen * (Tamaño recomendado 336x90px)', array('class' => 'form-label')) !!}
                            @else
                              {!! Form::label ('imagenes', 'Agregar imagen * (Tamaño recomendado 336x90px)', array('class' => 'form-label')) !!}
                            @endif
                            <p></p>
                            <div class="controls">
                                @if($producto->imagenes <> '')
                                    @foreach($producto->imagenes as $image)
                                        <div class="img-album">
                                            <div class="close" data-carpeta="{{url('Plataforma/ProductosImagen/'.$image->id.'/eliminar')}}"><i class="fa fa-times"></i></div>
                                            <img src="{{asset($image->src)}}" alt="Imagen" height="100"  />
                                        </div>
                                    @endforeach
                                    <!-- <p>Revisar que la resolución sea de 72dpi y la imágen tiene que ser mayor a 800px de ancho</p> -->
                                @endif
                                {!! Form::file ('imagenes[]', ['class' => 'form-control ', 'id' => 'imagenes' ,'multiple' => true, 'accept' => 'image/jpg, image/jpeg, imagen/png'] ) !!}
                                @if($errors->first('imagenes'))
                                    <div class="alert alert-error alert-dismissible fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                        {{$errors->first('imagenes')}}
                                    </div>
                                @endif
                            </div>
                        </div>

                        @foreach($categoriasWP as $categoria)
                          <input id="sub_{{$categoria['id_categoria']}}" type="text" name="" value="{{ ${'sub_'.$categoria['id_categoria']} }}" hidden>
                        @endforeach

                        @if($producto->id_producto)
                          {{ Form::hidden ('hidSub', $producto->id_subcategoria, ['id' => 'hidSub']) }}
                          {{ Form::hidden ('_method', 'PUT', ['id' => 'methodo']) }}
                        @endif

                        <div class="text-right" style="margin-top:70px;">
                            <a class="btn btn-warning" href="{{ URL::previous() }}">Cancelar</a>
                            {{-- {{ link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-warning']) }} --}}
                            {{ Form::submit('Guardar', ['class' => 'btn btn-success', 'type' => 'submit', 'id' => 'guardar']) }}
                        </div>
                        {{ csrf_field() }}
                    {{ Form::close() }}

            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
        </div>
    </section>
</div>

@stop


@section('moreJs')
<script type="text/javascript">

$(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('.close').on('click', function(){
    var url = $(this).attr("data-carpeta");
    var parent = $(this).parent();
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        success:function(data){
          console.log(data);
          if(data.delete == "true"){
            parent.remove();
          }else{
            alert("Can't delete image");
          }
        }
    });
  });

  $('#price').on('change focusout focusin',function(){
    if($('#price').val()<=0){
      $('#price').val("1")
    }
  });

  // $("#imagenes").change(function () { //Show images before upload
  //   if(this.files.length > 6){
  //     alert("You can only upload a maximum of 6 images");
  //   }else{
  //     if(this.files.length > 0){
  //       $('.img-album-new').empty();
  //       var imageFiles = this.files;
  //       $(this.files).each(function(index, item){
  //         var reader = new FileReader();
  //         reader.onload = function (e) {
  //           $('.img-album-new').
  //           append("</div><img src="+e.target.result+" class='imgs' style='margin-right:5px; margin-top:5px;' alt='' height='100'/>");
  //         }
  //         reader.readAsDataURL(imageFiles[index]);
  //       });
  //     }
  //   }
  // });


  $('.id_categoria').on('change', function(){
    checkCategory($(this).val());
  })

  checkCategory = function(id){
    var subcategory = $('#hidSub').attr('value');
    var select = $('.subcategorias');
    select.empty();
    $('select.subcategorias').val("");
    $(JSON.parse($('#sub_'+id).val())).each(function(index, item){
      $.each(item, function(key, value){
        if(subcategory == key){
          $('.subcategorias').append('<option value="' + key + '" selected>' + value + '</option>');
        }else{
          $('.subcategorias').append('<option value="' + key + '">' + value + '</option>');
        }
      });
    });
    $('select.subcategorias').select2();
  };
  checkCategory($('.id_categoria').val());

});

</script>
@stop
