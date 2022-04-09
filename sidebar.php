  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
      error_reporting(0); 
      require 'cek-sesi.php';
      $level = $_SESSION['level'];
      if($level == "admin") {
    ?>

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-0">
          <img src="img/icon.png" class="img" width="45px" height="45px">
        </div>
        <div class="sidebar-brand-text mx-1 ">EWS HZ</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <hr class="sidebar-divider">

         <!-- Heading -->
      <div class="sidebar-heading">
        Laporan dan Statistik
      </div>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="laporan harian.php">
          <i class="fas fa-book-open"></i>
          <span>Laporan Harian</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="laporan mingguan.php">
          <i class="fas fa-book-open"></i>
          <span>Laporan Perminggu</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="laporan.php">
          <i class="fas fa-book-open"></i>
          <span>Laporan Perbulan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="laporan pertahun.php">
          <i class="fas fa-book-open"></i>
          <span>Laporan Pertahun</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="rekap halaman.php">
          <i class="fas fa-book-open"></i>
          <span>Rekapitulasi Laporan</span></a>
      </li>
      
      
      
      

      <li class="nav-item">
        <a class="nav-link" href="statistik.php">
          <i class="fas fa-chart-line"></i>
          <span>Statistik</span></a>
      </li>

      <hr class="sidebar-divider">
       <div class="sidebar-heading">
        Perusahaan
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="profile.php">
          <i class="fas fa-building"></i>
          <span>Profil Perusahaan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="kelola perusahaan.php">
          <i class="fas fa-tools"></i>
          <span>Kelola Perusahaan</span>
        </a>
      </li>

       <hr class="sidebar-divider">
       <div class="sidebar-heading">
        Request Update dan Hapus Data
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="request update data.php">
          <i class="fas fa-pencil-alt"></i>
          <span>Update Data</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="request delete data.php">
          <i class="far fa-trash-alt"></i>
          <span>Hapus Data</span>
        </a>
      </li>

      <hr class="sidebar-divider">
       <div class="sidebar-heading">
        Profil
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="profile.php">
          <i class="fa fa-key"></i>
          <span>Lihat Profil</span>
        </a>
      </li>
      
      <hr class="sidebar-divider">
       <div class="sidebar-heading">
        Log Login
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="log.php">
          <i class="fa fa-key"></i>
          <span>Log</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
    </ul>
    <?php } else { ?>

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-0">
          <img src="img/icon.png" class="img" width="45px" height="45px">
        </div>
        <div class="sidebar-brand-text mx-1 ">DOHARA</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

   
      <div class="sidebar-heading">
        Transaksi
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pendapatan.php">
          <i class="fas fa-fw fa-arrow-up"></i>
          <span>Pemasukan</span>
        </a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pengeluaran.php" >
          <i class="fas fa-fw fa-arrow-down"></i>
          <span>Pengeluaran</span>
        </a>
      </li>

          <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Laporan dan Statistik
      </div>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="laporan harian.php">
          <i class="fas fa-book-open"></i>
          <span>Laporan Harian</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="laporan mingguan.php">
          <i class="fas fa-book-open"></i>
          <span>Laporan Perminggu</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="laporan.php">
          <i class="fas fa-book-open"></i>
          <span>Laporan Perbulan</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="laporan pertahun.php">
          <i class="fas fa-book-open"></i>
          <span>Laporan Pertahun</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="statistik.php">
          <i class="fas fa-chart-line"></i>
          <span>Statistik</span></a>
      </li>
      
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Status Perubahan
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="status update.php">
          <i class="fa fa-pencil"></i>
          <span>Status Update</span>
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link collapsed" href="status hapus.php">
          <i class="fa fa-window-close"></i>
          <span>Status Hapus</span>
        </a>
      </li>

      <hr class="sidebar-divider">
       <div class="sidebar-heading">
        Profil
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="profile.php">
          <i class="fa fa-key"></i>
          <span>Lihat Profil</span>
        </a>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
    </ul>
  <?php } ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class=" d-flex flex-column">