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
        <?= $this->include('admin/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              
                
              <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Accounts List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchAccount" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
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
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Suspension</th>
                                        <th>Activity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Pagination Logic -->
                                <?php
                                // Define the number of records per page
                                $recordsPerPage = 5;

                                // Calculate the total number of pages
                                $totalPages = ceil(count($account) / $recordsPerPage);

                                // Get the current page number from the query string, default to 1 if not set
                                $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

                                // Calculate the offset for the subset of records to be displayed on the current page
                                $offset = ($currentPage - 1) * $recordsPerPage;

                                // Get a subset of records for the current page
                                $accountsSubset = array_slice($account, $offset, $recordsPerPage);
                                ?>

                                <!-- Display Account List -->
                                <?php foreach ($accountsSubset as $accy): ?>
                                    <tr>
                                        <td><?= $accy['username'] ?></td>
                                        <td><?= $accy['email'] ?></td>
                                        <td><?= $accy['role'] ?></td>
                                        <td><?= $accy['status'] ?></td>
                                        <td><?= $accy['suspension'] ?></td>
                                        <td><?= $accy['activity'] ?></td>
                                        <td>
                                            <a href="/deleteAccount/<?= $accy['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editAccount/<?= $accy['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <!-- End Display Account List -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    </div>
                    <!-- /.card -->
                </div> <!-- /.dito -->

            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <ul class="pagination">
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
            </div>
            <!-- End Pagination -->


<div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Create/Edit Account</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveAccount" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($acc['id'])) {echo $acc['id'];}?>">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" 
                        value="<?php if (isset($acc['username'])) {echo $acc['username'];}?>" required>
                                 
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email"
                        value="<?php if (isset($acc['email'])) {echo $acc['email'];}?>" required>

                        <label for="role">Role:</label>
                                        <select class="form-control" name="role" id="role" value= "
                                        <?php if (isset($acc['role'])) {echo $acc['role'];}?>" required>>
                                            <option value="">Select Role</option>
                                            <!--<option value="ADMIN">Admin</option>-->
                                            <option value="TEACHER">Teacher</option>
                                            <option value="STUDENT">Student</option>
                                            <option value="PARENT">Parent</option>
                                            <option value="REGISTRAR">Registrar</option>
                                            <option value="LIBRARIAN">Librarian</option>
                                            <!--<option value="DAC">Disciplinary Affairs Coordinator</option>
                                            <option value="IAC">Internal Affairs Coordinator</option>
                                            <option value="SAC">Student Affairs Coordinator</option>-->
                                            <option value="AAC">Academic Affairs Coordinator</option>
                                        </select>
                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
  <label for="status">status:</label>
                                        <select class="form-control" name="status" id="status" value= "
                                        <?php if (isset($acc['status'])) {echo $acc['status'];}?>" required>>
                                            <option value="ACTIVE">Active</option>
                                            <option value="INACTIVE">Inactive</option>
                                            <option value="PENDING">Pending</option>
                                            <option value="UNVERIFIED">Unverified</option>
                                            <option value="VERIFIED">Verified</option>
                                            <option value="BANNED">Banned</option>
                                            <option value="SUSPENDED">Suspended</option>
                                        </select>

                        <label for="suspension">Suspension:</label>
                        <input type="text" class="form-control" name="suspension" placeholder="Enter Suspension" 
                        value="<?php if (isset($acc['suspension'])) {echo $acc['suspension'];}?>" required>
                        
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
