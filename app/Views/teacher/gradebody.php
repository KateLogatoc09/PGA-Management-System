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
        <?= $this->include('teacher/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              
                
              <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Grades List</h3>
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
                                        <th>Teacher Id</th>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($grade as $g): ?>
                                    <tr>
                                            <td><?= $g['id'] ?></td>
                                            <td><?= $g['student_id'] ?></td>
                                            <td><?= $g['idnum'] ?></td>
                                            <td><?= $g['subject'] ?></td>
                                            <td><?= $g['grade'] ?></td>
                                            <td> <a href="/deleteGrade/<?= $g['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editGrade/<?= $g['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                           
                                           
                                          
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
                        <h5 class="card-title text-primary">Save Grade</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveGrade" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($gr['id'])) {echo $gr['id'];}?>">
                        <label for="student_id">Student Id:</label>
                        <input type="text" class="form-control" name="student_id" placeholder="Enter Student Id" 
                        value="<?php if (isset($gr['student_id'])) {echo $gr['student_id'];}?>" required>
</div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                        <label for="subject">Subject:</label>
                                        <select name="subject" id="subject" class="form-control">
                                        <option value="">Select Subject</option>
                                            <?php $uniqueCategories = array(); 
                                                foreach ($subject as $se) {$subject = $se['name'];
                                                if (!in_array($subject, $uniqueCategories)) {$uniqueCategories[] = $subject; 
                                                echo '<option value="' . $subject . '">' . $subject . '</option>';}}?> 
                                        </select>  
                        <label for="grade">Grade:</label>
                        <input type="number" class="form-control" name="grade" placeholder="Enter Grade" 
                        value="<?php if (isset($gr['grade'])) {echo $gr['grade'];}?>" required>        
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
