@extends('Plataforma.layout')


@section('title') Promociones @stop

@section('content')

    <div class="col-md-12 col-xs-12">

        <section class="box ">
          <header class="panel_header">
              <h2 class="title pull-left">Lista de promociones</h2>
              {{-- @if(Auth::user()->id_rol == 1) --}}
                <div class="actions panel_actions pull-right">
                    <!-- {{ Html::link('export-products', 'Generar Excel', array('class' => 'btn btn-success')) }} -->
                    {{ Html::link('Plataforma/Productos/create', 'Crear Nuevo', array('class' => 'btn btn-info')) }}
                </div>
              {{-- @endif --}}
          </header>
          <div class="content-body">
            @if(Session::has('notice'))
              <div class="alert alert-error alert-dismissible fade in">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×iii</span>
                  </button>
                  <strong>{{ Session::get('notice') }}</strong>
              </div>
            @endif

            @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible fade in">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                  <strong>{{ Session::get('success') }}</strong>
              </div>
            @endif

                <div class="row">
                        <table class="table table table-striped dt-responsive display" id="example-1">
                          @if(count($productos)>0)
                            <thead>
                              <tr>
                                  <th class="text-center">Mostrar</th>
                                  <th class="text-left">Código</th>
                                  <th class="text-left">Nombre</th>
                                  <th class="text-left">Precio</th>
                                  <th class="text-left">Categoria</th>
                                  <th class="text-left">Subcategoria</th>
                                  <!-- <th class="text-left">Descripción</th> -->
                                  
                                  
                                  <th class="text-left">Opciones</th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($productos as $producto)
                                <tr style="">
                                    <td width="2%" class="text-center">
                                      {{ Form::checkbox('mostrar', ($producto['mostrar'] == "1" ? true : false ) , ($producto['mostrar'] == "1" ? true : false ) , ['class' => 'iCheck' ,'id' => 'checkVisibleP', 'data-val' => $producto['id_producto'] ]) }}
                                    </td>
                                    <td width="10%" class="text-left">{{ $producto['codigo'] }}</td>
                                    <td width="12%" class="text-left">{{ $producto['nombre'] }}</td>
                                    <td width="5%" class="text-left">{{ $producto['precio'] }}</td>
                                    <td width="5%" class="text-left">{{ $producto['categoria']['nombre'] or "Undefined" }}</td>
                                    <td width="8%" class="text-left">{{ $producto['subcategoria']['nombre'] or "Undefined"}}</td>
                                    <!-- <td width="8%" class="text-left">{{ $producto['descripcion'] }}</td> -->
                                   
                                   
                                    <td width="10%">
                                      <a href="Productos/{{ $producto['id_producto'] }}/edit" class="btn btn-info btn-xs pull-left right15" rel="tooltip" data-animate="animated bounce" data-toggle="tooltip" data-original-title="Editar registro" data-placement="top"><i class="fa fa-pencil" ></i></a>
                                      {{ Form::open(array('url' => 'Plataforma/Productos/'.$producto['id_producto'])) }}
                                      {{ Form::hidden("_method", "DELETE") }}
                                      {{ Form::submit("x", array('class' => 'btn btn-xs btn-danger pull-left right15', 'onclick' => 'return confirm("Seguro que deseas eliminar?");')) }}
                                      {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                          @else
                            <h4 class="text-center">No hay registros para mostrar</h4>
                          @endif
                        </table>

                </div>
            </div>
        </section>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('moreJs')
<script type="text/javascript">

$(function(){

  $('input[type="checkbox"][id="checkVisibleP"]').on('ifChecked', function () {
    $('.pace').show();
    id = $(this).attr('data-val');
    changeVisibility();
  });

  $('input[type="checkbox"][id="checkVisibleP"]').on('ifUnchecked', function () {
    $('.pace').show();
    id = $(this).attr('data-val');
    changeVisibility();
  });

  function changeVisibility(){
    $.ajax({
        type: "POST",
        url: 'Productos/changeVisibility/'+id,
        async: false,
        data: {
          '_token': "{{ csrf_token() }}",
        },
        success:function(data){
          $('.pace').hide();
          if(data.save){
            console.log("<------- Guardado --------->");
          }else{
            alert("Ocurrió un error al guardar la visibilidad del producto");
            console.log("<------- No guardado --------->");
          }
        }
    });
  }


});

</script>
@stop
