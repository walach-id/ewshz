<?php
error_reporting(0); 
require 'cek-sesi.php';
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

if($perusahaan != "admin") {

$date=date('Y-m-d');
$bulan = substr($date, 4, 4);
$tahun = substr($date, 0, 4);
$karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan where nama_perusahaan = '$perusahaan'");
$karyawan = mysqli_num_rows($karyawan);
$perusahaan = $_SESSION['level'];

$pengeluaran_bulan_ini = mysqli_query($koneksi, "SELECT jumlah FROM pengeluaran where tgl_pengeluaran like '%$bulan%' and flag1 = '$slamet'");
$pengeluaran_bulan_ini = mysqli_fetch_array($pengeluaran_bulan_ini);

$pengeluaran_hari_ini = mysqli_query($koneksi, "SELECT jumlah FROM pengeluaran where tgl_pengeluaran = CURDATE() and flag1 = '$slamet'");
$pengeluaran_hari_ini = mysqli_fetch_array($pengeluaran_hari_ini);

$pemasukan_bulan_ini = mysqli_query($koneksi, "SELECT jumlah FROM pemasukan where tgl_pemasukan like '%$bulan%' and flag1 = '$slamet'");
$pemasukan_bulan_ini = mysqli_fetch_array($pemasukan_bulan_ini);

$pemasukan_hari_ini = mysqli_query($koneksi, "SELECT jumlah FROM pemasukan where tgl_pemasukan = CURDATE() and flag1 = '$slamet'");
$pemasukan_hari_ini = mysqli_fetch_array($pemasukan_hari_ini);



$pemasukan=mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($masuk=mysqli_fetch_array($pemasukan)){
$arraymasuk[] = $masuk['jumlah'];
}
$jumlahmasuk = array_sum($arraymasuk);


$pengeluaran=mysqli_query($koneksi,"SELECT * FROM pengeluaran where nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($keluar=mysqli_fetch_array($pengeluaran)){
$arraykeluar[] = $keluar['jumlah'];
}
$jumlahkeluar = array_sum($arraykeluar);
$uang = $jumlahmasuk - $jumlahkeluar;

$pemasukan2=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() and flag1 = '$slamet'");
while ($masuk2=mysqli_fetch_array($pemasukan2)){
$arraymasuk2[] = $masuk2['jumlah'];
}
$jumlahmasuk2 = array_sum($arraymasuk2);

$pengeluaran2=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran = CURDATE() and flag1 = '$slamet'");
while ($keluar2=mysqli_fetch_array($pengeluaran2)){
$arraykeluar2[] = $keluar2['jumlah'];
}
$jumlahkeluar2 = array_sum($arraykeluar2);//untuk data chart area
$sisauanghariini=$jumlahmasuk2-$jumlahkeluar2;

$hutangbulan=mysqli_query($koneksi,"SELECT * FROM hutang where keterangan='HUTANG' AND tgl_hutang like '%$bulan%' and flag1 = '$slamet'");
while ($hutangan=mysqli_fetch_array($hutangbulan)){
$arrayhutangbulan[] = $hutangan['jumlah'];
}
$hutangbulanini = array_sum($arrayhutangbulan);

$pemasukanbulan=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$bulan%' and flag1 = '$slamet'");
while ($masukbulan=mysqli_fetch_array($pemasukanbulan)){
$arraymasukbulan[] = $masukbulan['jumlah'];
}
$jumlahmasukbulan = array_sum($arraymasukbulan);

$pengeluaranbulan=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$bulan%' and flag1 = '$slamet'");
while ($keluarbulan=mysqli_fetch_array($pengeluaranbulan)){
$arraykeluarbulan[] = $keluarbulan['jumlah'];
}
$jumlahkeluarbulan = array_sum($arraykeluarbulan);//untuk data chart area

$sisauangbulanini=$jumlahmasukbulan-$jumlahkeluarbulan;

//GRAFIK MINGGUAN
$sekarang=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() and flag1 = '$slamet'");
while ($a=mysqli_fetch_array($sekarang)){
$arraysekarang[] = $a['jumlah'];}
$sekarang = array_sum($arraysekarang);

// $sekarang =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
// WHERE tgl_pemasukan = CURDATE()");
// $sekarang = mysqli_fetch_array($sekarang);

$satuhari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 1 DAY and flag1 = '$slamet'");
while ($b=mysqli_fetch_array($satuhari)){
$arraysatuhari[] = $b['jumlah'];}
$satuhari = array_sum($arraysatuhari);

// $satuhari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
// WHERE tgl_pemasukan = CURDATE() - INTERVAL 1 DAY");
// $satuhari= mysqli_fetch_array($satuhari);

$duahari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 2 DAY and flag1 = '$slamet'");
while ($c=mysqli_fetch_array($duahari)){
$arrayduahari[] = $c['jumlah'];}
$duahari = array_sum($arrayduahari);

// $duahari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
// WHERE tgl_pemasukan = CURDATE() - INTERVAL 2 DAY");
// $duahari= mysqli_fetch_array($duahari);

$tigahari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 3 DAY and flag1 = '$slamet'");
while ($d=mysqli_fetch_array($tigahari)){
$arraytigahari[] = $d['jumlah'];}
$tigahari = array_sum($arraytigahari);

// $tigahari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
// WHERE tgl_pemasukan = CURDATE() - INTERVAL 3 DAY");
// $tigahari= mysqli_fetch_array($tigahari);

$empathari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 4 DAY and flag1 = '$slamet'");
while ($e=mysqli_fetch_array($empathari)){
$arrayempathari[] = $e['jumlah'];}
$empathari = array_sum($arrayempathari);

// $empathari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
// WHERE tgl_pemasukan = CURDATE() - INTERVAL 4 DAY");
// $empathari= mysqli_fetch_array($empathari);

$limahari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 5 DAY and flag1 = '$slamet'");
while ($f=mysqli_fetch_array($limahari)){
$arraylimahari[] = $f['jumlah'];}
$limahari = array_sum($arraylimahari);


// $limahari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
// WHERE tgl_pemasukan = CURDATE() - INTERVAL 5 DAY");
// $limahari= mysqli_fetch_array($limahari);

$enamhari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 6 DAY and flag1 = '$slamet'");
while ($g=mysqli_fetch_array($enamhari)){
$arrayenamhari[] = $g['jumlah'];}
$enamhari = array_sum($arrayenamhari);

// $enamhari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
// WHERE tgl_pemasukan = CURDATE() - INTERVAL 6 DAY");
// $enamhari= mysqli_fetch_array($enamhari);

$tujuhhari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 7 DAY and flag1 = '$slamet'");
while ($h=mysqli_fetch_array($tujuhhari)){
$arraytujuhhari[] = $h['jumlah'];}
$tujuhhari = array_sum($arraytujuhhari);

// $tujuhhari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
// WHERE tgl_pemasukan = CURDATE() - INTERVAL 7 DAY");
// $tujuhhari= mysqli_fetch_array($tujuhhari);

//PER BULAN
$masukjanuari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-01-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanjanuari=mysqli_fetch_array($masukjanuari)){
$arraymasukbulanjanuari[] = $bulanjanuari['jumlah'];
}
$jumlahmasukbulanjanuari = array_sum($arraymasukbulanjanuari);

