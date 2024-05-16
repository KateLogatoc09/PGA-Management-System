<body>
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
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Send a Message /</span> Queries, Inquiries, Etc.</h4>

<div class="row">
  <div class="col-md-12">
      <div class="card">
          <h5 class="card-header">Send Email</h5>
          <hr class="my-0">
          <form action="/send" method="POST" enctype="multipart/form-data">
              <div class="card-body d-flex row">
                  <div class="col-sm-12 col-md-12 d-sm-block d-md-block ps-2">
                      <div class="row">
                      <div class="mb-2 col-md-12">
                              <label for="recipient" class="form-label">Recipient</label>
                              <input
                              class="form-control"
                              type="email"
                              id="recipient"
                              name="recipient"
                              autofocus
                              required
                              />
                          </div>
                          <div class="mb-2 col-md-12">
                              <label for="subject" class="form-label">Subject</label>
                              <input
                              class="form-control"
                              type="text"
                              id="subject"
                              name="subject"
                              autofocus
                              required
                              />
                          </div>

                          <div class="mb-2 col-md-12">
                              <label for="message" class="form-label">Message</label>
                              <textarea class="form-control" id="message" name="message" style="resize:none" rows="6" required></textarea>
                          </div>



                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG.</p>

                          <div>
                              <label for="upload" class="btn btn-primary me-2 mb-2 w-100" tabindex="0">
                                  <span class="d-sm-block">Upload Attachment <i class="bx bx-upload"></i></span>
                                  <input
                                  type="file"
                                  id="upload"
                                  class="account-file-input"
                                  hidden
                                  accept="image/png, image/jpeg, application/pdf"
                                  name="attachment"
                                  />
                              </label>
                          </div>

                          <div class="mt-2">
                          <button type="submit" class="btn btn-primary float-end ms-2">Save changes</button>
                          <button type="button" id="clear" onclick="event.preventDefault();" class="btn btn-primary float-end" >Clear</button>
                          </div>
                      </div>
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
