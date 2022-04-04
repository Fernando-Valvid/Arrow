<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Reporte de usuarios operativos</title>
<link rel="icon" href="{{ asset('images/favicon.ico')}}" type="image/x-icon">
<link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Custom Css -->


</head>
<body class="theme-blush">
    <h2>Reporte de usuarios operativos</h2>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">

                <div class="body table-responsive">
                    <table class="table table-bordered  ">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id}}</td>
                                    <td>{{ $usuario->name}}</td>
                                    <td>{{ $usuario->email}}</td>
                                    <td>{{ $usuario->rol}}</td>





                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="pagination justify-content-end">
                        {{-- {!! $usuarios->links() !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
