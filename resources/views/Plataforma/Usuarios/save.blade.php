@extends('Plataforma.layout') @section('title') Usuarios | Party Time @stop @section('content')

<div class="col-md-6">

    <section class="box ">
        <header class="panel_header">
              <h2 class="title pull-left">Editar Usuario</h2>

        </header>
        <div class="content-body">

            <div class="row">
                <?php $lectura = ""?>
                    @if($user->id)
                      <?php $lectura = "disabled"?>
                    @endif

                    {{ Form::open( array('url' => 'Plataforma/Usuarios/'.$user->id, 'method' => 'POST', 'id' => 'icon_validate', 'class' => '', 'enctype' => 'multipart/form-data') ) }}

                        <div class="form-group">
                            {{ Form::label ('name', 'Nombre *', ['class' => 'form-label']) }}
                            <div class="controls">
                                <i class=""></i>
                                {{ Form::hidden('name', $user->name) }}
                                {{ Form::text ('name', $user->name, ['class' => 'form-control', 'required' => 'required']) }}
                                @if($errors->first('nombre'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('name') }}
                                  </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label ('email', 'Correo electrónico	 *', ['class' => 'form-label']) }}
                            <div class="controls">
                                <i class=""></i>
                                @if($user->id)
                                  {{ Form::hidden('email', $user->email ) }}
                                  {{ Form::email ('email',  $user->email, ['class' => 'form-control', 'required' => 'required']) }}
                                @else
                                  {{ Form::hidden('email', null ) }}
                                  {{ Form::email ('email',  null, ['class' => 'form-control', 'required' => 'required']) }}
                                @endif
                                @if($errors->first('email'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                      {{ $errors->first('email') }}
                                  </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            @if($user->id)
                              {{ Form::label ('password', 'Nueva contraseña *', ['class' => 'form-label']) }}
                            @else
                              {{ Form::label ('password', 'Password *', ['class' => 'form-label']) }}
                            @endif
                            <div class="controls">
                                <i class=""></i>
                                @if($user->id)
                                  {{ Form::hidden('password', null) }}
                                  {{ Form::password ('password',['class' => 'form-control', 'placeholder' => 'Nueva Contraseña']) }}
                                @else
                                  {{ Form::hidden('password', null) }}
                                  {{ Form::password ('password', ['class' => 'form-control', 'placeholder' => '' , 'required' => 'required']) }}
                                @endif
                                @if($errors->first('password'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('password') }}
                                  </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            @if($user->id)
                              {{ Form::label ('imagen', 'Imagen *', ['class' => 'form-label']) }}
                            @else
                              {{ Form::label ('imagen', 'Image *', ['class' => 'form-label']) }}
                            @endif
                            <div class="controls">
                              @if($user->id)
                                {{ Html::image($user->imagen, '', array('class' => 'img-thumbnail img-responsive', 'style' => 'height:140px;' ,'id' => 'imagenChange', 'data-holder-rendered' => 'true')) }}
                              @else
                                {{ Html::image(null, '', array('class' => 'img-thumbnail img-responsive', 'style' => 'height:140px;' ,'id' => 'imagenChange', 'data-holder-rendered' => 'true')) }}
                              @endif
                            </div>
                            <div class="controls">
                                <i class=""></i>
                                @if($user->id)
                                  {{ Form::file ('imagen', ['class' => 'custom-file-input', 'id' => 'imagen']) }}
                                @else
                                  {{ Form::file ('imagen', ['class' => 'custom-file-input', 'id' => 'imagen', 'required' =>'required']) }}
                                @endif
                                @if($errors->first('imagen'))
                                  <div class="alert alert-error alert-dismissible fade in">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                      {{ $errors->first('imagen') }}
                                  </div>
                                @endif
                            </div>
                        </div>



                        @if($user->id)
                          {{ Form::hidden ('_method', 'PUT', ['id' => 'methodo']) }}
                        @endif

                        <div class="text-right" style="">
                          {{ link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-warning']) }}
                          {{ Form::submit('Save', ['class' => 'btn btn-success', 'type' => 'submit', 'id' => 'guardar']) }}
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

  $("#imagen").change(function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#imagenChange').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    }
  });


});

</script>
@stop
