<?php
// Define the number of records per page
$recordsPerPage = 5;

// Calculate the total number of pages
$totalPages = ceil(count($alumni) / $recordsPerPage);

// Get the current page number from the query string, default to 1 if not set
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Get a subset of records for the current page
$alumniSubset = array_slice($alumni, $offset, $recordsPerPage);
?>

<body>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <h5 class="mt-3">Welcome<?php if(isset($_SESSION['username'])): ?>, <?= $_SESSION['username']; endif; ?>!</h5>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?php if(isset($_SESSION['img'])): ?><?= site_url().'/'.$_SESSION['img']; ?><?php else: ?>../assets/img/avatars/1.png<?php endif; ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?php if(isset($_SESSION['img'])): ?><?= site_url().'/'.$_SESSION['img']; ?><?php else: ?>../assets/img/avatars/1.png<?php endif; ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php if(isset($_SESSION['username'])): ?><?= $_SESSION['username']; endif; ?></span>
                            <small class="text-muted">User</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>

                    <li>
                      <a class="dropdown-item active" href="/general">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Home</span>
                      </a>
                    </li>
                    
                    <li>
                      <a class="dropdown-item active" href="/">
                        <i class="bx bx-notification me-2"></i>
                        <span class="align-middle">Notifications</span>
                      </a>
                    </li>

                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>
        <?= $this->include('registrar/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              
                
              <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Alumni List</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                         <table class="table table-hover text-nowrap">
                    
                            <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Occupation</th>
                                        <th>Year Graduated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($alumniSubset as $al): ?>
                                    <tr>
                                            <td><?= $al['id'] ?></td>
                                            <td><?= $al['fullname'] ?></td>
                                            <td><?= $al['gender'] ?></td>
                                            <td><?= $al['email'] ?></td>
                                            <td><?= $al['phone'] ?></td>
                                            <td><?= $al['address'] ?></td>
                                            <td><?= $al['occupation'] ?></td>
                                            <td><?= $al['yr_graduated'] ?></td>
                                            <td> <a href="/deleteAlumni/<?= $al['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editAlumni/<?= $al['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                     </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    </div>
                    <!-- /.card -->
                </div> <!-- /.dito -->

  <!-- Pagination buttons -->
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= max($currentPage - 1, 1) ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
      <?php endfor; ?>
      <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
        <a class="page-link" href="?page=<?= min($currentPage + 1, $totalPages) ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- / Pagination buttons -->


                <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Alumni</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveAlumni" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($alum['id'])) {echo $alum['id'];}?>">
                        <label for="fullname">Fullname:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname" 
                        value="<?php if (isset($alum['fullname'])) {echo $alum['fullname'];}?>" required>

                        <label for="gender">Gender:</label>
                                        <select class="form-control" name="gender" id="gender" value= "
                                        <?php if (isset($alum['gender'])) {echo $alum['gender'];}?>" required>>
                                        <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" 
                        value="<?php if (isset($alum['email'])) {echo $alum['email'];}?>" required>
                                 
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone"
                        value="<?php if (isset($alum['phone'])) {echo $alum['phone'];}?>" required>
                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter Address" 
                        value="<?php if (isset($alum['address'])) {echo $alum['address'];}?>" required>

                        <label for="occupation">Occupation:</label>
                        <input type="text" class="form-control" name="occupation" placeholder="Enter Occupation" 
                        value="<?php if (isset($alum['occupation'])) {echo $alum['occupation'];}?>" required>
                                 
                        <label for="yr_graduated">Year Graduated:</label>
                        <input type="date" class="form-control" name="yr_graduated" placeholder="Enter Year Graduated" 
                        value="<?php if (isset($alum['yr_graduated'])) {echo $alum['yr_graduated'];}?>" required>
                        
  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>
</div>

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
