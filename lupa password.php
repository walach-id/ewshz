<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <link href="img/icon.png" rel="icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Lupa Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background: linear-gradient(90deg, #FC466B 0%, #3F5EFB 100%);">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-6 col-md-4">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <!-- Nested Row within Card Body -->

                <div class="p-5">
          
                  
                  <form class="user" action="proses-ubah-password.php" method="post">
                    <div class="form-group">
                      <input type="text" name="usernamelama" class="form-control form-control-user" id="exampleInputEmail" placeholder="Masukan Username/Email ..." required="required">
                    </div>
                     <div class="form-group">
                      <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password Baru ..." required="required">
                    </div>
                  
                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Update">
                  </form>
                  <hr>
                  <p align="center">&copy; DOHARA</p>
                </div>

          </div>
      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
