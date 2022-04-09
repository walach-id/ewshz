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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.0.2/cleave.min.js"></script>
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
$level=$_SESSION['level'];?>   
     <!-- Main Content -->
      <div id="content">

<?php require ('navbar.php'); ?> 

		        <!-- Begin Page Content -->
        <div class="container-fluid">
   <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-xl-10 col-lg-7">
               <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Pemasukan</i></button><br>

			           <!-- DataTales Example -->
	
					   <!-- <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Pemasukan</i></button><br> -->

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi Masuk </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
                      <th>Jumlah</th>
					           <th>Aksi</th>
                    

                    </tr>
                  </thead>
   
                  <tbody>
				  <?php 
$query = mysqli_query($koneksi,"SELECT * FROM pemasukan WHERE nama_perusahaan = '$level' and NOT flag1 = 'Admin Slamet' order by tgl_pemasukan DESC");
$nomer = 1;
while ($data = mysqli_fetch_assoc($query)) 
{
?>
                    <tr>
                      <td><?=$nomer++?></td>
                      <td><?=$data['tgl_pemasukan']?></td>
                      <td><?=$data['jam_pemasukan']?></td>
                      <td>Rp <?=number_format($data['jumlah'],0,',','.');?></td>
					  <td>
                    <!-- Button untuk modal -->
<a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id_pemasukan']; ?>"></a>
</td>



</tr>
<!-- Modal Edit Mahasiswa-->
<div class="modal fade" id="myModal<?php echo $data['id_pemasukan']; ?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Ubah Data Pemasukan</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form role="form" action="proses-edit-pemasukan.php" method="post">

<?php
$id = $data['id_pemasukan']; 
$query_edit = mysqli_query($koneksi,"SELECT * FROM pemasukan WHERE id_pemasukan='$id'");
//$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($query_edit)) {  
?>


<input type="hidden" name="id_pemasukan" value="<?php echo $row['id_pemasukan']; ?>">

<div class="form-group">
<label>Id</label>
<input type="text" name="id_pemasukan" class="form-control" value="<?php echo $row['id_pemasukan']; ?>" disabled>      
</div>

<div class="form-group">
<p style="font-weight: bold;">Update / Hapus Data Pada Tanggal : <?php echo $row['tgl_pemasukan']; ?></p>
</div>

<div class="form-group">
<label>Jumlah</label>
<input class="input-numeral" placeholder="Masukan Nominal" name="jumlah" style="width:100%;" />
</div>

<div class="modal-footer">  
<button type="submit" class="btn btn-success">Ubah</button>
<a href="hapus-pemasukan.php?id_pemasukan=<?=$row['id_pemasukan'];?>&jumlah=<?=$row['jumlah']; ?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
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
          <h4 class="modal-title">Tambah Pemasukan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- body modal -->
    <form action="tambah-pendapatan.php" method="get">
        <div class="modal-body">
    <!-- Tanggal *: 
         <input type="date" class="form-control" name="tgl_pemasukan" required="required">
    Jam *: 
         <input type="time" class="form-control" name="jam_pemasukan" required="required">
    Nominal (Rp.) *: -->
        <p style="font-weight: bold;">Pemasukan Pada Tanggal : <?php echo $tgl; ?></p>
         Nominal Pemasukan (Rp.) *:  
         <!--<input type="number" class="form-control" name="jumlah"  required="required">-->
         <br>
         <input class="input-numeral" placeholder="Masukan Nominal" name="jumlah" style="width:100%;" />
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
    <button type="submit" class="btn btn-success" >Tambah</button>
    </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        </div>
      </div>

    </div>
    <script type="text/javascript">
	    	var cleaveNumeral = new Cleave('.input-numeral', {
		    numeral: true,
		    numeralThousandsGroupStyle: 'thousand'
		});
	    
	    </script>
</body>

</html>