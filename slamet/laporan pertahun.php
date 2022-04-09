<?php
require 'cek-sesi.php';
error_reporting(0);
$date=date('Y-m-d');
$bulan = substr($date, 5, 2);
$tahun = substr($date, 0, 4);

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

  <title>Laporan Keuangan</title>

  <!-- Custom fonts for this template -->
 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<?php 
require 'koneksi.php';
require 'sidebar.php'; 
$perusahaan = $_SESSION['level'];
$slamet = "Admin Slamet";
?>

      <!-- Main Content -->
      <div id="content">

<?php require 'navbar.php'; ?>

        <div class="container-fluid">

         <br/>
         <?php $namakantor = $_POST['kantor']; ?>

          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Jumlah Transaksi </th>
                      <th>Jumlah Total Uang</th>
            <th>Download</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$perusahaan = $_SESSION['level'];
// SELECT * FROM pemasukan where month(tgl_pemasukan)= '12'

//$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where month(tgl_pemasukan) like '%$tahun%' AND tgl_pemasukan like '%$bulanangka%' and nama_perusahaan = '$perusahaan' ");

$pemasukan1=mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");

while ($masuk1=mysqli_fetch_array($pemasukan1)){
$arraymasuk1[] = $masuk1['jumlah'];
}
$jumlahmasuk1 = array_sum($arraymasuk1);


$pengeluaran1=mysqli_query($koneksi,"SELECT * FROM pengeluaran where nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");

while ($keluar1=mysqli_fetch_array($pengeluaran1)){
$arraykeluar1[] = $keluar1['jumlah'];
}
$jumlahkeluar1 = array_sum($arraykeluar1);


$query2 = mysqli_query($koneksi,"SELECT * FROM pemasukan where nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");
$query2 = mysqli_num_rows($query2);

$query3 = mysqli_query($koneksi,"SELECT id_pengeluaran FROM pengeluaran where nama_perusahaan = '$perusahaan' and flag1 = '$slamet'");

$query3 = mysqli_num_rows($query3);
$no1 = 1;
?>
                    <tr>
                      <td>Pemasukan</td>
                      <td><?=$query2?></td>
                      <td>Rp. <?=number_format($jumlahmasuk1,2,',','.');?></td>
                    <td>
                      <a href="export-pemasukan-bulan.php?id=<?php echo $id_pesan; ?>" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
                    </td>
                  </tr>

                   <tr>
                      <td>Pengeluaran</td>
                      <td><?=$query3?></td>
                      <td>Rp. <?=number_format($jumlahkeluar1,2,',','.');?></td>
            <td>
                    <!-- Button untuk modal -->
<a href="export-pengeluaran-bulan.php" type="button" class="btn btn-primary btn-md"><i class="fa fa-download"></i></a>
</td>
</tr>
                  </tbody>
                </table>
                <br/>
                <?php
             
               
               if($jumlahmasuk1 > $jumlahkeluar1) {
               $sisa  = $jumlahmasuk1 - $jumlahkeluar1;
               $persen = ($sisa / $jumlahkeluar1);
               $x = round($persen,2) * 100;
               $judul = "Keuntungan";
               }
               elseif ($jumlahkeluar1 > $jumlahmasuk1) {
               $sisa  = $jumlahmasuk1 - $jumlahkeluar1;
               $persen = ($sisa / $jumlahkeluar1);
               $x = round($persen,2) * 100;
               $judul = "Pengeluaran";
               }


              ?>
              <p style="color: black;"><b>KETERANGAN </b></p>
             
               </div>
              <p style="color: red;"><b> Total Pemasukan : <?php echo "Rp. ".number_format($sisa,2,',','.'); ?></b></p>
              <p style="color: green;"><b> Persentase <?php echo $judul; ?> : <?php echo $x; ?> % </b></p>
              
            </div>
          </div>
        </div>
        <?php require 'footer.php'?>
      </div>

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
<?php require 'logout-modal.php';?>

  <!-- Bootstrap core JavaScript-->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
