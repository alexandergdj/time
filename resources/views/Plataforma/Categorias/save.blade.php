@extends('Plataforma.layout') @section('title') Categories @stop @section('content')

<div class="col-md-6 col-xs-6">

    <section class="box ">
        <header class="panel_header">
              <h2 class="title pull-left">SAVE CATEGORY</h2>

        </header>
        <div class="content-body">

            <div class="row">
                <?php $lectura = ""?>
                    @if($categoria->id_categoria)
                      <?php $lectura = "disabled"?>
                    @endif

                    {{ Form::open( array('url' => 'Plataforma/Categorias/'.$categoria->id_categoria, 'method' => 'POST', 'id' => 'icon_validate', 'class' => 'formular', 'enctype' => 'multipart/form-data') ) }}

                        <div class="form-group">
                            {{ Form::label ('nombre', 'Name *', ['class' => 'form-label']) }}
                            <div class="controls">
                                <i class=""></i>
                                {{ Form::hidden('nombre', $categoria->nombre) }}
                                {{ Form::text ('nombre', $categoria->nombre, ['class' => 'form-control', 'required' => 'required']) }}
                                @if($errors->first('nombre'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('nombre') }}
                                  </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label ('orden', 'Sequence *', ['class' => 'form-label']) }}
                            <div class="controls">
                                {{ Form::hidden('orden', null) }}
                                @if($categoria->id_categoria)
                                  {{ Form::select('orden', $posiciones , $categoria->orden,  ['id' => 's2example-1']) }}
                                @else
                                  {{ Form::select('orden', $posiciones , 'Posicion',  ['id' => 's2example-1']) }}
                                @endif
                                @if($errors->first('orden'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('orden') }}
                                  </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                <div class="checkbox" style='margin-left:-20px; margin-top:30px;'>
                                    {{ Form::label ('mostrar', 'Show *', ['class' => 'form-label']) }}
                                    {{ Form::hidden('mostrar', 0) }}
                                    {{ Form::checkbox('mostrar', 1, $categoria->mostrar, ['class' => 'iCheck']) }}
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
                                @if($categoria->imagen <> '')
                                    <img id="imgProd" src="{{asset($categoria->imagen)}}" alt="{{$categoria->imagen}}" width="100"/>
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


                        @if($categoria->id_categoria)
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
