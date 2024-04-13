<body>
    <?php $session = session() ?>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 mb-5 topp">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" style="min-height: 300px;">
                    <img class="position-relative w-100" src="<?= base_url() ?>img/pg.jpg" style="height: 700px; object-fit: fill;">
                    <div class="carousel-caption d-flex align-items-left justify-content-left">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">WELCOME TO</h5>
                            <h1 class="display-3 text-white mb-md-4">PUERTO GALERA ACADEMY INC.</h1>

                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="<?= base_url() ?>img/front.jpg" style="height: 700px; object-fit: fill;">
                    <div class="carousel-caption d-flex align-items-bottom justify-content-bottom">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-4 mb-lg-0 w-100" src="<?= base_url() ?>img/about.jpg" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="text-left mb-4">
                        <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">About Us</h5>
                        <h1>Puerto Galera Academy</h1>
                    </div>
                    <p>Puerto Galera Academy is a private Catholic school located at Poblacion, Puerto Galera, Oriental Mindoro</p>
                    <a href="/li" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->





    <!-- FAQ Start -->
    <div class="container-fluid bg-registration py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Frequently Ask Question</h5>
                        <h1 class="text-white">Any Question about our Institution?</h1>
                    </div>
                    <p class="text-white">DOMINO OPTIMO MAXIMO "TO THE LORD THE BEST, AND THE GREATEST"</p>

                </div>
                <div class="col-lg-5">
                    <div class="card border-0">
                        <div class="card-header bg-primary text-center p-4">
                            <h1 class="m-0 text-white">Ask Now</h1>
                        </div>
                        <div class="card-body rounded-bottom bg-light p-5">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control border-0 p-4" placeholder="Type here" required="required" />
                                </div>

                                <div>
                                    <button class="btn btn-dark btn-block border-0 py-3" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ End -->


    <!-- Announcement Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-5">
                <h1>Announcements</h1>
            </div>
            <!-- Field Announcement Start     -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card border-0">
                            <div class="card-header bg-primary text-center p-4">
                                <h1 id="currentDateTime" class="m-0 text-white" style="font-size: 2.5rem;"></h1>
                            </div>
                            <div class="card-body rounded-bottom bg-light p-5">
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control border-0 p-4" style="font-size: 1.5rem;" placeholder="Announcement" required="required" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Field Announcement ENd     -->
        </div>
    </div>
    <!-- Announcement End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">PGA INC.</h5>
                <h1>Vision, Mission, Goals, Core Values</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="text-center">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <h4 class="font-weight-normal mb-4">We envision Puerto Galera Academy, INC. as an evangelized and evangelizing Parochial school committed to excellence for life sustaining and quality Catholic Education to form a caring and competent learners enlivened by gospel values through integral human formation for the Church and the country.</h4>
                            <span>VISION</span>
                        </div>
                        <div class="text-center">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <h4 class="font-weight-normal mb-4">To zelously proclaim the Good News, we commit ourselves to form students in the pursuit of excellence through Faith, Virtue, Standard and Competency based education realizing their God given potentials with integrity and preferential option for the poor, indigenous people and environmental conservation.</h4>
                            <span>MISSION</span>
                        </div>
                        <div class="text-center">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <h5 class="font-weight-normal mb-4">1. Provide an environment in which every individual is cared for spiritually, morally, intellectually, physically,socially and emotionally.
                            </h5>
                            <h5 class="font-weight-normal mb-4">2.Deliver a stimulating learning environment with a technological orientation across the whole curriculum.
                            </h5>
                            </h5>
                            <span>GOALS</span>
                        </div>
                        <div class="text-center">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <h5 class="font-weight-normal mb-4">3. Advocate programs that uphold the love of God and country and care for the integrity of life and creation.
                            </h5>
                            <h5 class="font-weight-normal mb-4">4. Strengthen and enrich values formation based on the moral standards of Christ.
                            </h5>
                            <h5 class="font-weight-normal mb-4">5. Deliver civic duties thru community extension services and charitable outreaches.
                            </h5>
                            <span>GOALS</span>
                        </div>
                        <div class="text-center">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <h4 class="font-weight-bold mb-4">C-Charity</h4>
                            <h4 class="font-weight-bold mb-4">A-Activism</h4>
                            <h4 class="font-weight-bold mb-4">R-Reverence</h4>
                            <h4 class="font-weight-bold mb-4">E-Excellence</h4>
                            <h4 class="font-weight-bold mb-4">S-Stewardship</h4>
                            <span>CORE VALUES</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->





    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4" style="letter-spacing: 5px;">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>Puerto Galera, Oriental Mindoro, Philippines</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                        <div class="d-flex justify-content-start mt-4">

                            <a class="btn btn-outline-light btn-square mr-2" href="https://www.facebook.com/pgacare1967"><i class="fab fa-facebook-f"></i></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
                <div class="row">
                    <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                        <p class="m-0 text-white">&copy; <a href="#" class="text-secondary">pga.com</a>. All Rights Reserved. Designed by CSS Student of MINSU-Calapan
                        </p>
                    </div>
                    <div class="col-lg-6 text-center text-md-right">
                        <ul class="nav d-inline-flex">
                            <li class="nav-item">
                                <a class="nav-link text-white py-0" href="#">Privacy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white py-0" href="#">Terms</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Footer End -->


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
</body>

</html>