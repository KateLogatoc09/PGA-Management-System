<body style="background-image:url('<?= base_url() ?>img/pgaBG.png');background-repeat:no-repeat;background-attachment:fixed;background-size:cover">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v19.0" nonce="AFffryss"></script>
<?php $session = session()?>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar d-flex align-items-center justify-content-center">
  <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <?= $this->include('general/nav') ?>
          <?php if($_SESSION['role'] == 'GENERAL'): ?>
        <?= $this->include('general/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'STUDENT'): ?>
        <?= $this->include('student/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'TEACHER'): ?>
        <?= $this->include('teacher/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'LIBRARIAN'): ?>
        <?= $this->include('library/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'PARENT'): ?>
        <?= $this->include('parent/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'REGISTRAR'): ?>
        <?= $this->include('registrar/sidebar') ?>
        <?php elseif($_SESSION['role'] == 'AAC'): ?>
        <?= $this->include('AAC/sidebar') ?>
        <?php endif; ?>
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

            <div class="col-lg-18 mb-4 order-0">
                <div class="card">
                <div class="card-body">
                        <h5 class="card-title text-primary">Rate our website and share your comments!</h5>
                      </div>
                  <div class="d-flex">
                    <div class="col-sm-11">
                <form action="/sendfeedback" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <input type="hidden" class="form-control" name="id" value="<?php if (isset($sfeed['id'])) {echo $sfeed['id'];}?>">
                  
                    <div class="form-group margin-left">
                        <label for="rateYo">Rating:</label> <small id="ratingnum"></small>
                        <div id="rateYo"></div>
                        <input type="hidden" name="rating" id="rating">
                                 
                      

  <label for="comment" class="form-label">Feedback/Comment</label>
  <textarea class="form-control" id="comment" name="comment" style="resize:none" rows="6"><?php if(isset($sfeed['comment'])) { echo $sfeed['comment']; }?></textarea>

  </div>
</div>
</div>

<!-- Move the "Save changes" button inside the form -->
<div class="modal-footer">
<button class="btn btn-primary" id="submit">Submit</button>
</div>
</form>
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
  
  $(function () {
 
  var $rateYo = $("#rateYo").rateYo();

// Setter
$("#rateYo").rateYo("option", "halfStar", true); //returns a jQuery Element
$("#rateYo").rateYo("option", "ratedFill", "#0790f2");
$("#rateYo").rateYo("option", "onSet", function () { $("#ratingnum").text($rateYo.rateYo("rating"));}); 

<?php if(isset($sfeed['rating'])): ?>
  $("#rateYo").rateYo("option", "rating", <?= $sfeed['rating']; ?>);
<?php endif; ?>
  $("#submit").click(function () {
    /* get rating */
    var rating = $rateYo.rateYo("rating");
    $("#rating").val(rating);
  });
 
});

</script>

</html>
