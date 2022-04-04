<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>:: Arrow ::</title>
<link rel="icon" href="{{ asset('images/favicon.ico')}}" type="image/x-icon">
<link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Custom Css -->
@yield('estilos')
<link rel="stylesheet" href="{{asset('css/main.css')}}">
<link rel="stylesheet" href="{{asset('css/themes/all-themes.css')}}"/>

</head>
<body class="theme-blush">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-blush">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Cargando...</p>
    </div>
</div>
<!-- #END# Page Loader -->

<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->

<!-- Morphing Search  -->
<div id="morphsearch" class="morphsearch">

    <div class="morphsearch-content">
        <div class="column">
            <h2>People</h2>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{asset('images/sm/avatar1.jpg')}}" alt=""/>
                <h3>Sara Soueidan</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{asset('images/sm/avatar2.jpg')}}" alt=""/>
                <h3>Rachel Smith</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{asset('images/sm/avatar3.jpg')}}" alt=""/>
                <h3>Peter Finlan</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{asset('images/sm/avatar4.jpg')}}" alt=""/>
                <h3>Patrick Cox</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{asset('images/sm/avatar5.jpg')}}" alt=""/>
                <h3>Tim Holman</h3>
            </a>
        </div>
        <div class="column">
            <h2>Popular</h2>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar5.jpg')}}" alt=""/>
                <h3>Sara Soueidan</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar4.jpg')}}" alt=""/>
                <h3>Rachel Smith</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar3.jpg')}}" alt=""/>
                <h3>Peter Finlan</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar2.jpg') }}" alt=""/>
                <h3>Patrick Cox</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar1.jpg')}}" alt=""/>
                <h3>Tim Holman</h3>
            </a>
        </div>
        <div class="column">
            <h2>Recent</h2>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar1.jpg')}}" alt=""/>
                <h3>Sara Soueidan</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar2.jpg')}}" alt=""/>
                <h3>Rachel Smith</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar3.jpg')}}" alt=""/>
                <h3>Peter Finlan</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar4.jpg')}}" alt=""/>
                <h3>Patrick Cox</h3>
            </a>
            <a class="media-object" href="#">
                <img class="rounded-circle" src="{{ asset('images/sm/avatar5.jpg')}}" alt=""/>
                <h3>Tim Holman</h3>
            </a>
        </div>
    </div>
    <!-- /morphsearch-content -->
    <span class="morphsearch-close"></span>
</div>

<!-- Top Bar -->
<nav class="navbar clearHeader">
    <div class="col-12">
        <div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand" href="/home">Arrow</a> </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- Notifications -->
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-account"></i>  </a>
                <ul class="dropdown-menu">
                    <li class="header">Menú</li>
                    <li class="body">
                        <ul class="menu">
                            <li>
                                <a href="{{route('perfil.show',$id=Auth::user()->id)}}">
                                    <div class="icon-circle bg-light-green"><i class="zmdi zmdi-account"></i></div>
                                    <div class="menu-info">
                                        <h4>Mi perfil</h4>
                                       
                                    </div>
                                </a>
                            </li>
                        
                           
                            <li>
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();" >
                                    <div class="icon-circle bg-red"><i class="zmdi zmdi-sign-in"></i></div>
                                    <div class="menu-info">
                                        <h4>Cerrar sesión</h4>
                                    </div>
                                </a>
                                <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
                                    @csrf
                                </form>
                            </li>
                            
                        </ul>
                    </li>
                   
                </ul>
            </li>
            <!-- #END# Notifications -->

            
        </ul>
    </div>
</nav>
<!-- #Top Bar -->

