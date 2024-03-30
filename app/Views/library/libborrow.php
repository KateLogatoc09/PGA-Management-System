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
                                        <th>Account Id</th>
                                        <th>Student ID</th>
                                        <th>Fullname of Borrower</th>
                                        <th>Book Borrowed</th>
                                        <th>No. of Books Borrowed</th>
                                        <th>Date Borrowed</th>
                                        <th>Date Return</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($borrow as $book): ?>
                                    <tr>
                                            <td><?= $book['id'] ?></td>
                                            <td><?= $book['account_id'] ?></td>
                                            <td><?= $book['book_title'] ?></td>
                                            <td><?= $book['student_id'] ?></td>
                                            <td><?= $book['last_name'] ?>, <?= $book['first_name'] ?> <?= $book['middle_name'] ?></td>
                                            <td><?= $book['book_number'] ?></td>
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
                            <h3 class="card-title">Transactions</h3>
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
                                        <th>Book Borrowed</th>
                                        <th>Account ID</th>
                                        <th>Book Quantity</th>
                                        <th>Date Borrowed</th>
                                        <th>Date Return</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($borrow2 as $book): ?>
                                    <tr>
                                            <td><?= $book['id'] ?></td>
                                            <td><?= $book['book_title'] ?></td>
                                            <td><?= $book['account_id'] ?></td>
                                            <td><?= $book['book_qty'] ?></td>
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
                <div class="card-body">
                        <h5 class="card-title text-primary">Update List</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveBorrowedBook" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($borrowed['id'])) {echo $borrowed['id'];}?>">

                    <label for="book_id">Book Borrowed:</label>
                                        <select name="book_id" id="book_id" class="form-control">
                                        <option value="">Select Book</option>
                                            <?php foreach ($booky as $bk):?> 
                                                <option value="<?= $bk['id'] ?>"><?= $bk['book_title'] ?></option>
                                            <?php endforeach; ?>
                                        </select> 
                                        
                        <label for="book_qty">Book Quantity</label>
                        <input type="number" class="form-control" id="book_qty" name="book_qty" placeholder="Select Date Borrowed"
                        value="<?php if (isset($borrowed['book_qty'])) {echo $borrowed['book_qty'];}?>" required>

                        <label for="dateBorrowed">Date Borrowed</label>
                        <input type="datetime-local" class="form-control" id="dateBorrowed" name="dateBorrowed" placeholder="Select Date Borrowed"
                        value="<?php if (isset($borrowed['date_borrowed'])) {echo $borrowed['date_borrowed'];}?>" required>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                       <label for="dateReturn">Date Return</label>
                        <input type="datetime-local" class="form-control" id="dateReturn" name="dateReturn" placeholder="Select Date Return"
                        value="<?php if (isset($borrowed['date_return'])) {echo $borrowed['date_return'];}?>" required>

                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status"                         
                                        value="<?php if (isset($borrowed['status'])) {echo $borrowed['status'];}?>" required>
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
  </div>
  <!-- / Layout wrapper -->

</body>

</html>
