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
        <?= $this->include('admin/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

              <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Learner Information List</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                         <table class="table table-hover text-nowrap">
                    
                            <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Student Id</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Nickname</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Birthdate</th>
                                        <th>Birthplace</th>
                                        <th>Marital Status</th>
                                        <th>Mobile Number</th>
                                        <th>Nationality</th>
                                        <th>Religion</th>
                                        <th>Yaer Level</th>
                                        <th>Section</th>
                                        <th>Account Id</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($learner as $le): ?>
                                    <tr>
                                            <td><?= $le['id'] ?></td>
                                            <td><?= $le['student_id'] ?></td>
                                            <td><?= $le['first_name'] ?></td>
                                            <td><?= $le['middle_name'] ?></td>
                                            <td><?= $le['last_name'] ?></td>
                                            <td><?= $le['nickname'] ?></td>
                                            <td><?= $le['age'] ?></td>
                                            <td><?= $le['gender'] ?></td>
                                            <td><?= $le['birthdate'] ?></td>
                                            <td><?= $le['birthplace'] ?></td>
                                            <td><?= $le['marital_status'] ?></td>
                                            <td><?= $le['mobile_num'] ?></td>
                                            <td><?= $le['nationality'] ?></td>
                                            <td><?= $le['religion'] ?></td>
                                            <td><?= $le['yr_lvl'] ?></td>
                                            <td><?= $le['section'] ?></td>
                                            <td><?= $le['account_id'] ?></td>
                                            <td> <a href="/deleteLearner/<?= $le['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editLearner/<?= $le['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                     </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    </div>
                    <!-- /.card -->
                </div> <!-- /.dito -->

                <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Learner</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                    <form action="/saveLearner" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($learn['id'])) {echo $learn['id'];}?>">
                          
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
                            
                                    <label for="gender">Gender:</label>
                                        <select class="form-control" name="gender" id="gender" 
                                        value="<?php if (isset($learn['gender'])) {echo $learn['gender'];}?>">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                        
                                        <label for="marital_status">Marital Status:</label>
                                            <select class="form-control" name="marital_status" id="marital_status"
                                            value="<?php if (isset($learn['marital_status'])) {echo $learn['marital_status'];}?>">
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Widow">Widow</option>
                                        </select>
                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
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
                        
                                        <label for="account_id">Account Id</label>
                        <input type="text" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($learn['account_id'])) {echo $learn['account_id'];}?>" required> 
                        </div>

                        
  </div>

</div>
<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
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

  <script src="assets/js/book.js"></script>
</body>

</html>
