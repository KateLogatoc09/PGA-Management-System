<?= $this->include('student/head') ?>
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
        <?= $this->include('student/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
          <h1 class="card-title text-primary">Address Information</h1>
          <p class="mb-10">
                          Fill Up The Following Fields.
                        </p>
            <div class="row">
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveaddress" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">

                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($address['id'])) {echo $address['id'];}?>">
                        
                                        <label for="type">Type of Address:</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="Permanent">Permanent</option>
                                            <option value="Mailing">Mailing</option>
                                        </select>

                                        <label for="region">Region</label>
                                        <input type="text" class="form-control" id="region" name="region" placeholder="Enter Region" required/>
 
                                                        <label for="province">Province</label>
                                                        <input type="text" class="form-control" id="province" name="province" placeholder="Enter Province" required/>
                                                 
                                                        <label for="municipality">Municipality</label>
                                                        <input type="text" class="form-control" id="municipality" name="municipality" placeholder="Enter Municipality" required/>
                                                       
</div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
           
  <label for="barangay">Barangay</label>
                                                        <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Enter Barangay" required/>
                                                   
                                                        <label for="street">Street</label>
                                        <input type="text" class="form-control" id="street" name="street" placeholder="House No. , Street" required/>
                                        
                                    <label for="postal_code">Postal Code:</label>
                                        <input type="number" class="form-control" name="postal_code" placeholder="Enter Postal Code">
                        
                            
                                    <label for="tel_num">Telephone Number:</label>
                                        <input type="number" class="form-control" name="tel_num" max_length="11" placeholder="Enter Telephone Number" required>
             
  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="form-group">
    <hr>
    <center><a href="/learner" class="btn btn-primary">Back</a>
<button type="submit" class="btn btn-primary">Next</button></center>
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
</body>
</html>

<?= $this->include('student/js') ?>


