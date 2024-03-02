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
                            <h3 class="card-title">Students' Siblings List</h3>
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
                                        <th>Sibling's Fullname</th>
                                        <th>Sibling's Year Level</th>
                                        <th>Sibling's Affiliation</th>
                                        <th>Account Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sibling as $si): ?>
                                    <tr>
                                            <td><?= $si['id'] ?></td>
                                            <td><?= $si['student_id'] ?></td>
                                            <td><?= $si['last_name'] ?>, <?= $si['first_name'] ?> <?= $si['middle_name'] ?></td>
                                            <td><?= $si['fullname'] ?></td>
                                            <td><?= $si['yr_lvl'] ?></td>
                                            <td><?= $si['affiliation'] ?></td>
                                            <td><?= $si['account_id'] ?></td>
                                            <td> <a href="/regDeletesibling/<?= $si['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/regEditsibling/<?= $si['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Edit Students' Sibling</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/regSavesibling" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id" value="<?php if (isset($sib['id'])) {echo $sib['id'];}?>">
                    
                                        <label for="fullname">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name"
                                        value="<?php if (isset($sib['fullname'])) {echo $sib['fullname'];}?>">
                                 
                                        <label for="yr_lvl">Year Level:</label>
                                        <select class="form-control" name="yr_lvl" id="yr_lvl"
                                        value="<?php if (isset($sib['yr_lvl'])) {echo $sib['yr_lvl'];}?>">
                                            <option value="Kinder 1">Kinder 1</option>
                                            <option value="Kinder 2">Kinder 2</option>
                                            <option value="Grade 1">Grade 1</option>
                                            <option value="Grade 2">Grade 2</option>
                                            <option value="Grade 3">Grade 3</option>
                                            <option value="Grade 4">Grade 4</option>
                                            <option value="Grade 5">Grade 5</option>
                                            <option value="Grade 6">Grade 6</option>
                                            <option value="Grade 7">Grade 7</option>
                                            <option value="Grade 8">Grade 8</option>
                                            <option value="Grade 9">Grade 9</option>
                                            <option value="Grade 10">Grade 10</option>
                                            <option value="Grade 11">Grade 11</option>
                                            <option value="Grade 12">Grade 12</option>
                                        </select>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
  <label for="affiliation">Affiliation:</label>
                                        <input type="text" class="form-control" name="affiliation" placeholder="Enter Affiliation"
                                        value="<?php if (isset($sib['affiliation'])) {echo $sib['affiliation'];}?>">
                                 
               
                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($sib['account_id'])) {echo $sib['account_id'];}?>" required>             
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
