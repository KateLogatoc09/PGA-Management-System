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
                                        <th>ID Number</th>
                                        <th>Firt Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($teacher as $teach): ?>
                                    <tr>
                                            <td><?= $teach['id'] ?></td>
                                            <td><?= $teach['idnum'] ?></td>
                                            <td><?= $teach['fname'] ?></td>
                                            <td><?= $teach['mname'] ?></td>
                                            <td><?= $teach['lname'] ?></td>
                                            <td><?= $teach['age'] ?></td>
                                            <td><?= $teach['gender'] ?></td>
                                            <td><?= $teach['dob'] ?></td>
                                            <td><?= $teach['address'] ?></td>
                                            <td><?= $teach['phone'] ?></td>
                                            <td> <a href="/deleteteacher/<?= $teach['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editteacher/<?= $teach['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                           
                                           
                                          
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
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
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

  <script src="assets/js/book.js"></script>
</body>

</html>
