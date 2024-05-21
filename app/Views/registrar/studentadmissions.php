<?php
$config    = new \Config\Encryption(); 
$encrypter = \Config\Services::encrypter($config);
// Define the number of records per page
$recordsPerPage = 5;

// Calculate the total number of pages
$totalPages = ceil(count($student) / $recordsPerPage);

// Get the current page number from the query string, default to 1 if not set
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Get a subset of records for the current page
$studentSubset = array_slice($student, $offset, $recordsPerPage);
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
                            <h3 class="card-title">Admission List</h3>
                            <div class="card-tools">
                            <form action="/searchStudAdmission" method="get">
                                <div class="input-group input-group-sm" style="width: 400px;">
                                    <div class="input-group-append">
                                    <input type="text" name="table_search" class="form-control float-right me-2" placeholder="Search">
                                    <select class="form-control" name="categ">
                                        <option value="student_id">Student ID</option>
                                        <option value="first_name">First Name</option>
                                        <option value="middle_name">Middle Name</option>
                                        <option value="last_name">Last Name</option>
                                        <option value="category">Category</option>
                                        <option value="yr_lvl">Year Level</option>
                                        <option value="name">Section</option>
                                        <option value="Adviser">Adviser</option>
                                        <option value="program">Program</option>
                                        <option value="schedule">Schedule Date</option>
                                        <option value="status">Status</option>
                                    </select>
                                    <button type="submit" class="btn btn-default">
                                    <i class="menu-icon tf-icons bx bx-search"></i>
                                    </button>
                                    </div>
                                </div>
                              </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                         <table class="table table-hover text-nowrap">
                    
                            <thead>
                                    <tr>
                                        <th>2x2 ID</th>
                                        <th>Student ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Category</th>
                                        <th>Year Level</th>
                                        <th>Section</th>
                                        <th>Adviser</th>
                                        <th>Program</th>
                                        <th>School Year</th>
                                        <th>Birth Certificate</th>
                                        <th>Report Card</th>
                                        <th>Good Moral</th>
                                        <th>Schedule Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $x = 1; foreach ($studentSubset as $ad): ?>
                                    <tr>
                                            <td><img
                                            src="<?= base_url().$ad['photo'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="p<?=$x?>"
                                            onclick="openFullscreenp<?=$x?>();"
                                            /></td>
                                            <td><?= $ad['student_id'] ?></td>
                                            <td><?= $ad['first_name'] ?></td>
                                            <td><?= $ad['middle_name'] ?></td>
                                            <td><?= $ad['last_name'] ?></td>
                                            <td><?= $ad['category'] ?></td>
                                            <td><?= $ad['yr_lvl'] ?></td>
                                            <td><?= $ad['name'] ?></td>
                                            <td><?= $ad['fname'] ?> <?= $ad['mname'] ?> <?= $ad['lname'] ?></td>
                                            <td><?= $ad['program'] ?></td>
                                            <td><?= $ad['school_year'] ?></td>
                                            <td><img
                                            src="<?= base_url().$ad['birth_cert'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="b<?=$x?>"
                                            onclick="openFullscreenb<?=$x?>();"
                                            /></td>
                                            <td><img
                                            src="<?= base_url().$ad['report_card'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="r<?=$x?>"
                                            onclick="openFullscreenr<?=$x?>();"
                                            /></td>
                                            <td><img
                                            src="<?= base_url().$ad['good_moral'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="g<?=$x?>"
                                            onclick="openFullscreeng<?=$x?>();"
                                            /></td>
                                            <td><?= $ad['schedule'] ?></td>
                                            <td><?= $ad['status'] ?></td>
                                            <td> <a href="/regDeleteadmissions/<?php echo bin2hex($encrypter->encrypt($ad['id'])); ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/regEditadmissions/<?php echo bin2hex($encrypter->encrypt($ad['id'])); ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                                        <option value="">Select Student Category</option>
                                        <option value="Continuing" <?php if(isset($admissions["category"])) { if($admissions["category"] == "Continuing") { echo "selected"; }} ?>>Continuing</option>
                                        <option value="Transferee" <?php if(isset($admissions["category"])) { if($admissions["category"] == "Transferee") { echo "selected"; }} ?>>Transferee</option>
                                        <option value="Returnee" <?php if(isset($admissions["category"])) { if($admissions["category"] == "Returnee") { echo "selected"; }} ?>>Returnee</option>
                                        </select>

                                        <label for="yr_lvl">Year Level:</label>
                                        <select class="form-control" name="yr_lvl" id="yr_lvl">
                                            <option value="">Select Year Level</option>
                                            <option value="Kinder 1" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Kinder 1") { echo "selected"; }} ?>>Kinder 1</option>
                                            <option value="Kinder 2" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Kinder 2") { echo "selected"; }} ?>>Kinder 2</option>
                                            <option value="Grade 1" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 1") { echo "selected"; }} ?>>Grade 1</option>
                                            <option value="Grade 2" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 2") { echo "selected"; }} ?>>Grade 2</option>
                                            <option value="Grade 3" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 3") { echo "selected"; }} ?>>Grade 3</option>
                                            <option value="Grade 4" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 4") { echo "selected"; }} ?>>Grade 4</option>
                                            <option value="Grade 5" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 5") { echo "selected"; }} ?>>Grade 5</option>
                                            <option value="Grade 6" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 6") { echo "selected"; }} ?>>Grade 6</option>
                                            <option value="Grade 7" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 7") { echo "selected"; }} ?>>Grade 7</option>
                                            <option value="Grade 8" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 8") { echo "selected"; }} ?>>Grade 8</option>
                                            <option value="Grade 9" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 9") { echo "selected"; }} ?>>Grade 9</option>
                                            <option value="Grade 10" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 10") { echo "selected"; }} ?>>Grade 10</option>
                                            <option value="Grade 11" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 11") { echo "selected"; }} ?>>Grade 11</option>
                                            <option value="Grade 12" <?php if(isset($admissions["yr_lvl"])) { if($admissions["yr_lvl"] == "Grade 12") { echo "selected"; }} ?>>Grade 12</option>
                                            
                                        </select>

                                        <label for="section">Section:</label>
                                        <select name="section" id="section" class="form-control">
                                        <option value="">Select Section</option>
                                            <?php foreach ($stud_section as $se):?> 
                                                <option value="<?= $se['id'] ?>" <?php if(isset($admissions["section"])) { if($admissions["section"] == $se['id']) { echo "selected"; }} ?>><?= $se['name'] ?></option> 
                                            <?php endforeach; ?>
                                        </select> 

                                        <label for="program">Strand/Program:</label>
                                        <select class="form-control" name="program" id="program">
                                        <option value="">Select Program</option>
                                        <option value="None" <?php if(isset($admissions["program"])) { if($admissions["program"] == "None") { echo "selected"; }} ?>>None</option>    
                                        <option value="STEM" <?php if(isset($admissions["program"])) { if($admissions["program"] == "STEM") { echo "selected"; }} ?>>STEM</option>    
                                        <option value="ABM" <?php if(isset($admissions["program"])) { if($admissions["program"] == "ABM") { echo "selected"; }} ?>>ABM</option>    
                                        <option value="HUMMS" <?php if(isset($admissions["program"])) { if($admissions["program"] == "HUMMS") { echo "selected"; }} ?>>HUMMS</option>    

                                        </select>

                                        <label for="school_year">School Year:</label>
                                        <input type="text" class="form-control" name="school_year" placeholder="Enter School Year" 
                                        value="<?php if (isset($admissions['school_year'])) {echo $admissions['school_year'];}?>" required>  

                                        <label for="schedule">Schedule Date:</label>
                                        <input type="date" class="form-control" name="schedule" placeholder="Enter Schedule Date" 
                                        value="<?php if (isset($admissions['schedule'])) {echo $admissions['schedule'];}?>" required>  

                                        <label for="status">Status:</label>
                                        <select class="form-control" name="status" id="status">
                                        <option value="">Select Status</option>    
                                        <option value="PENDING" <?php if(isset($admissions["status"])) { if($admissions["status"] == "PENDING") { echo "selected"; }} ?>>Pending</option>    
                                        <option value="ON PROCESS" <?php if(isset($admissions["status"])) { if($admissions["status"] == "ON PROCESS") { echo "selected"; }} ?>>On Process</option>    
                                        <option value="ENROLLED" <?php if(isset($admissions["status"])) { if($admissions["status"] == "ENROLLED") { echo "selected"; }} ?>>Enrolled</option>    
                                        <option value="REJECTED" <?php if(isset($admissions["status"])) { if($admissions["status"] == "REJECTED") { echo "selected"; }} ?>>Rejected</option>    
                                        <option value="GRADUATED" <?php if(isset($admissions["status"])) { if($admissions["status"] == "GRADUATED") { echo "selected"; }} ?>>Graduated</option>    

                                        </select>

                                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
    <center>
                                        
                                        <label><strong>2x2 ID:</strong></label>
                                        <?php if(isset($admissions['photo'])): ?>
                                            <img
                                            src="<?= $admissions['photo']?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="twobytwoimg"
                                            />
                                        <?php else: ?>
                                            <img
                                            src="<?= base_url() ?>img/placeholder.jpg"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="twobytwoimg"
                                            />
                                        <?php endif; ?>

                                        <div class="button-wrapper my-4">
                                      <label for="twobytwo" class="btn btn-primary mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input
                                        type="file"
                                        id="twobytwo"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                        name="twobytwo"
                                        />
                                    </label>
                                    </div>

                                    <label><strong>Birth Certificate:</strong></label>
                                    <?php if(isset($admissions['birth_cert'])): ?>
                                            <img
                                            src="<?= $admissions['birth_cert']?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="birth_certimg"
                                            />
                                        <?php else: ?>
                                            <img
                                            src="<?= base_url() ?>img/placeholder.jpg"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="birth_certimg"
                                            />
                                        <?php endif; ?>

                                        <div class="button-wrapper my-4">
                                      <label for="birth_cert" class="btn btn-primary mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input
                                        type="file"
                                        id="birth_cert"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                        name="birth_cert"
                                        />
                                    </label>
                                    </div>

                                    <label><strong>Report Card:</strong></label>
                                    <?php if(isset($admissions['report_card'])): ?>
                                            <img
                                            src="<?= $admissions['report_card']?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="report_cardimg"
                                            />
                                        <?php else: ?>
                                            <img
                                            src="<?= base_url() ?>img/placeholder.jpg"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="report_cardimg"
                                            />
                                        <?php endif; ?>

                                        <div class="button-wrapper my-4">
                                      <label for="report_card" class="btn btn-primary mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input
                                        type="file"
                                        id="report_card"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                        name="report_card"
                                        />
                                    </label>
                                    </div>

                                    <label><strong>Good Moral:</strong></label>
                                    <?php if(isset($admissions['good_moral'])): ?>
                                            <img
                                            src="<?= $admissions['good_moral']?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="good_moralimg"
                                            />
                                        <?php else: ?>
                                            <img
                                            src="<?= base_url() ?>img/placeholder.jpg"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="good_moralimg"
                                            />
                                        <?php endif; ?>

                                        <div class="button-wrapper my-4">
                                      <label for="good_moral" class="btn btn-primary mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input
                                        type="file"
                                        id="good_moral"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                        name="good_moral"
                                        />
                                    </label>
                                    </div>

                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($admissions['account_id'])) {echo $admissions['account_id'];}?>" required> 
    </center>
                                 
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
  <script>
    //2x2
    const twobytwo = document.getElementById('twobytwoimg');
    const twobytwoinput = document.getElementById('twobytwo');

    twobytwoinput.addEventListener('change', function(){
    const [file] = twobytwoinput.files
    if (file) {
        twobytwo.src = URL.createObjectURL(file)
    }
    });
    //birth
    const birth = document.getElementById('birth_certimg');
    const birthinput = document.getElementById('birth_cert');

    birthinput.addEventListener('change', function(){
    const [file] = birthinput.files
    if (file) {
        birth.src = URL.createObjectURL(file)
    }
    });
    //report
    const report = document.getElementById('report_cardimg');
    const reportinput = document.getElementById('report_card');

    reportinput.addEventListener('change', function(){
    const [file] = reportinput.files
    if (file) {
        report.src = URL.createObjectURL(file)
    }
    });
    //goodmoral 
    const gmoral = document.getElementById('good_moralimg');
    const gmoralinput = document.getElementById('good_moral');

    gmoralinput.addEventListener('change', function(){
    const [file] = gmoralinput.files
    if (file) {
        gmoral.src = URL.createObjectURL(file)
    }
    });


    <?php $y = 1; foreach ($studentSubset as $add): ?>

      function openFullscreenp<?=$y?>() {
        if (document.getElementById('p<?=$y?>').requestFullscreen) {
          document.getElementById('p<?=$y?>').requestFullscreen();
        } else if (document.getElementById('p<?=$y?>').webkitRequestFullscreen) { /* Safari */
          document.getElementById('p<?=$y?>').webkitRequestFullscreen();
        } else if (document.getElementById('p<?=$y?>').msRequestFullscreen) { /* IE11 */
          document.getElementById('p<?=$y?>').msRequestFullscreen();
        }
      }

      function openFullscreenb<?=$y?>() {
        if (document.getElementById('b<?=$y?>').requestFullscreen) {
          document.getElementById('b<?=$y?>').requestFullscreen();
        } else if (document.getElementById('b<?=$y?>').webkitRequestFullscreen) { /* Safari */
          document.getElementById('b<?=$y?>').webkitRequestFullscreen();
        } else if (document.getElementById('b<?=$y?>').msRequestFullscreen) { /* IE11 */
          document.getElementById('b<?=$y?>').msRequestFullscreen();
        }
      }

      function openFullscreenr<?=$y?>() {
        if (document.getElementById('r<?=$y?>').requestFullscreen) {
          document.getElementById('r<?=$y?>').requestFullscreen();
        } else if (document.getElementById('r<?=$y?>').webkitRequestFullscreen) { /* Safari */
          document.getElementById('r<?=$y?>').webkitRequestFullscreen();
        } else if (document.getElementById('r<?=$y?>').msRequestFullscreen) { /* IE11 */
          document.getElementById('r<?=$y?>').msRequestFullscreen();
        }
      }

      function openFullscreeng<?=$y?>() {
        if (document.getElementById('g<?=$y?>').requestFullscreen) {
          document.getElementById('g<?=$y?>').requestFullscreen();
        } else if (document.getElementById('g<?=$y?>').webkitRequestFullscreen) { /* Safari */
          document.getElementById('g<?=$y?>').webkitRequestFullscreen();
        } else if (document.getElementById('g<?=$y?>').msRequestFullscreen) { /* IE11 */
          document.getElementById('g<?=$y?>').msRequestFullscreen();
        }
      }

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
    <?php $y++; endforeach ?>
  </script>
</body>

</html>
