<?php
// Define the number of records per page
$recordsPerPage = 5;

// Calculate the total number of pages
$totalPages = ceil(count($permit) / $recordsPerPage);

// Get the current page number from the query string, default to 1 if not set
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Get a subset of records for the current page
$permitSubset = array_slice($permit, $offset, $recordsPerPage);
?>

<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
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
                            <h3 class="card-title">Permit List</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 400px;">
                                <form action="/searchpermit" method="get">
                                    <div class="input-group-append">
                                    <input type="text" name="table_search" class="form-control float-right me-2" placeholder="Search">
                                    <select class="form-control" name="categ">
                                        <option value="student_id">Student ID</option>
                                        <option value="first_name">First Name</option>
                                        <option value="middle_name">Middle Name</option>
                                        <option value="last_name">Last Name</option>
                                        <option value="yr_lvl">Year Level</option>
                                        <option value="name">Section</option>
                                        <option value="quarter">Quarter</option>
                                        <option value="permit.status">Status</option>
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
                                        <th>Student Id</th>
                                        <th>Student's Full Name</th>
                                        <th>Section</th>
                                        <th>Year Level</th>
                                        <th>Permit Photo</th>
                                        <th>Quarter</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                        // Paginate the results
                        $start = ($currentPage - 1) * $recordsPerPage;
                        $end = $start + $recordsPerPage;
                        $permitSubset = array_slice($permit, $start, $recordsPerPage);
                        $x = 1;
                        foreach ($permitSubset as $permi):
                        ?>
                                    <tr>
                                            <td><?= $permi['student_id'] ?></td>
                                            <td><?= $permi['first_name'] ?> <?= $permi['middle_name'] ?> <?= $permi['last_name'] ?></td>
                                            <td><?= $permi['name'] ?></td>
                                            <td><?= $permi['yr_lvl'] ?></td>
                                            <td><img
                                            src="<?= base_url().$permi['permit_photo'] ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="id<?=$x?>"
                                            onclick="openFullscreenid<?=$x?>();"
                                            /></td>
                                            <td><?= $permi['quarter'] ?></td>
                                            <td><?= $permi['date'] ?></td>
                                            <td><?= $permi['status'] ?></td>
                                            <td> <a href="/deletePermit/<?= $permi['id'] ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/editPermit/<?= $permi['id'] ?>" class="btn btn-primary btn-sm" id="d<?=$x?>">Edit</a></td>
                                           
                                           
                                          
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
                        <h5 class="card-title text-primary">Edit Permit</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveRegpermit" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" name="id" value="<?php if (isset($pe['id'])) {echo $pe['id'];}?>">
                        <label for="quarter">Quarter:</label>
                        <input type="number" class="form-control" name="quarter" placeholder="Enter Quarter" 
                        value="<?php if (isset($pe['quarter'])) {echo $pe['quarter'];}?>">

                        <label for="date">Date:</label>
                        <input type="datetime-local" class="form-control" name="date" placeholder="Enter Date" 
                        value="<?php if (isset($pe['date'])) {echo $pe['date'];}?>">

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">

                        <label for="status">Status:</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Select Status</option>    
                                        <option value="PENDING" <?php if(isset($pe["status"])) { if($pe["status"] == "PENDING") { echo "selected"; }} ?>>Pending</option>    
                                        <option value="ON PROCESS" <?php if(isset($pe["status"])) { if($pe["status"] == "ON PROCESS") { echo "selected"; }} ?>>On Process</option>  
                                        <option value="APPROVED" <?php if(isset($pe["status"])) { if($pe["status"] == "APPROVED") { echo "selected"; }} ?>>Approved</option>     
                                        <option value="REJECTED" <?php if(isset($pe["status"])) { if($pe["status"] == "REJECTED") { echo "selected"; }} ?>>Rejected</option>  
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
    <?php $y = 1; foreach ($permitSubset as $permi): ?>

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

<script>
$(document).ready(function() {
    $('#permitModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        $.ajax({
            url: '/editPermit/' + id,
            method: 'GET',
            success: function(data) {
                modal.find('.modal-body').html(data);
            },
            error: function() {
                modal.find('.modal-body').html('<p>Error loading user data.</p>');
            }
        });
    });
});
</script>
  <script src="assets/js/book.js"></script>
</body>

</html>
