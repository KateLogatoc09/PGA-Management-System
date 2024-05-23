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

          <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Parent Information</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveEditFamily" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($fam['id'])) {echo $fam['id'];}?>">
                    <label for="relation">Relationship To Student:</label>
                        <select class="form-control" name="relation" id="relation" 
                        value="<?php if (isset($fam['relation'])) {echo $fam['relation'];}?>">
                        <option value="">Select Relationship</option>
                        <option value="Mother" <?php if(isset($fam["relation"])) { if($fam["relation"] == "Mother") { echo "selected"; }} ?>>Mother</option>  
                        <option value="Father" <?php if(isset($fam["relation"])) { if($fam["relation"] == "Father") { echo "selected"; }} ?>>Father</option>
                        <option value="Guardian" <?php if(isset($fam["relation"])) { if($fam["relation"] == "Guardian") { echo "selected"; }} ?>>Guardian</option>

                    </select>

                                    <label for="fullname">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name"
                                        value="<?php if (isset($fam['fullname'])) {echo $fam['fullname'];}?>">
                                 

                                    <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                        value="<?php if (isset($fam['email'])) {echo $fam['email'];}?>">
                                 

                                    <label for="occupation">Occupation:</label>
                                        <input type="text" class="form-control" name="occupation" placeholder="Occupation"
                                        value="<?php if (isset($fam['occupation'])) {echo $fam['occupation'];}?>">

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">

  <label for="res_add">Residential Address:</label>
                                        <input type="text" class="form-control" name="res_add" placeholder="Enter Residential Address"
                                        value="<?php if (isset($fam['res_add'])) {echo $fam['res_add'];}?>">
      
                                    <label for="mob_num">Mobile Number:</label>
                                        <input type="number" class="form-control" name="mob_num" max_length="11" placeholder="Enter Mobile Number"
                                        value="<?php if (isset($fam['mob_num'])) {echo $fam['mob_num'];}?>">
                                 
                        
  <label for="off_add">Office Address:</label>
                                        <input type="text" class="form-control" name="off_add" placeholder="Enter Office Address"
                                        value="<?php if (isset($fam['off_add'])) {echo $fam['off_add'];}?>">

                                    <label for="off_num">Office Number:</label>
                                        <input type="number" class="form-control" name="off_num" max_length="11" placeholder="Enter Office Number"
                                        value="<?php if (isset($fam['off_num'])) {echo $fam['off_num'];}?>">

                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($fam['account_id'])) {echo $fam['account_id'];}?>" required> 
                        
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




