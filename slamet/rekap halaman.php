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

  <title>Dashboard - <?=$_SESSION['nama']?></title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php
 ?>
<?php 
$tgl=date('d-m-Y');
require 'koneksi.php';
require ('sidebar.php'); 
$level=$_SESSION['level'];
$slamet = "Admin Slamet";
?>   
     <!-- Main Content -->
      <div id="content">

<?php require ('navbar.php'); ?> 
<?php 

$pemasukan=mysqli_query($koneksi,"SELECT * FROM pemasukan where flag1 = '$slamet' ");
while ($masuk=mysqli_fetch_array($pemasukan)){
$arraymasuk[] = $masuk['jumlah'];
}
$jumlahmasuk = array_sum($arraymasuk1);

$pengeluaran=mysqli_query($koneksi,"SELECT * FROM pengeluaran where flag1 = '$slamet'");
while ($masuk=mysqli_fetch_array($pengeluaran)){
$arraykeluar[] = $keluar['jumlah'];
}
$jumlahkeluar= array_sum($arraykeluar);

$total_saldo_seluruh = $jumlahmasuk - $jumlahkeluar;

$pemasukan2=mysqli_query($koneksi,"SELECT nama_perusahaan FROM pemasukan where flag1 = '$slamet'");
while ($masuk2=mysqli_fetch_array($pemasukan2)){
$arraymasuk2[] = $masuk2['nama_perusahaan'];
}



?>



		        <!-- Begin Page Content -->
        <div class="container-fluid">
   <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-xl-12 col-lg-7">
                <a href="export-semua-laporan.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Download Laporan Total</a>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detail Perusahaan </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                     <th>No.</th>
                     <th>Nama</th>
                     <th>Total Pemasukan</th>
                     <th>Total Pengeluaran</th>
					 <th>Saldo Akhir</th>
                     
                    </tr>
                  </thead>
                  <?php
                   $query = mysqli_query($koneksi,"SELECT pemasukan.nama_perusahaan, SUM(pemasukan.jumlah) as total_pemasukan, SUM(pengeluaran.jumlah) as total_pengeluaran, SUM(pemasukan.jumlah)-SUM(pengeluaran.jumlah) as saldo_akhir FROM pemasukan JOIN pengeluaran ON pemasukan.nama_perusahaan = pengeluaran.nama_perusahaan where flag1 = '$slamet'GROUP BY nama_perusahaan");
                  $nomer = 1;
                  while ($data = mysqli_fetch_assoc($query)) 
                  {
                  ?>
                    <tr>
                      <td><?=$nomer++?></td>
                      <td><?=$data['nama_perusahaan']?></td>
                      <td><?=$data['total_pemasukan']?></td>
                      <td><?=$data['total_pengeluaran']?></td>
                      <td><?=$data['saldo_akhir']?></td>
                      
</tr>
<!-- Modal Edit Mahasiswa-->
<?php } ?>
</div>
</div>

</div>
</div>
 <!-- Modal -->

  </div>

                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
		  </div>


       </div>
        <!-- /.container-fluid -->

      </div>
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

  <div id="myModalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Perusahaan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
    <form action="tambah-perusahaan.php" method="POST">
        <div class="modal-body">
    <!-- Tanggal *: 
         <input type="date" class="form-control" name="tgl_pemasukan" required="required">
    Jam *: 
         <input type="time" class="form-control" name="jam_pemasukan" required="required">
    Nominal (Rp.) *: -->
         Nama User :  
         <input type="text" class="form-control" name="nama_user"  required="required">

         Email / Username :  
         <input type="text" class="form-control" name="email"  required="required">
         
         Password : 
         <input type="text" class="form-control" name="password"  required="required">
         
         Level :
         <input type="text" class="form-control" name="level"  required="required">
         
         Nama Perusahaan  
         <input type="text" class="form-control" name="nama_perusahaan"  required="required">

         No.Whatsapp 
         <input type="number" class="form-control" name="no_wa"  required="required">
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
    <button type="submit" class="btn btn-success" >Tambah</button>
    </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </div>

    </div>
</body>

</html>