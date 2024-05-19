<?php
// Define the number of records per page
$recordsPerPage = 5;

// Calculate the total number of pages
$totalPages = ceil(count($subject) / $recordsPerPage);

// Get the current page number from the query string, default to 1 if not set
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Get a subset of records for the current page
$subjectSubset = array_slice($subject, $offset, $recordsPerPage);
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
                            <h3 class="card-title">Subject List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchSubject" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                              <option value="subject_name">Subject Name</option>
                              <option value="type">Type of Subject</option>
                              <option value="yr_lvl">Grade Level</option>
                              <option value="Teacher">Teacher</option>
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
                                        <th>Subject Name</th>
                                        <th>Type of Subject</th>
                                        <th>Grade Level</th> 
                                        <th>Subject Teacher</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $x = 1; foreach ($subjectSubset as $ad): ?>
                                    <tr>
                                            <td><?= $ad['subject_name'] ?></td>
                                            <td><?= $ad['type'] ?></td>
                                            <td><?= $ad['yr_lvl'] ?></td>
                                            <td><?= $ad['lname'] ?>, <?= $ad['fname'] ?> <?= $ad['mname'] ?></td>
                                            <td> <a href="/deleteSubject/<?= $ad['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/editSubject/<?= $ad['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Edit Subject</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveSubject" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">

                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($sub['id'])) {echo $sub['id'];}?>">

                                        <label for="subject_name">Subject Name:</label>
                                        <input type="text" class="form-control" name="subject_name" placeholder="Enter Subject Name"
                                        value="<?php if (isset($sub['subject_name'])) {echo $sub['subject_name'];}?>">

                                        <label for="type">Type of Subject:</label>
                                        <select class="form-control" name="type" id="Type of Subject">
                                        <option value="" <?php if(isset($sub["type"])) { if($sub["type"] == "") { echo "selected"; }} ?>>Select Subject Type</option>
                                          <option value="Core Subject" <?php if(isset($sub["type"])) { if($sub["type"] == "Core Subject") { echo "selected"; }} ?>>Core Subject</option>
                                            <option value="Applied Subject" <?php if(isset($sub["type"])) { if($sub["type"] == "Applied Subject") { echo "selected"; }} ?>>Applied Subject</option>
                                            <option value="Specialized Subject" <?php if(isset($sub["type"])) { if($sub["type"] == "Specialized Subject") { echo "selected"; }} ?>>Specialized Subject</option>
                                           
                                        </select>

                                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
  <label for="teacher_id">Subject Teacher:</label>
                        <input type="text" class="form-control" name="teacher_id" placeholder="Enter Subject Teacher" 
                        value="<?php if (isset($sub['teacher_id'])) {echo $sub['teacher_id'];}?>" list="list" required>
                        <datalist type="hidden" id="list">
                                            <?php foreach ($teacher as $te):?> 
                                                <option value="<?= $te['idnum'] ?>"><?= $te['fname'] ?> <?= $te['mname'] ?> <?= $te['lname'] ?></option>
                                            <?php endforeach; ?>
                                        </datalist> 

                                        <label for="yr_lvl">Grade Level:</label>
                                        <input type="text" class="form-control" name="yr_lvl" placeholder="Enter Grade Level" 
                                        value="<?php if (isset($sub['yr_lvl'])) {echo $sub['yr_lvl'];}?>" required>  
                      
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
<?php $y = 1; foreach ($subjectSubset as $ad): ?>
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
