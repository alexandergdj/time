@extends('Plataforma.layout')


@section('title') SUBCATEGORIES @stop

@section('content')

    <div class="col-md-12 col-xs-12">

        <section class="box ">
          <header class="panel_header">
              <h2 class="title pull-left">LIST OF SUBCATEGORIES</h2>
                <div class="actions panel_actions pull-right">
                    <!-- {{ Html::link('export-products', 'Generar Excel', array('class' => 'btn btn-success')) }} -->
                    {{ Html::link('Plataforma/Subcategorias/create', 'Crear Nuevo', array('class' => 'btn btn-info')) }}
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
                          @if(count($subcategorias)>0)
                            <thead>
                              <tr>
                                <th class="text-center">Show</th>
                                <th class="text-left">Name</th>
                                <th class="text-left">Sequence</th>
                                <th class="text-left">Category</th>
                                <th class="text-left">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($subcategorias as $subcategory)
                                <tr style="">
                                    <td width="2%" class="text-center">
                                      {{ Form::checkbox('mostrar', ($subcategory['mostrar'] == "1" ? true : false ) , ($subcategory['mostrar'] == "1" ? true : false ) , ['class' => 'iCheck' ,'id' => 'checkVisibleP', 'data-val' => $subcategory['id_subcategoria'] ]) }}
                                    </td>
                                    <td width="12%" class="text-left">{{ $subcategory['nombre'] }}</td>
                                    <td width="8%" class="text-left">{{ $subcategory['orden'] }}</td>
                                    @if(count($subcategory['categoria'])>0)
                                      <td width="15%" class="text-left">{{ $subcategory['categoria']['nombre'] }}</td>
                                    @else
                                      <td width="15%" class="text-left">Unassigned</td>
                                    @endif
                                    <td width="10%">
                                      <a href="Subcategorias/{{ $subcategory['id_subcategoria'] }}/edit" class="btn btn-info btn-xs pull-left right15" rel="tooltip" data-animate="animated bounce" data-toggle="tooltip" data-original-title="Editar registro" data-placement="top"><i class="fa fa-pencil" ></i></a>
                                      {{ Form::open(array('url' => 'Plataforma/Subcategorias/'.$subcategory['id_subcategoria'])) }}
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
        url: 'Subcategorias/changeVisibility/'+id,
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
