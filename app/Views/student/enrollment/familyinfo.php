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
          <h1 class="card-title text-primary">Parents Information</h1>
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
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">

                                    <label for="res_add">Residential Address:</label>
                                        <input type="text" class="form-control" name="res_add" placeholder="Enter Residential Address" required>
                                 

                                    <label for="off_add">Office Address:</label>
                                        <input type="text" class="form-control" name="off_add" placeholder="Enter Office Address" required>
                                 
                                
                                    <label for="mob_num">Mobile Number:</label>
                                        <input type="number" class="form-control" name="mob_num" max_length="11" placeholder="Enter Mobile Number" required>
                                 

                                    <label for="off_num">Office Number:</label>
                                        <input type="number" class="form-control" name="off_num" max_length="11" placeholder="Enter Office Number" required>
                                 
  </div>
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


