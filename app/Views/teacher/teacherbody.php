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
        <?= $this->include('teacher/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
          <h5 class="card-title text-primary">Welcome <?= $_SESSION['username']; ?>! 🎉</h5>

            <div class="row">
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">

                      <div class="content-wrapper">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                      <?php if(is_array($teach)): ?>
                        <h5 class="card-title text-primary">Teacher Information</h5>
                        <br>
                        <h7 class="orange">Teacher ID:</h7>
                        <?php if (isset($teach['idnum'])) {echo $teach['idnum'];}?>
                        <br>
                        <h7 class="orange">Full Name:</h7>
                        <?php if (isset($teach['fname'])) {echo $teach['fname'];}?>
                        <?php if (isset($teach['mname'])) {echo $teach['mname'];}?>
                        <?php if (isset($teach['lname'])) {echo $teach['lname'];}?>
                        <br>
                        <h7 class="orange">Age:</h7>
                        <?php if (isset($teach['age'])) {echo $teach['age'];}?>
                        <br>
                        <h7 class="orange">Gender:</h7>
                        <?php if (isset($teach['gender'])) {echo $teach['gender'];}?>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">   
                        <h7 class="orange">Birthdate:</h7>
                        <?php if (isset($teach['dob'])) {echo $teach['dob'];}?>
                        <br>
                        <h7 class="orange">Address:</h7>
                        <?php if (isset($teach['address'])) {echo $teach['address'];}?>
                        <br>  
                        <h7 class="orange">Phone Number:</h7>
                        <?php if (isset($teach['phone'])) {echo $teach['phone'];}?>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              <?php else: ?>
                <h5 class="m-4">No Information Available Yet.</h5>
              <?php endif; ?>
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
