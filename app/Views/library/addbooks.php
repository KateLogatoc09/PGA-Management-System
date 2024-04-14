<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
    <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar"
        >
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <h5 class="mt-3">Welcome<?php if(isset($_SESSION['username'])): ?>, <?= $_SESSION['username']; endif; ?>!</h5>
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="<?php if(isset($_SESSION['img'])): ?><?= site_url().'/'.$_SESSION['img']; ?><?php else: ?>../assets/img/avatars/1.png<?php endif; ?>" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="<?php if(isset($_SESSION['img'])): ?><?= site_url().'/'.$_SESSION['img']; ?><?php else: ?>../assets/img/avatars/1.png<?php endif; ?>" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?php if(isset($_SESSION['username'])): ?><?= $_SESSION['username']; endif; ?></span>
                          <small class="text-muted">User</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>

                  <li>
                    <a class="dropdown-item active" href="/general">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">Home</span>
                    </a>
                  </li>
                  
                  <li>
                    <a class="dropdown-item active" href="/">
                      <i class="bx bx-notification me-2"></i>
                      <span class="align-middle">Notifications</span>
                    </a>
                  </li>

                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="logout">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
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
                  <div class="card-header">
                    <h3 class="card-title">Book List</h3>
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
                          <th>Id</th>
                          <th>Book Title</th>
                          <th>Book Number</th>
                          <th>Book Author</th>
                          <th>Book Publisher</th>
                          <th>Place of Publication</th>
                          <th>Book Category</th>
                          <th>Book Pages</th>
                          <th>Book Quantity</th>
                          <th>ISBN</th>
                          <th>Date Published</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Pagination Logic -->
                        <?php
                        $recordsPerPage = 5;
                        $totalPages = ceil(count($booky) / $recordsPerPage);
                        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                        $offset = ($currentPage - 1) * $recordsPerPage;
                        $subset = array_slice($booky, $offset, $recordsPerPage);
                        foreach ($subset as $book) :
                        ?>
                          <tr>
                            <td><?= $book['id'] ?></td>
                            <td><?= $book['book_title'] ?></td>
                            <td><?= $book['book_number'] ?></td>
                            <td><?= $book['book_author'] ?></td>
                            <td><?= $book['book_publisher'] ?></td>
                            <td><?= $book['place_printed'] ?></td>
                            <td><?= $book['book_category'] ?></td>
                            <td><?= $book['book_pages'] ?></td>
                            <td><?= $book['book_qty'] ?></td>
                            <td><?= $book['ISBN'] ?></td>
                            <td><?= $book['datepublish'] ?></td>
                            <td><?= $book['status'] ?></td>
                            <td>
                              <a href="/deleteBook/<?= $book['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                              <a href="/editBook/<?= $book['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                          </tr>
                        <?php endforeach ?>
                        <!-- End Pagination Logic -->
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <!-- Pagination Links -->
                  <div class="card-footer">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                          <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                        <?php endfor; ?>
                        <?php if ($currentPage < $totalPages) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div> <!-- /.dito -->

            <div class="col-lg-18 mb-4 order-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title text-primary">Add/Update Book List</h5>
                </div>
                <div class="d-flex">
                  <div class="col-sm-5">
                    <form action="/saveBook" method="post">
                      <!-- Add your form fields and content here -->

                      <div class="form-group margin-left">
                        <input type="hidden" name="id" value="<?php if (isset($booke['id'])) {echo $booke['id'];}?>">

                        <!-- Add your form inputs here -->
                      </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="form-group margin-left">
                        <!-- Add your form inputs here -->
                      </div>
                    </div>
                  </div>

                  <!-- Move the "Save changes" button inside the form -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
  <!-- / Layout wrapper -->

</body>

</html>
