
<!DOCTYPE html>
<html class=" ">

<head>
     <link rel="shortcut icon" type="image/x-icon" href="http://www.alexandergdj.com/images/favicon.png"> 
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <!-- <meta charset="utf-8" http-equiv="Refresh" content="60" /> -->
    <title>@yield('title', 'Plataforma : Administración') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    @if(Session::has('download.in.the.next.request'))
       <meta http-equiv="refresh" content="1;url={{ Session::get('download.in.the.next.request') }}">
    @endif


    <!-- CORE CSS FRAMEWORK - START -->
    {{Html::style('assets/plugins/pace/pace-theme-flash.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/bootstrap/css/bootstrap.min.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/bootstrap/css/bootstrap-theme.min.css', array('media'=>'screen'))}}
    {{Html::style('assets/fonts/font-awesome/css/font-awesome.css', array('media'=>'screen'))}}
    {{Html::style('css/animate.min.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array('media'=>'screen'))}}
    {{Html::style('css/style.css', array('media' => 'screen')) }}
    <!-- CORE CSS FRAMEWORK - END -->

    {{Html::style('assets/plugins/jquery-ui/smoothness/jquery-ui.min.css', array('media'=>'screen')) }}
    {{Html::style('assets/plugins/datepicker/css/datepicker.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/daterangepicker/css/daterangepicker-bs3.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/daterangepicker/css/daterangepicker-bs3.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/timepicker/css/timepicker.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/datetimepicker/css/datetimepicker.min.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/datatables/css/jquery.dataTables.css', array('media'=>'screen'))}}
    {{Html::style('assets/plugins/select2/select2.css', array('media'=>'screen')) }}
    {{Html::style('assets/plugins/bootstrap3-wysihtml5/css/bootstrap3-wysihtml5.min.css', array('media' => 'screen'))}}
    {{Html::style('assets/plugins/messenger/css/messenger.css')}}
    {{Html::style('assets/plugins/messenger/css/messenger-theme-future.css')}}
    {{Html::style('assets/plugins/messenger/css/messenger-theme-flat.css')}}
    {{Html::style('assets/plugins/icheck/skins/all.css', array('media'=>'screen')) }}
    {{Html::style('assets/plugins/multi-select/css/multi-select.css', array('media' => 'screen')) }}
    {{Html::style('assets/plugins/prettyphoto/prettyPhoto.css', array('media' => 'screen')) }}
    {{Html::style('assets/plugins/dropzone/css/dropzone.css', array('media' => 'screen')) }}
    {{Html::style('css/jquery.dataTables.min.css', array('media' => 'screen')) }}



    <!-- <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet"> -->



      <!-- CORE CSS TEMPLATE - START -->
      {{Html::style('assets/css/style.css', array('media'=>'screen'))}}
      {{Html::style('assets/css/responsive.css', array('media'=>'screen'))}}
      <!-- CORE CSS TEMPLATE - END -->

    @yield('head')

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class=" "><!-- START TOPBAR -->
<div class='page-topbar'>
    <div class='logo-area'>

    </div>
    <div class='quick-area'>
        <div class='pull-left'>
            <ul class="info-menu left-links list-inline list-unstyled">
                <li class="sidebar-toggle-wrap">
                    <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class='pull-right'>
            <ul class="info-menu right-links list-inline list-unstyled">
                <li class="profile">
                    <a href="#" data-toggle="dropdown" class="toggle">
                       
						@if(strlen(Auth::user()->imagen))
							
                          <!-- <img src="{{URL::asset('img/profile.jpg')}}" alt="user-image" class="img-circle img-inline"> -->
                          <img src="{{url(Auth::user()->imagen)}}" alt="user-image" class="img-circle img-inline"> 
                        
						@else
                          <img src="{{URL::asset('imgage/usuario1.jpg')}}" alt="user-image" class="img-circle img-inline">
                        @endif 




<!--					   @if(strlen(Auth::user()->imagen))
                          <!-- <img src="{{URL::asset('img/profile.jpg')}}" alt="user-image" class="img-circle img-inline"> --
                          <img src="/{{Auth::user()->imagen}}" alt="user-image" class="img-circle img-inline"> 
                        @else
                          <img src="{{URL::asset('imgage/usuario1.jpg')}}" alt="user-image" class="img-circle img-inline">
                        @endif -->
                        <span>
                          @if(Auth::check())
                            {{ Auth::user()->name }}
                          @else
                            Administrador
                          @endif
                         <i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="dropdown-menu profile animated fadeIn">
                        <li>
                            <a href="{{ url('Plataforma/Usuarios') }}/{{Auth::user()->id}}/edit">
                                <i class="fa fa-user"></i>
                                Editar Perfil
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#help">
                                <i class="fa fa-info"></i>
                                Ayuda
                            </a>
                        </li> -->
                        <li class="last">
                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            <i class="fa fa-lock"></i>
                              Cerrar Sesión
                          </a>
                          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                            <!-- <a href="{{ url('/logout') }}">
                                <i class="fa fa-lock"></i>
                                Salir
                            </a> -->
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>

</div>
<!-- END TOPBAR -->
<!-- START CONTAINER -->
<div class="page-container row-fluid" >

    <!-- SIDEBAR - START -->
    <div class="page-sidebar" style="height:100%;">


        <!-- MAIN MENU - START -->
        <div class="page-sidebar-wrapper" id="main-menu-wrapper">


            <ul class='wraplist'>


                <li class="{{ (Request::is('Plataforma') ? 'open' : '') }}">
                    <a href="{{ url('Plataforma') }}">
                        <i class="fa fa-dashboard"></i>
                        <span class="title">Ventana Principal</span>
                    </a>
                </li>

                <li class="{{ (Request::is('Plataforma/Productos*') ? 'open' : '') }}">
                    <a href="{{ url('Plataforma/Productos') }}">
                    <!-- <a href="javascript:;"> -->
                        <i class="fa fa-cubes"></i>
                        <span class="title">Promociones Guardadas</span>
                        <!-- <span class="arrow "></span> -->
                    </a>
                </li>
               

                

              

                
            </ul>

        </div>
        <!-- MAIN MENU - END -->



        <div class="project-info text-center" style="">
          <p> Desarrollado por Fraktalweb</p>
        </div>



    </div>
    <!--  SIDEBAR - END -->
    <!-- START CONTENT -->
    <section id="main-content" class="">
      <div class="" id="sound">

      </div>
        <section class="wrapper" style='margin-top:60px;display:inline-block;width:100%;padding:15px 0 0 15px;'>

            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class="page-title">

                    <div class="pull-left">
                        <h1 class="title">@yield('title')</h1>
                    </div>


                </div>
            </div>
            <div class="clearfix"></div>


            <div class="col-lg-12">


                @yield('content')

            </div>



        </section>
    </section>
    <!-- END CONTENT -->


  </div>
<!-- END CONTAINER -->
<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

@section('footer')

  <!-- CORE JS FRAMEWORK - START -->
  {{ HTML::script('assets/js/jquery-1.11.2.min.js') }}
  {{ HTML::script('assets/js/jquery.easing.min.js')}}
  {{ HTML::script('assets/plugins/bootstrap/js/bootstrap.min.js')}}
  {{ HTML::script('assets/plugins/pace/pace.min.js')}}
  {{ HTML::script('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}
  {{ HTML::script('assets/plugins/viewport/viewportchecker.js') }}
  <!-- CORE JS FRAMEWORK - END -->

  <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
  {{ HTML::script('assets/plugins/datepicker/js/datepicker.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/daterangepicker/js/moment.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/daterangepicker/js/daterangepicker.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/timepicker/js/timepicker.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/datetimepicker/js/datetimepicker.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.fr.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/jquery-validation/js/jquery.validate.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/jquery-validation/js/additional-methods.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/js/form-validation.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/datatables/js/jquery.dataTables.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/bootstrap3-wysihtml5/js/bootstrap3-wysihtml5.all.min.js', ["type" => "text/javascript"])}}
  {{ HTML::script('assets/js/jquery.jeditable.js', ["type" => "text/javascript"])}}
  {{ HTML::script('assets/js/jquery.form.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/messenger/js/messenger.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/messenger/js/messenger-theme-future.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/messenger/js/messenger-theme-flat.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/js/messenger.js', ["type" => "text/javascript"]) }}
  {{ Html::script('assets/plugins/jquery-ui/smoothness/jquery-ui.min.js', ["type" => "text/javascript"]) }}
  {{ Html::script('assets/plugins/icheck/icheck.min.js', ["type" => "text/javascript"]) }}
  {{ Html::script('assets/plugins/select2/select2.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/multi-select/js/jquery.multi-select.js', ["type" => "text/javascript"])}}
  {{ HTML::script('assets/plugins/multi-select/js/jquery.quicksearch.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/js/jquery.jeditable.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/prettyphoto/jquery.prettyPhoto.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('js/jquery.dataTables.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js', ["type" => "text/javascript"]) }}
  {{ HTML::script('assets/plugins/dropzone/dropzone.min.js', ["type" => "text/javascript"]) }}
  <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

  <!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> -->


  <!-- CORE TEMPLATE JS - START -->
  {{ HTML::script('assets/js/scripts.js') }}
  <!-- END CORE TEMPLATE JS - END -->




@show

@section('moreJs')

@show

<script type="text/javascript">

</script>

</body>
</html>
