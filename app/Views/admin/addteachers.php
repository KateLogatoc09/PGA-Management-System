<?php
$config    = new \Config\Encryption(); 
$encrypter = \Config\Services::encrypter($config);
?>
<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('admin/nav') ?>
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
                            <h3 class="card-title">Teacher List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchTeacher" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                              <option value="idnum">Teacher's ID</option>
                              <option value="Teacher">Teacher's Name</option>
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
                                        <th>ID Number</th>
                                        <th>Last Name</th>
                                        <th>Firt Name</th>
                                        <th>Middle Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Account ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Pagination Logic -->
                                <?php
                                // Define the number of records per page
                                $recordsPerPage = 5;

                                // Calculate the total number of pages
                                $totalPages = ceil(count($teacher) / $recordsPerPage);

                                // Get the current page number from the query string, default to 1 if not set
                                $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

                                // Calculate the offset for the subset of records to be displayed on the current page
                                $offset = ($currentPage - 1) * $recordsPerPage;

                                // Get a subset of records for the current page
                                $teacherSubset = array_slice($teacher, $offset, $recordsPerPage);
                                ?>

                                <!-- Display Teacher List -->
                                <?php $x = 1; foreach ($teacherSubset as $teach): ?>
                                    <tr>
                                            <td><?= $teach['idnum'] ?></td>
                                            <td><?= $teach['lname'] ?>,</td>
                                            <td><?= $teach['fname'] ?></td>
                                            <td><?= $teach['mname'] ?></td>
                                            <td><?= $teach['age'] ?></td>
                                            <td><?= $teach['gender'] ?></td>
                                            <td><?= $teach['dob'] ?></td>
                                            <td><?= $teach['address'] ?></td>
                                            <td><?= $teach['phone'] ?></td>
                                            <td><?= $teach['account_id'] ?></td>
                                            <td> <a href="/deleteteacher/<?php echo bin2hex($encrypter->encrypt($teach['id'])); ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/editteacher/<?php echo bin2hex($encrypter->encrypt($teach['id'])); ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Edit Teacher</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveteacher" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($prof['id'])) {echo $prof['id'];}?>">
                        <label for="idnum">ID number:</label>
                        <input type="text" class="form-control" name="idnum" placeholder="Enter ID number" 
                        value="<?php if (isset($prof['idnum'])) {echo $prof['idnum'];}?>" required>
                                 
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" name="fname" placeholder="Enter First Name"
                        value="<?php if (isset($prof['fname'])) {echo $prof['fname'];}?>" required>

                        <label for="mname">Middle Name:</label>
                        <input type="text" class="form-control" name="mname" placeholder="Enter Middle Name" 
                        value="<?php if (isset($prof['mname'])) {echo $prof['mname'];}?>" required>

                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" 
                        value="<?php if (isset($prof['lname'])) {echo $prof['lname'];}?>" required>
                           
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" name="age" placeholder="Enter Age" 
                        value="<?php if (isset($prof['age'])) {echo $prof['age'];}?>" required>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                        <label for="gender">Gender:</label>
                        <select class="form-control" name="gender" id="gender" 
                                        value="<?php if (isset($prof['gender'])) {echo $prof['gender'];}?>">
                                        <option value="">Select Gender</option>  
                                        <option value="Male" <?php if(isset($prof["gender"])) { if($prof["gender"] == "Male") { echo "selected"; }} ?>>Male</option>  
                                        <option value="Female" <?php if(isset($prof["gender"])) { if($prof["gender"] == "Female") { echo "selected"; }} ?>>Female</option>  
                                        </select>
                                 
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth" 
                        value="<?php if (isset($prof['dob'])) {echo $prof['dob'];}?>" required>    

                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter Address" 
                        value="<?php if (isset($prof['address'])) {echo $prof['address'];}?>" required>  

                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone" 
                        value="<?php if (isset($prof['phone'])) {echo $prof['phone'];}?>" required> 
                        
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
  <?php $y = 1; foreach ($teacherSubset as $teach): ?>
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