$masukfebruari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-02-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanfebruari=mysqli_fetch_array($masukfebruari)){
$arraymasukbulanfebruari[] = $bulanfebruari['jumlah'];
}
$jumlahmasukbulanfebruari = array_sum($arraymasukbulanfebruari);

$masukmaret=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-03-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanmaret=mysqli_fetch_array($masukmaret)){
$arraymasukbulanmaret[] = $bulanmaret['jumlah'];
}
$jumlahmasukbulanmaret = array_sum($arraymasukbulanmaret);

$masukapril=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-04-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanapril=mysqli_fetch_array($masukapril)){
$arraymasukbulanapril[] = $bulanapril['jumlah'];
}
$jumlahmasukbulanapril = array_sum($arraymasukbulanapril);

$masukmei=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-05-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanmei=mysqli_fetch_array($masukmei)){
$arraymasukbulanmei[] = $bulanmei['jumlah'];
}
$jumlahmasukbulanmei = array_sum($arraymasukbulanmei);

$masukjuni=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-06-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanjuni=mysqli_fetch_array($masukjuni)){
$arraymasukbulanjuni[] = $bulanjuni['jumlah'];
}
$jumlahmasukbulanjuni = array_sum($arraymasukbulanjuni);

$masukjuli=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-07-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanjuli=mysqli_fetch_array($masukjuli)){
$arraymasukbulanjuli[] = $bulanjuli['jumlah'];
}
$jumlahmasukbulanjuli = array_sum($arraymasukbulanjuli);

$masukagustus=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-08-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanagustus=mysqli_fetch_array($masukagustus)){
$arraymasukbulanagustus[] = $bulanagustus['jumlah'];
}
$jumlahmasukbulanagustus = array_sum($arraymasukbulanagustus);

