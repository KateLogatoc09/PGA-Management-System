<body>
        <!-- Sign up form -->
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <section class="signup">
                        <form method='post' class="register-form" id="register-form" action="/Registering">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" placeholder="Enter Username" name="username" value="<?= set_value('username') ?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" placeholder="Enter Email" name="email" value="<?= set_value('email') ?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" placeholder="Enter Password" name="password" value="<?= set_value('password') ?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" placeholder="Confirm Password" name="confirmpassword" value="<?= set_value('confirmpassword') ?>" required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                    <?php if(isset($validation)):?>
                    <div class="alert alert-warning">
                    <?= $validation->listErrors()?>
                    </div>
                    <?php endif;?>
                    <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-success">
                    <?= session()->getFlashdata('msg')?>
                    </div>
                    <?php endif;?>
                        <figure><img src="<?= base_url() ?>img/pga.ico" alt="sing up image"></figure>
                        <a href="/login" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
</body>