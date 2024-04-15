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
          <h1 class="card-title text-primary">Parents Information</h1>
          <p class="mb-10">
                          Fill Up The Following Fields.
                        </p>
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                      </div>
                  <div class="d-flex">
                    <div class="row">
                    <form action="/savefamily" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">  
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($family['id'])) {echo $family['id'];}?>">
                    <label for="relation">Relationship To Student:</label>
                        <select class="form-control" name="relation" id="relation">
                        <option value="">Select Relation</option>
                        <option value="Mother">Mother</option>
                        <option value="Father">Father</option>
                        <option value="Guardian">Guardian</option>
                    </select>

                                    <label for="fullname">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name" required>
                                 

                                    <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                                 

                                    <label for="occupation">Occupation:</label>
                                        <input type="text" class="form-control" name="occupation" placeholder="Occupation" required>
                                 
                                        </div>
</div>

  <div class="form-group margin-left">

                                    <label for="res_add">Residential Address:</label>
                                        <input type="text" class="form-control" name="res_add" placeholder="Enter Residential Address" required>
                                 

                                    <label for="off_add">Office Address:</label>
                                        <input type="text" class="form-control" name="off_add" placeholder="Enter Office Address" required>
                                 
                                
                                    <label for="mob_num">Mobile Number:</label>
                                        <input type="tel" class="form-control" name="mob_num" maxlength="11" placeholder="Enter Mobile Number" required>
                                 

                                    <label for="off_num">Office Number:</label>
                                        <input type="tel" class="form-control" name="off_num" maxlength="11" placeholder="Enter Office Number" required>
           
  </div>
<!---->
<div class="form-group margin-left hidden" id='div2'>  
                    <label for="relation2">Relationship To Student:</label>
                        <select class="form-control" name="relation2" id="relation2">
                        <option value="">Select Relation</option>
                        <option value="Mother">Mother</option>
                        <option value="Father">Father</option>
                        <option value="Guardian">Guardian</option>
                    </select>

                                    <label for="fullname2">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname2" placeholder="Enter Full Name" >
                                 

                                    <label for="email2">Email:</label>
                                        <input type="email" class="form-control" name="email2" placeholder="Email" >
                                 

                                    <label for="occupation2">Occupation:</label>
                                        <input type="text" class="form-control" name="occupation2" placeholder="Occupation" >
                                 
                                        </div>

  <div class="form-group margin-left hidden" id="div3">

                                    <label for="res_add2">Residential Address:</label>
                                        <input type="text" class="form-control" name="res_add2" placeholder="Enter Residential Address" >
                                 

                                    <label for="off_add2">Office Address:</label>
                                        <input type="text" class="form-control" name="off_add2" placeholder="Enter Office Address" >
                                 
                                
                                    <label for="mob_num2">Mobile Number:</label>
                                        <input type="tel" class="form-control" name="mob_num2" maxlength="11" placeholder="Enter Mobile Number" >
                                 

                                    <label for="off_num2">Office Number:</label>
                                        <input type="tel" class="form-control" name="off_num2" maxlength="11" placeholder="Enter Office Number" >
           
  </div>


</div>

<!-- Move the "Save changes" button inside the form -->
<div class="form-group">
    <hr>
    <center>
    <a href="/admission" class="btn btn-primary">Back</a>        
    <button type="submit" class="btn btn-primary">Next</button></center>
</div>
</form>
<button class="btn btn-primary" id="add">Add Another</button>
<button class="btn btn-primary hidden" id="remove">Remove</button>
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
</body>
<script>
  const add = document.getElementById('add');
  const remove = document.getElementById('remove');

  const adding = function () {
    document.getElementById("div2").classList.remove("hidden");
    document.getElementById("div3").classList.remove("hidden");
    document.getElementById("remove").classList.remove("hidden");
    document.getElementById("add").classList.add("hidden");

    document.getElementById("relation2").setAttribute("required", "");
    document.getElementById("fullname2").setAttribute("required", "");
    document.getElementById("res_add2").setAttribute("required", "");
    document.getElementById("off_add2").setAttribute("required", "");
    document.getElementById("mob_num2").setAttribute("required", "");
    document.getElementById("off_num2").setAttribute("required", "");
    document.getElementById("email2").setAttribute("required", "");
    document.getElementById("occupation2").setAttribute("required", "");
  }

  const removing = function () {
    document.getElementById("div2").classList.add("hidden");
    document.getElementById("div3").classList.add("hidden");
    document.getElementById("remove").classList.add("hidden");
    document.getElementById("add").classList.remove("hidden");

    document.getElementById("relation2").removeAttribute("required"); 
    document.getElementById("fullname2").removeAttribute("required"); 
    document.getElementById("res_add2").removeAttribute("required"); 
    document.getElementById("off_add2").removeAttribute("required"); 
    document.getElementById("mob_num2").removeAttribute("required"); 
    document.getElementById("off_num2").removeAttribute("required"); 
    document.getElementById("email2").removeAttribute("required"); 
    document.getElementById("occupation2").removeAttribute("required"); 
  }

  add.addEventListener('click', adding);
  remove.addEventListener('click', removing);

</script>
</html>

<?= $this->include('student/js') ?>




