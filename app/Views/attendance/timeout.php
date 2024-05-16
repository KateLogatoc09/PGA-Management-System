<body>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('attendance/nav') ?>
        <?= $this->include('attendance/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Attendance /</span> Time Out</h4>
        <div class="card my-4">
                <h5 class="card-header">Monitoring</h5>
                <hr class="my-0">
                    <div class="card-body d-flex row">
                        <div class="col-sm-6 col-md-6 d-sm-block d-md-block align-items-sm-center">
                        <video id="preview" width="100%" height="100%" autoplay controls></video>
                        </div>
                        <div class="col-sm-6 col-md-6 d-sm-block d-md-block ps-2">
                        <form action="<?php echo base_url(); ?>/time_out" method="POST">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label for="sid" class="form-label">Students' ID:</label>
                                    <input
                                    class="form-control"
                                    type="text"
                                    id="sid"
                                    name="sid"
                                    autofocus
                                    readonly
                                    />
                                </div>
                            </div>
                            </form>
                            <div class="card">
                                <div class="table-responsive text-nowrap rounded-3 overflow-y-scroll h-px-400 invisible-scrollbar">
                                <table class="table table-hover text-center">
                                    <thead class="table-custom border-top-0 position-sticky top-0">
                                    <tr>
                                        <th>ID</th>
                                        <th>Students' ID</th>
                                        <th>Type</th>
                                        <th>Time</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php foreach($attendance as $att): ?>
                                        <tr>
                                            <td><?= $att['id']; ?></td>
                                            <td><?= $att['idnumb']; ?></td>
                                            <td><?= $att['type']; ?></td>
                                            <td><?= $att['time']; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
              </div>
          <!-- Content wrapper -->
</div>
        <!-- / Layout page -->
      </div>
    </div>
  </div>
  <!-- / Layout wrapper -->
  <!-- Instascan -->
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            document.getElementById("sid").value = content;
            document.forms[0].submit();
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
            scanner.start(cameras[0]);
            } else {
            console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        })
  </script>
</body>

</html>
