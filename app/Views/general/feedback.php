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
          <?php if($_SESSION['role'] == 'GENERAL'): ?>
        <?= $this->include('general/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'STUDENT'): ?>
        <?= $this->include('student/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'TEACHER'): ?>
        <?= $this->include('teacher/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'LIBRARIAN'): ?>
        <?= $this->include('library/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'PARENT'): ?>
        <?= $this->include('parent/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'REGISTRAR'): ?>
        <?= $this->include('registrar/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'AAC'): ?>
        <?= $this->include('AAC/sidebar') ?>
        <?php endif; ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Rate our website and share your comments!</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-11">
                <form action="/sendfeedback" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <input type="hidden" class="form-control" name="id" value="<?php if (isset($sfeed['id'])) {echo $sfeed['id'];}?>">
                  
                    <div class="form-group margin-left">
                        <label for="rateYo">Rating:</label> <small id="ratingnum"></small>
                        <div id="rateYo"></div>
                        <input type="hidden" name="rating" id="rating">
                                 
                      

  <label for="comment" class="form-label">Feedback/Comment</label>
  <textarea class="form-control" id="comment" name="comment" style="resize:none" rows="6"><?php if(isset($sfeed['comment'])) { echo $sfeed['comment']; }?></textarea>

  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
<button class="btn btn-primary" id="submit">Submit</button>
</div>
</form>
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
  
  $(function () {
 
  var $rateYo = $("#rateYo").rateYo();

// Setter
$("#rateYo").rateYo("option", "halfStar", true); //returns a jQuery Element
$("#rateYo").rateYo("option", "ratedFill", "#0790f2");
$("#rateYo").rateYo("option", "onSet", function () { $("#ratingnum").text($rateYo.rateYo("rating"));}); 

<?php if(isset($sfeed['rating'])): ?>
  $("#rateYo").rateYo("option", "rating", <?= $sfeed['rating']; ?>);
<?php endif; ?>
  $("#submit").click(function () {
    /* get rating */
    var rating = $rateYo.rateYo("rating");
    $("#rating").val(rating);
  });
 
});

</script>

</html>
