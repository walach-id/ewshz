<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <link href="img/icon.png" rel="icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <script type="text/javascript" src="install.js"></script>
  <script type="text/javascript" src="main.js"></script> 
  <link rel="manifest" href="manifest.json">      
  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" type="text/css">


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- PushAlert -->
    
  <style>
               #mybutton {
            position: relative;
            z-index: 1;
            left: 85%;
            top: -35px;
            cursor: pointer;
         }
  </style>    
       
        <!-- End PushAlert -->
</head>

<body style="background: linear-gradient(90deg, #FC466B 0%, #3F5EFB 100%);">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-6 col-md-4">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <!-- Nested Row within Card Body -->
       
                <div class="p-5">
                <div class="sidebar-brand-icon rotate-n-0" align="center">
          <img src="img/icon.png" class="img" width="100px" height="100px">
        </div>
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><br>Early Warning System <br> HZ</h1>
                    <hr>
                  </div>
                  <form class="user" action="proses-login.php" method="post">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email..." required="required">
                    </div>
                    <div class="form-group">
                      <input type="password" name="pass" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password.." required="required" >
                       <span id="mybutton" onclick="change()"><i class="fa fa-eye"></i></span>
                    </div>
                    <hr>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <a href="ubah akun.php">Ubah Akun</a>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <a href="lupa password.php">Lupa Password</a>
                      </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Masuk">
                  </form>
                  <hr>
                  
                  
                  <br>
                  <!--<center><button class="btn btn-danger" id="setup_button" onclick="installApp()">Add To Home Screen</button></center>-->
                  <p align="center">&copy; DOHARA 2020</p>
                   <p align="center">Version 1.0</p>
                </div>

          </div>
      </div>

    </div>

  </div>
  
 

  <!-- Bootstrap core JavaScript-->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

<script>
      function change()
         {
            var x = document.getElementById('exampleInputPassword').type;
 
            if (x == 'password')
            {
               document.getElementById('exampleInputPassword').type = 'text';
               document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye-slash"></i>';
            }
            else
            {
               document.getElementById('exampleInputPassword').type = 'password';
               document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye"></i>';
            }
         }
    
 </script>
</body>

</html>

