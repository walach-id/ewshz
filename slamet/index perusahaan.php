<?php
error_reporting(0); 
require 'cek-sesi.php';
$bulanini = date('F');
$minggulalu = date('d')-7;
$hariini = date('d-m-Y');
?>
<!DOCTYPE html>
<html lang="en">

  <head>
  <link href="img/icon.png" rel="icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard - Admin</title>

  <!-- Custom fonts for this template-->
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<?php
require ('koneksi.php');
require ('sidebar.php');

$perusahaan = $_SESSION['level'];
$slamet = "Admin Slamet";

      $tgl = date('Y-m-d');
$bulan = substr($date, 4, 4);
$tahun = substr($date, 0, 4);
$karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan");
$karyawan = mysqli_num_rows($karyawan);

$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = '$tgl' and nama_perusahaan = '$perusahaan' and not flag1 = '$slamet'");
while ($masuk1=mysqli_fetch_array($pemasukan1)){
$arraymasuk1[] = $masuk1['jumlah'];
}
$jumlahmasuk1 = array_sum($arraymasuk1);


$pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran = '$tgl' and nama_perusahaan = '$perusahaan' and not flag1 = '$slamet'");

while ($keluar1=mysqli_fetch_array($pengeluaran1)){
$arraykeluar1[] = $keluar1['jumlah'];
}
$jumlahkeluar1 = array_sum($arraykeluar1);

$sisauanghariini = $jumlahmasuk1 - $jumlahkeluar1;




$pemasukanseluruh=mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$perusahaan' and not flag1 ='$slamet'");
while ($masukseluruh=mysqli_fetch_array($pemasukanseluruh)){
$arraymasukseluruh[] = $masukseluruh['jumlah'];
}
$jumlahmasukseluruh = array_sum($arraymasukseluruh);


$pengeluaranseluruh=mysqli_query($koneksi,"SELECT * FROM pengeluaran where nama_perusahaan = '$perusahaan' and not flag1 = '$slamet'");

while ($keluarseluruh=mysqli_fetch_array($pengeluaranseluruh)){
$arraykeluarseluruh[] = $keluarseluruh['jumlah'];
}
$jumlahkeluarseluruh = array_sum($arraykeluarseluruh);

$sisauangseluruh = $jumlahmasukseluruh - $jumlahkeluarseluruh;

$minggupemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan WHERE tgl_pemasukan > DATE_SUB(NOW(), INTERVAL 1 WEEK) and nama_perusahaan = '$perusahaan' and not flag1 = '$slamet'");

while ($minggumasuk1=mysqli_fetch_array($minggupemasukan1)){
$mingguarraymasuk1[] = $minggumasuk1['jumlah'];
}
$minggujumlahmasuk1 = array_sum($mingguarraymasuk1);


$minggupengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran WHERE tgl_pengeluaran > DATE_SUB(NOW(), INTERVAL 1 WEEK) and nama_perusahaan = '$perusahaan' and not flag1 = '$slamet'");

while ($minggukeluar1=mysqli_fetch_array($minggupengeluaran1)){
$mingguarraykeluar1[] = $minggukeluar1['jumlah'];
}
$minggujumlahkeluar1 = array_sum($mingguarraykeluar1);

$minggusisauanghariini = $minggujumlahmasuk1 - $minggujumlahkeluar1;


$bln = date('m');

$bulanpemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) = '$bln' and nama_perusahaan = '$perusahaan' and not flag1 ='$slamet'");

while ($bulanmasuk1=mysqli_fetch_array($bulanpemasukan1)){
$bulanarraymasuk1[] = $bulanmasuk1['jumlah'];
}
$bulanjumlahmasuk1 = array_sum($bulanarraymasuk1);


$bulanpengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where month(tgl_pengeluaran) = '$bln'  and nama_perusahaan = '$perusahaan' and not flag1 = '$slamet'");

while ($bulankeluar1=mysqli_fetch_array($bulanpengeluaran1)){
$bulanarraykeluar1[] = $bulankeluar1['jumlah'];
}
$bulanjumlahkeluar1 = array_sum($bulanarraykeluar1);

$sisauangbulanini = $bulanjumlahmasuk1 - $bulanjumlahkeluar1;

?>
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
<h2> Selamat Datang, <?=$_SESSION['nama']?> | <?=$_SESSION['nama_lengkap']?></h2><?php echo ""; ?> 

<?php require 'user.php'; ?>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
       
            
            <a href="export-semua.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Laporan Total</a>
          </div>

          <!-- Content Row -->
            <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2" style="background-color: #05B640;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Total Pemasukan</div>
                      <div class="h5 mb-0 font-weight-bold" style="color: black; font-weight: bold;">Rp <?= number_format($jumlahmasukseluruh,0,',','.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> 
      </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2" style="background-color: #F3413F;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Total Pengeluaran</div>
                      <div class="h5 mb-0 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($jumlahkeluarseluruh,0,',','.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> 
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2" style="background-color: #08ADBA;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Total Saldo</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($sisauangseluruh,0,',','.');?></div>
                        </div>   
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>


          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2" style="background-color: #05B640;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Pemasukan <?php echo date('d-m-Y');?></div>
                      <div class="h5 mb-0 font-weight-bold" style="color: black; font-weight: bold;">Rp <?= number_format($jumlahmasuk1,0,',','.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> 
      </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2" style="background-color: #F3413F;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Pengeluaran <?php echo date('d-m-Y');?></div>
                      <div class="h5 mb-0 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($jumlahkeluar1,0,',','.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> 
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2" style="background-color: #08ADBA;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Saldo <?php echo date('d-m-Y');?></div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($sisauanghariini,0,',','.');?></div>
                        </div>   
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

       

<!-- COBA COBA 2 BARIS START -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2" style="background-color: #05B640;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Pemasukan (<?php echo $minggulalu." s.d ". $hariini;?></div>
                      <div class="h5 mb-0 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($minggujumlahmasuk1,0,',','.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
      </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2" style="background-color: #F3413F;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Pengeluaran <?php echo $minggulalu." s.d ". $hariini;?></div>
                      <div class="h5 mb-0 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($minggujumlahkeluar1,0,',','.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> 
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2" style="background-color: #08ADBA;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Saldo <?php echo $minggulalu." s.d ". $hariini;?></div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($minggusisauanghariini,0,',','.');?></div>
                        </div>   
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2" style="background-color: #05B640;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Pemasukan Bulan <?php echo $bulanini; ?></div>
                      <div class="h5 mb-0 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($bulanjumlahmasuk1 ,0,',','.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
      </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2" style="background-color: #F3413F;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Pengeluaran Bulan <?php echo $bulanini; ?></div>
                      <div class="h5 mb-0 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($bulanjumlahkeluar1,0,',','.');?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div> 
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2" style="background-color: #08ADBA;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: white; font-weight: bold;">Saldo Bulan <?php echo $bulanini; ?></div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold" style="color: black; font-weight: bold;">Rp <?=number_format($sisauangbulanini,0,',','.');?></div>
                        </div>   
                      </div>
                   </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>

                </div>
              </div>
            </div>

        </div>
        <!-- /.container-fluid -->

      </div>

<?php require 'footer.php'?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<?php require 'logout-modal.php'; ?>

  <!-- Bootstrap core JavaScript-->
   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  
  

</body>

</html>
