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
          <h1 class="card-title text-primary">Sibling Information</h1>
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
                    <form action="/savesibling" method="post" id='form'>
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                
                                        <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($admissions['id'])) {echo $admissions['id'];}?>">
                        
                                        <label for="fullname">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name" id="fullname">
                                 
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

                                        <label for="affiliation">Affiliation:</label>
                                        <input type="text" class="form-control" name="affiliation" placeholder="Enter Affiliation" id="affiliation">
                          
  </div>
  
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="form-group">
    <hr>
    <center><a href="/family" class="btn btn-primary">Back</a>
<button type="submit" class="btn btn-primary">Next</button></center>
</div>
</form>
<button class="btn btn-primary" id="add">Add Another</button>
<button class="btn btn-primary hidden" id="remove">Remove</button>
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
</body>
<script>
const add = document.getElementById('add');
const remove = document.getElementById('remove');
const form = document.getElementById('form');
var x = 0;
var y = 1;
const opt = '<option value="Kinder 1">Kinder 1</option><option value="Kinder 2">Kinder 2</option><option value="Grade 1">Grade 1</option><option value="Grade 2">Grade 2</option><option value="Grade 3">Grade 3</option><option value="Grade 4">Grade 4</option><option value="Grade 5">Grade 5</option><option value="Grade 6">Grade 6</option><option value="Grade 7">Grade 7</option><option value="Grade 8">Grade 8</option><option value="Grade 9">Grade 9</option><option value="Grade 10">Grade 10</option><option value="Grade 11">Grade 11</option><option value="Grade 12">Grade 12</option>';

const create = function () {
  window['div' + y] = document.createElement("div");
  window['div' + y].className = "form-group margin-left";
  window['div' + y].setAttribute("id", "div" + y); // set the CSS class
  form.appendChild(window['div' + y]); // put it into the DOM

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Full Name:";
  window['label' + x].setAttribute("for", "fullname" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "text";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "fullname" + y);
  window['input' + x].setAttribute("placeholder", "Enter Full Name");
  window['input' + x].setAttribute("required", "");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Year Level:";
  window['label' + x].setAttribute("for", "yr_lvl" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("select");
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "yr_lvl" + y);
  window['input' + x].setAttribute("required", "");
  window['input' + x].innerHTML = opt;
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Affiliation:";
  window['label' + x].setAttribute("for", "affiliation" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "text";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "affiliation" + y);
  window['input' + x].setAttribute("placeholder", "Enter Affiliation");
  window['input' + x].setAttribute("required", "");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;
  y++;

  remove.classList.remove("hidden");
}

const rem = function () {
  if(y > 1) {
    y--;
    if(y === 1) {
    form.removeChild(window['div' + y]);
    remove.classList.add("hidden");
    } else { 
    form.removeChild(window['div' + y]);
    }
  }
}


add.addEventListener('click', create);
remove.addEventListener('click', rem);

</script>
</html>

<?= $this->include('student/js') ?>


