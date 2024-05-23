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
          <center><h1 class="white">Edit Student Information</h1></center>
            <div class="row">
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Learner</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                    <form action="/saveEditLearner" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($learn['id'])) {echo $learn['id'];}?>">
                                        <center>
                                        <?php if(isset($learn['photo'])): ?>
                                            <img
                                            src="<?= $learn['photo'] ?>"
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
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name"
                                        value="<?php if (isset($learn['first_name'])) {echo $learn['first_name'];}?>">
                        
                                    <label for="middle_name">Middle Name:</label>
                                        <input type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name"
                                        value="<?php if (isset($learn['middle_name'])) {echo $learn['middle_name'];}?>">
                        
                                    <label for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name"
                                        value="<?php if (isset($learn['last_name'])) {echo $learn['last_name'];}?>">
                      
                                    <label for="nickname">Nickname:</label>
                                        <input type="text" class="form-control" name="nickname" placeholder="Enter Nickname"
                                        value="<?php if (isset($learn['nickname'])) {echo $learn['nickname'];}?>">
                            
                                    <label for="age">Age:</label>
                                        <input type="number" class="form-control" name="age" placeholder="Enter Age"
                                        value="<?php if (isset($learn['age'])) {echo $learn['age'];}?>">
                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
  <label for="gender">Gender:</label>
                                        <select class="form-control" name="gender" id="gender" 
                                        value="<?php if (isset($learn['gender'])) {echo $learn['gender'];}?>">
                                        <option value="">Select Gender</option>  
                                        <option value="Male" <?php if(isset($learn["gender"])) { if($learn["gender"] == "Male") { echo "selected"; }} ?>>Male</option>  
                                        <option value="Female" <?php if(isset($learn["gender"])) { if($learn["gender"] == "Female") { echo "selected"; }} ?>>Female</option>  
                                        </select>
                        
                                        <label for="marital_status">Marital Status:</label>
                                            <select class="form-control" name="marital_status" id="marital_status"
                                            value="<?php if (isset($learn['marital_status'])) {echo $learn['marital_status'];}?>">
                                            <option value="">Select Marital Status</option>  
                                            <option value="Single" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "Single") { echo "selected"; }} ?>>Single</option>  
                                            <option value="Married" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "Married") { echo "selected"; }} ?>>Married</option>  
                                            <option value="Separated" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "Separated") { echo "selected"; }} ?>>Separated</option>  
                                            <option value="Widow" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "Widow") { echo "selected"; }} ?>>Widow</option>  
                                        
                                        </select>
  <label for="birthdate">Birthdate:</label>
                                        <input type="date" class="form-control" name="birthdate" placeholder="Enter Birthdate"
                                        value="<?php if (isset($learn['birthdate'])) {echo $learn['birthdate'];}?>">
                            
                                    <label for="birthplace">Birthplace:</label>
                                        <input type="text" class="form-control" name="birthplace" placeholder="Enter Birthplace"
                                        value="<?php if (isset($learn['birthplace'])) {echo $learn['birthplace'];}?>">

                            
                                    <label for="last_name">Mobile Number:</label>
                                        <input type="number" class="form-control" name="mobile_num" max_length="11" placeholder="Enter Mobile Number"
                                        value="<?php if (isset($learn['mobile_num'])) {echo $learn['mobile_num'];}?>">
                        
                            
                                    <label for="last_name">Nationality:</label>
                                        <input type="text" class="form-control" name="nationality" placeholder="Enter Nationality"
                                        value="<?php if (isset($learn['nationality'])) {echo $learn['nationality'];}?>">
                            
                                    <label for="last_name">Religion:</label>
                                        <input type="text" class="form-control" name="religion" placeholder="Enter Religion"
                                        value="<?php if (isset($learn['religion'])) {echo $learn['religion'];}?>">
                        
                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($learn['account_id'])) {echo $learn['account_id'];}?>" required> 
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