$masukseptember=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-09-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanseptember=mysqli_fetch_array($masukseptember)){
$arraymasukbulanseptember[] = $bulanseptember['jumlah'];
}
$jumlahmasukbulanseptember = array_sum($arraymasukbulanseptember);

$masukoktober=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-10-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanoktober=mysqli_fetch_array($masukoktober)){
$arraymasukbulanoktober[] = $bulanoktober['jumlah'];
}
$jumlahmasukbulanoktober = array_sum($arraymasukbulanoktober);

$masuknovember=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-11-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulannovember=mysqli_fetch_array($masuknovember)){
$arraymasukbulannovember[] = $bulannovember['jumlah'];
}
$jumlahmasukbulannovember = array_sum($arraymasukbulannovember);

$masukdesember=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-12-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulandesember=mysqli_fetch_array($masukdesember)){
$arraymasukbulandesember[] = $bulandesember['jumlah'];
}
$jumlahmasukbulandesember = array_sum($arraymasukbulandesember);


//PER BULAN
$keluarjanuari=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-01-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanjanuari=mysqli_fetch_array($keluarjanuari)){
$arraykeluarbulanjanuari[] = $bulanjanuari['jumlah'];
}
$jumlahkeluarbulanjanuari = array_sum($arraykeluarbulanjanuari);

$keluarfebruari=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-02-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanfebruari=mysqli_fetch_array($keluarfebruari)){
$arraykeluarbulanfebruari[] = $bulanfebruari['jumlah'];
}
$jumlahkeluarbulanfebruari = array_sum($arraykeluarbulanfebruari);

$keluarmaret=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-03-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanmaret=mysqli_fetch_array($keluarmaret)){
$arraykeluarbulanmaret[] = $bulanmaret['jumlah'];
}
$jumlahkeluarbulanmaret = array_sum($arraykeluarbulanmaret);

$keluarapril=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-04-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanapril=mysqli_fetch_array($keluarapril)){
$arraykeluarbulanapril[] = $bulanapril['jumlah'];
}
$jumlahkeluarbulanapril = array_sum($arraymasukbulanapril);

$keluarmei=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-05-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanmei=mysqli_fetch_array($keluarmei)){
$arraykeluarbulanmei[] = $bulanmei['jumlah'];
}
$jumlahkeluarbulanmei = array_sum($arraykeluarbulanmei);

$keluarjuni=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-06-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanjuni=mysqli_fetch_array($keluarjuni)){
$arraykeluarbulanjuni[] = $bulanjuni['jumlah'];
}
$jumlahkeluarbulanjuni = array_sum($arraykeluarbulanjuni);

$keluarjuli=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-07-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanjuli=mysqli_fetch_array($keluarjuli)){
$arraykeluarbulanjuli[] = $bulanjuli['jumlah'];
}
$jumlahkeluarbulanjuli = array_sum($arraykeluarbulanjuli);

$keluaragustus=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-08-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanagustus=mysqli_fetch_array($keluaragustus)){
$arraykeluarbulanagustus[] = $bulanagustus['jumlah'];
}
$jumlahkeluarbulanagustus = array_sum($arraykeluarbulanagustus);

$keluarseptember=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-09-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanseptember=mysqli_fetch_array($keluarseptember)){
$arraykeluarbulanseptember[] = $bulanseptember['jumlah'];
}
$jumlahkeluarbulanseptember = array_sum($arraykeluarbulanseptember);

$keluaroktober=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-10-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulanoktober=mysqli_fetch_array($keluaroktober)){
$arraykeluarbulanoktober[] = $bulanoktober['jumlah'];
}
$jumlahkeluarbulanoktober = array_sum($arraykeluarbulanoktober);

$keluarnovember=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-11-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulannovember=mysqli_fetch_array($keluarnovember)){
$arraykeluarbulannovember[] = $bulannovember['jumlah'];
}
$jumlahkeluarbulannovember = array_sum($arraykeluarbulannovember);

$keluardesember=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-12-%' and nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
while ($bulandesember=mysqli_fetch_array($keluardesember)){
$arraykeluarbulandesember[] = $bulandesember['jumlah'];
}
$jumlahkeluarbulandesember = array_sum($arraykeluarbulandesember);

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
<h2> Selamat Datang, <?=$_SESSION['nama']?></h2><?php echo ""; ?>

<?php require 'user.php'; ?>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Statistik</h1>
            <a href="export-semua.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Laporan Total</a>
          </div>


