<?= $this->include('student/head') ?>
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
          <center><h1 class="white">Student Information</h1></center>
            <div class="row">
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                <h5 class="card-title text-primary">Fill out the following fields</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/save" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">

                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($learner['id'])) {echo $learner['id'];}?>">
                        
                                        <center>
                                        <?php if(isset($photo)): ?>
                                            <img
                                            src="<?= $photo ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="uploadedAvatar"
                                            />
                                        <?php else: ?>
                                            <img
                                            src="<?= base_url() ?>img/user-1.jpg"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="uploadedAvatar"
                                            />
                                        <?php endif; ?>
                                    <div class="button-wrapper my-4">
                                    <label for="upload" class="btn btn-primary mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input
                                        type="file"
                                        id="upload"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                        name="photo"
                                        />
                                    </label>
                                    </div>
                                    </center>

                                    <label for="first_name">First Name:</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" required>
                        

                            
                                    <label for="middle_name">Middle Name:</label>
                                        <input type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name">
                        

                            
                                    <label for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required>
                        

                            
                                    <label for="nickname">Nickname:</label>
                                        <input type="text" class="form-control" name="nickname" placeholder="Enter Nickname" required>

                                                                
                                    <label for="age">Age:</label>
                                        <input type="number" class="form-control" name="age" placeholder="Enter Age" required>
                        
</div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
      
                                    <label for="gender">Gender:</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

  <label for="marital_status">Marital Status:</label>
                                            <select class="form-control" name="marital_status" id="marital_status" required>
                                            <option value="">Select Marital Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Widow">Widow</option>
                                        </select>
                            
                                    <label for="birthdate">Birthdate:</label>
                                        <input type="date" class="form-control" name="birthdate" placeholder="Enter Birthdate" required>
                        

                            
                                    <label for="birthplace">Birthplace:</label>
                                        <input type="text" class="form-control" name="birthplace" placeholder="Enter Birthplace" required>

                            
                                    <label for="last_name">Mobile Number:</label>
                                        <input type="tel" class="form-control" name="mobile_num" maxlength="11" placeholder="Enter Mobile Number" required>
                        
                            
                                    <label for="last_name">Nationality:</label>
                                        <input type="text" class="form-control" name="nationality" placeholder="Enter Nationality" required>
                        

                            
                                    <label for="last_name">Religion:</label>
                                        <input type="text" class="form-control" name="religion" placeholder="Enter Religion" required>

                        
  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="form-group">
    <hr>
    <center><button type="submit" class="btn btn-primary">Next</button></center>
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


