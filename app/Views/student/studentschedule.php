<?= $this->include('student/head') ?>
<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('student/nav') ?>
        <?= $this->include('student/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

 <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Schedule</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <div class="input-group-append">
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                         <table class="table table-hover text-nowrap">
                            <thead>              
                                    <th>Time</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                </thead>
                                <tbody>
                                <?php foreach ($Monday as $ad): ?>
                                <?php foreach ($Tuesday as $tu): ?>
                                <?php foreach ($Wednesday as $we): ?>
                                    <tr>
                                            <td><?= $ad['start_time'] ?> - <?= $ad['end_time'] ?></td>
                                            <td><?= $ad['subject'] ?></td>
                                            <td><?= $tu['subject'] ?></td>
                                            <td><?= $we['subject'] ?></td>
                                     </tr>
                                </tbody>
                                <?php endforeach ?>
                                <?php endforeach ?>
                                <?php endforeach ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
                  <!-- Pagination Links -->
                  <div class="card-footer">
                    
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div> <!-- /.dito -->

            </div>
            <!-- / Content -->

            
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
    </div>
  </div>
  <!-- / Layout wrapper -->

</body>

</html>
