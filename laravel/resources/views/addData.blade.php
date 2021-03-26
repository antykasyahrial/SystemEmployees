<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="../agros/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

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
            <!-- Registeration Form -->
            <div class="col-md-7 col-lg-12 ml-auto">
                <form action="{{route('storeData')}}" method="post">
                @csrf
                    <div class="row">
                        <!-- name -->
                        <div class="input-group col-lg-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                            </div>
                            <input id="name" type="text" name="name" placeholder="Full Name" class="form-control bg-white border-left-0 border-md">
                        </div>

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

                        <!-- Address -->
                        <div class="input-group col-lg-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                            </div>
                            <input id="address" type="text" name="address" placeholder="Alamat" class="form-control bg-white border-left-0 border-md">
                        </div>

                        <!-- jabatan -->
                        <div class="input-group col-lg-12 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white px-4 border-md border-right-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                            </div>
                            <select name="jabatan" class="form-control selectpicker">
                                <option value="staff">Staff</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                       
                        <!-- Submit Button -->
                        <div class="form-group col-lg-12 mx-auto mb-0">
                            <button type ="submit" class="btn btn-primary btn-block py-2">
                                <span class="font-weight-bold">Tambah</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>