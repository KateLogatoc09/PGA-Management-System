<!-- Pagination Logic -->
<?php
// Define the number of records per page
      $recordsPerPage = 5;

      // Calculate the total number of pages
      $totalPages = ceil(count($student) / $recordsPerPage);

      // Get the current page number from the query string, default to 1 if not set
      $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

      // Calculate the offset for the subset of records to be displayed on the current page
      $offset = ($currentPage - 1) * $recordsPerPage;

      // Get a subset of records for the current page
      $sectionSubset = array_slice($student, $offset, $recordsPerPage);
?>
<body>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('AAC/nav') ?>
        <?= $this->include('AAC/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

 <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">St. Stephen</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="searchStephen" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                              <option value="Student">Student</option>
                              <option value="category">Category</option>
                              <option value="yr_lvl">Grade Level</option>
                              <option value="Adviser">Adviser</option>
                          </select>
                          <button type="submit" class="btn btn-default">
                          <i class="menu-icon tf-icons bx bx-search"></i>
                          </button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                         <table class="table table-hover text-nowrap">
                    
                            <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Category</th>
                                        <th>Year Level</th>
                                        <th>Section</th>
                                        <th>Program</th>
                                        <th>Adviser</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sectionSubset as $ad): ?>
                                    <tr>
                                            <td><?= $ad['student_id'] ?></td>
                                            <td><?= $ad['last_name'] ?>,</td>
                                            <td><?= $ad['first_name'] ?></td>
                                            <td><?= $ad['middle_name'] ?></td>
                                            <td><?= $ad['category'] ?></td>
                                            <td><?= $ad['yr_lvl'] ?></td>
                                            <td><?= $ad['name'] ?></td>
                                            <td><?= $ad['program'] ?></td>   
                                            <td><?= $ad['fname'] ?> <?= $ad['mname'] ?> <?= $ad['lname'] ?></td>
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

  <script src="assets/js/book.js"></script>
</body>

</html>
