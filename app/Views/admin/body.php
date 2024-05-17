<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('admin/nav') ?>
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
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                              <option value="username">Username</option>
                              <option value="email">Email</option>
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
                                <?php $x = 1; foreach ($accountsSubset as $accy): ?>
                                    <tr>
                                        <td><?= $accy['username'] ?></td>
                                        <td><?= $accy['email'] ?></td>
                                        <td><?= $accy['role'] ?></td>
                                        <td><?= $accy['status'] ?></td>
                                        <td><?= $accy['suspension'] ?></td>
                                        <td><?= $accy['activity'] ?></td>
                                        <td>
                                            <a href="/deleteAccount/<?= $accy['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/editAccount/<?= $accy['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                <?php $x++; endforeach ?>
                                <!-- End Display Account List -->
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
  <script>
  <?php $y = 1; foreach ($accountsSubset as $accy): ?>
  document.getElementById("d<?=$y?>").addEventListener("click", function (event) {
    event.preventDefault()
      //sweetalert2 code
      Swal.fire({
          title: 'PGA',
          text: "Are you sure? You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = $(this).attr('href');
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info');
        }
      })
    });
<?php $y++; endforeach; ?>
  </script>
  <script src="assets/js/book.js"></script>
</body>

</html>
