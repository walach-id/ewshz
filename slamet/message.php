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
require 'sidebar.php'; ?>

      <!-- Main Content -->
      <div id="content">

<?php require 'navbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pesan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Pengirim</th>
                      <th>Tanggal Kirim</th>
                      <th>Jam Kirim</th>
                      
                      <th>Isi Pesan </th>
                      <th>Status Pesan </th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $query = mysqli_query($koneksi,"SELECT * FROM alert_message WHERE penerima = 'rsdh' order by tanggal_pesan DESC");
                      $nomer = 1;
                      while ($data = mysqli_fetch_assoc($query)) 
                      { $id_pesan = $data['id'];
                      ?>
                    <tr>
                      <td>Hafizzurahman</td>
                      <td><?php echo $data['tanggal_pesan']; ?></td>
                      <td><?php echo $data['jam_pesan']; ?></td>
                      <td><?php echo $data['isi_pesan']; ?></td>
                      <td><?php echo $data['status'];?> </td>
                      <td>
                       
                        <a href="#" type="button" class=" fa fa-eye btn btn-primary btn-md" data-toggle="modal" data-target="#modalpesan">

                        </td>
                    </tr>
                  </tbody>
                <?php } ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
<div class="modal fade" id="modalpesan<?php echo $data['id_pesan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Status Pesan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-check">
          <form action="ubah-status.php?id=<?php echo $id_pesan; ?>" method="post">
          <select class=""></select>   
         
          <label class="form-check-label" for="exampleRadios1">
            On (Pesan dilaksanakan)
          </label>
          
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Ubah Status">
      </form>
      </div>
    </div>
  </div>
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
