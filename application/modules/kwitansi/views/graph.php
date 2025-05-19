
<div class="row">
          <!-- Left col -->
          <div class="col-md-12">
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
                
<div id="graphic" ></div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <?php                                                                                                                                                                          
          $operator ='';
          $jumlah ='';
          foreach ($data as $k) {
            $operator .= "'".$k->nama."',";
            $jumlah .= $k->jumlah.",";
          }
          
        //  echo $operator;
        //  echo $jumlah;
          ?>

<script>
    Highcharts.chart('graphic', {
        chart: {
            type: 'column' // Tipe column untuk batang vertikal
        },
        title: {
            text: 'KWITANSI PER OPERATOR'
        },
        xAxis: {
            categories: [<?= $operator?>],
            title: {
                text: 'Kwitansi Berdarkan Pencarian'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Permohonan'
            }
        },
        series: [{
            name: 'Pengajuan',
            data: [<?= $jumlah?>]
        }]
    });
</script>

