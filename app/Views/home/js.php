    <!-- JavaScript Libraries -->
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
        document.getElementById("logout3").addEventListener("click", function (event) {
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

<script>
    // Function to update the current date and time
    function updateDateTime() {
        // Get the current date and time
        var now = new Date();

        // Format the date and time
        var formattedDateTime = now.toLocaleString();

        // Set the formatted date and time to the h1 element
        document.getElementById("currentDateTime").textContent = formattedDateTime;
    }

    // Call the updateDateTime function to initially display the date and time
    updateDateTime();

    // Update the date and time every second
    setInterval(updateDateTime, 1000);
</script>