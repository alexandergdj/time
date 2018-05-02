@extends('Plataforma.layout')


@section('title') USERS @stop

@section('content')

    <div class="col-md-12 col-xs-12">

        <section class="box ">
          <header class="panel_header">
              <h2 class="title pull-left">LIST OF USERS</h2>
                <div class="actions panel_actions pull-right">
                    <!-- {{ Html::link('export-products', 'Generar Excel', array('class' => 'btn btn-success')) }} -->
                    {{ Html::link('Plataforma/Usuarios/create', 'Create new', array('class' => 'btn btn-info')) }}
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
                          @if(count($users)>0)
                            <thead>
                              <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Email</th>
                                <th class="text-left">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                             @foreach($users as $user)
                                <tr style="">
                                    <td width="12%" class="text-left">{{ $user['name'] }}</td>
                                    <td width="20%" class="text-left">{{ $user['email'] }}</td>
                                    <td width="10%">
                                      <a href="Usuarios/{{ $user['id'] }}/edit" class="btn btn-info btn-xs pull-left right15" rel="tooltip" data-animate="animated bounce" data-toggle="tooltip" data-original-title="Editar registro" data-placement="top"><i class="fa fa-pencil" ></i></a>
                                      {{ Form::open(array('url' => 'Plataforma/Usuarios/'.$user['id'])) }}
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

});

</script>
@stop
