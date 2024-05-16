<?php
// Define the number of records per page
$recordsPerPage = 5;

// Calculate the total number of pages
$totalPages = ceil(count($appli) / $recordsPerPage);

// Get the current page number from the query string, default to 1 if not set
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Get a subset of records for the current page
$appliSubset = array_slice($appli, $offset, $recordsPerPage);
?>

<body>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('registrar/nav') ?>
        <?= $this->include('registrar/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              
                
              <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Application List</h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchAppli" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                          <option value="fullname">Full Name</option>
                          <option value="email">Email</option>
                          <option value="type">Type</option>
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
                                        <th>Full Name</th>
                                        <th>Id</th>
                                        <th>Card</th>
                                        <th>Birth Certificate</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                        // Paginate the results
                        $start = ($currentPage - 1) * $recordsPerPage;
                        $end = $start + $recordsPerPage;
                        $appliSubset = array_slice($appli, $start, $recordsPerPage);
                        $x = 1;
                        foreach ($appliSubset as $applica):
                        ?>
                                    <tr>
                                            <td><?= $applica['fullname'] ?></td>
                                            <td><img
                                            src="<?= base_url().$applica['valid_id'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="id<?=$x?>"
                                            onclick="openFullscreenid<?=$x?>();"
                                            /></td>
                                            <td><img
                                            src="<?= base_url().$applica['card'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="c<?=$x?>"
                                            onclick="openFullscreenc<?=$x?>();"
                                            /></td>
                                            <td><img
                                            src="<?= base_url().$applica['birth_cert'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="b<?=$x?>"
                                            onclick="openFullscreenb<?=$x?>();"
                                            /></td>
                                            <td><?= $applica['email'] ?></td>
                                            <td><?= $applica['type'] ?></td>
                                            <td><?= $applica['status'] ?></td>
                                            <td> <a href="/deleteApplication/<?= $applica['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/editApplication/<?= $applica['id'] ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                           
                                           
                                          
                                     </tr>
                                <?php $x++; endforeach ?>
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
                        <h5 class="card-title text-primary">Edit Application</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveApplication" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($ap['id'])) {echo $ap['id'];}?>">
                        <label for="fullname">Fullname:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname" 
                        value="<?php if (isset($ap['fullname'])) {echo $ap['fullname'];}?>" readonly>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">

                        <label for="status">Status:</label>
                                        <select class="form-control" name="status" id="status">
                                        <option value="">Status</option>
                                            <option value="PENDING">Pending</option>
                                            <option value="APPROVED">Approved</option>
                                            <option value="REJECTED">Rejected</option>
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
  <script>    
    <?php $y = 1; foreach ($appliSubset as $applica): ?>

      function openFullscreenid<?=$y?>() {
        if (document.getElementById('id<?=$y?>').requestFullscreen) {
          document.getElementById('id<?=$y?>').requestFullscreen();
        } else if (document.getElementById('id<?=$y?>').webkitRequestFullscreen) { /* Safari */
          document.getElementById('id<?=$y?>').webkitRequestFullscreen();
        } else if (document.getElementById('id<?=$y?>').msRequestFullscreen) { /* IE11 */
          document.getElementById('id<?=$y?>').msRequestFullscreen();
        }
      }

      function openFullscreenb<?=$y?>() {
        if (document.getElementById('b<?=$y?>').requestFullscreen) {
          document.getElementById('b<?=$y?>').requestFullscreen();
        } else if (document.getElementById('b<?=$y?>').webkitRequestFullscreen) { /* Safari */
          document.getElementById('b<?=$y?>').webkitRequestFullscreen();
        } else if (document.getElementById('b<?=$y?>').msRequestFullscreen) { /* IE11 */
          document.getElementById('b<?=$y?>').msRequestFullscreen();
        }
      }

      function openFullscreenc<?=$y?>() {
        if (document.getElementById('c<?=$y?>').requestFullscreen) {
          document.getElementById('c<?=$y?>').requestFullscreen();
        } else if (document.getElementById('c<?=$y?>').webkitRequestFullscreen) { /* Safari */
          document.getElementById('c<?=$y?>').webkitRequestFullscreen();
        } else if (document.getElementById('c<?=$y?>').msRequestFullscreen) { /* IE11 */
          document.getElementById('c<?=$y?>').msRequestFullscreen();
        }
      }

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
    
    <?php $y++; endforeach ?>
  </script>
  <script src="assets/js/book.js"></script>
</body>

</html>