<div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7" >
              <div class="card shadow mb-4" style="width: 1050px;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Pemasukan Per Bulan Pada Tahun <?=$tahun?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChartBulan"></canvas>
                  </div>
                </div>
              </div>
            </div>

        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7" >
              <div class="card shadow mb-4" style="width: 1050px;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Pengeluaran Per Bulan Pada Tahun <?=$tahun?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChartBulanKeluar"></canvas>
                  </div>
                </div>
              </div>
            </div>

        </div>

                <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7" >
              <div class="card shadow mb-4" style="width: 1050px;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Perbandingan Pemasukan dan Pengeluaran Tahun <?=$tahun?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChartPerbandingan"></canvas>
                  </div>
                </div>
              </div>
            </div>

        </div>

        <!-- /.container-fluid -->

      </div>
    <?php } else { ?>

     
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
<h2> Selamat Datang, <?=$_SESSION['nama']?></h2><?php echo ""; ?>

<?php require 'user.php'; 

?>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
             <form action="#" method="POST">  
        <select style="width: 220px;" class="form-control" id="gender1" name="kantor">
          <option value="" selected disabled>PILIH PERUSAHAAN</option>
         <?php
            $queryy = "select * from admin where level NOT IN('admin')";
            $hasil = mysqli_query($koneksi,$queryy);
            while ($qtabel = mysqli_fetch_assoc($hasil))
            {
              echo '<option value="'.$qtabel['level'].'">'.$qtabel['nama_lengkap'].'</option>';        
            }
            
         ?>
           
        </select>
           <input style="margin-top:8px; width: 220px;" type="submit" name="btn-bulan" value="Tampilkan Laporan">  
         </form>

         <?php 
          $namakantor = $_POST['kantor'];
          $date=date('Y-m-d');
                $bulan = substr($date, 4, 4);
                $tahun = substr($date, 0, 4);
                $karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan where nama_perusahaan = '$perusahaan'");
                $karyawan = mysqli_num_rows($karyawan);
                $perusahaan = $_SESSION['level'];

                $pengeluaran_bulan_ini = mysqli_query($koneksi, "SELECT jumlah FROM pengeluaran where tgl_pengeluaran like '%$bulan%' and nama_perusahaan = '$namakantor'");
                $pengeluaran_bulan_ini = mysqli_fetch_array($pengeluaran_bulan_ini);

                $pengeluaran_hari_ini = mysqli_query($koneksi, "SELECT jumlah FROM pengeluaran where tgl_pengeluaran = CURDATE() and nama_perusahaan = '$namakantor'");
                $pengeluaran_hari_ini = mysqli_fetch_array($pengeluaran_hari_ini);

                $pemasukan_bulan_ini = mysqli_query($koneksi, "SELECT jumlah FROM pemasukan where tgl_pemasukan like '%$bulan%' and nama_perusahaan = '$namakantor'");
                $pemasukan_bulan_ini = mysqli_fetch_array($pemasukan_bulan_ini);

                $pemasukan_hari_ini = mysqli_query($koneksi, "SELECT jumlah FROM pemasukan where tgl_pemasukan = CURDATE() and nama_perusahaan = '$namakantor'");
                $pemasukan_hari_ini = mysqli_fetch_array($pemasukan_hari_ini);



                $pemasukan=mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$perusahaan' and nama_perusahaan = '$namakantor'");
                while ($masuk=mysqli_fetch_array($pemasukan)){
                $arraymasuk[] = $masuk['jumlah'];
                }
                $jumlahmasuk = array_sum($arraymasuk);


                $pengeluaran=mysqli_query($koneksi,"SELECT * FROM pengeluaran where nama_perusahaan = '$perusahaan' and nama_perusahaan = '$namakantor'");
                while ($keluar=mysqli_fetch_array($pengeluaran)){
                $arraykeluar[] = $keluar['jumlah'];
                }
                $jumlahkeluar = array_sum($arraykeluar);
                $uang = $jumlahmasuk - $jumlahkeluar;

                $pemasukan2=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() and nama_perusahaan = '$namakantor'");
                while ($masuk2=mysqli_fetch_array($pemasukan2)){
                $arraymasuk2[] = $masuk2['jumlah'];
                }
                $jumlahmasuk2 = array_sum($arraymasuk2);

                $pengeluaran2=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran = CURDATE() and nama_perusahaan = '$namakantor'");
                while ($keluar2=mysqli_fetch_array($pengeluaran2)){
                $arraykeluar2[] = $keluar2['jumlah'];
                }
                $jumlahkeluar2 = array_sum($arraykeluar2);//untuk data chart area
                $sisauanghariini=$jumlahmasuk2-$jumlahkeluar2;

                $hutangbulan=mysqli_query($koneksi,"SELECT * FROM hutang where keterangan='HUTANG' AND tgl_hutang like '%$bulan%' and nama_perusahaan = '$namakantor'");
                while ($hutangan=mysqli_fetch_array($hutangbulan)){
                $arrayhutangbulan[] = $hutangan['jumlah'];
                }
                $hutangbulanini = array_sum($arrayhutangbulan);

                $pemasukanbulan=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$bulan%' and nama_perusahaan = '$namakantor'");
                while ($masukbulan=mysqli_fetch_array($pemasukanbulan)){
                $arraymasukbulan[] = $masukbulan['jumlah'];
                }
                $jumlahmasukbulan = array_sum($arraymasukbulan);

                $pengeluaranbulan=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$bulan%' and nama_perusahaan = '$namakantor'");
                while ($keluarbulan=mysqli_fetch_array($pengeluaranbulan)){
                $arraykeluarbulan[] = $keluarbulan['jumlah'];
                }
                $jumlahkeluarbulan = array_sum($arraykeluarbulan);//untuk data chart area

                $sisauangbulanini=$jumlahmasukbulan-$jumlahkeluarbulan;

                //GRAFIK MINGGUAN
                $sekarang=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() and nama_perusahaan = '$namakantor'");
                while ($a=mysqli_fetch_array($sekarang)){
                $arraysekarang[] = $a['jumlah'];}
                $sekarang = array_sum($arraysekarang);

                // $sekarang =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
                // WHERE tgl_pemasukan = CURDATE()");
                // $sekarang = mysqli_fetch_array($sekarang);

                $satuhari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 1 DAY and nama_perusahaan = '$namakantor'");
                while ($b=mysqli_fetch_array($satuhari)){
                $arraysatuhari[] = $b['jumlah'];}
                $satuhari = array_sum($arraysatuhari);

                // $satuhari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
                // WHERE tgl_pemasukan = CURDATE() - INTERVAL 1 DAY");
                // $satuhari= mysqli_fetch_array($satuhari);

                $duahari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 2 DAY and nama_perusahaan = '$namakantor'");
                while ($c=mysqli_fetch_array($duahari)){
                $arrayduahari[] = $c['jumlah'];}
                $duahari = array_sum($arrayduahari);

                // $duahari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
                // WHERE tgl_pemasukan = CURDATE() - INTERVAL 2 DAY");
                // $duahari= mysqli_fetch_array($duahari);

                $tigahari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 3 DAY and nama_perusahaan = '$namakantor'");
                while ($d=mysqli_fetch_array($tigahari)){
                $arraytigahari[] = $d['jumlah'];}
                $tigahari = array_sum($arraytigahari);

                // $tigahari =mysqli_query($koneksi, "SELECT jumlah FROM pemasukan
                // WHERE tgl_pemasukan = CURDATE() - INTERVAL 3 DAY");
                // $tigahari= mysqli_fetch_array($tigahari);

                $empathari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 4 DAY and nama_perusahaan = '$namakantor'");
                while ($e=mysqli_fetch_array($empathari)){
                $arrayempathari[] = $e['jumlah'];}
                $empathari = array_sum($arrayempathari);



                $limahari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 5 DAY and nama_perusahaan = '$namakantor'");
                while ($f=mysqli_fetch_array($limahari)){
                $arraylimahari[] = $f['jumlah'];}
                $limahari = array_sum($arraylimahari);


                $enamhari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 6 DAY and nama_perusahaan = '$namakantor'");
                while ($g=mysqli_fetch_array($enamhari)){
                $arrayenamhari[] = $g['jumlah'];}
                $enamhari = array_sum($arrayenamhari);


                $tujuhhari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan = CURDATE() - INTERVAL 7 DAY and nama_perusahaan = '$namakantor'");
                while ($h=mysqli_fetch_array($tujuhhari)){
                $arraytujuhhari[] = $h['jumlah'];}
                $tujuhhari = array_sum($arraytujuhhari);


                $masukjanuari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-01-%' and nama_perusahaan = '$namakantor'");
                while ($bulanjanuari=mysqli_fetch_array($masukjanuari)){
                $arraymasukbulanjanuari[] = $bulanjanuari['jumlah'];
                }
                $jumlahmasukbulanjanuari = array_sum($arraymasukbulanjanuari);

                $masukfebruari=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-02-%' and nama_perusahaan = '$namakantor'");
                while ($bulanfebruari=mysqli_fetch_array($masukfebruari)){
                $arraymasukbulanfebruari[] = $bulanfebruari['jumlah'];
                }
                $jumlahmasukbulanfebruari = array_sum($arraymasukbulanfebruari);

                $masukmaret=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-03-%' and nama_perusahaan = '$namakantor'");
                while ($bulanmaret=mysqli_fetch_array($masukmaret)){
                $arraymasukbulanmaret[] = $bulanmaret['jumlah'];
                }
                $jumlahmasukbulanmaret = array_sum($arraymasukbulanmaret);

                $masukapril=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-04-%' and nama_perusahaan = '$namakantor'");
                while ($bulanapril=mysqli_fetch_array($masukapril)){
                $arraymasukbulanapril[] = $bulanapril['jumlah'];
                }
                $jumlahmasukbulanapril = array_sum($arraymasukbulanapril);

                $masukmei=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-05-%' and nama_perusahaan = '$namakantor'");
                while ($bulanmei=mysqli_fetch_array($masukmei)){
                $arraymasukbulanmei[] = $bulanmei['jumlah'];
                }
                $jumlahmasukbulanmei = array_sum($arraymasukbulanmei);

                $masukjuni=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-06-%' and nama_perusahaan = '$namakantor'");
                while ($bulanjuni=mysqli_fetch_array($masukjuni)){
                $arraymasukbulanjuni[] = $bulanjuni['jumlah'];
                }
                $jumlahmasukbulanjuni = array_sum($arraymasukbulanjuni);

                $masukjuli=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-07-%' and nama_perusahaan = '$namakantor'");
                while ($bulanjuli=mysqli_fetch_array($masukjuli)){
                $arraymasukbulanjuli[] = $bulanjuli['jumlah'];
                }
                $jumlahmasukbulanjuli = array_sum($arraymasukbulanjuli);

                $masukagustus=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-08-%' and nama_perusahaan = '$namakantor'");
                while ($bulanagustus=mysqli_fetch_array($masukagustus)){
                $arraymasukbulanagustus[] = $bulanagustus['jumlah'];
                }
                $jumlahmasukbulanagustus = array_sum($arraymasukbulanagustus);

                $masukseptember=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-09-%' and nama_perusahaan = '$namakantor'");
                while ($bulanseptember=mysqli_fetch_array($masukseptember)){
                $arraymasukbulanseptember[] = $bulanseptember['jumlah'];
                }
                $jumlahmasukbulanseptember = array_sum($arraymasukbulanseptember);

                $masukoktober=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-10-%' and nama_perusahaan = '$namakantor'");
                while ($bulanoktober=mysqli_fetch_array($masukoktober)){
                $arraymasukbulanoktober[] = $bulanoktober['jumlah'];
                }
                $jumlahmasukbulanoktober = array_sum($arraymasukbulanoktober);

                $masuknovember=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-11-%' and nama_perusahaan = '$namakantor'");
                while ($bulannovember=mysqli_fetch_array($masuknovember)){
                $arraymasukbulannovember[] = $bulannovember['jumlah'];
                }
                $jumlahmasukbulannovember = array_sum($arraymasukbulannovember);

                $masukdesember=mysqli_query($koneksi,"SELECT * FROM pemasukan where tgl_pemasukan like '%$tahun-12-%' and nama_perusahaan = '$namakantor'");
                while ($bulandesember=mysqli_fetch_array($masukdesember)){
                $arraymasukbulandesember[] = $bulandesember['jumlah'];
                }
                $jumlahmasukbulandesember = array_sum($arraymasukbulandesember);


                //PER BULAN
                $keluarjanuari=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-01-%' and nama_perusahaan = '$namakantor'");
                while ($bulanjanuari=mysqli_fetch_array($keluarjanuari)){
                $arraykeluarbulanjanuari[] = $bulanjanuari['jumlah'];
                }
                $jumlahkeluarbulanjanuari = array_sum($arraykeluarbulanjanuari);

                $keluarfebruari=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-02-%' and nama_perusahaan = '$namakantor'");
                while ($bulanfebruari=mysqli_fetch_array($keluarfebruari)){
                $arraykeluarbulanfebruari[] = $bulanfebruari['jumlah'];
                }
                $jumlahkeluarbulanfebruari = array_sum($arraykeluarbulanfebruari);

                $keluarmaret=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-03-%' and nama_perusahaan = '$namakantor'");
                while ($bulanmaret=mysqli_fetch_array($keluarmaret)){
                $arraykeluarbulanmaret[] = $bulanmaret['jumlah'];
                }
                $jumlahkeluarbulanmaret = array_sum($arraykeluarbulanmaret);

                $keluarapril=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-04-%' and nama_perusahaan = '$namakantor'");
                while ($bulanapril=mysqli_fetch_array($keluarapril)){
                $arraykeluarbulanapril[] = $bulanapril['jumlah'];
                }
                $jumlahkeluarbulanapril = array_sum($arraymasukbulanapril);

                $keluarmei=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-05-%' and nama_perusahaan = '$namakantor'");
                while ($bulanmei=mysqli_fetch_array($keluarmei)){
                $arraykeluarbulanmei[] = $bulanmei['jumlah'];
                }
                $jumlahkeluarbulanmei = array_sum($arraykeluarbulanmei);

                $keluarjuni=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-06-%' and nama_perusahaan = '$namakantor'");
                while ($bulanjuni=mysqli_fetch_array($keluarjuni)){
                $arraykeluarbulanjuni[] = $bulanjuni['jumlah'];
                }
                $jumlahkeluarbulanjuni = array_sum($arraykeluarbulanjuni);

                $keluarjuli=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-07-%' and nama_perusahaan = '$namakantor'");
                while ($bulanjuli=mysqli_fetch_array($keluarjuli)){
                $arraykeluarbulanjuli[] = $bulanjuli['jumlah'];
                }
                $jumlahkeluarbulanjuli = array_sum($arraykeluarbulanjuli);

                $keluaragustus=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-08-%' and nama_perusahaan = '$namakantor'");
                while ($bulanagustus=mysqli_fetch_array($keluaragustus)){
                $arraykeluarbulanagustus[] = $bulanagustus['jumlah'];
                }
                $jumlahkeluarbulanagustus = array_sum($arraykeluarbulanagustus);

                $keluarseptember=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-09-%' and nama_perusahaan = '$namakantor'");
                while ($bulanseptember=mysqli_fetch_array($keluarseptember)){
                $arraykeluarbulanseptember[] = $bulanseptember['jumlah'];
                }
                $jumlahkeluarbulanseptember = array_sum($arraykeluarbulanseptember);

                $keluaroktober=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-10-%' and nama_perusahaan = '$namakantor'");
                while ($bulanoktober=mysqli_fetch_array($keluaroktober)){
                $arraykeluarbulanoktober[] = $bulanoktober['jumlah'];
                }
                $jumlahkeluarbulanoktober = array_sum($arraykeluarbulanoktober);

                $keluarnovember=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-11-%' and nama_perusahaan = '$namakantor'");
                while ($bulannovember=mysqli_fetch_array($keluarnovember)){
                $arraykeluarbulannovember[] = $bulannovember['jumlah'];
                }
                $jumlahkeluarbulannovember = array_sum($arraykeluarbulannovember);

                $keluardesember=mysqli_query($koneksi,"SELECT * FROM pengeluaran where tgl_pengeluaran like '%$tahun-12-%' and nama_perusahaan = '$namakantor'");
                while ($bulandesember=mysqli_fetch_array($keluardesember)){
                $arraykeluarbulandesember[] = $bulandesember['jumlah'];
                }
                $jumlahkeluarbulandesember = array_sum($arraykeluarbulandesember);
        
          ?>
          <!-- Page Heading -->
          <br>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Statistik</h1>
            <a href="export-semua.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Laporan Total</a>
          </div>


<div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7" >
              <div class="card shadow mb-4" style="width: 1050px;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Pemasukan Per Bulan Pada Tahun <?=$tahun?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChartBulan"></canvas>
                  </div>
                </div>
              </div>
            </div>

        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7" >
              <div class="card shadow mb-4" style="width: 1050px;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Pengeluaran Per Bulan Pada Tahun <?=$tahun?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChartBulanKeluar"></canvas>
                  </div>
                </div>
              </div>
            </div>

        </div>

                <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7" >
              <div class="card shadow mb-4" style="width: 1050px;">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Perbandingan Pemasukan dan Pengeluaran Tahun <?=$tahun?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChartPerbandingan"></canvas>
                  </div>
                </div>
              </div>
            </div>

        </div>

        <!-- /.container-fluid -->

      </div>

    <?php } ?>

      
      <!-- End of Main Content -->
    

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

  <!-- Page level custom scripts -->
  <script type="text/javascript">
  // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}