<!--Side menu and right menu -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="admin-image"> <img src="{{asset('img/usuarios/'.Auth::user()->photo)}}" alt=""> </div>
            <div class="admin-action-info"> <span>Bienvenido:  </span>
                <span>  {{ Auth::user()->name }}</span>
                <ul>

                    <li><a data-placement="bottom" title="Go to Profile" href="{{route('perfil.show',$id=Auth::user()->id)}}"><i class="zmdi zmdi-account"></i></a></li>
                    <li><a data-placement="bottom" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();"  ><i class="zmdi zmdi-sign-in"></i></a>
                        <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">Navegación</li>
                @php
                    use App\Models\User;
                    use Spatie\Permission\Models\Role;
                    use Illuminate\Support\Facades\DB;
                    use Illuminate\Support\Facades\Auth;
                    $id=Auth::id();
                    $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->join('roles','roles.id','=','model_has_roles.role_id')
                    ->select('roles.name')
                    ->where('users.id','=',$id)->first();

                
                    $validacion=User::select('confirmed')->where('id','=',$id)->first();

                @endphp
                <li class="active open"><a href="/home"><i class="zmdi zmdi-home"></i><span>Inicio</span></a></li>
                @if($validacion->confirmed==1)
                @if ($rol->name=="Tenant")
                <li><a href="/roles"><i class="zmdi zmdi-calendar-check"></i><span>Roles</span> </a></li>
                {{-- tenant --}}
                <li><a href="/usuarios"><i class="zmdi zmdi-account"></i><span>Usuarios</span> </a></li>
                <li><a href="/empresas"><i class="material-icons">business</i><span>Empresas</span> </a></li>
                @elseif ($rol->name=="Responsable de empresa")

                {{-- Responsable de empresa --}}
                <li><a href="/operativos"><i class="zmdi zmdi-account"></i><span>Usuarios-Operativo</span> </a></li>


                <li><a href="/afianzadoras"><i class="material-icons">next_week</i><span>Afianzadoras</span> </a></li>
                <li><a href="/clientes"><i class="material-icons">supervisor_account</i><span>Clientes</span> </a></li>
                <li><a href="/empleados"><i class="material-icons">build</i><span>Empleados</span> </a></li>
                <li><a href="/contratos"> <i class="material-icons">assignment</i><span>Contratos</span> </a></li>
               {{-- <li><a  href="/contratosR"> <i class="material-icons">assignment</i><span>Contratos-Asignados</span> </a></li> --}}

         
               
            <li><a  href="/unidades"> <i class="material-icons">format_shapes</i> <span class="icon-name">Unidades</span> </a></li>

               
           
               <li><a  href="/cargos"> <i class="material-icons">business_center</i> <span class="icon-name">Cargos</span> </a></li>
                <li><a  href="/asignarcargo"> <i class="material-icons">assignment_ind</i><span>Asignar cargo</span> </a></li>
                <li><a  href="/firmantes"> <i class="material-icons">border_color</i> <span class="icon-name">Firmantes</span> </a></li>
            
                     
                






                @elseif ($rol->name=="Responsable de obra" || $rol->name="Asistente de obra")

                {{-- Responsable de empresa --}}


                <li><a href="/contratosR"> <i class="material-icons">assignment</i><span>Contratos-Asignados</span> </a></li>
                <li><a  href="/unidades"> <i class="material-icons">format_shapes</i> <span class="icon-name">Unidades</span> </a></li>
                @endif
                @endif

                



            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    
    <!-- #END# Right Sidebar -->
</section>
<!--Side menu and right menu -->

<!-- main content -->
<section class="content home">
    @yield('contenido')


</section>
<!-- main content -->

<div class="color-bg"></div>

<!-- Jquery Core Js -->
<script src="{{asset('bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('bundles/morphingsearchscripts.bundle.js')}}"></script> <!-- Main top morphing search -->

@yield('scripts')
{{-- <script src="https://kit.fontawesome.com/0daff41b97.js" crossorigin="anonymous"></script> --}}
<script src="{{asset('plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script> <!-- Sparkline Plugin Js --> --}}
<script src="{{asset('plugins/chartjs/Chart.bundle.min.js')}}"></script> <!-- Chart Plugins Js -->
 <script src="{{asset('bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->
<script src="{{asset('js/pages/charts/sparkline.min.js')}}"></script>

 <script src="{{asset('js/pages/index.js')}}"></script>





</body>

</html>
