<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session();
$config    = new \Config\Encryption(); 
$encrypter = \Config\Services::encrypter($config);?>
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
                            <h3 class="card-title">Parents List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchParentchild" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                          <option value="fullname">Parent</option>
                          <option value="child_id">Child/Student Id</option>
                          <option value="Student">Child's Fullname</option>
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
                                        <th>Parent</th>
                                        <th>Child/Student Id</th>
                                        <th>Child's Fullname</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Pagination Logic -->
                                <?php
                                // Define the number of records per page
                                $recordsPerPage = 5;

                                // Calculate the total number of pages
                                $totalPages = ceil(count($table) / $recordsPerPage);

                                // Get the current page number from the query string, default to 1 if not set
                                $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

                                // Calculate the offset for the subset of records to be displayed on the current page
                                $offset = ($currentPage - 1) * $recordsPerPage;

                                // Get a subset of records to display based on the current page and records per page
                                $subset = array_slice($table, $offset, $recordsPerPage);

                                // Loop through the subset of records to display
                                $x = 1;
                                foreach ($subset as $t) :
                                ?>
                                    <tr>
                                            <td><?= $t['fullname'] ?></td>
                                            <td><?= $t['child_id'] ?></td>
                                            <td><?= $t['first_name'] ?> <?= $t['middle_name'] ?> <?= $t['last_name'] ?></td>
                                            <td> <a href="/deleteParentacc/<?php echo bin2hex($encrypter->encrypt($t['id'])); ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/editParentacc/<?php echo bin2hex($encrypter->encrypt($t['id'])); ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Save/Edit Parent</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveParentacc" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($par['id'])) {echo $par['id'];}?>">
                        <label for="student_id">Child/Student Id:</label>
                        <input type="text" class="form-control" name="student_id" placeholder="Enter Child/Student Id" 
                        value="<?php if (isset($par['child_id'])) {echo $par['child_id'];}?>" list="list" required>
                        <datalist type="hidden" id="list">
                                            <?php foreach ($student as $sa):?> 
                                                <option value="<?= $sa['student_id'] ?>"><?= $sa['first_name'] ?> <?= $sa['middle_name'] ?> <?= $sa['last_name'] ?></option>
                                            <?php endforeach; ?>
                                        </datalist> 
                                        
                                      
</div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                        <label for="parent_id">Parent Account ID:</label>
                        <input type="text" class="form-control" name="parent_id" placeholder="Parent Id" 
                        value="<?php if (isset($par['parent_id'])) {echo $par['parent_id'];}?>" list="list2" required>
                        <datalist type="hidden" id="list2">
                                            <?php foreach ($parent as $pa):?> 
                                                <option value="<?= $pa['id'] ?>"><?= $pa['fullname'] ?></option>
                                            <?php endforeach; ?>
                                        </datalist> 
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
<script>
  <?php $y = 1; foreach ($subset as $t): ?>
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
</html>
