<body>
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
                        <div class="card-header">
                            <h3 class="card-title">Borrowed Book List</h3>
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
                                        <th>Student Id</th>
                                        <th>Book Title</th>
                                        <th>Book Number</th>
                                        <th>Book Author</th>
                                        <th>Date Published</th>
                                        <th>Date Borrowed</th>
                                        <th>Date Return</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($borrow as $book): ?>
                                    <tr>
                                            <td><?= $book['id'] ?></td>
                                            <td><?= $book['student_id'] ?></td>
                                            <td><?= $book['book_title'] ?></td>
                                            <td><?= $book['book_number'] ?></td>
                                            <td><?= $book['book_author'] ?></td>
                                            <td><?= $book['datepublish'] ?></td>
                                            <td><?= $book['date_borrowed'] ?></td>
                                            <td><?= $book['date_return'] ?></td>
                                            <td><?= $book['status'] ?></td>
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
                                        <th>Date Published</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($booky as $book): ?>
                                    <tr>
                                            <td><?= $book['id'] ?></td>
                                            <td><?= $book['book_title'] ?></td>
                                            <td><?= $book['book_number'] ?></td>
                                            <td><?= $book['book_author'] ?></td>
                                            <td><?= $book['datepublish'] ?></td>
                                            <td> <a href="/deleteBook/<?= $book['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editBook/<?= $book['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
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

                              
              <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Add/Update Book List</h5>
                      </div>
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

                        <label for="datePublish">Date Publish</label>
                        <input type="date" class="form-control" id="datePublish" name="datePublish" placeholder="Enter Date Publish" 
                        value="<?php if (isset($booke['datepublish'])) {echo $booke['datepublish'];}?>" required>
                    </div>
                    
                    <!-- Move the "Save changes" button inside the form -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
                            <h3 class="card-title">Borrower List</h3>
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
                                        <th>Book Id</th>
                                        <th>Student ID</th>
                                        <th>Date Borrowed</th>
                                        <th>Date Return</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($borrowedBook as $book): ?>
                                    <tr>
                                            <td><?= $book['id'] ?></td>
                                            <td><?= $book['book_id'] ?></td>
                                            <td><?= $book['student_id'] ?></td>
                                            <td><?= $book['date_borrowed'] ?></td>
                                            <td><?= $book['date_return'] ?></td>
                                            <td><?= $book['status'] ?></td>
                                            <td> <a href="/deleteBorrow/<?= $book['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="/editBorrow/<?= $book['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                           
                                           
                                          
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
                    
                <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Update Borrow List</h5>
                      </div>
                      <form action="/saveBorrowedBook" method="post">
                    <!-- Add your form fields and content here -->
                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($borrowed['id'])) {echo $borrowed['id'];}?>">

                        <label for="book_id">Book Id</label>
                        <input type="text" class="form-control" id="book_id" name="book_id" placeholder="Enter Book Id"                         
                        value="<?php if (isset($borrowed['book_id'])) {echo $borrowed['book_id'];}?>" required> 

                        <label for="studIDnum">Student ID Number</label>
                        <input type="text" class="form-control" id="studIDnum" name="studIDnum" placeholder="Enter Student ID Number"                         
                        value="<?php if (isset($borrowed['student_id'])) {echo $borrowed['student_id'];}?>" required>

                        <label for="dateBorrowed">Date Borrowed</label>
                        <input type="datetime-local" class="form-control" id="dateBorrowed" name="dateBorrowed" placeholder="Select Date Borrowed"
                        value="<?php if (isset($borrowed['date_borrowed'])) {echo $borrowed['date_borrowed'];}?>" required>

                        <label for="dateReturn">Date Return</label>
                        <input type="datetime-local" class="form-control" id="dateReturn" name="dateReturn" placeholder="Select Date Return"
                        value="<?php if (isset($borrowed['date_return'])) {echo $borrowed['date_return'];}?>" required>

                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status"                         
                                        value="<?php if (isset($borrowed['status'])) {echo $borrowed['status'];}?>" required>
                                            <option value="Pending">Pending</option>
                                            <option value="On Borrow">On Borrow</option>
                                            <option value="Returned">Returned</option>
                                        </select>
                    </div>

                    <!-- Move the "Save changes" button inside the form -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                      </div>
                    </div>
                  </div>
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
  </div>
  <!-- / Layout wrapper -->

</body>

</html>
