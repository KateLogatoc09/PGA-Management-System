<body>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <!-- ... (existing navbar code) ... -->
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
                                <?php foreach ($account as $accy): ?>
                                    <tr>
                                            <td><?= $accy['id'] ?></td>
                                            <td><?= $accy['username'] ?></td>
                                            <td><?= $accy['email'] ?></td>
                                            <td><?= $accy['role'] ?></td>
                                            <td><?= $accy['status'] ?></td>
                                            <td><?= $accy['suspension'] ?></td>
                                            <td><?= $accy['activity'] ?></td>
                                            <td> <a href="/deleteAccount/<?= $accy['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editAccount/<?= $accy['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                           
                                           
                                          
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

                <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Create/Edit Account</h5>
                      </div>
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
                                            <option value="ADMIN">Admin</option>
                                            <option value="TEACHER">Teacher</option>
                                            <option value="STUDENT">Student</option>
                                            <option value="PARENT">Parent</option>
                                            <option value="REGISTRAR">Registrar</option>
                                            <option value="DAC">Disciplinary Affairs Coordinator</option>
                                            <option value="IAC">Internal Affairs Coordinator</option>
                                            <option value="SAC">Student Affairs Coordinator</option>
                                            <option value="AAC">Academic Affairs Coordinator</option>
                                            <option value="LIBRARIAN">Librarian</option>
                                        </select>

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

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="card-body pb-0 px-0 px-md-4">
    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
  </div>
</div>
</div>
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
