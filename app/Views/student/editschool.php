<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('student/nav') ?>
        <?= $this->include('student/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
          <center><h1 class="white">School Information</h1></center>
            <div class="row">
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Students' School Attended</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveEditSchool" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id" value="<?php if (isset($sch['id'])) {echo $sch['id'];}?>">
             
                                    <label for="grade">Grade/Year:</label>
                                        <select class="form-control" name="grade" id="grade">
                                        <option value="">Select Grade</option>  
                                        <option value="Pre-School (Kinder)" <?php if(isset($sch["grade"])) { if($sch["grade"] == "Pre-School (Kinder)") { echo "selected"; }} ?>>Pre-School (Kinder)</option>  
                                        <option value="Grade School (G1-G3)" <?php if(isset($sch["grade"])) { if($sch["grade"] == "Grade School (G1-G3)") { echo "selected"; }} ?>>Grade School (G1-G3)</option>  
                                        <option value="Grade School (G4-G6)" <?php if(isset($sch["grade"])) { if($sch["grade"] == "Grade School (G4-G6)") { echo "selected"; }} ?>>Grade School (G4-G6)</option>  
                                        <option value="Junior High School (G7-G10)" <?php if(isset($sch["grade"])) { if($sch["grade"] == "Junior High School (G7-G10)") { echo "selected"; }} ?>>Junior High School (G7-G10)</option>  
                                    </select>

                                    <label for="school_name">School Name:</label>
                                        <input type="text" class="form-control" name="school_name" placeholder="Enter Name of School"
                                        value="<?php if (isset($sch['school_name'])) {echo $sch['school_name'];}?>">

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                                    <label for="level">Level:</label>
                                        <input type="text" class="form-control" name="level" placeholder="Enter Level"
                                        value="<?php if (isset($sch['level'])) {echo $sch['level'];}?>">
                               
                                    <label for="period">Period Covered:</label>
                                        <input type="text" class="form-control" name="period" placeholder="Enter Period Covered"
                                        value="<?php if (isset($sch['period'])) {echo $sch['period'];}?>">

                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($sch['account_id'])) {echo $sch['account_id'];}?>" required>             
  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
<a href="/student" class="btn btn-primary">Go Back</a>
    <button type="submit" class="btn btn-primary">Save changes</button>
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


