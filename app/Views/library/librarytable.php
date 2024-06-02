<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
      <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?= $this->include('library/nav') ?>
                <?= $this->include('library/sidebar') ?>
                <!-- / Navbar -->

               <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <?php foreach($book as $all): ?>
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Most Borrowed Books</h5>
                        <canvas id="libchart<?=$all['id']?>"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
                
              
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
      <?php foreach($book as $all): ?>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx<?=$all['id']?> = document.getElementById('libchart<?=$all['id']?>').getContext('2d');
            const borrow<?=$all['id']?> = [<?php foreach(${'book'.$all['id']} as $borrow):?><?= $borrow['id']?>,<?php endforeach;?>];
            const names<?=$all['id']?> = [<?php foreach(${'book'.$all['id']} as $name):?>"<?= $name['book_title']?>",<?php endforeach;?>];

            // Create gradient fill for wave effect
            const gradient<?=$all['id']?> = ctx<?=$all['id']?>.createLinearGradient(0, 0, 0, 400);
            gradient<?=$all['id']?>.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
            gradient<?=$all['id']?>.addColorStop(0.5, 'rgba(75, 192, 192, 0.2)');
            gradient<?=$all['id']?>.addColorStop(1, 'rgba(75, 192, 192, 0)');

            const data<?=$all['id']?> = {
                labels: names<?=$all['id']?>,
                datasets: [{
                    label: book<?=$all['id']?>,
                    data: borrow<?=$all['id']?>,
                    backgroundColor: gradient<?=$all['id']?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    tension: 0.4, // Creates the wave effect
                    fill: true // Fill the area under the line
                }]
            };

            const config<?=$all['id']?> = {
                type: 'bar', // Line chart for spline area effect
                data: data<?=$all['id']?>,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            const libchart<?=$all['id']?> = new Chart(ctx<?=$all['id']?>, config<?=$all['id']?>);
        });
      <?php endforeach; ?>
    </script>
    </body>
</html>
