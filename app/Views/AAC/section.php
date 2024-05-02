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
                            <h3 class="card-title">Section List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchAacsection" method="get">
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
                                        <th>Id</th>                      
                                        <th>Section Name</th>
                                        <th>Grade Level</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($stud_section as $ad): ?>
                                    <tr>
                                            <td><?= $ad['id'] ?></td>
                                            <td><?= $ad['name'] ?></td>
                                            <td><?= $ad['grade_level_id'] ?></td>
                                            <td> <a href="/aacdeleteSection/<?= $ad['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/aaceditSection/<?= $ad['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Section</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/aacsaveSection" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($sec['id'])) {echo $sec['id'];}?>">

                                        
                                        <label for="name">Section Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Section Name"
                                        value="<?php if (isset($sec['name'])) {echo $sec['name'];}?>">
       
                                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                                        <label for="grade_level_id">Grade Level:</label>
                                        <input type="text" class="form-control" name="grade_level_id" placeholder="Enter Grade Level" 
                                        value="<?php if (isset($sec['grade_level_id'])) {echo $sec['grade_level_id'];}?>" required>  
                      
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
