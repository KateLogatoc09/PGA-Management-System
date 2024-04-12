<body>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <!-- ... (existing navbar code) ... -->
        </nav>
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
                            <h3 class="card-title">Alumni List</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                         <table class="table table-hover text-nowrap">
                    
                            <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Full Name</th>
                                        <th>Gender</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Occupation</th>
                                        <th>Year Graduated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($alumni as $al): ?>
                                    <tr>
                                            <td><?= $al['id'] ?></td>
                                            <td><?= $al['fullname'] ?></td>
                                            <td><?= $al['gender'] ?></td>
                                            <td><?= $al['email'] ?></td>
                                            <td><?= $al['phone'] ?></td>
                                            <td><?= $al['address'] ?></td>
                                            <td><?= $al['occupation'] ?></td>
                                            <td><?= $al['yr_graduated'] ?></td>
                                            <td> <a href="/deleteAlumni/<?= $al['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editAlumni/<?= $al['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                           
                                           
                                          
                                     </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    </div>
                    <!-- /.card -->
                </div> <!-- /.dito -->

                <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Alumni</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveAlumni" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($alum['id'])) {echo $alum['id'];}?>">
                        <label for="fullname">Fullname:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname" 
                        value="<?php if (isset($alum['fullname'])) {echo $alum['fullname'];}?>" required>

                        <label for="gender">Gender:</label>
                                        <select class="form-control" name="gender" id="gender" value= "
                                        <?php if (isset($alum['gender'])) {echo $alum['gender'];}?>" required>>
                                        <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" 
                        value="<?php if (isset($alum['email'])) {echo $alum['email'];}?>" required>
                                 
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone"
                        value="<?php if (isset($alum['phone'])) {echo $alum['phone'];}?>" required>
                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter Address" 
                        value="<?php if (isset($alum['address'])) {echo $alum['address'];}?>" required>

                        <label for="occupation">Occupation:</label>
                        <input type="text" class="form-control" name="occupation" placeholder="Enter Occupation" 
                        value="<?php if (isset($alum['occupation'])) {echo $alum['occupation'];}?>" required>
                                 
                        <label for="yr_graduated">Year Graduated:</label>
                        <input type="date" class="form-control" name="yr_graduated" placeholder="Enter Year Graduated" 
                        value="<?php if (isset($alum['yr_graduated'])) {echo $alum['yr_graduated'];}?>" required>
                        
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

</html>
