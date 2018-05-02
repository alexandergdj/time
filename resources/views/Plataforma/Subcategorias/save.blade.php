@extends('Plataforma.layout') @section('title') SUBCATEGORIES @stop @section('content')

<div class="col-md-6 col-xs-6">

    <section class="box ">
        <header class="panel_header">
              <h2 class="title pull-left">SAVE SUBCATEGORY</h2>

        </header>
        <div class="content-body">

            <div class="row">
                <?php $lectura = ""?>
                    @if($subcategoria->id_subcategoria)
                      <?php $lectura = "disabled"?>
                    @endif

                    {{ Form::open( array('url' => 'Plataforma/Subcategorias/'.$subcategoria->id_subcategoria, 'method' => 'POST', 'id' => 'icon_validate', 'class' => 'formular', 'enctype' => 'multipart/form-data') ) }}

                        <div class="form-group">
                            {{ Form::label ('nombre', 'Name *', ['class' => 'form-label']) }}
                            <div class="controls">
                                <i class=""></i>
                                {{ Form::hidden('nombre', $subcategoria->nombre) }}
                                {{ Form::text ('nombre', $subcategoria->nombre, ['class' => 'form-control', 'required' => 'required']) }}
                                @if($errors->first('nombre'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('nombre') }}
                                  </div>
                                @endif
                            </div>
                        </div>

                       


                        <div class="form-group">
                            {{ Form::label ('id_categoria', 'Categoria *', ['class' => 'form-label']) }}
                            <div class="controls">
                                {{ Form::hidden('id_categoria', $subcategoria->id_categoria) }}
                                @if($subcategoria->id_categoria)
                                  {{ Form::select('id_categoria', $categorias , $subcategoria->id_categoria,  ['id' => 's2example-2']) }}
                                @else
                                  {{ Form::select('id_categoria', $categorias , 'Subcategoria',  ['id' => 's2example-2']) }}
                                @endif
                                @if($errors->first('id_categoria'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('id_categoria') }}
                                  </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="controls">
                                <div class="checkbox" style='margin-left:-20px; margin-top:30px;'>
                                    {{ Form::label ('mostrar', 'Show *', ['class' => 'form-label']) }}
                                    {{ Form::hidden('mostrar', 0) }}
                                    {{ Form::checkbox('mostrar', 1, $subcategoria->mostrar, ['class' => 'iCheck']) }}
                                </div>
                                @if($errors->first('mostrar'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('mostrar') }}
                                  </div>
                                @endif
                            </div>
                        </div>


                        {{-- <div class="form-group">
                            {{ Form::label ('imagen', 'Imagen *', array('class' => 'form-label')) }}
                            <!-- <p>Ancho cualquiera, Alto 190px, a color, png fondo transparente.</p> -->
                            <div class="controls">
                                @if($subcategoria->imagen <> '')
                                    <img id="imgProd" src="{{asset($subcategoria->imagen)}}" alt="{{$subcategoria->imagen}}" width="100"/>
                                    <p>&nbsp;</p>
                                @endif
                                {{ Form::file ('imagen', ['class' => 'form-control', 'id' => 'imagen']) }}

                                @if($errors->first('imagen'))
                                    <div class="alert alert-error alert-dismissible fade in">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                        {{$errors->first('imagen')}}
                                    </div>
                                @endif
                            </div>
                        </div> --}}


                        @if($subcategoria->id_subcategoria)
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
        </div>
    </section>
</div>

@stop


@section('moreJs')
<script type="text/javascript">

$(function(){

});

</script>
@stop
