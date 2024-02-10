<?= $this->include('logreg/head') ?>
<body>
     <!-- Sing in  Form -->
     <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="<?= base_url() ?>img/pga.ico" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">Resend Code</a>
                        <a href="/login" class="signup-image-link">Go Back to Log In</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Verify Your Account</h2>
                        <form class="register-form" id="login-form" action="/LoginAuth" method='post'>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" placeholder="Enter Code Sent" name="Code Sent" required/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Submit"/>
                            </div>
</form>
                    </div>
                </div>
            </div>
        </section>
</body>
<?= $this->include('logreg/js') ?>