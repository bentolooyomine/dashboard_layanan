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
            <h1 class="m-0">Ramalan Mangsa Sasi <?= date('M')?></h1>
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
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Proses WA+Notif</span>
                <span class="info-box-number">
                  <?= $wa_belum->jumlah?>
                  <small>Pesan</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Nomor Valid</span>
                <span class="info-box-number"><?= $outbox_status[0]->jumlah?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Nomor Invalid</span>
                <span class="info-box-number"><?= $outbox_status[1]->jumlah?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Kirim WA+Notif</span>
                <span class="info-box-number"><?= $jumlah_kirim[0]->jumlah?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Report YOSODIPURO</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Pelayanan Kwitansi Dukcapil</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Readme !</strong>
                    </p>
<p>Dengan ini kami sampaikan bahwa aplikasi PRIMBON YOSODIPURO saat ini masih dalam tahap prototype. Data yang ditampilkan merupakan hasil pengolahan dengan metode sederhana dan bertujuan sebagai gambaran umum pelayanan Dispendukcapil Kabupaten Boyolali. Proyeksi 1 bulan ke belakang (berdasarkan data pelayanan yang telah masuk)

Perkiraan 1 bulan ke depan (menggunakan pendekatan sederhana dari tren data sebelumnya) Mohon dipahami bahwa informasi yang ditampilkan belum bersifat final dan akan terus diperbarui serta dikembangkan untuk meningkatkan akurasi dan keandalan data. (B.D.K) </p>
                 
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">

                <?php
                foreach ($prediksi as $k) {
                  ?>
                 <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                    <?php 
                        if($k->status_perubahan =="Menurun"){
                          echo ' <span class="description-percentage text-danger">
                        <i class="fas fa-caret-down"></i>';
                        }else if($k->status_perubahan =="Meningkat"){
                          echo ' <span class="description-percentage text-success">
                        <i class="fas fa-caret-up"></i>';
                        }else{
                          echo ' <span class="description-percentage text-info">
                        <i class="fas fa-caret-left"></i>';
                        }
                        ?>


                     
                         <?= $k->prediksi_bulan_depan; ?></span>
                      <h5 class="description-header"><?= $k->status_perubahan; ?> Bulan Depan</h5>
                      <span class="description-text">Prediksi <?= $k->nama_layanan; ?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <?php
                }
                
                ?>
                  
                 
            
                </div>
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
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
           
                

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Capaian Layanan Online</h3>

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
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Nama Layanan</th>
                      <th>Bulan Lalu</th>
                      <th>Bulan Ini</th>
                      <th>Status</th>
                      <th>Selisih</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php 
                    foreach ($rekap_layanan_last as $k) {
                      ?>
                     <tr>
                      <td><?= $k->nama_layanan?></td>
                      <td><?= $k->jumlah_bulan_lalu?></td>
                      <td><?= $k->jumlah_bulan_ini?></td>
                      <td>
                        <?php 
                        if($k->status_perubahan =="Menurun"){
                          echo '<span class="badge badge-danger">Menurun</span>';
                        }else if($k->status_perubahan =="Meningkat"){
                          echo '<span class="badge badge-success">Meningkat</span>';
                        }else{
                          echo '<span class="badge badge-info">Tetap</span>';
                        }
                        ?>
                        
                      </td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $k->selisih?></div>
                      </td>
                    </tr>

                      <?php }  ?>
                  
                   
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-microchip"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Rata Rata Kwitansi Bulan Ini </span>
                <span class="info-box-number"><?= $rata2_kwitansi[0]->rata_rata_pelayanan?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Kwitansi Bulan Ini </span>
                <span class="info-box-number"><?= $rata2_kwitansi[0]->jumlah_pelayanan?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-microchip"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Rata Rata Kwitansi Bulan lalu</span>
                <span class="info-box-number"><?= $rata2_kwitansi_kemaren[0]->rata_rata_pelayanan?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Kwitansi Bulan lalu</span>
                <span class="info-box-number"><?= $rata2_kwitansi_kemaren[0]->jumlah_pelayanan?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

       
            <!-- /.card -->

          
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <?php 
    $label = '';
    $jumlah_bulan_ini = '';
    foreach ($bulan_ini as $k) {
      $label .= '"'.$k->nama_layanan.'",';
      $jumlah_bulan_ini .= $k->jumlah_semua_layanan.',';
    }

    $jumlah_bulan_kemaren = '';
    foreach ($bulan_kemaren as $k) {
       $jumlah_bulan_kemaren .= $k->jumlah_semua_layanan.',';
    }


    // echo $label;
    ?>
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
<script src="<?= base_url('assets/template/')?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url('assets/template/')?>plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url('assets/template/')?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url('assets/template/')?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/template/')?>plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/template/')?>dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/template/')?>dist/js/pages/dashboard2.js"></script> -->
</body>
</html>


