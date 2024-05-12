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
        <?= $this->include('teacher/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit/Add Information</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/teachersave" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($prof['id'])) {echo $prof['id'];}?>">
                        <label for="idnum">ID number:</label>
                        <input type="text" class="form-control" name="idnum" placeholder="Enter ID number" 
                        value="<?php if (isset($prof['idnum'])) {echo $prof['idnum'];}?>" required>
                                 
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" name="fname" placeholder="Enter First Name"
                        value="<?php if (isset($prof['fname'])) {echo $prof['fname'];}?>" required>

                        <label for="mname">Middle Name:</label>
                        <input type="text" class="form-control" name="mname" placeholder="Enter Middle Name" 
                        value="<?php if (isset($prof['mname'])) {echo $prof['mname'];}?>" required>

                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" 
                        value="<?php if (isset($prof['lname'])) {echo $prof['lname'];}?>" required>
                           
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" name="age" placeholder="Enter Age" 
                        value="<?php if (isset($prof['age'])) {echo $prof['age'];}?>" required>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                        <label for="gender">Gender:</label>
                                        <select class="form-control" name="gender" id="gender" 
                                        value="<?php if (isset($prof['gender'])) {echo $prof['gender'];}?>">
                                        <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                 
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth" 
                        value="<?php if (isset($prof['dob'])) {echo $prof['dob'];}?>" required>    

                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter Address" 
                        value="<?php if (isset($prof['address'])) {echo $prof['address'];}?>" required>  

                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone" 
                        value="<?php if (isset($prof['phone'])) {echo $prof['phone'];}?>" required> 
                        
  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save changes</button>
    <a href="/teacher" class="btn btn-primary">Back</a>
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
