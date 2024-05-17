<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('teacher/nav') ?>
        <?= $this->include('teacher/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Top Students in Class</h5>
                        <canvas id="gradesChart"></canvas>
                      </div>
                    </div>
                  </div>
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
  <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('gradesChart').getContext('2d');
            const grades = <?= json_encode(array_column($grades, 'grade')) ?>;
            const names = <?= json_encode(array_column($grades, 'student_id')) ?>;

            // Create gradient fill for wave effect
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
            gradient.addColorStop(0.5, 'rgba(75, 192, 192, 0.2)');
            gradient.addColorStop(1, 'rgba(75, 192, 192, 0)');

            const data = {
                labels: names,
                datasets: [{
                    label: 'GWA',
                    data: grades,
                    backgroundColor: gradient,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    tension: 0.4, // Creates the wave effect
                    fill: true // Fill the area under the line
                }]
            };

            const config = {
                type: 'bar', // Line chart for spline area effect
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            const gradesChart = new Chart(ctx, config);
        });
    </script>
</body>
</html>
