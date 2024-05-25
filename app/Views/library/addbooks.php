<?php
$config    = new \Config\Encryption(); 
$encrypter = \Config\Services::encrypter($config);
// Define the number of records per page
$recordsPerPage = 5;

// Calculate the total number of pages
$totalPages = ceil(count($booky) / $recordsPerPage);

// Get the current page number from the query string, default to 1 if not set
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Get a subset of records for the current page
$subset = array_slice($booky, $offset, $recordsPerPage);
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

              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Book List</h3>
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchBook" method="get">
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
                      <?php $x = 1;  foreach ($subset as $book): ?>
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
                              <a href="/deleteBook/<?php echo bin2hex($encrypter->encrypt($book['id'])); ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
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
                        <option value="TEXTBOOKS" <?php if(isset($booke["book_category"])) { if($booke["book_category"] == "TEXTBOOKS") { echo "selected"; }} ?>>Textbooks</option>
                        <option value="FICTION AND STORYBOOK" <?php if(isset($booke["book_category"])) { if($booke["book_category"] == "FICTION AND STORYBOOK") { echo "selected"; }} ?>>Fiction And Storybook</option>
                        <option value="REFERENCE AND FILIPINIANA" <?php if(isset($booke["book_category"])) { if($booke["book_category"] == "REFERENCE AND FILIPINIANA") { echo "selected"; }} ?>>Reference And Filipiniana</option>
                        <option value="BOOKS WITH MULTIPLE COPIES" <?php if(isset($booke["book_category"])) { if($booke["book_category"] == "BOOKS WITH MULTIPLE COPIES") { echo "selected"; }} ?>>Books With Multiple Copies</option>
                        <option value="TEACHER'S REFERENCES" <?php if(isset($booke["book_category"])) { if($booke["book_category"] == "TEACHER'S REFERENCES") { echo "selected"; }} ?>>Teacher's Reference</option>
                        <option value="OTHER TEXTBOOKS" <?php if(isset($booke["book_category"])) { if($booke["book_category"] == "OTHER TEXTBOOKS") { echo "selected"; }} ?>>Other Textbooks</option>
                        
                        </select>

                        <label for="book_type">Book Type</label>
                        <select class="form-select" id="book_type" name='book_type' aria-label="Select Book Type">
                        <option value="">Select Book Type</option>
                        <option value="NEW ARRIVAL BOOK" <?php if(isset($booke["book_type"])) { if($booke["book_type"] == "NEW ARRIVAL BOOK") { echo "selected"; }} ?>>New Arrival Book</option>
                        <option value="RESERVED BOOK" <?php if(isset($booke["book_type"])) { if($booke["book_type"] == "RESERVED BOOK") { echo "selected"; }} ?>>Reserved Book</option>
                        <option value="NORMAL" <?php if(isset($booke["book_type"])) { if($booke["book_type"] == "NORMAL") { echo "selected"; }} ?>>Normal</option>
                        
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
                          <option value="AVAILABLE" <?php if(isset($booke["status"])) { if($booke["status"] == "AVAILABLE") { echo "selected"; }} ?>>Available</option>
                          <option value="UNAVAILABLE" <?php if(isset($booke["status"])) { if($booke["status"] == "UNAVAILABLE") { echo "selected"; }} ?>>Unavailable</option>
                        
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
