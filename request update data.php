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

  <title>Kelola Akun</title>

  <!-- Custom fonts for this template -->
 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php require 'koneksi.php'; ?>
<?php require 'sidebar.php'; ?>
      <!-- Main Content -->
      <div id="content">

<?php require 'navbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
<?php
if ($_SESSION['id'] == 1) {
	$lihat = 'none';
} else {
	$lihat = 'hidden';
};
?>
<!-- <button type="button" class="btn btn-success" style="margin:5px; visibility:<?=$lihat?>" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Admin</i></button><br>
-->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Request Update Data Pemasukan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID Pemasukan</th>
                      <th>Tanggal Update</th>
                      <th>Jam Update</th>
                      <th>Perubahan Data</th>
                      <th>Perusahaan</th>
                      <th>Status</th>
                      <th>Update Status</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                  </tfoot>
                  <tbody>
				  <?php 
				  $level_user = $_SESSION['level'];
          $query = mysqli_query($koneksi,"SELECT * FROM tahan_ubah_pemasukan");
          while ($data = mysqli_fetch_assoc($query)) {
?>
                    <tr>
                      <td><?=$data['id_pemasukan']?></td>
                      <td><?=$data['tgl_pemasukan']?></td>
                      <td><?=$data['jam_pemasukan']?></td>
                      <td><?=$data['jumlah']?></td>
                      <td><?=$data['nama_perusahaan']?></td>
                      <td><?=$data['status']?></td>
                      <td><a href="status update pemasukan.php?id_pemasukan=<?=$data['id_pemasukan'];?>&jumlah=<?=$data['jumlah'];?>&tgl=<?=$data['tgl_pemasukan'];?>&jam=<?=$data['jam_pemasukan'];?>&comp=<?=$data['nama_perusahaan'];?>&status=<?php echo "Diterima";?>"> Status Terima </a> <br/> <a href="status update pemasukan.php?id_pemasukan=<?=$data['id_pemasukan'];?>&jumlah=<?=$data['jumlah'];?>&tgl=<?=$data['tgl_pemasukan'];?>&jam=<?=$data['jam_pemasukan'];?>&comp=<?=$data['nama_perusahaan'];?>&status=<?php echo "Ditolak";?>"> Status Tolak</a></td>
                    </tr>

<!-- Modal Edit Mahasiswa-->
<div class="modal fade" id="myModal<?php echo $data['id_admin']; ?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Ubah Data Admin</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form role="form" action="proses-edit-admin.php" method="get">

<?php
$id = $data['id_admin']; 
$query_edit = mysqli_query($koneksi,"SELECT * FROM admin WHERE id_admin='$id'");
//$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($query_edit)) {  
?>


<input type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">

<div class="form-group">
<label>ID</label>
<input type="text" name="id" class="form-control" value="<?php echo $row['id_admin']; ?>" disabled>      
</div>

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">      
</div>


<div class="form-group">
<label>Email</label>
<input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">      
</div>

<div class="form-group">
<label>Password</label>
<input type="text" name="pass" class="form-control" value="<?php echo $row['pass']; ?>">      
</div>

<div class="modal-footer">  
<button type="submit" class="btn btn-success">Ubah</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
</div>
<?php 
}
//mysql_close($host);
?>  
       
</form>
</div>
</div>

</div>
</div>



 <!-- Modal -->
  <div id="myModalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
		    <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
		<form action="tambah-admin.php" method="get">
        <div class="modal-body">
		Nama : 
         <input type="text" class="form-control" name="nama">
		Email : 
         <input type="text" class="form-control" name="email">
		Password : 
         <input type="password" class="form-control" name="pass">
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
		<button type="submit" class="btn btn-success" >Tambah</button>
		</form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </div>

    </div>
  </div>


<?php               
} 
?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
		  


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Request Update Data Pengeluaran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID Pemasukan</th>
                      <th>Tanggal Update</th>
                      <th>Jam Update</th>
                      <th>Perubahan Data</th>
                      <th>Perusahaan</th>
                      <th>Status</th>
                      <th>Update Status</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                  </tfoot>
                  <tbody>
          <?php 
          $level_user = $_SESSION['level'];
          $query = mysqli_query($koneksi,"SELECT * FROM tahan_ubah_pengeluaran");
          while ($data = mysqli_fetch_assoc($query)) {
?>
                    <tr>
                      <td><?=$data['id_pengeluaran']?></td>
                      <td><?=$data['tgl_pengeluaran']?></td>
                      <td><?=$data['jam_pengeluaran']?></td>
                      <td><?=$data['jumlah']?></td>
                      <td><?=$data['nama_perusahaan']?></td>
                      <td><?=$data['status']?></td>
                      <td><a href="status update pengeluaran.php?id_pengeluaran=<?=$data['id_pengeluaran'];?>&jumlah=<?=$data['jumlah'];?>&tgl=<?=$data['tgl_pengeluaran'];?>&jam=<?=$data['jam_pengeluaran'];?>&comp=<?=$data['nama_perusahaan'];?>&status=<?php echo "Diterima";?>"> Status Terima </a> <br/> <a href="status update pengeluaran.php?id_pengeluaran=<?=$data['id_pengeluaran'];?>&jumlah=<?=$data['jumlah'];?>&tgl=<?=$data['tgl_pengeluaran'];?>&jam=<?=$data['jam_pengeluaran'];?>&comp=<?=$data['nama_perngeluaran'];?>&status=<?php echo "Ditolak";?>"> Status Tolak</a></td>
                    </tr>

<!-- Modal Edit Mahasiswa-->
<div class="modal fade" id="myModal<?php echo $data['id_admin']; ?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Ubah Data Admin</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form role="form" action="proses-edit-admin.php" method="get">

<?php
$id = $data['id_admin']; 
$query_edit = mysqli_query($koneksi,"SELECT * FROM admin WHERE id_admin='$id'");
//$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($query_edit)) {  
?>


<input type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">

<div class="form-group">
<label>ID</label>
<input type="text" name="id" class="form-control" value="<?php echo $row['id_admin']; ?>" disabled>      
</div>

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">      
</div>


<div class="form-group">
<label>Email</label>
<input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">      
</div>

<div class="form-group">
<label>Password</label>
<input type="text" name="pass" class="form-control" value="<?php echo $row['pass']; ?>">      
</div>

<div class="modal-footer">  
<button type="submit" class="btn btn-success">Ubah</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
</div>
<?php 
}
//mysql_close($host);
?>  
       
</form>
</div>
</div>

</div>
</div>



 <!-- Modal -->
  <div id="myModalTambah" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
    <form action="tambah-admin.php" method="get">
        <div class="modal-body">
    Nama : 
         <input type="text" class="form-control" name="nama">
    Email : 
         <input type="text" class="form-control" name="email">
    Password : 
         <input type="password" class="form-control" name="pass">
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
    <button type="submit" class="btn btn-success" >Tambah</button>
    </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </div>

    </div>
  </div>


<?php               
} 
?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


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

</body>

</html>
