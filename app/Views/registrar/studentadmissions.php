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
                                        <th>2x2 ID</th>
                                        <th>Student ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Category</th>
                                        <th>Year Level</th>
                                        <th>Section</th>
                                        <th>Program</th>
                                        <th>Birth Certificate</th>
                                        <th>Report Card</th>
                                        <th>Good Moral</th>
                                        <th>Schedule Date</th>
                                        <th>Status</th>
                                        <th>Account Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($student as $ad): ?>
                                    <tr>
                                            <td><?= $ad['id'] ?></td>
                                            <td><img
                                            src="<?= base_url().$ad['photo'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            /></td>
                                            <td><?= $ad['student_id'] ?></td>
                                            <td><?= $ad['first_name'] ?></td>
                                            <td><?= $ad['middle_name'] ?></td>
                                            <td><?= $ad['last_name'] ?></td>
                                            <td><?= $ad['category'] ?></td>
                                            <td><?= $ad['yr_lvl'] ?></td>
                                            <td><?= $ad['section'] ?></td>
                                            <td><?= $ad['program'] ?></td>
                                            <td><img
                                            src="<?= base_url().$ad['birth_cert'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            /></td>
                                            <td><img
                                            src="<?= base_url().$ad['report_card'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            /></td>
                                            <td><img
                                            src="<?= base_url().$ad['good_moral'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            /></td>
                                            <td><?= $ad['schedule'] ?></td>
                                            <td><?= $ad['status'] ?></td>
                                            <td><?= $ad['account_id'] ?></td>
                                            <td> <a href="/regDeleteadmissions/<?= $ad['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/regEditadmissions/<?= $ad['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Edit Admission</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/regSaveadmissions" method="post" enctype="multipart/form-data">
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
                                        <select name="section" id="section" class="form-control">
                                        <option value="">Select Section</option>
                                            <?php $uniqueCategories = array(); 
                                                foreach ($stud_section as $se) {$stud_section = $se['name'];
                                                if (!in_array($stud_section, $uniqueCategories)) {$uniqueCategories[] = $stud_section; 
                                                echo '<option value="' . $stud_section . '">' . $stud_section . '</option>';}}?> 
                                        </select>  

                                        <label for="program">Strand/Program:</label>
                                        <select class="form-control" name="program" id="program">
                                            <option value="None">None</option>
                                            <option value="STEM">STEM</option>
                                            <option value="ABM">ABM</option>
                                            <option value="HUMMS">HUMMS</option>
                                        </select>


                                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                                        <label for="schedule">Schedule Date:</label>
                                        <input type="date" class="form-control" name="schedule" placeholder="Enter Schedule Date" 
                                        value="<?php if (isset($admissions['schedule'])) {echo $admissions['schedule'];}?>" required>  

                                        <label for="status">Status:</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="PENDING">Pending</option>
                                            <option value="ON PROCESS">On Process</option>
                                            <option value="ENROLLED">Enrolled</option>
                                            <option value="REJECTED">Rejected</option>
                                        </select>

                                        <label for="twobytwo">2x2 ID:</label>
                                        <input type="file" id="upload" accept="image/png, image/jpeg" name="twobytwo"/>


                                        <label for="birth_cert">Birth Certificate:</label>
                                        <input type="file" id="upload" accept="image/png, image/jpeg" name="birth_cert"/>

                                        
                                        <label for="report_card">Report Card:</label>
                                        <input type="file" id="upload" accept="image/png, image/jpeg" name="report_card"/>

                                        
                                        <label for="good_moral">Good Moral:</label>
                                        <input type="file" id="upload" accept="image/png, image/jpeg" name="good_moral"/>

                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($admissions['account_id'])) {echo $admissions['account_id'];}?>" required> 
                                 
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
