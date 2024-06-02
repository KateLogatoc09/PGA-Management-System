  <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?=base_url()?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?=base_url()?>assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?=base_url()?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="<?=base_url()?>assets/vendor/libs/rateyo/jquery.rateyo.js"></script>

    <!-- Main JS -->
    <script src="<?=base_url()?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?=base_url()?>assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="assets/js/book.js"></script>

    <!-- SWEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JS -->
<script>
    <?php for($x = 1;$x <= 2;$x++): ?>
        document.getElementById("logout<?= $x?>").addEventListener("click", function (event) {
        event.preventDefault()
        //sweetalert2 code
        Swal.fire({
            title: 'PGA',
            text: "Are you sure?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
            window.location = $(this).attr('href');
            }
        })
        });
    <?php endfor; ?>

$(document).ready(function(){
            <?php if (isset($_SESSION['msg'])): ?>
                Swal.fire({
                    title: "PGA",
                    text: "<?= $_SESSION['msg'] ?>",
                    icon: "info",
                    showClass: {
                        popup: `
                        animate__animated
                        animate__fadeInUp
                        animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                        `
                    }
                });
            <?php endif; ?>

            <?php if (isset($_SESSION['validator'])): ?>
                Swal.fire({
                    title: "PGA",
                    text: "<?= $_SESSION['validator'] ?>",
                    icon: "info",
                    showClass: {
                        popup: `
                        animate__animated
                        animate__fadeInUp
                        animate__faster
                        `
                    },
                    hideClass: {
                        popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                        `
                    }
                });
            <?php endif; ?>
})
        </script>

    