// Area Chart Bulanan
var ctx = document.getElementById("myAreaChartBulan");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan","Feb", "Mar", "Apr", "Mei", "Jun", "Jul","Agu","Sep","Okt","Nov","Des"],
    datasets: [{
      label: "Pemasukan",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $jumlahmasukbulanjanuari?>, <?php echo $jumlahmasukbulanfebruari ?>, <?php echo $jumlahmasukbulanmaret ?>, <?php echo $jumlahmasukbulanapril ?>, <?php echo $jumlahmasukbulanmei ?>, <?php echo $jumlahmasukbulanjuni ?>, <?php echo $jumlahmasukbulanjuli ?>, <?php echo $jumlahmasukbulanagustus ?>, <?php echo $jumlahmasukbulanseptember ?>, <?php echo $jumlahmasukbulanoktober ?>, <?php echo $jumlahmasukbulannovember ?>, <?php echo $jumlahmasukbulandesember ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp.' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
})

var ctx = document.getElementById("myAreaChartBulanKeluar");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan","Feb", "Mar", "Apr", "Mei", "Jun", "Jul","Agu","Sep","Okt","Nov","Des"],
    datasets: [{
      label: "Pengeluaran",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(255,0,0,0.72)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $jumlahkeluarbulanjanuari?>, <?php echo $jumlahkeluarbulanfebruari ?>, <?php echo $jumlahkeluarbulanmaret ?>, <?php echo $jumlahkeluarbulanapril ?>, <?php echo $jumlahkeluarbulanmei ?>, <?php echo $jumlahkeluarbulanjuni ?>, <?php echo $jumlahkeluarbulanjuli ?>, <?php echo $jumlahkeluarbulanagustus ?>, <?php echo $jumlahkeluarbulanseptember ?>, <?php echo $jumlahkeluarbulanoktober ?>, <?php echo $jumlahkeluarbulannovember ?>, <?php echo $jumlahkeluarbulandesember ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp.' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
})



