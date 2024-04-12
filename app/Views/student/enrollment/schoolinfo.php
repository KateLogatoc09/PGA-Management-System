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
          <h1 class="card-title text-primary">School Information</h1>
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
                    <form action="/saveschool" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                                        <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($school['id'])) {echo $school['id'];}?>">

                                    <label for="grade">Grade/Year:</label>
                                        <select class="form-control" name="grade" id="grade">
                                        <option value="Pre-School (Kinder)">Pre-School (Kinder)</option>
                                        <option value="Grade School (G1-G3)">Grade School (G1-G3)</option>
                                        <option value="Grade School (G4-G6)">Grade School (G4-G6)</option>
                                        <option value="Junior High School (G7-G10)">Junior High School (G7-G10)</option>
                                    </select>

                                    <label for="school_name">School Name:</label>
                                        <input type="text" class="form-control" name="school_name" placeholder="Enter Name of School">

                                    <label for="level">Level:</label>
                                        <input type="text" class="form-control" name="level" placeholder="Enter Level">
                               
                                    <label for="period">Period Covered:</label>
                                        <input type="text" class="form-control" name="period" placeholder="Enter Period Covered">

  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="form-group">
    <hr>
    <center><a href="/sibling" class="btn btn-primary">Back</a>
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
</body>
</html>

<?= $this->include('student/js') ?>


