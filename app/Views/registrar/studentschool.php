<?php
// Pagination Configuration
$totalRecords = count($school);
$recordsPerPage = 5;
$totalPages = ceil($totalRecords / $recordsPerPage);

// Current Page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
  <?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
    <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('registrar/nav') ?>
        <?= $this->include('registrar/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
      
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Students' School Attended List</h3>
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="searchSchool"method="Get">
                      <div class="input-group-append">
                        <input type="text" name="table_search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ"> 
                          <option value="student_id">Student's ID Number</option>
                          <option value="Student">Student's Name</option>
                          <option value="grade">Grade</option>
                          <option value="school_name">School Name</option>
                          <option value="level">Level</option>
                          <option value="period">Period</option>
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
                          <th>Student's ID Number</th>
                          <th>Student's Name</th>
                          <th>Grade</th>
                          <th>School Name</th>
                          <th>Level</th>
                          <th>Period</th>
                          <th>Account Id</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Paginate Data
                        $offset = ($currentPage - 1) * $recordsPerPage;
                        $paginatedSchool = array_slice($school, $offset, $recordsPerPage);
                        $x = 1;
                        foreach ($paginatedSchool as $sc):
                        ?>
                        <tr>
                          <td><?= $sc['student_id'] ?></td>
                          <td><?= $sc['last_name'] ?>, <?= $sc['first_name'] ?> <?= $sc['middle_name'] ?></td>
                          <td><?= $sc['grade'] ?></td>
                          <td><?= $sc['school_name'] ?></td>
                          <td><?= $sc['level'] ?></td>
                          <td><?= $sc['period'] ?></td>
                          <td><?= $sc['account_id'] ?></td>
                          <td>
                            <a href="/regDeleteschool/<?= $sc['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                            <a href="/regEditschool/<?= $sc['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                          </td>
                        </tr>
                        <?php $x++; endforeach ?>
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
                        <h5 class="card-title text-primary">Edit Students' School Attended</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/regSaveschool" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id" value="<?php if (isset($sch['id'])) {echo $sch['id'];}?>">
             
                                    <label for="grade">Grade/Year:</label>
                                        <select class="form-control" name="grade" id="grade">
                                        <option value="">Select Grade</option>
                                        <option value="Pre-School (Kinder)">Pre-School (Kinder)</option>
                                        <option value="Grade School (G1-G3)">Grade School (G1-G3)</option>
                                        <option value="Grade School (G4-G6)">Grade School (G4-G6)</option>
                                        <option value="Junior High School (G7-G10)">Junior High School (G7-G10)</option>
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
<?php $y = 1; foreach ($paginatedSchool as $sc): ?>
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
