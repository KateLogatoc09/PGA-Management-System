  <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="assets/js/book.js"></script>

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
//previmg 
const prev = document.getElementById('uploadedAvatar');
    const imginput = document.getElementById('upload');

    imginput.addEventListener('change', function(){
    const [file] = imginput.files
    if (file) {
        prev.src = URL.createObjectURL(file)
    }
    });

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
    