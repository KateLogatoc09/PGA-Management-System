<?php
$config    = new \Config\Encryption(); 
$encrypter = \Config\Services::encrypter($config);
// Define the number of records per page
$recordsPerPage = 5;

// Calculate the total number of pages
$totalPages = ceil(count($schedule) / $recordsPerPage);

// Get the current page number from the query string, default to 1 if not set
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Calculate the offset for the subset of records to be displayed on the current page
$offset = ($currentPage - 1) * $recordsPerPage;

// Get a subset of records for the current page
$scheduleSubset = array_slice($schedule, $offset, $recordsPerPage);
?>
<?= $this->include('AAC/head') ?>
<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('AAC/nav') ?>
        <?= $this->include('AAC/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

 <div class="col-lg-18 mb-4 order-0">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Schedule of <?php if (isset($teacher['fname'])) {echo $teacher['fname'];}?> <?php if (isset($teacher['mname'])) {echo $teacher['mname'];}?> <?php if (isset($teacher['lname'])) {echo $teacher['lname'];}?></h3>
                            <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 400px;">
                      <form action="/searchTeacherSchedule/<?php echo bin2hex($encrypter->encrypt(isset($teacher['id']))); ?>" method="get">
                        <div class="input-group-append">
                        <input type="text" name="search" class="form-control float-right me-2" placeholder="Search">
                        <select class="form-control" name="categ">
                              <option value="day">Day</option>
                              <option value="subject">Subject</option>
                              <option value="start_time">Period Start</option>
                              <option value="end_time">Period End</option>
                              <option value="name">Section</option>
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
                                        <th>Day</th>
                                        <th>Subject</th>
                                        <th>Start Time</th> 
                                        <th>End Time</th>
                                        <th>Section</th>
                                        <th>Teacher</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $x = 1; foreach ($scheduleSubset as $ad): ?>
                                    <tr>
                                            <td><?= $ad['day'] ?></td>
                                            <td><?= $ad['subject'] ?></td>
                                            <td><?= $ad['start_time'] ?></td>
                                            <td><?= $ad['end_time'] ?></td>
                                            <td><?= $ad['name'] ?></td>
                                            <td><?= $ad['lname'] ?>, <?= $ad['fname'] ?> <?= $ad['mname'] ?></td>
                                            <td> <a href="/deleteTeacherSchedule/<?php echo bin2hex($encrypter->encrypt($ad['id'])); ?>" class="btn btn-danger btn-sm" id="d<?=$x?>">Delete</a>
                                            <a href="/editTeacherSchedule/<?php echo bin2hex($encrypter->encrypt($ad['id'])); ?>/<?php echo bin2hex($encrypter->encrypt($teacher['id'])); ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                        <h5 class="card-title text-primary">Add/Edit Schedule</h5>
                      </div>
                <form action="/saveSchedule" method="post"  id='form'>
                  <div id="outer" class="row">
                    <div class="col-sm-5">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                      <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($sched['id'])) {echo $sched['id'];}?>">

                                        <label for="day">Day:</label>
                                        <select class="form-control" name="day1" id="day">
                                        <option value="">Select Day</option>
                                          <option value="Monday" <?php if(isset($sched["day"])) { if($sched["day"] == "Monday") { echo "selected"; }} ?>>Monday</option>
                                            <option value="Tuesday" <?php if(isset($sched["day"])) { if($sched["day"] == "Tuesday") { echo "selected"; }} ?>>Tuesday</option>
                                            <option value="Wednesday" <?php if(isset($sched["day"])) { if($sched["day"] == "Wednesday") { echo "selected"; }} ?>>Wednesday</option>
                                            <option value="Thursday" <?php if(isset($sched["day"])) { if($sched["day"] == "Thursday") { echo "selected"; }} ?>>Thursday</option>
                                            <option value="Friday" <?php if(isset($sched["day"])) { if($sched["day"] == "Friday") { echo "selected"; }} ?>>Friday</option>
                                            <option value="Saturday" <?php if(isset($sched["day"])) { if($sched["day"] == "Saturday") { echo "selected"; }} ?>>Saturday</option>
                                        </select>

                                        <label for="subject">Subject/Activity:</label>
                                        <select name="subject1" id="subject" class="form-control">
                                        <option value="">Select Subject/Activity</option>
                                        <option value="Home Room With Class Adviser" <?php if(isset($sched["subject"])) { if($sched["subject"] == "Home Room With Class Adviser") { echo "selected"; }} ?>>Home Room With Class Adviser</option>
                                        <option value="Lunch Break" <?php if(isset($sched["subject"])) { if($sched["subject"] == "Lunch Break") { echo "selected"; }} ?>>Lunch Break</option>
                                        <option value="Health Break" <?php if(isset($sched["subject"])) { if($sched["subject"] == "Health Break") { echo "selected"; }} ?>>Health Break</option>
                                            <?php foreach ($subject as $se):?> 
                                                <option value="<?= $se['subject_name'] ?>" <?php if(isset($sched["subject"])) { if($sched["subject"] == $se['subject_name']) { echo "selected"; }} ?>><?= $se['subject_name'] ?></option> 
                                            <?php endforeach; ?>
                                        </select> 

                                        <label for="start_time">Period Start:</label>
                                        <input type="time" class="form-control" name="start_time1" id="start_time" placeholder="Period Start"
                                        value="<?php if (isset($sched['start_time'])) {echo $sched['start_time'];}?>">


                                        </div>
                    </div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
                                        <label for="end_time">Period End:</label>
                                        <input type="time" class="form-control" name="end_time1" id="end_time" placeholder="Period End"
                                        value="<?php if (isset($sched['end_time'])) {echo $sched['end_time'];}?>">

                                        <label for="section_id">Section:</label>
                                        <select name="section_id" id="section_id" class="form-control">
                                        <option value="">Select Section</option>
                                            <?php foreach ($section as $se):?> 
                                                <option value="None" <?php if(isset($sched["section_id"])) { if($sched["section_id"] == $se['id']) { echo "selected"; }} ?>><?= $se['name'] ?></option> 
                                            <?php endforeach; ?>
                                        </select> 
                                        
                                        <label for="teacher_id">Teacher:</label>
                                        <input type="text" class="form-control" name="teacher_id1" placeholder="teacher"
                                        value="<?php if (isset($teacher['id'])) {echo $teacher['idnum'];}?>" readonly>

                      
  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
