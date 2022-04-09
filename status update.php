<?php
require 'cek-sesi.php';
$perusahaan = $_SESSION['level'];
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

  <title>Status Update</title>

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
require 'sidebar.php'; ?>

      <!-- Main Content -->
      <div id="content">

<?php require 'navbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Status Update Data Pemasukan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tanggal Hapus </th>
                      <th>Jam Hapus</th>
					            <th>Jumlah</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $perusahaan = $_SESSION['level'];
                    $sql=mysqli_query($koneksi,"SELECT * FROM tahan_ubah_pemasukan where nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'");

                    while ($row=mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['tgl_pemasukan']; ?></td>
                      <td><?php echo $row['jam_pemasukan']; ?></td>
                      <td><?php echo $row['jumlah']; ?></td>
                      <td><?php echo $row['status']; ?></td>
        					 </tr>
          </tbody>
        <?php } ?>
        </table>
              
              
            </div>
          </div>

        </div>


         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Status Update Data Pengeluaran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tanggal Hapus</th>
                      <th>Jam Hapus</th>
                      <th>Jumlah</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $perusahaan = $_SESSION['level'];
                    $sql=mysqli_query($koneksi,"SELECT * FROM tahan_ubah_pengeluaran where nama_perusahaan = '$perusahaan' and NOT flag1 = 'Admin Slamet'");

                    while ($row=mysqli_fetch_array($sql)){
                    ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['tgl_pengeluaran']; ?></td>
                      <td><?php echo $row['jam_pengeluaran']; ?></td>
                      <td><?php echo $row['jumlah']; ?></td>
                      <td><?php echo $row['status']; ?></td>
                   </tr>
          </tbody>
        <?php } ?>
        </table>
              
              
            </div>
          </div>

        </div>
  
        </div>
        <!-- /.container-fluid -->


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

</body>

</html>
