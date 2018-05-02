@extends('Plataforma.layout')


@section('title') Administrador | Party Time @stop

@section('main_title') Bienvenido @stop

@section('content')


    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"></h2>
                <div class="actions panel_actions pull-right">
                    <i class="box_toggle fa fa-chevron-down"></i>
                    <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                    <i class="box_close fa fa-times"></i>
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
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="row">
                {{--  @if(count($productos)>0)
                    @foreach($productos as $producto)
                    <div class="alert alert-warning alert-dismissible fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>{{ $producto }}</strong></div>
                    @endforeach
                  @endif --}}
                </div>
            </div>
        </section>
    </div>

    <div class="col-md-12">

        <div class="row">
             <a href="{{url('/Plataforma')}}">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="r4_counter db_box">
                    <i class="pull-left fa fa-cubes icon-md icon-rounded icon-primary"></i>
                    <div class="stats">
                        <h4><strong>{{ Html::link('/Plataforma/Productos', $productos) }}</strong></h4>
                        <span>Productos</span>
                    </div>
                </div>
            </div>
            </a>
            <a href="{{url('/Plataforma')}}">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="r4_counter db_box">
                    <i class="pull-left fa fa-tag icon-md icon-rounded icon-orange"></i>
                    <div class="stats">
                        <h4><strong>{{ Html::link('/Plataforma/Categorias', $categorias) }}</strong></h4>
                        <span>Categorias</span>
                    </div>
                </div>
            </div>
            </a>
            
            <a href="{{url('/Plataforma')}}">
            <div class="col-md-3 col-sm-6 col-xs-6">

                <div class="r4_counter db_box">
                    <i class="pull-left fa fa-users icon-md icon-rounded icon-warning"></i>
                    <div class="stats">
                        <h4><strong>{{ Html::link('/Plataforma/Usuarios ', $usuarios) }}</strong></h4>
                        <span>Users</span>
                    </div>
                </div>
            </div>
            </a>
        </div>

    </div>





@stop
