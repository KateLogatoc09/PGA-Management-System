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
                          <th>Book Title</th>
                          <th>Book Number</th>
                          <th>Book Author</th>
                          <th>Book Publisher</th>
                          <th>Place of Publication</th>
                          <th>Book Category</th>
                          <th>Book Pages</th>
                          <th>Book Quantity</th>
                          <th>Shelf Number</th>
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
                            <td><?= $book['book_title'] ?></td>
                            <td><?= $book['book_number'] ?></td>
                            <td><?= $book['book_author'] ?></td>
                            <td><?= $book['book_publisher'] ?></td>
                            <td><?= $book['place_printed'] ?></td>
                            <td><?= $book['book_category'] ?></td>
                            <td><?= $book['book_pages'] ?></td>
                            <td><?= $book['book_qty'] ?></td>
                            <td><?= $book['book_shelf'] ?></td>
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

<label for="bookTitle">Book Title</label>
<input type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Enter Book Title" 
value="<?php if (isset($booke['book_title'])) {echo $booke['book_title'];}?>" required>

<label for="bookNumber">Book Number</label>
<input type="text" class="form-control" id="bookNumber" name="bookNumber" placeholder="Enter Book Number" 
value="<?php if (isset($booke['book_number'])) {echo $booke['book_number'];}?>" required>

<label for="bookAuthor">Book Author</label>
<input type="text" class="form-control" id="bookAuthor" name="bookAuthor" placeholder="Enter Book Author" 
value="<?php if (isset($booke['book_author'])) {echo $booke['book_author'];}?>" required>

<label for="book_publisher">Book Publisher</label>
<input type="text" class="form-control" id="book_publisher" name="book_publisher" placeholder="Enter Book Publisher" 
value="<?php if (isset($booke['book_publisher'])) {echo $booke['book_publisher'];}?>" required>

<label for="place_printed">Place of Publication</label>
<input type="text" class="form-control" id="place_printed" name="place_printed" placeholder="Enter Place of Publication" 
value="<?php if (isset($booke['place_printed'])) {echo $booke['place_printed'];}?>" required>
                        
                        <label for="book_category" class="form-label">Book Category</label>
                        <select class="form-select" id="book_category" name='book_category' aria-label="Select Book Category">
                        <option value="">Select Book Category</option>
                          <option value="TEXTBOOKS">Textbooks</option>
                          <option value="FICTION AND STORYBOOK">Fiction and Storybook</option>
                          <option value="REFERENCE AND FILIPINIANA">Reference and Filipiniana</option>
                          <option value="BOOKS WITH MULTIPLE COPIES">Books with Multiple Copies</option>
                          <option value="TEACHER'S REFERENCES">Teacher's References</option>
                          <option value="OTHER TEXTBOOKS">Other Textbooks</option>
                        </select>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                        <label for="book_pages">Book Pages</label>
                        <input type="number" class="form-control" id="book_pages" name="book_pages" placeholder="Enter Book Pages" 
                        value="<?php if (isset($booke['book_pages'])) {echo $booke['book_pages'];}?>" required>

                        <label for="book_qty">Book Quantity</label>
                        <input type="number" class="form-control" id="book_qty" name="book_qty" placeholder="Enter Book Quantity" 
                        value="<?php if (isset($booke['book_qty'])) {echo $booke['book_qty'];}?>" required>
                        
                        <label for="book_shelf">Shelf Number</label>
                        <input type="text" class="form-control" id="book_shelf" name="book_shelf" placeholder="Enter Shelf Number" 
                        value="<?php if (isset($booke['book_shelf'])) {echo $booke['book_shelf'];}?>" required>


                        <label for="ISBN">International Standard Book Number</label>
                        <input type="text" class="form-control" id="ISBN" name="ISBN" placeholder="Enter International Standard Book Number" 
                        value="<?php if (isset($booke['ISBN'])) {echo $booke['ISBN'];}?>" required>

                        <label for="datePublish">Date Publish</label>
                        <input type="date" class="form-control" id="datePublish" name="datePublish" placeholder="Enter Date Publish" 
                        value="<?php if (isset($booke['datepublish'])) {echo $booke['datepublish'];}?>" required>

                        <label for="exampleFormControlSelect1" class="form-label">Status</label>
                        <select class="form-select" id="exampleFormControlSelect1" name='status' aria-label="Default select example">
                        <option value="">Select Status</option>
                          <option value="AVAILABLE">AVAILABLE</option>
                          <option value="UNAVAILABLE">UNAVAILABLE</option>
                        </select>
                        
                        
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
