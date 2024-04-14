<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v19.0" nonce="AFffryss"></script>
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
        <?= $this->include('general/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
          <h5 class="card-title text-primary">General Portal</h5>
          <?php if($_SESSION['role'] == 'GENERAL'): ?>
          <div class="row mb-3">
            <!-- Student -->
            <div class="col-md-6 col-lg-4">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Student Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/student.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">Apply? Submit necessary documents to enjoy various features and privileges as a student.</p>
                  <a href="applyStudent" class="btn btn-primary">Apply</a>
                </div>
              </div>
            </div>
            <!-- Parent -->
            <div class="col-md-6 col-lg-4">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Parent Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/couple.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text"> Apply? Submit necessary documents to enjoy various features and privileges as a parent.</p>
                  <a href="applyParent" class="btn btn-primary">Apply</a>
                </div>
              </div>
            </div>
            <!-- Personnel -->
            <div class="col-md-6 col-lg-4">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Personnel Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">Apply? Submit necessary documents to enjoy various features and privileges as a personnel.</p>
                  <a href="javascript:void(0)" class="btn btn-primary">Apply</a>
                </div>
              </div>
            </div>
          </div>

          <?php elseif($_SESSION['role'] == 'STUDENT'): ?>

            <div class="row mb-3">
            <!-- Student -->
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Student Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/student.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to student account. You may now go to your student page.</p>
                  <a href="/student" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>

          <?php elseif($_SESSION['role'] == 'PARENT'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Parent Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/couple.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to parent account. You may now go to your parent page.</p>
                  <a href="/parent" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>

          <?php elseif($_SESSION['role'] == 'GUARD'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Guard Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/couple.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to guard account. You may now go to your guard page.</p>
                  <a href="/guard" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>

          <?php elseif($_SESSION['role'] == 'TEACHER'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Teacher Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to teacher account. You may now go to your teacher page.</p>
                  <a href="/teacher" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>

          <?php elseif($_SESSION['role'] == 'LIBRARIAN'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Librarian Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to librarian account. You may now go to your librarian page.</p>
                  <a href="/librarian" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>
          
          <?php elseif($_SESSION['role'] == 'REGISTRAR'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Registrar Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to registrar account. You may now go to your registrar page.</p>
                  <a href="/registrar" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>
          
          <?php elseif($_SESSION['role'] == 'DAC'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">DAC Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to DAC account. You may now go to your DAC page.</p>
                  <a href="/DAC" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>

          <?php elseif($_SESSION['role'] == 'IAC'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">IAC Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to IAC account. You may now go to your IAC page.</p>
                  <a href="/IAC" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>

          <?php elseif($_SESSION['role'] == 'SAC'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">SAC Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to SAC account. You may now go to your SAC page.</p>
                  <a href="/SAC" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>
          
          <?php elseif($_SESSION['role'] == 'AAC'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">AAC Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to AAC account. You may now go to your AAC page.</p>
                  <a href="/AAC" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>
          
          <?php elseif($_SESSION['role'] == 'ALUMNI'): ?>

            <div class="row mb-3">
            <div class="col-md-12 col-lg-12">
              <div class="card text-center mb-3">
                <div class="card-body">
                  <h5 class="card-title">Alumni Account</h5>
                  <center>
                  <img
                          src="../assets/img/avatars/teacher.png"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                  </center>
                  <p class="card-text">You're upgraded to alumni account. You may now go to your alumni page.</p>
                  <a href="/alumni" class="btn btn-primary px-20">Navigate</a>
                </div>
              </div>
            </div>
          </div>

          <?php endif; ?>

          <div class="row mb-3">
          <div class="fb-page col-md-4" data-href="https://www.facebook.com/pgacare1967" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
            <blockquote cite="https://www.facebook.com/pgacare1967" class="fb-xfbml-parse-ignore">
              <a href="https://www.facebook.com/pgacare1967">Pga Cares</a>
            </blockquote>
          </div>
          <div>

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