<script>

	/* global Chart:false */

$(function () {
  'use strict'

 
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

  var salesChartData = {
    labels: [<?= $label?>],
    datasets: [
      {
        label: 'Bulan Ini',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [<?= $jumlah_bulan_ini?>]
      },
      {
        label: 'Bulan Kemaren',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: [<?= $jumlah_bulan_kemaren?>]
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, {
    type: 'line',
    data: salesChartData,
    options: salesChartOptions
  }
  )

  //---------------------------
  // - END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  // - PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = {
    labels: [
      <?= $label?>
    ],
    datasets: [
      {
        data: [<?= $jumlah_bulan_ini?>],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'  ]
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })

  //-----------------
  // - END PIE CHART -
  //-----------------

  /* jVector Maps
   * ------------
   * Create a world map with markers
   */
  $('#world-map-markers').mapael({
    map: {
      name: 'usa_states',
      zoom: {
        enabled: true,
        maxLevel: 10
      }
    }
  })

  // $('#world-map-markers').vectorMap({
  //   map              : 'world_en',
  //   normalizeFunction: 'polynomial',
  //   hoverOpacity     : 0.7,
  //   hoverColor       : false,
  //   backgroundColor  : 'transparent',
  //   regionStyle      : {
  //     initial      : {
  //       fill            : 'rgba(210, 214, 222, 1)',
  //       'fill-opacity'  : 1,
  //       stroke          : 'none',
  //       'stroke-width'  : 0,
  //       'stroke-opacity': 1
  //     },
  //     hover        : {
  //       'fill-opacity': 0.7,
  //       cursor        : 'pointer'
  //     },
  //     selected     : {
  //       fill: 'yellow'
  //     },
  //     selectedHover: {}
  //   },
  //   markerStyle      : {
  //     initial: {
  //       fill  : '#00a65a',
  //       stroke: '#111'
  //     }
  //   },
  //   markers          : [
  //     {
  //       latLng: [41.90, 12.45],
  //       name  : 'Vatican City'
  //     },
  //     {
  //       latLng: [43.73, 7.41],
  //       name  : 'Monaco'
  //     },
  //     {
  //       latLng: [-0.52, 166.93],
  //       name  : 'Nauru'
  //     },
  //     {
  //       latLng: [-8.51, 179.21],
  //       name  : 'Tuvalu'
  //     },
  //     {
  //       latLng: [43.93, 12.46],
  //       name  : 'San Marino'
  //     },
  //     {
  //       latLng: [47.14, 9.52],
  //       name  : 'Liechtenstein'
  //     },
  //     {
  //       latLng: [7.11, 171.06],
  //       name  : 'Marshall Islands'
  //     },
  //     {
  //       latLng: [17.3, -62.73],
  //       name  : 'Saint Kitts and Nevis'
  //     },
  //     {
  //       latLng: [3.2, 73.22],
  //       name  : 'Maldives'
  //     },
  //     {
  //       latLng: [35.88, 14.5],
  //       name  : 'Malta'
  //     },
  //     {
  //       latLng: [12.05, -61.75],
  //       name  : 'Grenada'
  //     },
  //     {
  //       latLng: [13.16, -61.23],
  //       name  : 'Saint Vincent and the Grenadines'
  //     },
  //     {
  //       latLng: [13.16, -59.55],
  //       name  : 'Barbados'
  //     },
  //     {
  //       latLng: [17.11, -61.85],
  //       name  : 'Antigua and Barbuda'
  //     },
  //     {
  //       latLng: [-4.61, 55.45],
  //       name  : 'Seychelles'
  //     },
  //     {
  //       latLng: [7.35, 134.46],
  //       name  : 'Palau'
  //     },
  //     {
  //       latLng: [42.5, 1.51],
  //       name  : 'Andorra'
  //     },
  //     {
  //       latLng: [14.01, -60.98],
  //       name  : 'Saint Lucia'
  //     },
  //     {
  //       latLng: [6.91, 158.18],
  //       name  : 'Federated States of Micronesia'
  //     },
  //     {
  //       latLng: [1.3, 103.8],
  //       name  : 'Singapore'
  //     },
  //     {
  //       latLng: [1.46, 173.03],
  //       name  : 'Kiribati'
  //     },
  //     {
  //       latLng: [-21.13, -175.2],
  //       name  : 'Tonga'
  //     },
  //     {
  //       latLng: [15.3, -61.38],
  //       name  : 'Dominica'
  //     },
  //     {
  //       latLng: [-20.2, 57.5],
  //       name  : 'Mauritius'
  //     },
  //     {
  //       latLng: [26.02, 50.55],
  //       name  : 'Bahrain'
  //     },
  //     {
  //       latLng: [0.33, 6.73],
  //       name  : 'São Tomé and Príncipe'
  //     }
  //   ]
  // })
})

// lgtm [js/unused-local-variable]


</script>