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
                            <h3 class="card-title">Students' Address List</h3>
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
                                        <th>Student's ID Number</th>
                                        <th>Student's Name</th>
                                        <th>Type of Address</th>
                                        <th>Address</th>
                                        <th>Postal Code</th>
                                        <th>Telphone Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($address as $ad): ?>
                                    <tr>
                                            <td><?= $ad['id'] ?></td>
                                            <td><?= $ad['student_id'] ?></td>
                                            <td><?= $ad['last_name'] ?>, <?= $ad['first_name'] ?> <?= $ad['middle_name'] ?></td>
                                            <td><?= $ad['type'] ?></td>
                                            <td><?= $ad['address'] ?></td>
                                            <td><?= $ad['postal_code'] ?></td>
                                            <td><?= $ad['tel_num'] ?></td>
                                            <td> <a href="/deleteaddress/<?= $ad['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editaddress/<?= $ad['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Edit Students' Address</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/adminaddress" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id" value="<?php if (isset($add['id'])) {echo $add['id'];}?>">
                        
                        <label for="type">Type of Address:</label>
                        <select class="form-control" name="type" id="type" value="<?php if (isset($add['type'])) {echo $add['type'];}?>">
                        <option value="">Select Type</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Mailing">Mailing</option>
                        </select>

                    <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter Address" value="<?php if (isset($add['address'])) {echo $add['address'];}?>">
                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
  <label for="tel_num">Telephone Number:</label>
                                        <input type="number" class="form-control" name="tel_num" max_length="11" placeholder="Enter Telephone Number" value="<?php if (isset($add['tel_num'])) {echo $add['tel_num'];}?>">

                                        <label for="postal_code">Postal Code:</label>
                        <input type="number" class="form-control" name="postal_code" placeholder="Enter Postal Code" value="<?php if (isset($add['postal_code'])) {echo $add['postal_code'];}?>">
               

                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($add['account_id'])) {echo $add['account_id'];}?>" required>             
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
