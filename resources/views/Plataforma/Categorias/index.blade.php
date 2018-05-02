@extends('Plataforma.layout')


@section('title') CATEGORIES @stop

@section('content')

    <div class="col-md-12 col-xs-12">

        <section class="box ">
          <header class="panel_header">
              <h2 class="title pull-left">LIST OF CATEGORIES</h2>
                <div class="actions panel_actions pull-right">
                    <!-- {{ Html::link('export-products', 'Generar Excel', array('class' => 'btn btn-success')) }} -->
                    {{ Html::link('Plataforma/Categorias/create', 'Create new', array('class' => 'btn btn-info')) }}
                </div>
          </header>
          <div class="content-body">
            @if(Session::has('notice'))
              <div class="alert alert-error alert-dismissible fade in">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
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
                          @if(count($categorias)>0)
                            <thead>
                              <tr>
                                <th class="text-center">Show</th>
                                <th class="text-left">Name</th>
                                <th class="text-left">Sequence</th>
                                <th class="text-left">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($categorias as $categoria)
                                <tr style="">
                                    <td width="2%" class="text-center">
                                      {{ Form::checkbox('mostrar', ($categoria['mostrar'] == "1" ? true : false ) , ($categoria['mostrar'] == "1" ? true : false ) , ['class' => 'iCheck' ,'id' => 'checkVisibleP', 'data-val' => $categoria['id_categoria'] ]) }}
                                    </td>
                                    <td width="12%" class="text-left">{{ $categoria['nombre'] }}</td>
                                    <td width="8%" class="text-left">{{ $categoria['orden'] }}</td>
                                    <td width="10%">
                                      <a href="Categorias/{{ $categoria['id_categoria'] }}/edit" class="btn btn-info btn-xs pull-left right15" rel="tooltip" data-animate="animated bounce" data-toggle="tooltip" data-original-title="Editar registro" data-placement="top"><i class="fa fa-pencil" ></i></a>
                                      {{ Form::open(array('url' => 'Plataforma/Categorias/'.$categoria['id_categoria'])) }}
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
        url: 'Categorias/changeVisibility/'+id,
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
