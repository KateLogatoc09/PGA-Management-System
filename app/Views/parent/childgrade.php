<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('parent/nav') ?>
        <?= $this->include('parent/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Grades List</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Subject Type</th>
                            <th>Grade</th>
                            <th>Quarter</th>
                            <th>School Year</th>
                            <th>Subject Teacher</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      // Pagination Configuration
                      $totalRecords = count($grade);
                      $recordsPerPage = 5;
                      $totalPages = ceil($totalRecords / $recordsPerPage);

                      // Current Page
                      $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                      ?>
                        <?php
                        // Paginate the results
                        $start = ($currentPage - 1) * $recordsPerPage;
                        $end = $start + $recordsPerPage;
                        $paginatedGrade = array_slice($grade, $start, $recordsPerPage);
                        
                        foreach ($paginatedGrade as $g):
                        ?>
                        <tr>
                            <td><?= $g['subject_name'] ?></td>
                            <td><?= $g['type'] ?></td>
                            <td><?= $g['grade'] ?></td>
                            <td><?= $g['quarter'] ?></td>
                            <td><?= $g['school_year'] ?></td>
                            <td><?= $g['fname']?> <?= $g['mname']?> <?= $g['lname']?></td>
                        </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <!-- Pagination Links -->
                  <div class="card-footer">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                          <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                        <?php endfor; ?>
                        <?php if ($currentPage < $totalPages) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </nav>
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
