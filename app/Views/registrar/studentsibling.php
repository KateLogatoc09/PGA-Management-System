<?php
// Pagination Configuration
$totalRecords = count($sibling);
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
                    <h3 class="card-title">Students' Siblings List</h3>
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchSibling" method="Get">
                      <div class="input-group-append">
                        <input type="text" name="table_search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                          <option value="student_id">Student's ID Number</option>
                          <option value="Student">Student's Name</option>
                          <option value="fullname">Sibling's Fullname</option>
                          <option value="yr_lvl">Sibling's Year Level</option>
                          <option value="affiliation">Sibling's Affiliation</option>
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
                          <th>Sibling's Fullname</th>
                          <th>Sibling's Year Level</th>
                          <th>Sibling's Affiliation</th>
                          <th>Account Id</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Paginate Data
                        $offset = ($currentPage - 1) * $recordsPerPage;
                        $paginatedSibling = array_slice($sibling, $offset, $recordsPerPage);
                        $x = 1;
                        foreach ($paginatedSibling as $si):
                        ?>
                        <tr>
                          <td><?= $si['student_id'] ?></td>
                          <td><?= $si['last_name'] ?>, <?= $si['first_name'] ?> <?= $si['middle_name'] ?></td>
                          <td><?= $si['fullname'] ?></td>
                          <td><?= $si['yr_lvl'] ?></td>
                          <td><?= $si['affiliation'] ?></td>
                          <td><?= $si['account_id'] ?></td>
                          <td>
                            <a href="/regDeletesibling/<?= $si['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                            <a href="/regEditsibling/<?= $si['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
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
                        <h5 class="card-title text-primary">Edit Students' Sibling</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/regSavesibling" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id" value="<?php if (isset($sib['id'])) {echo $sib['id'];}?>">
                    
                                        <label for="fullname">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name"
                                        value="<?php if (isset($sib['fullname'])) {echo $sib['fullname'];}?>">
                                 
                                        <label for="yr_lvl">Year Level:</label>
                                        <select class="form-control" name="yr_lvl" id="yr_lvl">
                                            <option value="" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "") { echo "selected"; }} ?>>Select Year Level</option>
                                            <option value="Kinder 1" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Kinder 1") { echo "selected"; }} ?>>Kinder 1</option>
                                            <option value="Kinder 2" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Kinder 2") { echo "selected"; }} ?>>Kinder 2</option>
                                            <option value="Grade 1" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 1") { echo "selected"; }} ?>>Grade 1</option>
                                            <option value="Grade 2" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 2") { echo "selected"; }} ?>>Grade 2</option>
                                            <option value="Grade 3" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 3") { echo "selected"; }} ?>>Grade 3</option>
                                            <option value="Grade 4" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 4") { echo "selected"; }} ?>>Grade 4</option>
                                            <option value="Grade 5" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 5") { echo "selected"; }} ?>>Grade 5</option>
                                            <option value="Grade 6" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 6") { echo "selected"; }} ?>>Grade 6</option>
                                            <option value="Grade 7" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 7") { echo "selected"; }} ?>>Grade 7</option>
                                            <option value="Grade 8" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 8") { echo "selected"; }} ?>>Grade 8</option>
                                            <option value="Grade 9" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 9") { echo "selected"; }} ?>>Grade 9</option>
                                            <option value="Grade 10" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 10") { echo "selected"; }} ?>>Grade 10</option>
                                            <option value="Grade 11" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 11") { echo "selected"; }} ?>>Grade 11</option>
                                            <option value="Grade 12" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 12") { echo "selected"; }} ?>>Grade 12</option>
                                            
                                        </select>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
  <label for="affiliation">Affiliation:</label>
                                        <input type="text" class="form-control" name="affiliation" placeholder="Enter Affiliation"
                                        value="<?php if (isset($sib['affiliation'])) {echo $sib['affiliation'];}?>">
                                 
               
                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($sib['account_id'])) {echo $sib['account_id'];}?>" required>             
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
<?php $y = 1; foreach ($paginatedSibling as $si): ?>
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