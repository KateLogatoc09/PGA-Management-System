<?php
// Pagination Configuration
$totalRecords = count($family);
$recordsPerPage = 5;
$totalPages = ceil($totalRecords / $recordsPerPage);

// Current Page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<body>
  <?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
    <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
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
                    <h3 class="card-title">Students' Parent List</h3>
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
                          <th>Student's ID Number</th>
                          <th>Student's Name</th>
                          <th>Fullname</th>
                          <th>Relation</th>
                          <th>Residential Address</th>
                          <th>Mobile Number</th>
                          <th>Office Address</th>
                          <th>Office Number</th>
                          <th>Email</th>
                          <th>Occupation</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Paginate Data
                        $offset = ($currentPage - 1) * $recordsPerPage;
                        $paginatedFamily = array_slice($family, $offset, $recordsPerPage);
                        foreach ($paginatedFamily as $fa):
                        ?>
                        <tr>
                          <td><?= $fa['id'] ?></td>
                          <td><?= $fa['student_id'] ?></td>
                          <td><?= $fa['last_name'] ?>, <?= $fa['first_name'] ?> <?= $fa['middle_name'] ?></td>
                          <td><?= $fa['fullname'] ?></td>
                          <td><?= $fa['relation'] ?></td>
                          <td><?= $fa['res_add'] ?></td>
                          <td><?= $fa['mob_num'] ?></td>
                          <td><?= $fa['off_add'] ?></td>
                          <td><?= $fa['off_num'] ?></td>
                          <td><?= $fa['email'] ?></td>
                          <td><?= $fa['occupation'] ?></td>
                          <td>
                            <a href="/regDeletefamily/<?= $fa['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            <a href="/regEditfamily/<?= $fa['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                          </td>
                        </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <!-- /.card -->

              <div class="col-lg-18 mb-4 order-0">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                      <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor ?>
                  </ul>
                </nav>
              </div>

            </div>
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Students's Parent Information</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/regSavefamily" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($fam['id'])) {echo $fam['id'];}?>">
                    <label for="relation">Relationship To Student:</label>
                        <select class="form-control" name="relation" id="relation" 
                        value="<?php if (isset($fam['relation'])) {echo $fam['relation'];}?>">
                        <option value="">Select Relationship</option>
                        <option value="Mother">Mother</option>
                        <option value="Father">Father</option>
                        <option value="Guardian">Guardian</option>
                    </select>

                                    <label for="fullname">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name"
                                        value="<?php if (isset($fam['fullname'])) {echo $fam['fullname'];}?>">
                                 

                                    <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                        value="<?php if (isset($fam['email'])) {echo $fam['email'];}?>">
                                 

                                    <label for="occupation">Occupation:</label>
                                        <input type="text" class="form-control" name="occupation" placeholder="Occupation"
                                        value="<?php if (isset($fam['occupation'])) {echo $fam['occupation'];}?>">

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">

  <label for="res_add">Residential Address:</label>
                                        <input type="text" class="form-control" name="res_add" placeholder="Enter Residential Address"
                                        value="<?php if (isset($fam['res_add'])) {echo $fam['res_add'];}?>">
      
                                    <label for="mob_num">Mobile Number:</label>
                                        <input type="number" class="form-control" name="mob_num" max_length="11" placeholder="Enter Mobile Number"
                                        value="<?php if (isset($fam['mob_num'])) {echo $fam['mob_num'];}?>">
                                 
                        
  <label for="off_add">Office Address:</label>
                                        <input type="text" class="form-control" name="off_add" placeholder="Enter Office Address"
                                        value="<?php if (isset($fam['off_add'])) {echo $fam['off_add'];}?>">

                                    <label for="off_num">Office Number:</label>
                                        <input type="number" class="form-control" name="off_num" max_length="11" placeholder="Enter Office Number"
                                        value="<?php if (isset($fam['off_num'])) {echo $fam['off_num'];}?>">

                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($fam['account_id'])) {echo $fam['account_id'];}?>" required> 
                        
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
