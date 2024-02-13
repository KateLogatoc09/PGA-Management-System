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
            <div class="col-md-6 m-auto">
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
            <div class="col-md-6 m-auto p-md-2">
            <h4><b class="text-mn">Sign-up</b><a href='/'><i class="menu-icon tf-icons bx bx-home float-end"></i></a></h4> 
              <form id="formAuthentication" class="mb-3" action="/registering" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter your username"
                    autofocus
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="cpassword">Confirm Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="cpassword"
                      class="form-control"
                      name="cpassword"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      required
                    />
                  </div>
                </div>
                <div class="mb-3">
                  <label for="role" class="form-label">Are you a/an?</label>
                  <select class="form-select" name="role" aria-label="Select your Role" required>
                    <option selected disabled>Select your Role</option>
                    <option value="STUDENT">Student</option>
                    <option value="TEACHER">Teacher</option>
                    <option value="PERSONNEL">Personnel</option>
                  </select>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
                </div>
              </form>

              <p class="text-center">
                <span>Already a member?</span>
                <a href="/login">
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