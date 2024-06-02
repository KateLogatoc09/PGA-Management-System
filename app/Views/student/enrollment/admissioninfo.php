<?= $this->include('student/head') ?>
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
          <center><h1 class="white">Admission Information</h1></center>
            <div class="row">
              
            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                <h5 class="card-title text-primary">Fill out the following fields</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-5">
                    <form action="/saveadmissions" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <div class="form-group margin-left">
                
                                        <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($admissions['id'])) {echo $admissions['id'];}?>">
                        
                                        <label for="category">Student Category:</label>
                                        <select class="form-control" name="category" id="category" required>
                                            <option value="">Select Category</option>
                                            <option value="Continuing">Continuing</option>
                                            <option value="Transferee">Transferee</option>
                                            <option value="Returnee">Returnee</option>
                                        </select>

                                        <label for="yr_lvl">Year Level:</label>
                                        <select class="form-control" name="yr_lvl" id="yr_lvl" required>
                                            <option value="">Select Year Level</option>
                                            <option value="Kinder 1">Kinder 1</option>
                                            <option value="Kinder 2">Kinder 2</option>
                                            <option value="Grade 1">Grade 1</option>
                                            <option value="Grade 2">Grade 2</option>
                                            <option value="Grade 3">Grade 3</option>
                                            <option value="Grade 4">Grade 4</option>
                                            <option value="Grade 5">Grade 5</option>
                                            <option value="Grade 6">Grade 6</option>
                                            <option value="Grade 7">Grade 7</option>
                                            <option value="Grade 8">Grade 8</option>
                                            <option value="Grade 9">Grade 9</option>
                                            <option value="Grade 10">Grade 10</option>
                                            <option value="Grade 11">Grade 11</option>
                                            <option value="Grade 12">Grade 12</option>
                                        </select>

                                        <label for="program">Strand/Program:</label>
                                        <select class="form-control" name="program" id="program" required>
                                        <option value="">Select Strand</option>
                                            <option value="None">None</option>
                                            <option value="STEM">STEM</option>
                                            <option value="ABM">ABM</option>
                                            <option value="HUMMS">HUMMS</option>
                                        </select>

                                        <label for="specialization">Specialization:</label>
                                        <input type="text" class="form-control" name="specialization" placeholder="Type N/A if not applicable" required>

                                        <label for="school_year">School Year:</label>
                                        <input type="text" class="form-control" name="school_year" placeholder="Ex: 2023-2024" required>

                                        </div>
</div>
<div class="col-sm-5 text-center text-sm-left">
  <div class="form-group margin-left">

  
  <label for="birth" class="hidden" id="birthlabel">Birth Certificate:</label>
                                        <input
                                        type="file"
                                        class="form-control hidden"
                                        id="birth"
                                        accept="image/png, image/jpeg"
                                        name="birth"
                                        />

                                        <label for="report" class="hidden" id="reportlabel">Report Card:</label>
                                        <input
                                        type="file"
                                        class="form-control hidden"
                                        id="report"
                                        accept="image/png, image/jpeg"
                                        name="report"
                                        />

                                        <label for="moral" class="hidden" id="morallabel">Good Moral:</label>
                                        <input
                                        type="file"
                                        class="form-control hidden"
                                        id="moral"
                                        accept="image/png, image/jpeg"
                                        name="moral"
                                        />

                                        <label for="2by2" class="hidden" id="2by2label">2x2 Photo:</label>
                                        <input
                                        type="file"
                                        class="form-control hidden"
                                        id="2by2"
                                        accept="image/png, image/jpeg"
                                        name="2by2"
                                        />
</div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="form-group">
    <hr>
    <center><a href="/address" class="btn btn-primary">Back</a>    
    <button type="submit" class="btn btn-primary">Next</button></center>
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
    //Continuing
const categ = document.getElementById('category');

const detect = function () { 
    if (categ.value == "Transferee") {
        document.getElementById("birth").classList.remove("hidden");
        document.getElementById("report").classList.remove("hidden");
        document.getElementById("moral").classList.remove("hidden");
        document.getElementById("2by2").classList.remove("hidden");
        document.getElementById("birth").required = true;
        document.getElementById("report").required = true;
        document.getElementById("moral").required = true;
        document.getElementById("2by2").required = true;
        document.getElementById("birthlabel").classList.remove("hidden");
        document.getElementById("reportlabel").classList.remove("hidden");
        document.getElementById("morallabel").classList.remove("hidden");
        document.getElementById("2by2label").classList.remove("hidden");
    } else {
        document.getElementById("birth").classList.add("hidden");
        document.getElementById("report").classList.add("hidden");
        document.getElementById("moral").classList.add("hidden");
        document.getElementById("2by2").classList.add("hidden");
        document.getElementById("birth").required = false;
        document.getElementById("report").required = false;
        document.getElementById("moral").required = false;
        document.getElementById("2by2").required = false;
        document.getElementById("birthlabel").classList.add("hidden");
        document.getElementById("reportlabel").classList.add("hidden");
        document.getElementById("morallabel").classList.add("hidden");
        document.getElementById("2by2label").classList.add("hidden");
    }
}

categ.addEventListener('change', detect);
  </script>
</body>
</html>

<?= $this->include('student/js') ?>


