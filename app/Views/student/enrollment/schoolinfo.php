<?= $this->include('student/head') ?>
<body>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('student/nav') ?>
        <?= $this->include('student/sidebar') ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
          <h1 class="card-title text-primary">School Information</h1>
          <p class="mb-10">
                          Fill Up The Following Fields.
                        </p>
            <div class="row">
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                    <form action="/saveschool" method="post" id="form">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                                        <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($school['id'])) {echo $school['id'];}?>">

                                    <label for="grade">Grade/Year:</label>
                                        <select class="form-control" name="grade" id="grade">
                                        <option value="Pre-School (Kinder)">Pre-School (Kinder)</option>
                                        <option value="Grade School (G1-G3)">Grade School (G1-G3)</option>
                                        <option value="Grade School (G4-G6)">Grade School (G4-G6)</option>
                                        <option value="Junior High School (G7-G10)">Junior High School (G7-G10)</option>
                                    </select>

                                    <label for="school_name">School Name:</label>
                                        <input type="text" class="form-control" name="school_name" placeholder="Enter Name of School">

                                    <label for="level">Level:</label>
                                        <input type="text" class="form-control" name="level" placeholder="Enter Level">
                               
                                    <label for="period">Period Covered:</label>
                                        <input type="text" class="form-control" name="period" placeholder="Enter Period Covered">

  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="form-group">
    <hr>
    <center><a href="/sibling" class="btn btn-primary">Back</a>
<button type="submit" class="btn btn-primary">Next</button></center>
</div>
</form>
<button class="btn btn-primary" id="add">Add Another</button>
<button class="btn btn-primary hidden" id="remove">Remove</button>
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
<script>
const add = document.getElementById('add');
const remove = document.getElementById('remove');
const form = document.getElementById('form');
var x = 0;
var y = 1;
const opt = '<option value="Pre-School (Kinder)">Pre-School (Kinder)</option><option value="Grade School (G1-G3)">Grade School (G1-G3)</option><option value="Grade School (G4-G6)">Grade School (G4-G6)</option><option value="Junior High School (G7-G10)">Junior High School (G7-G10)</option>';

const create = function () {
  //DIV
  window['div' + y] = document.createElement("div");
  window['div' + y].className = "form-group margin-left";
  window['div' + y].setAttribute("id", "div" + y); // set the CSS class
  form.appendChild(window['div' + y]); // put it into the DOM
  //GRADE
  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Grade/Year:";
  window['label' + x].setAttribute("for", "grade" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("select");
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "grade" + y);
  window['input' + x].setAttribute("required", "");
  window['input' + x].innerHTML = opt;
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;
  //SCHNAME
  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "School Name:";
  window['label' + x].setAttribute("for", "school_name" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "text";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "school_name" + y);
  window['input' + x].setAttribute("placeholder", "Enter Name of School");
  window['input' + x].setAttribute("required", "");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++
  //LEVEL
  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Level:";
  window['label' + x].setAttribute("for", "level" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "text";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "level" + y);
  window['input' + x].setAttribute("placeholder", "Enter Level");
  window['input' + x].setAttribute("required", "");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;
  //PERIOD
  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Period Covered:";
  window['label' + x].setAttribute("for", "period" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "text";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "period" + y);
  window['input' + x].setAttribute("placeholder", "Enter Period Covered");
  window['input' + x].setAttribute("required", "");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++
  y++;

  console.log(y);

  remove.classList.remove("hidden");
}

const rem = function () {
  if(y > 1) {
    y--;
    if(y === 1) {
    form.removeChild(window['div' + y]);
    remove.classList.add("hidden");
    } else { 
    form.removeChild(window['div' + y]);
    }
  }
}


add.addEventListener('click', create);
remove.addEventListener('click', rem);

</script>
</html>

<?= $this->include('student/js') ?>


