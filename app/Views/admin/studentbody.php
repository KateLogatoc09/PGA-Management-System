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
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Welcome Admin! 🎉</h5>
                      </div>

                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
              <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enrollment List</h3>
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
                                        <th>Year Level</th>
                                        <th>Section</th>
                                        <th>Program</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Account Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($student as $stud): ?>
                                    <tr>
                                            <td><?= $stud['id'] ?></td>
                                            <td><?= $stud['student_id'] ?></td>
                                            <td><?= $stud['first_name'] ?></td>
                                            <td><?= $stud['middle_name'] ?></td>
                                            <td><?= $stud['last_name'] ?></td>
                                            <td><?= $stud['nickname'] ?></td>
                                            <td><?= $stud['age'] ?></td>
                                            <td><?= $stud['gender'] ?></td>
                                            <td><?= $stud['birthdate'] ?></td>
                                            <td><?= $stud['birthplace'] ?></td>
                                            <td><?= $stud['marital_status'] ?></td>
                                            <td><?= $stud['mobile_num'] ?></td>
                                            <td><?= $stud['nationality'] ?></td>
                                            <td><?= $stud['religion'] ?></td>
                                            <td><?= $stud['yr_lvl'] ?></td>
                                            <td><?= $stud['section'] ?></td>
                                            <td><?= $stud['program'] ?></td>
                                            <td><?= $stud['category'] ?></td>
                                            <td><?= $stud['status'] ?></td>
                                            <td><?= $stud['account_id'] ?></td>
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
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Edit Learner</h5>
                      </div>
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

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="card-body pb-0 px-0 px-md-4">
    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
  </div>
</div>
</div>
</div>
</div>

                
              <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admission List</h3>
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
                                        <th>Student ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Category</th>
                                        <th>Year Level</th>
                                        <th>Section</th>
                                        <th>Program</th>
                                        <th>Status</th>
                                        <th>Account Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($student as $ad): ?>
                                    <tr>
                                            <td><?= $ad['id'] ?></td>
                                            <td><?= $ad['student_id'] ?></td>
                                            <td><?= $ad['first_name'] ?></td>
                                            <td><?= $ad['middle_name'] ?></td>
                                            <td><?= $ad['last_name'] ?></td>
                                            <td><?= $ad['category'] ?></td>
                                            <td><?= $ad['yr_lvl'] ?></td>
                                            <td><?= $ad['section'] ?></td>
                                            <td><?= $ad['program'] ?></td>
                                            <td><?= $ad['status'] ?></td>
                                            <td><?= $ad['account_id'] ?></td>
                                            <td> <a href="/deleteAdmissions/<?= $ad['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editAdmissions/<?= $ad['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Edit Admission</h5>
                      </div>
                <form action="/adminadmissions" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($admissions['id'])) {echo $admissions['id'];}?>">

                                        
                                        <label for="student_id">Student ID:</label>
                                        <input type="text" class="form-control" name="student_id" placeholder="Enter Student ID"
                                        value="<?php if (isset($admissions['student_id'])) {echo $admissions['student_id'];}?>">

                        
                                        <label for="category">Student Category:</label>
                                        <select class="form-control" name="category" id="category">
                                            <option value="Continuing">Continuing</option>
                                            <option value="Transferee">Transferee</option>
                                            <option value="Returnee">Returnee</option>
                                        </select>

                                        <label for="yr_lvl">Year Level:</label>
                                        <select class="form-control" name="yr_lvl" id="yr_lvl">
                                            <option value="Kinder 1">Kinder 1</option>
                                            <option value="Kinder 2">Kinder 2</option>
                                            <option value="Grade 1">Grade 1</option>
                                            <option value="Grade 2">Grade 2</option>
                                            <option value="Grade 3">Grade 3</option>
                                            <option value="Grade 4">Grade 4</option>
                                            <option value="Grade 5">Grade 5</option>
                                            <option value="Grade 6">Grade 6</option>
                                            <option value="Grade 7">Grade 7</option>
                                            <option value="Grade 8">Grade 8</option>
                                            <option value="Grade 9">Grade 9</option>
                                            <option value="Grade 10">Grade 10</option>
                                            <option value="Grade 11">Grade 11</option>
                                            <option value="Grade 12">Grade 12</option>
                                        </select>

                                        <label for="section">Section:</label>
                                        <select class="form-control" name="section" id="section"
                                        value="<?php if (isset($admissions['section'])) {echo $admissions['section'];}?>">
                                            <option value="PENDING">Pending</option>
                                            <option value="St. Joseph Husband of Mary">St. Joseph Husband of Mary</option>
                                            <option value="St. Perpetua and Felicity">St. Perpetua and Felicity</option>
                                            <option value="St. Louise de Marillac">St. Louise de Marillac</option>
                                            <option value="St. Dominic Savio">St. Dominic Savio</option>
                                            <option value="St. Pedro Calungsod">St. Pedro Calungsod</option>
                                            <option value="St. Gemma Galgani">St. Gemma Galgani</option>
                                            <option value="St. Catherine of Sienna">St. Catherine of Sienna</option>
                                            <option value="St. Lawrence of Manila">St. Lawrence of Manila</option>
                                            <option value="St. Pio of Pietrelcina">St. Pio of Pietrelcina</option>
                                            <option value="St. Matthew the Evangelist">St. Matthew the Evangelist</option>
                                            <option value="St. Jerome of Stridon">St. Jerome of Stridon</option>
                                            <option value="St. Francis of Assisi">St. Francis of Assisi</option>
                                            <option value="St. Luke the Evangelist">St. Luke the Evangelist</option>
                                            <option value="St. Therese of Lisieux">St. Therese of Lisieux</option>
                                            <option value="St. Cecelia">St. Cecelia</option>
                                            <option value="St. Martin the Porres">St. Martin the Porres</option>
                                            <option value="St. Albert the Great">St. Albert the Great</option>
                                            <option value="St. Stephen">St. Stephen</option>
                                            <option value="St. Francis Xavier">St. Francis Xavier</option>
                                            <option value="St. John the Beloved">St. John the Beloved</option>
                                            <option value="St. Joseph Freinademetz">St. Joseph Freinademetz</option>
                                            <option value="St. Thomas Aquinas">St. Thomas Aquinas</option>
                                            <option value="St. Arnold Janssen">St. Arnold Janssen</option>
                                            <option value="Agatha Sicily">Agatha Sicily</option>
                                            <option value="Scholastica">Scholastica</option>
                                        </select>

                                        <label for="program">Strand/Program:</label>
                                        <select class="form-control" name="program" id="program">
                                            <option value="None">None</option>
                                            <option value="STEM">STEM</option>
                                            <option value="ABM">ABM</option>
                                            <option value="HUMMS">HUMMS</option>
                                        </select>

                                        <label for="status">Status:</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="PENDING">Pending</option>
                                            <option value="ON PROCESS">On Process</option>
                                            <option value="ENROLLED">Enrolled</option>
                                            <option value="REJECTED">Rejected</option>
                                        </select>

                                        <label for="account_id">Account Id</label>
                        <input type="text" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($admissions['account_id'])) {echo $admissions['account_id'];}?>" required> 
                        </div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="card-body pb-0 px-0 px-md-4">
    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
  </div>
</div>
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
