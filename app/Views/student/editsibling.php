<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
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
          <center><h1 class="white">Family Background</h1></center>
            <div class="row">
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Edit Students' Sibling</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                <form action="/saveEditSibling" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                    <input type="hidden" class="form-control" name="id" value="<?php if (isset($sib['id'])) {echo $sib['id'];}?>">
                    
                                        <label for="fullname">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name"
                                        value="<?php if (isset($sib['fullname'])) {echo $sib['fullname'];}?>">
                                 
                                        <label for="yr_lvl">Year Level:</label>
                                        <select class="form-control" name="yr_lvl" id="yr_lvl">
                                            <option value="">Select Year Level</option>
                                            <option value="Kinder 1" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Kinder 1") { echo "selected"; }} ?>>Kinder 1</option>
                                            <option value="Kinder 2" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Kinder 2") { echo "selected"; }} ?>>Kinder 2</option>
                                            <option value="Grade 1" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 1") { echo "selected"; }} ?>>Grade 1</option>
                                            <option value="Grade 2" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 2") { echo "selected"; }} ?>>Grade 2</option>
                                            <option value="Grade 3" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 3") { echo "selected"; }} ?>>Grade 3</option>
                                            <option value="Grade 4" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 4") { echo "selected"; }} ?>>Grade 4</option>
                                            <option value="Grade 5" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 5") { echo "selected"; }} ?>>Grade 5</option>
                                            <option value="Grade 6" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 6") { echo "selected"; }} ?>>Grade 6</option>
                                            <option value="Grade 7" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 7") { echo "selected"; }} ?>>Grade 7</option>
                                            <option value="Grade 8" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 8") { echo "selected"; }} ?>>Grade 8</option>
                                            <option value="Grade 9" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 9") { echo "selected"; }} ?>>Grade 9</option>
                                            <option value="Grade 10" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 10") { echo "selected"; }} ?>>Grade 10</option>
                                            <option value="Grade 11" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 11") { echo "selected"; }} ?>>Grade 11</option>
                                            <option value="Grade 12" <?php if(isset($sib["yr_lvl"])) { if($sib["yr_lvl"] == "Grade 12") { echo "selected"; }} ?>>Grade 12</option>
                                            
                                        </select>

                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">
  <label for="affiliation">Affiliation:</label>
                                        <input type="text" class="form-control" name="affiliation" placeholder="Enter Affiliation"
                                        value="<?php if (isset($sib['affiliation'])) {echo $sib['affiliation'];}?>">
                                 
               
                        <input type="hidden" class="form-control" id="account_id" name="account_id" placeholder="Enter Account Id"                         
                        value="<?php if (isset($sib['account_id'])) {echo $sib['account_id'];}?>" required>             
  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
<a href="/student" class="btn btn-primary">Go Back</a>
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
<script>
const add = document.getElementById('add');
const remove = document.getElementById('remove');
const form = document.getElementById('form');
var x = 0;
var y = 1;
const opt = '<option value="Kinder 1">Kinder 1</option><option value="Kinder 2">Kinder 2</option><option value="Grade 1">Grade 1</option><option value="Grade 2">Grade 2</option><option value="Grade 3">Grade 3</option><option value="Grade 4">Grade 4</option><option value="Grade 5">Grade 5</option><option value="Grade 6">Grade 6</option><option value="Grade 7">Grade 7</option><option value="Grade 8">Grade 8</option><option value="Grade 9">Grade 9</option><option value="Grade 10">Grade 10</option><option value="Grade 11">Grade 11</option><option value="Grade 12">Grade 12</option>';

const create = function () {
  window['div' + y] = document.createElement("div");
  window['div' + y].className = "form-group margin-left";
  window['div' + y].setAttribute("id", "div" + y); // set the CSS class
  form.appendChild(window['div' + y]); // put it into the DOM

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Full Name:";
  window['label' + x].setAttribute("for", "fullname" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "text";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "fullname" + y);
  window['input' + x].setAttribute("placeholder", "Enter Full Name");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Year Level:";
  window['label' + x].setAttribute("for", "yr_lvl" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("select");
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "yr_lvl" + y);
  window['input' + x].innerHTML = opt;
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++

  window['label' + x] = document.createElement("label");
  window['label' + x].innerHTML = "Affiliation:";
  window['label' + x].setAttribute("for", "affiliation" + y);
  window['div' + y].appendChild(window['label' + x]); // put it into the DOM

  window['input' + x] = document.createElement("input");
  window['input' + x].type = "text";
  window['input' + x].className = "form-control";
  window['input' + x].setAttribute("name", "affiliation" + y);
  window['input' + x].setAttribute("placeholder", "Enter Affiliation");
  window['div' + y].appendChild(window['input' + x]); // put it into the DOM

  x++;
  y++;

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


