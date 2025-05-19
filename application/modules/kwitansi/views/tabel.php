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
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Operator</th>
                      <th>Jumlah Kwitansi</th>
                      </tr>
                    </thead>
                    <tbody>

                   <?php
                   $no = 0;
                   foreach ($data as $k) {
                    $no++;
                    ?>

<tr>
    <td><?= $no;?></td>
    <td><?= $k->nama?></td>
    <td><?= $k->jumlah?></td>
</tr>
                    <?php
                    # code...
                   }
                   
                   ?>
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