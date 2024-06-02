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
        <?= $this->include('student/nav') ?>
        <?= $this->include('student/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->

          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
            <h1 class="center white">Student Profile</h1> 
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <?php if(is_array($status)): ?>
                <?php if(implode($status) == 'ENROLLED'): ?>
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
                        <?php if(isset($_SESSION['qr'])): ?>
                        <?php echo '<br>'; echo $_SESSION['qr'];  endif;?>
                        <hr>
                        <form action="/generate" method="post">
                        <button type="submit" class="btn btn-primary">Generate</button>
                        </form>
                        <br>
                        <h7 class="orange">Nickname:</h7>
                        <?php if (isset($learn['nickname'])) {echo $learn['nickname'];}?>
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
                        <h7 class="orange">Specialization:</h7>
                        <?php if (isset($ad['specialization'])) {echo $ad['specialization'];}?>
                        <br>
                        <h7 class="orange">School Year:</h7>
                        <?php if (isset($ad['school_year'])) {echo $ad['school_year'];}?>
                        <br>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <h7 class="orange">Age:</h7>
                        <?php if (isset($learn['age'])) {echo $learn['age'];}?>
                        <br>
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
                  <a href="/editlearner/<?php echo bin2hex($encrypter->encrypt($learn['id'])); ?>" class="btn btn-primary">Edit</a>
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
                      <center><a href="/editaddress/<?php echo bin2hex($encrypter->encrypt($a['id'])); ?>" class="btn btn-primary">Edit</a></center>
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
                      <center><a href="/editfamily/<?php echo bin2hex($encrypter->encrypt($f['id'])); ?>" class="btn btn-primary">Edit</a></center>
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
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Sibling/s Enrolled in PGA</h5>
                        <br>
                        <?php foreach ($sibling as $s): ?>
                        <h7 class="orange">Fullname:</h7>
                        <?= $s['fullname'] ?>
                        <br>
                        <h7 class="orange">Year Level:</h7>
                        <?= $s['yr_lvl'] ?>
                        <br>
                        <h7 class="orange">Affiliation:</h7>
                        <?= $s['affiliation'] ?>
                        <br>
                      </div>
                      <center><a href="/editsibling/<?php echo bin2hex($encrypter->encrypt($s['id'])); ?>" class="btn btn-primary">Edit</a></center>
                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <?php endforeach ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-5">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Schools Attended</h5>
                        <br>
                        <?php foreach ($school as $s): ?>
                          <h7 class="orange"><?= $s['grade'] ?>:</h7>
                        <?= $s['school_name'] ?>
                        <br>
                        <h7 class="orange">Level:</h7>
                        <?= $s['level'] ?>
                        <br>
                        <h7 class="orange">Period:</h7>
                        <?= $s['period'] ?>
                        <br>
                      </div>
                      <center><a href="/editschool/<?php echo bin2hex($encrypter->encrypt($s['id'])); ?>" class="btn btn-primary">Edit</a></center>
                    </div>

                    <div class="col-sm-5">
                      <div class="card-body">
                      <?php endforeach ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php endif; else: ?>
                  <h5 class="m-4">No Information Available Yet.</h5>
              <?php endif; ?>
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
