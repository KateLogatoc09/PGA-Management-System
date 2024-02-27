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
        <?= $this->include('student/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
          <h1 class="card-title text-primary">Enrollment Form</h1>
          <p class="mb-10">
                          Fill Up The Following Forms.
                        </p>
            <div class="row">
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Student Information</h5>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#learnerModal">Learner Info</a>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addressModal">Addresses</a>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#admissionModal">Admission Info</a>
                      </div>
                      <?= $this->include('student/enrollment/learner') ?>
                      <?= $this->include('student/enrollment/address') ?>
                      <?= $this->include('student/enrollment/admission') ?>
                    </div>

                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Family Information</h5>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#FamilyModal">Parent Info</a>
                        <p class="mb-10">
                          If you have siblings presently enrolled in PGA fill up the form below:<br>
                            <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#siblingModal">Sibling Info</a>
                        </p>
                      </div>

                      <?= $this->include('student/enrollment/family') ?>
                      <?= $this->include('student/enrollment/sibling') ?>

                    </div>

                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Schools Attendend Information</h5>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#schoolModal">School Info</a>
                      </div>
                      <?= $this->include('student/enrollment/school') ?>
                    </div>
                    <h7 class="note">Note: Please make sure that you have filled all of the forms or the enrollment will be disregarded</h7>
                  </div>
                </div>
              </div>
              <a href="/confirm" class="btn btn-primary sub">Submit</a>
              
                    </div>
                    <!-- /.card -->
                </div> <!-- /.dito -->



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
