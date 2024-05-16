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
                    <h3 class="card-title">Borrower List</h3>
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 200px;">
                      <form action="/searchBorrower" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                          <button type="submit" class="btn btn-default">
                          <i class="menu-icon tf-icons bx bx-search"></i>
                          </button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>Book Borrowed</th>
                          <th>ISBN</th>
                          <th>Student ID</th>
                          <th>Fullname of Borrower</th>
                          <th>Book Type</th>
                          <th>Number of Books Borrowed</th>
                          <th>Date Borrowed</th>
                          <th>Date To Be Returned</th>
                          <th>Date Returned</th>
                          <th>Fines</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Pagination Logic -->
                        <?php
                        $recordsPerPage = 5;
                        $totalPages = ceil(count($borrow) / $recordsPerPage);
                        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                        $offset = ($currentPage - 1) * $recordsPerPage;
                        $subset = array_slice($borrow, $offset, $recordsPerPage);
                        $x = 1;
                        foreach ($subset as $book) :
                        ?>
                          <tr>
                            <td><?= $book['book_title'] ?></td>
                            <td><?= $book['ISBN'] ?></td>
                            <td><?= $book['student_id'] ?></td>
                            <td><?= $book['last_name'] ?>, <?= $book['first_name'] ?> <?= $book['middle_name'] ?></td>
                            <td><?= $book['book_type'] ?></td>
                            <td><?= $book['book_qty'] ?></td>
                            <td><?= $book['date_borrowed'] ?></td>
                            <td><?= $book['date_to_be_return'] ?></td>
                            <td><?= $book['date_returned'] ?></td>
                            <td><?= $book['fines'] ?></td>
                            <td><?= $book['status'] ?></td>
                            <td>
                              <a href="/deleteBorrow/<?= $book['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                              <a href="/editBorrow/<?= $book['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                          </tr>
                        <?php $x++; endforeach ?>
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
                  <h5 class="card-title text-primary">Update List</h5>
                </div>
                <div class="d-flex">
                  <div class="col-sm-5">
                    <form action="/saveBorrowedBook" method="post">
                      <!-- Add your form fields and content here -->

                      <div class="form-group margin-left">
                        <input type="hidden" name="id" value="<?php if (isset($borrowed['id'])) {echo $borrowed['id'];}?>">
                        <input type="hidden" name="book_id" value="<?php if (isset($borrowed['book_id'])) {echo $borrowed['book_id'];}?>">

                        <label for="borrower">Borrower:</label>
                        <input type="text" name="borrower" list="list" class="form-control" value="<?php if (isset($borrowed['first_name'])) {echo $borrowed['first_name'];} ?> <?php if (isset($borrowed['middle_name'])) {echo $borrowed['middle_name'];} ?> <?php if (isset($borrowed['last_name'])) {echo $borrowed['last_name'];} ?>" readonly>

                        <label for="book_title">Book Borrowed:</label>
                        <input type="text" name="book_title" list="list" class="form-control" value="<?php if (isset($borrowed['book_title'])) {echo $borrowed['book_title'];} ?>" readonly>

                        <label for="book_qty">Book Quantity</label>
                        <input type="number" class="form-control" id="book_qty" name="book_qty" placeholder="Enter Book Quantity" value="<?php if (isset($borrowed['book_qty'])) {echo $borrowed['book_qty'];} ?>" required>

                        <label for="dateBorrowed">Date Borrowed</label>
                        <input type="datetime-local" class="form-control" id="dateBorrowed" name="dateBorrowed" placeholder="Select Date Borrowed" value="<?php if (isset($borrowed['date_borrowed'])) {echo $borrowed['date_borrowed'];} ?>" required>
                      </div>
                  </div>
                  <div class="col-sm-5 text-center text-sm-left">
                    <div class="form-group margin-left">
                      
                    <label for="dateReturn">Date To be Return</label>
                      <input type="datetime-local" class="form-control" id="dateReturn" name="dateReturn" placeholder="Select Date To be Return" value="<?php if (isset($borrowed['date_to_be_return'])) {echo $borrowed['date_to_be_return'];} ?>" required>

                      <label for="date_returned">Date Returned</label>
                      <input type="datetime-local" class="form-control" id="date_returned" name="date_returned" placeholder="Select Date Returned" value="<?php if (isset($borrowed['date_returned'])) {echo $borrowed['date_returned'];} ?>">


                      <label for="fines">Fines</label>
                        <input type="number" class="form-control" id="fines" name="fines" placeholder="Enter Amount of Fines" value="<?php if (isset($borrowed['fines'])) {echo $borrowed['fines'];} ?>" required>


                      <label for="status">Status</label>
                      <select class="form-control" name="status" id="status" value="<?php if (isset($borrowed['status'])) {echo $borrowed['status'];} ?>" required>
                        <option value="">Select Status</option>
                        <option value="PENDING">PENDING</option>
                        <option value="ON BORROW">ON BORROW</option>
                        <option value="RETURNED">RETURNED</option>
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
  <script>
  <?php $y = 1; foreach ($subset as $book): ?>
  document.getElementById("d<?=$y?>").addEventListener("click", function (event) {
    event.preventDefault()
      //sweetalert2 code
      Swal.fire({
          title: 'PGA',
          text: "Are you sure? You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = $(this).attr('href');
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info');
        }
      })
    });
<?php $y++; endforeach; ?>
  </script>
</body>

</html>
