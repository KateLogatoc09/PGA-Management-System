<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v19.0" nonce="AFffryss"></script>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('general/nav') ?>
        <?= $this->include('general/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Fill Out The Fields Needed for Verification</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="apply_pr" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($prof['id'])) {echo $prof['id'];}?>">
                        <label for="fullname">Full Name:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="First Name Middle Name, Last Name" required>
                                 
                        <label for="valid_id">Upload Valid Id:</label>
                        <input type="file" class="form-control" name="valid_id" placeholder="Upload Valid Id" required>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">

                        <label for="birth_cert">Upload Birth Certificate of Child:</label>
                        <input type="file" class="form-control" name="birth_cert" placeholder="Upload Birth Certificate" required>

  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
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
