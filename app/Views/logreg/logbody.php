<body>
     <!-- Sing in  Form -->
     <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="<?= base_url() ?>img/pga.ico" alt="sing up image"></figure>
                        <?php if(session()->getFlashdata('msg')):?>
                        <center><div class="alert alert-warning">
                        <?= session()->getFlashdata('msg')?>
                        </div></center><br>
                        <?php endif;?>
                        <a href="/reg" class="signup-image-link">Create an account</a>
                        <a href="/forget" class="signup-image-link">Forgot Password</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form class="register-form" id="login-form" action="/LoginAuth" method='post'>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" placeholder="Enter Username" name="username" value="<?= set_value('username') ?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" placeholder="Enter Password" name="password" value="<?= set_value('password') ?>" required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
</form>
                    </div>
                </div>
            </div>
        </section>
</body>