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

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
            <h1 class="center white">Student Information</h1> 
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">

                      <div class="content-wrapper">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary"><?php if (isset($learn['first_name'])) {echo $learn['first_name'];}?>
                        <?php if (isset($learn['middle_name'])) {echo $learn['middle_name'];}?>
                        <?php if (isset($learn['last_name'])) {echo $learn['last_name'];}?></h5>
                        <br>
                        <h7 class="orange">Student ID:</h7>
                        <?php if (isset($ad['student_id'])) {echo $ad['student_id'];}?>
                        <br>
                        <h7 class="orange">Full Name:</h7>
                        <?php if (isset($learn['first_name'])) {echo $learn['first_name'];}?>
                        <?php if (isset($learn['middle_name'])) {echo $learn['middle_name'];}?>
                        <?php if (isset($learn['last_name'])) {echo $learn['last_name'];}?>
                        <br>
                        <h7 class="orange">Nickname:</h7>
                        <?php if (isset($learn['nickname'])) {echo $learn['nickname'];}?>
                        <br>
                        <h7 class="orange">Age:</h7>
                        <?php if (isset($learn['age'])) {echo $learn['age'];}?>
                        <br>
                        <h7 class="orange">Year Level:</h7>
                        <?php if (isset($ad['yr_lvl'])) {echo $ad['yr_lvl'];}?>
                        <br>
                        <h7 class="orange">Section:</h7>
                        <?php if (isset($ad['name'])) {echo $ad['name'];}?>
                        <br>
                        <h7 class="orange">Adviser:</h7>
                        <?php if (isset($ad['fname'])) {echo $ad['fname'];}?>
                        <?php if (isset($ad['mname'])) {echo $ad['mname'];}?>
                        <?php if (isset($ad['lname'])) {echo $ad['lname'];}?>
                        <br>
                        <h7 class="orange">Program:</h7>
                        <?php if (isset($ad['program'])) {echo $ad['program'];}?>
                        <br>
                      
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <h7 class="orange">Gender:</h7>
                        <?php if (isset($learn['gender'])) {echo $learn['gender'];}?>
                        <br>
                        <h7 class="orange">Birthdate:</h7>
                        <?php if (isset($learn['birthdate'])) {echo $learn['birthdate'];}?>
                        <br>
                      <h7 class="orange">Birthplace:</h7>
                        <?php if (isset($learn['birthplace'])) {echo $learn['birthplace'];}?>
                        <br>  
                        <h7 class="orange">Marital Status:</h7>
                        <?php if (isset($learn['marital_status'])) {echo $learn['marital_status'];}?>
                        <br>
                        <h7 class="orange">Mobile Number:</h7>
                        <?php if (isset($learn['mobile_num'])) {echo $learn['mobile_num'];}?>
                        <br>
                        <h7 class="orange">Nationality:</h7>
                        <?php if (isset($learn['nationality'])) {echo $learn['nationality'];}?>
                        <br>
                        <h7 class="orange">Religion:</h7>
                        <?php if (isset($learn['religion'])) {echo $learn['religion'];}?>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-18 my-4 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Address/s</h5>
                        <br>
                        <?php foreach ($address as $a): ?>
                          <h7 class="orange"><?= $a['type'] ?> Address:</h7>
                          <?= $a['street'] ?>, <?= $a['barangay'] ?>, <?= $a['municipality'] ?>, <?= $a['province'] ?>, <?= $a['region'] ?>
                        <br>
                        <h7 class="orange">Postal Code:</h7>
                        <?= $a['postal_code'] ?>
                        <br>
                        <h7 class="orange">Telephone Number:</h7>
                        <?= $a['tel_num'] ?>
                        <br>
                      </div>

                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <?php endforeach ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-18 mb-1 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Parents/Guardian</h5>
                        <br>
                        <?php foreach ($fam as $f): ?>
                        <h7 class="orange"><?= $f['relation'] ?>:</h7>
                        <?= $f['fullname'] ?>
                        <br>
                        <h7 class="orange">Residential Address:</h7>
                        <?= $f['res_add'] ?>
                        <br>
                        <h7 class="orange">Mobile Number:</h7>
                        <?= $f['mob_num'] ?>
                        <br>
                        <h7 class="orange">Office Address:</h7>
                        <?= $f['off_add'] ?>
                        <br>
                        <h7 class="orange">Office Number:</h7>
                        <?= $f['off_num'] ?>
                        <br>
                        <h7 class="orange">Email:</h7>
                        <?= $f['email'] ?>
                        <br>
                        <h7 class="orange">Occupation:</h7>
                        <?= $f['occupation'] ?>
                        <br>
                      </div>

                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <?php endforeach ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
              
                    </div>
                    <!-- /.card -->
                </div> <!-- /.dito -->

              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Grades List</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Subject Type</th>
                            <th>Grade</th>
                            <th>Quarter</th>
                            <th>Subject Teacher</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
// Pagination Configuration
$totalRecords = count($grade);
$recordsPerPage = 5;
$totalPages = ceil($totalRecords / $recordsPerPage);

// Current Page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
?>
                        <?php
                        // Paginate the results
                        $start = ($currentPage - 1) * $recordsPerPage;
                        $end = $start + $recordsPerPage;
                        $paginatedGrade = array_slice($grade, $start, $recordsPerPage);
                        
                        foreach ($paginatedGrade as $g):
                        ?>
                        <tr>
                            <td><?= $g['subject_name'] ?></td>
                            <td><?= $g['type'] ?></td>
                            <td><?= $g['grade'] ?></td>
                            <td><?= $g['quarter'] ?></td>
                            <td><?= $g['fname']?> <?= $g['mname']?> <?= $g['lname']?></td>
                        </tr>
                        <?php endforeach ?>
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
              <center><a href="/advisoryClass" class="btn btn-primary">Back</a><center>
              <!-- /.card -->
            </div> <!-- /.dito -->

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
</body>

</html>
