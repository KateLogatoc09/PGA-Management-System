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
                            <h3 class="card-title">Subject List</h3>
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
                                        <th>Subject Name</th>
                                        <th>Type of Subject</th>
                                        <th>Grade Level</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($subject as $ad): ?>
                                    <tr>
                                            <td><?= $ad['id'] ?></td>
                                            <td><?= $ad['name'] ?></td>
                                            <td><?= $ad['type'] ?></td>
                                            <td><?= $ad['yr_lvl'] ?></td>
                                            <td> <a href="/deleteSubject/<?= $ad['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editSubject/<?= $ad['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Edit Subject</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveSubject" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($sub['id'])) {echo $sub['id'];}?>">

                                        <label for="name">Subject Name:</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Subject Name"
                                        value="<?php if (isset($sub['name'])) {echo $sub['name'];}?>">

                                        <label for="type">Type of Subject:</label>
                                        <select class="form-control" name="type" id="Type of Subject">
                                        <option value="">Select Type</option>
                                            <option value="Core Subject">Core Subject</option>
                                            <option value="Applied Subject">Applied Subject</option>
                                            <option value="Specialized Subject">Specialized Subject</option>
                                        </select>

                                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                                        <label for="yr_lvl">Grade Level:</label>
                                        <input type="text" class="form-control" name="yr_lvl" placeholder="Enter Grade Level" 
                                        value="<?php if (isset($sub['yr_lvl'])) {echo $sub['yr_lvl'];}?>" required>  
                      
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
