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
                            <h3 class="card-title">Subject List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchAacsubject" method="get">
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
                                        <th>Subject Name</th>
                                        <th>Type of Subject</th>
                                        <th>Grade Level</th> 
                                        <th>Subject Teacher</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($subject as $ad): ?>
                                    <tr>
                                            <td><?= $ad['subject_name'] ?></td>
                                            <td><?= $ad['type'] ?></td>
                                            <td><?= $ad['yr_lvl'] ?></td>
                                            <td><?= $ad['lname'] ?>, <?= $ad['fname'] ?> <?= $ad['mname'] ?></td>
                                            <td> <a href="/aacdeleteSubject/<?= $ad['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/aaceditSubject/<?= $ad['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Edit Subject</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/aacsaveSubject" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($sub['id'])) {echo $sub['id'];}?>">

                                        <label for="subject_name">Subject Name:</label>
                                        <input type="text" class="form-control" name="subject_name" placeholder="Enter Subject Name"
                                        value="<?php if (isset($sub['subject_name'])) {echo $sub['subject_name'];}?>">

                                        <label for="type">Type of Subject:</label>
                                        <select class="form-control" name="type" id="Type of Subject">
                                        <option value="">Select Type</option>
                                            <option value="Core Subject">Core Subject</option>
                                            <option value="Applied Subject">Applied Subject</option>
                                            <option value="Specialized Subject">Specialized Subject</option>
                                        </select>

                                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                                        <label for="teacher_id">Subject Teacher:</label>
                        <input type="text" class="form-control" name="teacher_id" placeholder="Enter Subject Teacher" 
                        value="<?php if (isset($sub['teacher_id'])) {echo $sub['teacher_id'];}?> " list="list" required>
                        <datalist type="hidden" id="list">
                                            <?php foreach ($teacher as $te):?> 
                                                <option value="<?= $te['idnum'] ?>"><?= $te['fname'] ?> <?= $te['mname'] ?> <?= $te['lname'] ?></option>
                                            <?php endforeach; ?>
                                        </datalist> 

                                        <label for="yr_lvl">Grade Level:</label>
                                        <input type="text" class="form-control" name="yr_lvl" placeholder="Enter Grade Level" 
                                        value="<?php if (isset($sub['yr_lvl'])) {echo $sub['yr_lvl'];}?>" required>  
                      
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
