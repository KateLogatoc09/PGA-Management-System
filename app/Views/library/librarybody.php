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
        <?= $this->include('library/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Welcome To Library! 🎉</h5>
                        <p class="mb-4">
                          Borrow a Book?
                        </p>
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#borrowBooksModal">Borrow Books</a>

                      </div>
                      <?= $this->include('library/borrowbooks') ?>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
              
              <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Books Available</h3>
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
                                        <th>Book Title</th>
                                        <th>Book Number</th>
                                        <th>Book Author</th>
                                        <th>Book Publisher</th>
                                        <th>Place of Publication</th>
                                        <th>Book Category</th>
                                        <th>Book Pages</th>
                                        <th>ISBN</th>
                                        <th>Date Published</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($booky as $book): ?>
                                    <tr>
                                            <td><?= $book['book_title'] ?></td>
                                            <td><?= $book['book_number'] ?></td>
                                            <td><?= $book['book_author'] ?></td>
                                            <td><?= $book['book_publisher'] ?></td>
                                            <td><?= $book['place_printed'] ?></td>
                                            <td><?= $book['book_category'] ?></td>
                                            <td><?= $book['book_pages'] ?></td>
                                            <td><?= $book['ISBN'] ?></td>
                                            <td><?= $book['datepublish'] ?></td>
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
