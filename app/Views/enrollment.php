<?= $this->include('student/head') ?>
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
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" <?php if($learn == 'False'): echo 'data-target="#learnerModal"'; endif;?>>Learner Info</a>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" <?php if($learn == 'True'): echo 'data-target="#addressModal"'; endif; ?> >Addresses</a>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" <?php if($address == 'True' && $admission != 'True'): echo 'data-target="#admissionModal"'; endif; ?>>Admission Info</a>
                      </div>
                      <?= $this->include('student/enrollment/learner') ?>
                      <?= $this->include('student/enrollment/address') ?>
                      <?= $this->include('student/enrollment/admission') ?>
                    </div>

                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Family Information</h5>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" <?php if($admission == 'True'): echo 'data-target="#FamilyModal"'; endif; ?>>Parent Info</a>
                        <p class="mb-10">
                          If you have siblings presently enrolled in PGA fill up the form below:<br>
                            <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" <?php if($family == 'True'): echo 'data-target="#siblingModal"'; endif; ?>>Sibling Info</a>
                        </p>
                      </div>

                      <?= $this->include('student/enrollment/family') ?>
                      <?= $this->include('student/enrollment/sibling') ?>

                    </div>

                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Schools Attendend Information</h5>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" <?php if($sibling == 'True'): echo 'data-target="#schoolModal"'; endif; ?>>School Info</a>
                      </div>
                      <?= $this->include('student/enrollment/school') ?>
                    </div>
                    <h7 class="note">Note: Please make sure that you have filled all of the forms or the enrollment will be disregarded</h7>
                  </div>
                </div>
              </div>
              
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

<?= $this->include('student/js') ?>


