<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PRIMBON | YOSODIPURO</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/template/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/template/')?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/template/')?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= base_url('assets/template/')?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a> -->
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->


      
      <!-- Notifications Dropdown Menu -->
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url('assets/template/')?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Ramalan Mangsa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
            <a href="<?= base_url('kwitansi')?>" class="nav-link">
              <i class="nav-icon fa fa-file text-danger"></i>
              <p class="text">Kwitansi</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('permohonan')?>" class="nav-link">
              <i class="nav-icon fa fa-users text-danger"></i>
              <p class="text">Permohonan</p>
            </a>
          </li>

          
          <li class="nav-item">
            <a  href="<?= base_url('ktp_el')?>" class="nav-link">
              <i class="nav-icon fa fa-address-card text-danger"></i>
              <p class="text">KTP EL</p>
            </a>
          </li>

          <li class="nav-item">
            <a  href="<?= base_url('antrian')?>" class="nav-link">
              <i class="nav-icon fa fa-cog text-danger"></i>
              <p class="text">Antrian</p>
            </a>
          </li>
     
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cart-arrow-down text-danger"></i>
              <p class="text">Barang</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Kwitansi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">


              <li class="breadcrumb-item active"> <div id="clock"></div></li>

             

              <script>
// Nama hari bahasa Indonesia
const hariIndo = ["MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU"];
// Nama bulan bahasa Indonesia
const bulanIndo = ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
// Pasaran Jawa urutan LEGI, PAHING, PON, WAGE, KLIWON
const pasaran = ["LEGI", "PAHING", "PON", "WAGE", "KLIWON"];

// Hitung index pasaran Jawa berdasarkan tanggal
function hitungPasaran(tanggal) {
  const tglDini = new Date(1900,0,1); // 1 Jan 1900 = Kliwon (index 4)
  const diff = Math.floor((tanggal - tglDini) / (1000 * 60 * 60 * 24));
  return pasaran[(diff + 4) % 5];
}

// Ambil waktu awal dari server PHP
let serverTime = new Date("<?php echo date("Y-m-d H:i:s"); ?>");

function updateClock() {
  serverTime.setSeconds(serverTime.getSeconds() + 1);

  const hari = hariIndo[serverTime.getDay()];
  const p = hitungPasaran(serverTime);
  const tgl = serverTime.getDate();
  const bln = bulanIndo[serverTime.getMonth()];
  const thn = serverTime.getFullYear();

  // Format jam:menit:detik dengan 2 digit
  const jam = String(serverTime.getHours()).padStart(2, '0');
  const menit = String(serverTime.getMinutes()).padStart(2, '0');
  const detik = String(serverTime.getSeconds()).padStart(2, '0');

  const teks = `${hari} ${p} ${tgl} ${bln} ${thn} ${jam}:${menit}:${detik}`;
  document.getElementById("clock").innerText = teks;
}

updateClock();
setInterval(updateClock, 1000);
</script>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->

           <!-- TABLE: LATEST ORDERS -->
           <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Pencarian Data</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
            
 
              <div class="card-body p-0">
                <div class="container">
                <form class="row align-items-center" method="GET" action="cari_kwitansi.php">
                    <div class="col-auto">
                      <label for="tanggal_awal" class="col-form-label">Tanggal Awal</label>
                    </div>
                    <div class="col-auto">
                      <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
                    </div>

                    <div class="col-auto">
                      <label for="tanggal_akhir" class="col-form-label">Tanggal Akhir</label>
                    </div>
                    <div class="col-auto">
                      <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
                    </div>

                    <div class="col-auto">
                      <a class="btn btn-primary" onclick="cari_data();" ><i class="fa fa-search"></i>  Cari </a>
                      <!-- <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i> Cari
                      </button> -->
                    </div>
                </form>
                </div>
                
             

                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->


            
   
   
            <div id="top_menu"></div>
            <div id="graph"></div>
            <div id="tabel"></div>

            

        
        <!-- /.row -->

                
                  
                 
            
          
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
      

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Create By Benny Danang Kurniawan &copy; <?= date('Y')?> </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url('assets/template/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url('assets/template/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/template/')?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/template/')?>dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<!-- <script src="<?= base_url('assets/template/')?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script> -->
<!-- <script src="<?= base_url('assets/template/')?>plugins/raphael/raphael.min.js"></script> -->
<!-- <script src="<?= base_url('assets/template/')?>plugins/jquery-mapael/jquery.mapael.min.js"></script> -->
<!-- <script src="<?= base_url('assets/template/')?>plugins/jquery-mapael/maps/usa_states.min.js"></script> -->
<!-- ChartJS -->
<!-- <script src="<?= base_url('assets/template/')?>plugins/chart.js/Chart.min.js"></script> -->

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/template/')?>dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/template/')?>dist/js/pages/dashboard2.js"></script> -->
<script src="https://code.highcharts.com/highcharts.js"></script>
</body>
</html>


<script>

default_();

function default_() {
  var tgl_now = '<?= date("Y-m-d")?>';
  $('#top_menu').load('<?= base_url("kwitansi/top_menu/")?>'+tgl_now+'/'+tgl_now);
$('#tabel').load('<?= base_url("kwitansi/tabel/")?>'+tgl_now+'/'+tgl_now);
$('#graph').load('<?= base_url("kwitansi/graph/")?>'+tgl_now+'/'+tgl_now);
}



 function cari_data() {
var tanggal_awal = $('#tanggal_awal').val();
var tanggal_akhir = $('#tanggal_akhir').val();
var tgl_now = '<?= date("Y-m-d")?>';

if(tanggal_awal =='' || tanggal_akhir == ''){

$('#top_menu').load('<?= base_url("kwitansi/top_menu/")?>'+tgl_now+'/'+tgl_now);
$('#tabel').load('<?= base_url("kwitansi/tabel/")?>'+tgl_now+'/'+tgl_now);
$('#graph').load('<?= base_url("kwitansi/graph/")?>'+tgl_now+'/'+tgl_now);


} else {
$('#top_menu').load('<?= base_url("kwitansi/top_menu/")?>'+tanggal_awal+'/'+tanggal_akhir);
$('#tabel').load('<?= base_url("kwitansi/tabel/")?>'+tanggal_awal+'/'+tanggal_akhir);
$('#graph').load('<?= base_url("kwitansi/graph/")?>'+tanggal_awal+'/'+tanggal_akhir);



} 
  
 }


</script>