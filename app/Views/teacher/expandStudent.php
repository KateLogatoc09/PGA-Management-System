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

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
            <h1 class="center blue">Student Information</h1> 
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">

                      <div class="content-wrapper">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary"><?php if (isset($learn['first_name'])) {echo $learn['first_name'];}?>
                        <?php if (isset($learn['middle_name'])) {echo $learn['middle_name'];}?>
                        <?php if (isset($learn['last_name'])) {echo $learn['last_name'];}?></h5>
                        <br>
                        <h7 class="orange">Student ID:</h7>
                        <?php if (isset($ad['student_id'])) {echo $ad['student_id'];}?>
                        <br>
                        <h7 class="orange">Full Name:</h7>
                        <?php if (isset($learn['first_name'])) {echo $learn['first_name'];}?>
                        <?php if (isset($learn['middle_name'])) {echo $learn['middle_name'];}?>
                        <?php if (isset($learn['last_name'])) {echo $learn['last_name'];}?>
                        <br>
                        <h7 class="orange">Nickname:</h7>
                        <?php if (isset($learn['nickname'])) {echo $learn['nickname'];}?>
                        <br>
                        <h7 class="orange">Age:</h7>
                        <?php if (isset($learn['age'])) {echo $learn['age'];}?>
                        <br>
                        <h7 class="orange">Year Level:</h7>
                        <?php if (isset($ad['yr_lvl'])) {echo $ad['yr_lvl'];}?>
                        <br>
                        <h7 class="orange">Section:</h7>
                        <?php if (isset($ad['name'])) {echo $ad['name'];}?>
                        <br>
                        <h7 class="orange">Adviser:</h7>
                        <?php if (isset($ad['fname'])) {echo $ad['fname'];}?>
                        <?php if (isset($ad['mname'])) {echo $ad['mname'];}?>
                        <?php if (isset($ad['lname'])) {echo $ad['lname'];}?>
                        <br>
                        <h7 class="orange">Program:</h7>
                        <?php if (isset($ad['program'])) {echo $ad['program'];}?>
                        <br>
                      
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <h7 class="orange">Gender:</h7>
                        <?php if (isset($learn['gender'])) {echo $learn['gender'];}?>
                        <br>
                        <h7 class="orange">Birthdate:</h7>
                        <?php if (isset($learn['birthdate'])) {echo $learn['birthdate'];}?>
                        <br>
                      <h7 class="orange">Birthplace:</h7>
                        <?php if (isset($learn['birthplace'])) {echo $learn['birthplace'];}?>
                        <br>  
                        <h7 class="orange">Marital Status:</h7>
                        <?php if (isset($learn['marital_status'])) {echo $learn['marital_status'];}?>
                        <br>
                        <h7 class="orange">Mobile Number:</h7>
                        <?php if (isset($learn['mobile_num'])) {echo $learn['mobile_num'];}?>
                        <br>
                        <h7 class="orange">Nationality:</h7>
                        <?php if (isset($learn['nationality'])) {echo $learn['nationality'];}?>
                        <br>
                        <h7 class="orange">Religion:</h7>
                        <?php if (isset($learn['religion'])) {echo $learn['religion'];}?>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-18 my-4 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Address/s</h5>
                        <br>
                        <?php foreach ($address as $a): ?>
                          <h7 class="orange"><?= $a['type'] ?> Address:</h7>
                          <?= $a['street'] ?>, <?= $a['barangay'] ?>, <?= $a['municipality'] ?>, <?= $a['province'] ?>, <?= $a['region'] ?>
                        <br>
                        <h7 class="orange">Postal Code:</h7>
                        <?= $a['postal_code'] ?>
                        <br>
                        <h7 class="orange">Telephone Number:</h7>
                        <?= $a['tel_num'] ?>
                        <br>
                      </div>

                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <?php endforeach ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-18 mb-1 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Parents/Guardian</h5>
                        <br>
                        <?php foreach ($fam as $f): ?>
                        <h7 class="orange"><?= $f['relation'] ?>:</h7>
                        <?= $f['fullname'] ?>
                        <br>
                        <h7 class="orange">Residential Address:</h7>
                        <?= $f['res_add'] ?>
                        <br>
                        <h7 class="orange">Mobile Number:</h7>
                        <?= $f['mob_num'] ?>
                        <br>
                        <h7 class="orange">Office Address:</h7>
                        <?= $f['off_add'] ?>
                        <br>
                        <h7 class="orange">Office Number:</h7>
                        <?= $f['off_num'] ?>
                        <br>
                        <h7 class="orange">Email:</h7>
                        <?= $f['email'] ?>
                        <br>
                        <h7 class="orange">Occupation:</h7>
                        <?= $f['occupation'] ?>
                        <br>
                      </div>

                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <?php endforeach ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
              
                    </div>
                    <!-- /.card -->
                </div> <!-- /.dito -->

                <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Grades</h5>
                        <br>
                        <?php foreach ($grade as $g): ?>
                        <h7 class="orange">Subject:</h7>
                        <?= $g['subject_name'] ?>
                        <br>
                        <h7 class="orange">Subject Type:</h7>
                        <?= $g['type'] ?>
                        <br>
                        <h7 class="orange">Grade:</h7>
                        <?= $g['grade'] ?>
                        <br>
                        <h7 class="orange">Subject Teacher:</h7>
                        <?php if (isset($g['fname'])) {echo $g['fname'];}?>
                        <?php if (isset($g['mname'])) {echo $g['mname'];}?>
                        <?php if (isset($g['lname'])) {echo $g['lname'];}?>
                        <br>
                      </div>

                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <?php endforeach ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <center><a href="/advisoryClass" class="btn btn-primary">Back</a><center>
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
</body>

</html>
