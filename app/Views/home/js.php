    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>lib/easing/easing.min.js"></script>
    <script src="<?= base_url() ?>lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="<?= base_url() ?>mail/jqBootstrapValidation.min.js"></script>
    <script src="<?= base_url() ?>mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url() ?>js/main.js"></script>

    <!-- SWEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JS -->
<script>

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