var ctx = document.getElementById("myAreaChartPerbandingan");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan","Feb", "Mar", "Apr", "Mei", "Jun", "Jul","Agu","Sep","Okt","Nov","Des"],
    datasets: [{
      label: "Pengeluaran",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(255,0,0,0.72)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $jumlahkeluarbulanjanuari?>, <?php echo $jumlahkeluarbulanfebruari ?>, <?php echo $jumlahkeluarbulanmaret ?>, <?php echo $jumlahkeluarbulanapril ?>, <?php echo $jumlahkeluarbulanmei ?>, <?php echo $jumlahkeluarbulanjuni ?>, <?php echo $jumlahkeluarbulanjuli ?>, <?php echo $jumlahkeluarbulanagustus ?>, <?php echo $jumlahkeluarbulanseptember ?>, <?php echo $jumlahkeluarbulanoktober ?>, <?php echo $jumlahkeluarbulannovember ?>, <?php echo $jumlahkeluarbulandesember ?>
        ],
        fill: false,
      }, {
        label: "Pemasukan",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $jumlahmasukbulanjanuari?>, <?php echo $jumlahmasukbulanfebruari ?>, <?php echo $jumlahmasukbulanmaret ?>, <?php echo $jumlahmasukbulanapril ?>, <?php echo $jumlahmasukbulanmei ?>, <?php echo $jumlahmasukbulanjuni ?>, <?php echo $jumlahmasukbulanjuli ?>, <?php echo $jumlahmasukbulanagustus ?>, <?php echo $jumlahmasukbulanseptember ?>, <?php echo $jumlahmasukbulanoktober ?>, <?php echo $jumlahmasukbulannovember ?>, <?php echo $jumlahmasukbulandesember ?>],

      }],

  },

  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp.' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
})



// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["7 hari lalu","6 hari lalu", "5 hari lalu", "4 hari lalu", "3 hari lalu", "2 hari lalu", "1 hari lalu"],
    datasets: [{
      label: "Pendapatan",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo $tujuhhari?>, <?php echo $enamhari ?>, <?php echo $limahari ?>, <?php echo $empathari ?>, <?php echo $tigahari ?>, <?php echo $duahari ?>, <?php echo $satuhari ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'Rp.' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});

  
  </script>
  <?php 
  $total= $jumlahmasukbulan+$jumlahkeluarbulan+$sisauangbulanini ?>
  <script type="text/javascript">
  
  // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';
// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Pendapatan", "Pengeluaran", "Sisa"],
    datasets: [{
      data: [<?php echo round($jumlahmasukbulan/$total,2) ?>, <?php echo round($jumlahkeluarbulan/$total,2) ?>, <?php echo round($sisauangbulanini/$total,2) ?>],
      backgroundColor: ['#4e73df', '#e74a3b', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#e74a3b', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

  
  </script>
</body>
</html>