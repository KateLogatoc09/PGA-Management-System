<?php
$config    = new \Config\Encryption(); 
$encrypter = \Config\Services::encrypter($config);
// Define the number of records per page
$recordsPerPage = 5;

// Calculate the total number of pages
$totalPages = ceil(count($stud_section) / $recordsPerPage);

// Get the current page number from the query string, default to 1 if not set
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Get a subset of records for the current page
$sectionSubset = array_slice($stud_section, $offset, $recordsPerPage);

$recordsPerPage2 = 5;

// Calculate the total number of pages
$totalPages2 = ceil(count($teacher) / $recordsPerPage2);

// Get the current page number from the query string, default to 1 if not set
$currentPage2 = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset2 = ($currentPage2 - 1) * $recordsPerPage2;

// Get a subset of records for the current page
$teacherSubset = array_slice($teacher, $offset2, $recordsPerPage2);
?>

<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
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
            <h1 class="center white">Add Schedule</h1>   
 <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Section List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchsectionlist" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                              <option value="name">Section Name</option>
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
                                    <th>Action</th>               
                                        <th>Section Name</th>
                                        <th>Grade Level</th> 
                                        <th>Adviser</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $x = 1; foreach ($sectionSubset as $ad): ?>
                                    <tr>
                                            <td><a href="/schedule/<?php echo bin2hex($encrypter->encrypt($ad['id'])); ?>" class="btn btn-info btn-sm">View/Add Schedule</a></td>
                                            <td><?= $ad['name'] ?></td>
                                            <td><?= $ad['grade_level_id'] ?></td>
                                            <td><?= $ad['lname'] ?>, <?= $ad['fname'] ?> <?= $ad['mname'] ?></td>
                                     </tr>
                                <?php $x++; endforeach ?>
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

            <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Teacher List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchteacherlist" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                              <option value="idnum">Teacher ID</option>
                              <option value="teacher">Name</option>
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
                                    <th>Action</th>               
                                        <th>Teacher ID</th>
                                        <th>Last Name</th>
                                        <th>First Name</th> 
                                        <th>Middle Name</th>       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $x = 1; foreach ($teacherSubset as $te): ?>
                                    <tr>
                                            <td><a href="/teacherschedule/<?php echo bin2hex($encrypter->encrypt($te['id'])); ?>" class="btn btn-info btn-sm">View/Add Schedule</a></td>
                                            <td><?= $te['idnum'] ?></td>
                                            <td><?= $te['lname'] ?>,</td>
                                            <td><?= $te['fname'] ?></td>
                                            <td><?= $te['mname'] ?></td>
                                     </tr>
                                <?php $x++; endforeach ?>
                                </tbody>
                            </table>
                        </div>
                      <!-- /.card-body -->
                  <!-- Pagination Links -->
                  <div class="card-footer">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center">
                        <?php if ($currentPage2 > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage2 - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages2; $i++) : ?>
                          <li class="page-item <?= $i == $currentPage2? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                        <?php endfor; ?>
                        <?php if ($currentPage2 < $totalPages2) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage2 + 1 ?>" aria-label="Next">
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
