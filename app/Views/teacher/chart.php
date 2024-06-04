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
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
          <!-- Content -->
          <?php foreach($sub as $all): ?>
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Top Students in <?=$all['subject_name'] ?></h5>
                        <canvas id="gradesChart<?=$all['id']?>"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <img id="image<?= $all['id'] ?>">
              <?php endforeach; ?>
         
              <form action="generateReport" method="POST">
            <?php foreach($sub as $all): ?>
              <input type="hidden" id="report<?= $all['id']?>" name="report<?= $all['id']?>">
            <?php endforeach;?>
              <button class="btn btn-primary" type="submit">Generate Report</button>
            </form>
              
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
      <?php foreach($sub as $all): ?>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx<?=$all['id']?> = document.getElementById('gradesChart<?=$all['id']?>').getContext('2d');
            const grades<?=$all['id']?> = [<?php foreach(${'sub'.$all['id']} as $grades):?><?= $grades['GWA']?>,<?php endforeach;?>];
            const names<?=$all['id']?> = [<?php foreach(${'sub'.$all['id']} as $name):?>"<?= $name['student']?>",<?php endforeach;?>];
            const subject<?=$all['id']?> = [<?php foreach(${'sub'.$all['id']} as $subject):?>"Grade in <?= $subject['subject_name']?>",<?php endforeach;?>];

            // Create gradient fill for wave effect
            const gradient<?=$all['id']?> = ctx<?=$all['id']?>.createLinearGradient(0, 0, 0, 400);
            gradient<?=$all['id']?>.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
            gradient<?=$all['id']?>.addColorStop(0.5, 'rgba(75, 192, 192, 0.2)');
            gradient<?=$all['id']?>.addColorStop(1, 'rgba(75, 192, 192, 0)');

            const data<?=$all['id']?> = {
                labels: names<?=$all['id']?>,
                datasets: [{
                    label: subject<?=$all['id']?>,
                    data: grades<?=$all['id']?>,
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
                        },
                    },
                    animation: {
                        onComplete: function() {
                          const canvas<?= $all['id'] ?> = document.getElementById('gradesChart<?=$all['id']?>');
                          const imgdata<?= $all['id'] ?> = canvas<?= $all['id'] ?>.toDataURL();
                          const img<?=$all['id'] ?> = document.getElementById('report<?= $all['id']; ?>');
                          img<?=$all['id'] ?>.setAttribute("value", imgdata<?= $all['id'] ?>);
                      }
                    }
                }
            };

            const gradesChart<?=$all['id']?> = new Chart(ctx<?=$all['id']?>, config<?=$all['id']?>);
        });

      <?php endforeach; ?>


    </script>
</body>
</html>
