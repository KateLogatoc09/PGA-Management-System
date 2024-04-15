<?= $this->include('student/head') ?>
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
        <?= $this->include('student/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
          <h1 class="card-title text-primary">Admission Information</h1>
          <p class="mb-10">
                          Fill Up The Following Fields.
                        </p>
            <div class="row">
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                    <form action="/saveadmissions" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                
                                        <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($admissions['id'])) {echo $admissions['id'];}?>">
                        
                                        <label for="category">Student Category:</label>
                                        <select class="form-control" name="category" id="category">
                                            <option value="Continuing">Continuing</option>
                                            <option value="Transferee">Transferee</option>
                                            <option value="Returnee">Returnee</option>
                                        </select>

                                        <label for="yr_lvl">Year Level:</label>
                                        <select class="form-control" name="yr_lvl" id="yr_lvl">
                                            <option value="Kinder 1">Kinder 1</option>
                                            <option value="Kinder 2">Kinder 2</option>
                                            <option value="Grade 1">Grade 1</option>
                                            <option value="Grade 2">Grade 2</option>
                                            <option value="Grade 3">Grade 3</option>
                                            <option value="Grade 4">Grade 4</option>
                                            <option value="Grade 5">Grade 5</option>
                                            <option value="Grade 6">Grade 6</option>
                                            <option value="Grade 7">Grade 7</option>
                                            <option value="Grade 8">Grade 8</option>
                                            <option value="Grade 9">Grade 9</option>
                                            <option value="Grade 10">Grade 10</option>
                                            <option value="Grade 11">Grade 11</option>
                                            <option value="Grade 12">Grade 12</option>
                                        </select>

                                        <label for="program">Strand/Program:</label>
                                        <select class="form-control" name="program" id="program">
                                            <option value="None">None</option>
                                            <option value="STEM">STEM</option>
                                            <option value="ABM">ABM</option>
                                            <option value="HUMMS">HUMMS</option>
                                        </select>

                                        <label for="birth" class="hidden" id="birthlabel">Birth Certificate:</label>
                                        <input
                                        type="file"
                                        class="form-control hidden"
                                        id="birth"
                                        accept="image/png, image/jpeg"
                                        name="birth"
                                        />

                                        <label for="report" class="hidden" id="reportlabel">Report Card:</label>
                                        <input
                                        type="file"
                                        class="form-control hidden"
                                        id="report"
                                        accept="image/png, image/jpeg"
                                        name="report"
                                        />

                                        <label for="moral" class="hidden" id="morallabel">Good Moral:</label>
                                        <input
                                        type="file"
                                        class="form-control hidden"
                                        id="moral"
                                        accept="image/png, image/jpeg"
                                        name="moral"
                                        />

                                        <label for="2by2" class="hidden" id="2by2label">2x2 Photo:</label>
                                        <input
                                        type="file"
                                        class="form-control hidden"
                                        id="2by2"
                                        accept="image/png, image/jpeg"
                                        name="2by2"
                                        />
</div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="form-group">
    <hr>
    <center><a href="/address" class="btn btn-primary">Back</a>    
    <button type="submit" class="btn btn-primary">Next</button></center>
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
    //Continuing
const categ = document.getElementById('category');

const detect = function () { 
    if (categ.value == "Transferee") {
        document.getElementById("birth").classList.remove("hidden");
        document.getElementById("report").classList.remove("hidden");
        document.getElementById("moral").classList.remove("hidden");
        document.getElementById("2by2").classList.remove("hidden");
        document.getElementById("birth").required = true;
        document.getElementById("report").required = true;
        document.getElementById("moral").required = true;
        document.getElementById("2by2").required = true;
        document.getElementById("birthlabel").classList.remove("hidden");
        document.getElementById("reportlabel").classList.remove("hidden");
        document.getElementById("morallabel").classList.remove("hidden");
        document.getElementById("2by2label").classList.remove("hidden");
    } else {
        document.getElementById("birth").classList.add("hidden");
        document.getElementById("report").classList.add("hidden");
        document.getElementById("moral").classList.add("hidden");
        document.getElementById("2by2").classList.add("hidden");
        document.getElementById("birth").required = false;
        document.getElementById("report").required = false;
        document.getElementById("moral").required = false;
        document.getElementById("2by2").required = false;
        document.getElementById("birthlabel").classList.add("hidden");
        document.getElementById("reportlabel").classList.add("hidden");
        document.getElementById("morallabel").classList.add("hidden");
        document.getElementById("2by2label").classList.add("hidden");
    }
}

categ.addEventListener('change', detect);
  </script>
</body>
</html>

<?= $this->include('student/js') ?>


