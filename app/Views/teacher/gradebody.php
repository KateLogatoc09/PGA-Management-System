<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('teacher/nav') ?>
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
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchGrade" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                              <option value="student_grades.student_id">Student Id</option>
                              <option value="Student">Fullname of Student</option>
                              <option value="name">Section</option>
                              <option value="subject_name">Subject</option>
                              <option value="grade">Grade</option>
                              <option value="quarter">Quarter</option>
                              <option value="idnum">Teacher Id</option>
                                    </select>
                          <button type="submit" class="btn btn-default">
                          <i class="menu-icon tf-icons bx bx-search"></i>
                          </button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                         <table class="table table-hover text-nowrap">
                    
                            <thead>
                                    <tr>
                                        <th>Student Id</th>
                                        <th>Fullname of Student</th>
                                        <th>Section</th>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th>Quarter</th>
                                        <th>School Year</th>
                                        <th>Teacher Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Pagination Logic -->
                                <?php
                                // Define the number of records per page
                                $recordsPerPage = 5;

                                // Calculate the total number of pages
                                $totalPages = ceil(count($grade) / $recordsPerPage);

                                // Get the current page number from the query string, default to 1 if not set
                                $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

                                // Calculate the offset for the subset of records to be displayed on the current page
                                $offset = ($currentPage - 1) * $recordsPerPage;

                                // Get a subset of records to display based on the current page and records per page
                                $subset = array_slice($grade, $offset, $recordsPerPage);

                                // Loop through the subset of records to display
                                $x = 1;
                                foreach ($subset as $g) :
                                ?>
                                    <tr>
                                            <td><?= $g['student_id'] ?></td>
                                            <td><?= $g['last_name'] ?>, <?= $g['first_name'] ?> <?= $g['middle_name'] ?></td>
                                            <td><?= $g['name'] ?></td>
                                            <td><?= $g['subject_name'] ?></td>
                                            <td><?= $g['grade'] ?></td>
                                            <td><?= $g['quarter'] ?></td>
                                            <td><?= $g['school_year'] ?></td>
                                            <td><?= $g['idnum'] ?></td>
                                            <td> <a href="/deleteGrade/<?= $g['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/editGrade/<?= $g['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                    </tr>
                                <?php $x++; endforeach ?>
                                <!-- End Pagination Logic -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <!-- Pagination Links -->
                        <div class="card-footer">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <?php if ($currentPage > 1) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <?php if ($currentPage < $totalPages) : ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
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
                        value="<?php if (isset($gr['student_id'])) {echo $gr['student_id'];}?>" list="list" required>
                        <datalist type="hidden" id="list">
                                            <?php foreach ($learner as $le):?> 
                                                <option value="<?= $le['student_id'] ?>"><?= $le['first_name'] ?> <?= $le['middle_name'] ?> <?= $le['last_name'] ?></option>
                                            <?php endforeach; ?>
                                        </datalist> 
                                        
                                        <label for="subject">Subject:</label>
                                        <select name="subject" id="subject" class="form-control">
                                        <option value="">Select Subject</option>
                                            <?php foreach ($subject as $se):?> 
                                                <option value="<?= $se['id'] ?>" <?php if(isset($gr["subject"])) { if($gr["subject"] == $se['id']) { echo "selected"; }} ?>><?= $se['subject_name'] ?></option> 
                                            <?php endforeach; ?>
                                        </select> 
</div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                        <label for="grade">Grade:</label>
                        <input type="number" class="form-control" name="grade" placeholder="Enter Grade" 
                        value="<?php if (isset($gr['grade'])) {echo $gr['grade'];}?>" required>   
                        
                        <label for="quarter">Quarter:</label>
                        <input type="number" class="form-control" name="quarter" placeholder="Enter Quarter" 
                        value="<?php if (isset($gr['quarter'])) {echo $gr['quarter'];}?>" required>   
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
  <script>
  <?php $y = 1; foreach ($subset as $g): ?>
  document.getElementById("d<?=$y?>").addEventListener("click", function (event) {
    event.preventDefault()
      //sweetalert2 code
      Swal.fire({
          title: 'PGA',
          text: "Are you sure? You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = $(this).attr('href');
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info');
        }
      })
    });
<?php $y++; endforeach; ?>
  </script>
  <script src="assets/js/book.js"></script>
</body>

</html>