<button class="btn btn-primary" id="add">Add Another</button>
<button class="btn btn-danger hidden" id="remove">Remove</button>
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
const add = document.getElementById('add');
const remove = document.getElementById('remove');
const outer = document.getElementById('outer');
var x = 0;
var y = 1;
var z = 2;
const opt = '<option value="Select Day">Select Day</option><option value="Monday">Monday</option><option value="Tuesday">Tuesday</option><option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option><option value="Friday">Friday</option><option value="Saturday">Saturday</option>';
const subfopt ='<option value="">Select Subject/Activity</option><option value="Home Room With Class Adviser" <?php if(isset($sched["subject"])) { if($sched["subject"] == "Home Room With Class Adviser") { echo "selected"; }} ?>>Home Room With Class Adviser</option><option value="Lunch Break" <?php if(isset($sched["subject"])) { if($sched["subject"] == "Lunch Break") { echo "selected"; }} ?>>Lunch Break</option><option value="Health Break" <?php if(isset($sched["subject"])) { if($sched["subject"] == "Health Break") { echo "selected"; }} ?>>Health Break</option>';

let subjectoptions = "<?php foreach($subject as $se): ?><option value='<?= $se['subject_name'] ?>' <?php if(isset($sched["subject"])) { if($sched["subject"] == $se['subject_name']) { echo "selected"; }} ?>><?= $se['subject_name'] ?></option><?php endforeach;?>" ;
var selsubject = document.getElementById('subject');

