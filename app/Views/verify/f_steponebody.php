<body style="background-image:url('<?= base_url() ?>img/pga_bg.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
    <!-- Content -->
    <?php $session = session()?>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body row">
                <!-- Logo -->
            <div class="col-md-5 m-auto">
            <div class="app-brand justify-content-center">
                <a href="/" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img
                      src="<?= base_url() ?>img/pga.ico"
                      height="180px"
                    >
                  </span>
                </a>
              </div>
              <h4 class="mb-4 text-center">Welcome to <b class="text-mn">Puerto Galera Academy!</b></h4>
            </div>
              <!-- /Logo -->
            <div class="col-md-7 m-auto p-md-4">
  	        <h4><b class="text-mn">Password Recovery</b> <a href='/'><i class="menu-icon tf-icons bx bx-home float-end"></i></a></h4>
              <p class="mb-2">Please verify your account to recover your password.</p>
            <form id="formAuthentication" class="mb-3" action="/recovery" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Send</button>
                </div>
              </form>

              <p class="text-center">
                <span>Remembered?</span>
                <a href="login">
                  <span>Sign-in</span>
                </a>
              </p>
            </div>
          </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

  </body>