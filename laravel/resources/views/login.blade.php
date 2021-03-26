<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="../agros/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="bg-gradient-primary">
<!-- Navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container">
            <h1>Agros</h1>
        </div>
    </nav>
</header>


<div class="container">
        <div class="row py-5 mt-4 align-items-center">
            <!-- For Demo Purpose -->
            <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
                <img src="https://res.cloudinary.com/mhmd/image/upload/v1569543678/form_d9sh6m.svg" alt="" class="img-fluid mb-3 d-none d-md-block">
            </div>

            <!-- Registeration Form -->
            <div class="col-md-7 col-lg-6 ml-auto">
                <form action="{{route('process')}}" method="post">
                @csrf
                    <div class="row">
                        <!-- Username -->
                        <div class="input-group col-lg-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                            </div>
                            <input id="username" type="text" name="username" placeholder="Username" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- Password -->
                        <div class="input-group col-lg-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                            </div>
                            <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md">
                        </div>
                       
                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto mb-0">
                            <button type ="submit" class="btn btn-primary btn-block py-2">
                                <span class="font-weight-bold">Login</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        @if(session()->has('message'))
            swal("{{ session()->get('message') }}");
        @endif
    </script>
</body>
</html>