const secopt ='<option value="">Select Section</option>';

let sectionoptions = "<?php foreach($section as $sec): ?><option value='<?= $sec['name'] ?>' <?php if(isset($sched["section_id"])) { if($sched["section_id"] == $sec['name']) { echo "selected"; }} ?>><?= $sec['name'] ?></option><?php endforeach;?>" ;
var selsection = document.getElementById('name');

const create = function () {
  window['hr' + y] = document.createElement("hr");
  window['hr' + y].setAttribute("style", "width: 92%;margin-left:30px");
  outer.appendChild(window['hr' + y]);

  window['div' + y] = document.createElement("div");
  window['div' + y].className = "col-sm-5";
  window['div' + y].setAttribute("id", "div" + y); // set the CSS class
  outer.appendChild(window['div' + y]); // put it into the DOM

  y++;

  window['div' + y] = document.createElement("div");
  window['div' + y].className = "form-group margin-left";
  window['div' + y].setAttribute("id", "div" + y); // set the CSS class
  window['div' + (y - 1)].appendChild(window['div' + y]);

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Day:";
  window['label' + x].setAttribute("for", "day" + z);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("select");
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "day" + z);
  window['input' + x].innerHTML = opt;
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Subject/Activity:";
  window['label' + x].setAttribute("for", "subject" + z);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("select");
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "subject" + z);
  window['input' + x].innerHTML = subfopt+subjectoptions;
  window['div' + y].appendChild(window['input' + x]);

  x++;

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Period Start:";
  window['label' + x].setAttribute("for", "start_time" + z);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "time";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "start_time" + z);
  window['input' + x].setAttribute("placeholder", "Select Period");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;
  y++;

  window['div' + y] = document.createElement("div");
  window['div' + y].className = "col-sm-5 text-center text-sm-left";
  window['div' + y].setAttribute("id", "div" + y); // set the CSS class
  outer.appendChild(window['div' + y]); // put it into the DOM

  y++;

  window['div' + y] = document.createElement("div");
  window['div' + y].className = "form-group margin-left";
  window['div' + y].setAttribute("id", "div" + y); // set the CSS class
  window['div' + (y - 1)].appendChild(window['div' + y]); // put it into the DOM

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Period End:";
  window['label' + x].setAttribute("for", "end_time" + z);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "time";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "end_time" + z);
  window['input' + x].setAttribute("placeholder", "Select Period End");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Section:";
  window['label' + x].setAttribute("for", "section" + z);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("select");
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "section" + z);
  window['input' + x].innerHTML = sectionoptions;
  window['div' + y].appendChild(window['input' + x]);

  x++;

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Teacher:";
  window['label' + x].setAttribute("for", "teacher" + z);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "text";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "teacher" + z);
  window['input' + x].setAttribute("value", "<?php if (isset($teacher['id'])) {echo $teacher['idnum'];}?>");
  window['input' + x].setAttribute("readonly", true);
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;
  y++;
  z++;

  remove.classList.remove("hidden");
}

const rem = function () {
  if(y > 1) {
    y--;
    if(y === 1) {
      window['div' + (y - 1)].removeChild(window['div' + y]);
      outer.removeChild(window['div' + (y - 1)]);
      window['div' + (y - 3)].removeChild(window['div' + (y - 2)]);
      outer.removeChild(window['div' + (y - 3)]);
      outer.removeChild(window['hr' + (y - 3)]);
      remove.classList.add("hidden");
    } else { 
      console.log(y);
      window['div' + (y - 1)].removeChild(window['div' + y]);
      outer.removeChild(window['div' + (y - 1)]);
      window['div' + (y - 3)].removeChild(window['div' + (y - 2)]);
      outer.removeChild(window['div' + (y - 3)]);
      outer.removeChild(window['hr' + (y - 3)]);
    }
  }
}


add.addEventListener('click', create);
remove.addEventListener('click', rem);

</script>

  <script>
  <?php $y = 1; foreach ($scheduleSubset as $ad): ?>
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
