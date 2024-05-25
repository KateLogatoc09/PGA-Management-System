<?php
$config    = new \Config\Encryption(); 
$encrypter = \Config\Services::encrypter($config);
?>
<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
    <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('library/nav') ?>
        <?= $this->include('library/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <h1 class="center white">FICTION & STORYBOOKS</h1>              
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Shelf 3 List</h3>
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchShelf3" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                            <option value="book_title">Book Title</option>
                            <option value="book_number">Book Number</option>
                            <option value="book_author">Book Author</option>
                            <option value="book_publisher">Book Publisher</option>
                            <option value="place_printed">Place of Publication</option>
                            <option value="book_category">Book Category</option>
                            <option value="book_type">Book Type</option>
                            <option value="book_pages">Book Pages</option>
                            <option value="book_qty">Book Quantity</option>
                            <option value="book_shelf">Shelf Number</option>
                            <option value="ISBN">ISBN</option>
                            <option value="datepublish">Date Published</option>
                          </select>
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
                          <th>Book Title</th>
                          <th>Book Number</th>
                          <th>Book Author</th>
                          <th>Book Publisher</th>
                          <th>Place of Publication</th>
                          <th>Book Category</th>
                          <th>Book Type</th>
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
                        $recordsPerPage1 = 5;
                        $totalPages1 = ceil(count($shelf3) / $recordsPerPage1);
                        $currentPage1 = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                        $offset1 = ($currentPage1 - 1) * $recordsPerPage1;
                        $subset1 = array_slice($shelf3, $offset1, $recordsPerPage1);
                        $x = 1;
                        foreach ($subset1 as $book) :
                        ?>
                          <tr>
                            <td><?= $book['book_title'] ?></td>
                            <td><?= $book['book_number'] ?></td>
                            <td><?= $book['book_author'] ?></td>
                            <td><?= $book['book_publisher'] ?></td>
                            <td><?= $book['place_printed'] ?></td>
                            <td><?= $book['book_category'] ?></td>
                            <td><?= $book['book_type'] ?></td>
                            <td><?= $book['book_pages'] ?></td>
                            <td><?= $book['book_qty'] ?></td>
                            <td><?= $book['book_shelf'] ?></td>
                            <td><?= $book['ISBN'] ?></td>
                            <td><?= $book['datepublish'] ?></td>
                            <td><?= $book['status'] ?></td>
                            <td>
                              <a href="/deleteBook/<?php echo bin2hex($encrypter->encrypt($book['id'])); ?>" class="btn btn-danger btn-sm" id="d1<?=$x?>">Delete</a>
                              <a href="/editBook/<?php echo bin2hex($encrypter->encrypt($book['id'])); ?>" class="btn btn-primary btn-sm">Edit</a>
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
                        <?php if ($currentPage1 > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage1 - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages1; $i++) : ?>
                          <li class="page-item <?= $i == $currentPage1 ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                        <?php endfor; ?>
                        <?php if ($currentPage1 < $totalPages1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage1 + 1 ?>" aria-label="Next">
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
                  <div class="card-header">
                    <h3 class="card-title">Shelf 6 List</h3>
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchShelf6" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                            <option value="book_title">Book Title</option>
                            <option value="book_number">Book Number</option>
                            <option value="book_author">Book Author</option>
                            <option value="book_publisher">Book Publisher</option>
                            <option value="place_printed">Place of Publication</option>
                            <option value="book_category">Book Category</option>
                            <option value="book_type">Book Type</option>
                            <option value="book_pages">Book Pages</option>
                            <option value="book_qty">Book Quantity</option>
                            <option value="book_shelf">Shelf Number</option>
                            <option value="ISBN">ISBN</option>
                            <option value="datepublish">Date Published</option>
                          </select>
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
                          <th>Book Title</th>
                          <th>Book Number</th>
                          <th>Book Author</th>
                          <th>Book Publisher</th>
                          <th>Place of Publication</th>
                          <th>Book Category</th>
                          <th>Book Type</th>
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
                        $totalPages = ceil(count($shelf6) / $recordsPerPage);
                        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                        $offset = ($currentPage - 1) * $recordsPerPage;
                        $subset = array_slice($shelf6, $offset, $recordsPerPage);
                        $a = 1;
                        foreach ($subset as $book) :
                        ?>
                          <tr>
                            <td><?= $book['book_title'] ?></td>
                            <td><?= $book['book_number'] ?></td>
                            <td><?= $book['book_author'] ?></td>
                            <td><?= $book['book_publisher'] ?></td>
                            <td><?= $book['place_printed'] ?></td>
                            <td><?= $book['book_category'] ?></td>
                            <td><?= $book['book_type'] ?></td>
                            <td><?= $book['book_pages'] ?></td>
                            <td><?= $book['book_qty'] ?></td>
                            <td><?= $book['book_shelf'] ?></td>
                            <td><?= $book['ISBN'] ?></td>
                            <td><?= $book['datepublish'] ?></td>
                            <td><?= $book['status'] ?></td>
                            <td>
                              <a href="/deleteBook/<?php echo bin2hex($encrypter->encrypt($book['id'])); ?>" class="btn btn-danger btn-sm" id="d<?=$a?>">Delete</a>
                              <a href="/editBook/<?php echo bin2hex($encrypter->encrypt($book['id'])); ?>" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                          </tr>
                        <?php $a++; endforeach ?>
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
  <?php $y = 1; foreach ($subset1 as $book): ?>
  document.getElementById("d1<?=$y?>").addEventListener("click", function (event) {
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

<?php $b = 1; foreach ($subset as $book): ?>
  document.getElementById("d<?=$b?>").addEventListener("click", function (event) {
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
<?php $b++; endforeach; ?>
  </script>
</body>

</html>
