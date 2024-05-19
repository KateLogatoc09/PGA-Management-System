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
                            <h3 class="card-title">Learner Information List</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 400px;">
                                  <form action="/searchLearner" method="Get">
                                    <div class="input-group-append">
                                    <input type="text" name="table_search" class="form-control float-right me-2" placeholder="Search">
                                    <select class="form-control" name="categ">
                                        <option value="student_id">Student Id</option>
                                        <option value="first_name">First Name</option>
                                        <option value="middle_name">Middle Name</option>
                                        <option value="last_name">Last Name</option>
                                        <option value="nickname">Nickname</option>
                                        <option value="age">Age</option>
                                        <option value="gender">Gender</option>
                                        <option value="birthdate">Birthdate</option>
                                        <option value="birthplace">Birthplace</option>
                                        <option value="marital_status">Marital Status</option>
                                        <option value="email">Email</option>
                                        <option value="mobile_num">Mobile Number</option>
                                        <option value="nationality">Nationality</option>
                                        <option value="religion">Religion</option>
                                        <option value="yr_lvl">Year Level</option>
                                        <option value="name">Section</option>
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
                                        <th>Photo</th>
                                        <th>Student Id</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Nickname</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Birthdate</th>
                                        <th>Birthplace</th>
                                        <th>Marital Status</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Nationality</th>
                                        <th>Religion</th>
                                        <th>Year Level</th>
                                        <th>Section</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Pagination Logic -->
                                <?php
                                $recordsPerPage = 5;
                                $totalPages = ceil(count($learner) / $recordsPerPage);
                                $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                                $offset = ($currentPage - 1) * $recordsPerPage;
                                $subset = array_slice($learner, $offset, $recordsPerPage);
                                $x = 1;
                                foreach ($subset as $le) :
                                ?>
                                    <tr>
                                            <td><img
                                            src="<?= base_url().$le['photo'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="p<?=$x?>"
                                            onclick="openFullscreenp<?=$x?>();"
                                            /></td>
                                            <td><?= $le['student_id'] ?></td>
                                            <td><?= $le['first_name'] ?></td>
                                            <td><?= $le['middle_name'] ?></td>
                                            <td><?= $le['last_name'] ?></td>
                                            <td><?= $le['nickname'] ?></td>
                                            <td><?= $le['age'] ?></td>
                                            <td><?= $le['gender'] ?></td>
                                            <td><?= $le['birthdate'] ?></td>
                                            <td><?= $le['birthplace'] ?></td>
                                            <td><?= $le['marital_status'] ?></td>
                                            <td><?= $le['email'] ?></td>
                                            <td><?= $le['mobile_num'] ?></td>
                                            <td><?= $le['nationality'] ?></td>
                                            <td><?= $le['religion'] ?></td>
                                            <td><?= $le['yr_lvl'] ?></td>
                                            <td><?= $le['name'] ?></td>
                                            <td> <a href="/regDeleteLearner/<?= $le['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/regEditLearner/<?= $le['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Edit Learner</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                    <form action="/regSaveLearner" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($learn['id'])) {echo $learn['id'];}?>">
                                        <center>
                                        <?php if(isset($learn['photo'])): ?>
                                            <img
                                            src="<?= $learn['photo'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="uploadedAvatar"
                                            />
                                        <?php else: ?>
                                            <img
                                            src="<?= base_url() ?>img/user-1.jpg"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="uploadedAvatar"
                                            />
                                        <?php endif; ?>
                                    <div class="button-wrapper my-4">
                                    <label for="upload" class="btn btn-primary mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input
                                        type="file"
                                        id="upload"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                        name="photo"
                                        />
                                    </label>
                                    </div>
                                    </center>
                          
                                    <label for="first_name">First Name:</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name"
                                        value="<?php if (isset($learn['first_name'])) {echo $learn['first_name'];}?>">
                        
                                    <label for="middle_name">Middle Name:</label>
                                        <input type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name"
                                        value="<?php if (isset($learn['middle_name'])) {echo $learn['middle_name'];}?>">
                        
                                    <label for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name"
                                        value="<?php if (isset($learn['last_name'])) {echo $learn['last_name'];}?>">
                      
                                    <label for="nickname">Nickname:</label>
                                        <input type="text" class="form-control" name="nickname" placeholder="Enter Nickname"
                                        value="<?php if (isset($learn['nickname'])) {echo $learn['nickname'];}?>">
                            
                                    <label for="age">Age:</label>
                                        <input type="number" class="form-control" name="age" placeholder="Enter Age"
                                        value="<?php if (isset($learn['age'])) {echo $learn['age'];}?>">
                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
  <label for="gender">Gender:</label>
                                        <select class="form-control" name="gender" id="gender" 
                                        value="<?php if (isset($learn['gender'])) {echo $learn['gender'];}?>">
                                        <option value="" <?php if(isset($learn["gender"])) { if($learn["gender"] == "") { echo "selected"; }} ?>>Select Gender</option>  
                                        <option value="Male" <?php if(isset($learn["gender"])) { if($learn["gender"] == "Male") { echo "selected"; }} ?>>Male</option>  
                                        <option value="Female" <?php if(isset($learn["gender"])) { if($learn["gender"] == "Female") { echo "selected"; }} ?>>Female</option>  
                                        </select>
                        
                                        <label for="marital_status">Marital Status:</label>
                                            <select class="form-control" name="marital_status" id="marital_status"
                                            value="<?php if (isset($learn['marital_status'])) {echo $learn['marital_status'];}?>">
                                            <option value="" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "") { echo "selected"; }} ?>>Select Marital Status</option>  
                                            <option value="Single" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "Single") { echo "selected"; }} ?>>Single</option>  
                                            <option value="Married" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "Married") { echo "selected"; }} ?>>Married</option>  
                                            <option value="Separated" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "Separated") { echo "selected"; }} ?>>Separated</option>  
                                            <option value="Widow" <?php if(isset($learn["marital_status"])) { if($learn["marital_status"] == "Widow") { echo "selected"; }} ?>>Widow</option>  
                                        
                                        </select>
  <label for="birthdate">Birthdate:</label>
                                        <input type="date" class="form-control" name="birthdate" placeholder="Enter Birthdate"
                                        value="<?php if (isset($learn['birthdate'])) {echo $learn['birthdate'];}?>">
                            
                                    <label for="birthplace">Birthplace:</label>
                                        <input type="text" class="form-control" name="birthplace" placeholder="Enter Birthplace"
                                        value="<?php if (isset($learn['birthplace'])) {echo $learn['birthplace'];}?>">

                            
                                    <label for="last_name">Mobile Number:</label>
                                        <input type="number" class="form-control" name="mobile_num" max_length="11" placeholder="Enter Mobile Number"
                                        value="<?php if (isset($learn['mobile_num'])) {echo $learn['mobile_num'];}?>">
                        
                            
                                    <label for="last_name">Nationality:</label>
                                        <input type="text" class="form-control" name="nationality" placeholder="Enter Nationality"
                                        value="<?php if (isset($learn['nationality'])) {echo $learn['nationality'];}?>">
                            
                                    <label for="last_name">Religion:</label>
                                        <input type="text" class="form-control" name="religion" placeholder="Enter Religion"
                                        value="<?php if (isset($learn['religion'])) {echo $learn['religion'];}?>">
                        
                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($learn['account_id'])) {echo $learn['account_id'];}?>" required> 
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
//2x2
const twobytwo = document.getElementById('uploadedAvatar');
    const twobytwoinput = document.getElementById('upload');

    twobytwoinput.addEventListener('change', function(){
    const [file] = twobytwoinput.files
    if (file) {
        twobytwo.src = URL.createObjectURL(file)
    }
    });  

<?php $y = 1; foreach ($subset as $le): ?>

function openFullscreenp<?=$y?>() {
  if (document.getElementById('p<?=$y?>').requestFullscreen) {
    document.getElementById('p<?=$y?>').requestFullscreen();
  } else if (document.getElementById('p<?=$y?>').webkitRequestFullscreen) { /* Safari */
    document.getElementById('p<?=$y?>').webkitRequestFullscreen();
  } else if (document.getElementById('p<?=$y?>').msRequestFullscreen) { /* IE11 */
    document.getElementById('p<?=$y?>').msRequestFullscreen();
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

<?php $y++; endforeach; ?>
</script>
  <script src="assets/js/book.js"></script>
</body>

</html>
