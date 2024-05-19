<?php
// Pagination Configuration
$totalRecords = count($family);
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
                    <h3 class="card-title">Students' Parent List</h3>
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchParent" method="Get">
                      <div class="input-group-append">
                        <input type="text" name="table_search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                          <option value="student_id">Student's ID Number</option>
                          <option value="Student">Student's Name</option>
                          <option value="fullname">Fullname</option>
                          <option value="relation">Relation</option>
                          <option value="res_add">Residential Address</option>
                          <option value="mob_num">Mobile Number</option>
                          <option value="off_add">Office Address</option>
                          <option value="off_num">Office Number</option>
                          <option value="email">Email</option>
                          <option value="occupation">Occupation</option>
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
                          <th>Fullname</th>
                          <th>Relation</th>
                          <th>Residential Address</th>
                          <th>Mobile Number</th>
                          <th>Office Address</th>
                          <th>Office Number</th>
                          <th>Email</th>
                          <th>Occupation</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Paginate Data
                        $offset = ($currentPage - 1) * $recordsPerPage;
                        $paginatedFamily = array_slice($family, $offset, $recordsPerPage);
                        $x = 1;
                        foreach ($paginatedFamily as $fa):
                        ?>
                        <tr>
                          <td><?= $fa['student_id'] ?></td>
                          <td><?= $fa['last_name'] ?>, <?= $fa['first_name'] ?> <?= $fa['middle_name'] ?></td>
                          <td><?= $fa['fullname'] ?></td>
                          <td><?= $fa['relation'] ?></td>
                          <td><?= $fa['res_add'] ?></td>
                          <td><?= $fa['mob_num'] ?></td>
                          <td><?= $fa['off_add'] ?></td>
                          <td><?= $fa['off_num'] ?></td>
                          <td><?= $fa['email'] ?></td>
                          <td><?= $fa['occupation'] ?></td>
                          <td>
                            <a href="/regDeletefamily/<?= $fa['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                            <a href="/regEditfamily/<?= $fa['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
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
                        <h5 class="card-title text-primary">Edit Students's Parent Information</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/regSavefamily" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($fam['id'])) {echo $fam['id'];}?>">
                    <label for="relation">Relationship To Student:</label>
                        <select class="form-control" name="relation" id="relation" 
                        value="<?php if (isset($fam['relation'])) {echo $fam['relation'];}?>">
                        <option value="" <?php if(isset($fam["relation"])) { if($fam["relation"] == "") { echo "selected"; }} ?>>Select Relationship</option>
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
<?php $y = 1; foreach ($paginatedFamily as $si): ?>
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
