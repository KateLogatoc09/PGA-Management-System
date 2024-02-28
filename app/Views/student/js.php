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

    <!-- AlertJs -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- Custom JS -->
<script>
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
    
$(document).ready(function(){
            alertify.defaults = {
                // dialogs defaults
                autoReset:true,
                basic:false,
                closable:true,
                closableByDimmer:true,
                invokeOnCloseOff:false,
                frameless:false,
                defaultFocusOff:false,
                maintainFocus:true, // <== global default not per instance, applies to all dialogs
                maximizable:true,
                modal:true,
                movable:true,
                moveBounded:false,
                overflow:true,
                padding: true,
                pinnable:true,
                pinned:true,
                preventBodyShift:false, // <== global default not per instance, applies to all dialogs
                resizable:true,
                startMaximized:false,
                transition:'pulse',
                transitionOff:false,
                tabbable:'button:not(:disabled):not(.ajs-reset),[href]:not(:disabled):not(.ajs-reset),input:not(:disabled):not(.ajs-reset),select:not(:disabled):not(.ajs-reset),textarea:not(:disabled):not(.ajs-reset),[tabindex]:not([tabindex^="-"]):not(:disabled):not(.ajs-reset)',  // <== global default not per instance, applies to all dialogs

                // notifier defaults
                notifier:{
                // auto-dismiss wait time (in seconds)  
                    delay:5,
                // default position
                    position:'bottom-right',
                // adds a close button to notifier messages
                    closeButton: false,
                // provides the ability to rename notifier classes
                    classes : {
                        base: 'alertify-notifier',
                        prefix:'ajs-',
                        message: 'ajs-message',
                        top: 'ajs-top',
                        right: 'ajs-right',
                        bottom: 'ajs-bottom',
                        left: 'ajs-left',
                        center: 'ajs-center',
                        visible: 'ajs-visible',
                        hidden: 'ajs-hidden',
                        close: 'ajs-close'
                    }
                },

                // language resources 
                glossary:{
                    // dialogs default title
                    title:'PGA',
                    // ok button text
                    ok: 'OK',
                    // cancel button text
                    cancel: 'Cancel'            
                },

                // theme settings
                theme:{
                    // class name attached to prompt dialog input textbox.
                    input:'ajs-input',
                    // class name attached to ok button
                    ok:'ajs-ok',
                    // class name attached to cancel button 
                    cancel:'ajs-cancel'
                },
                // global hooks
                hooks:{
                    // invoked before initializing any dialog
                    preinit:function(instance){},
                    // invoked after initializing any dialog
                    postinit:function(instance){},
                },
            };
            
            <?php if (isset($_SESSION['msg'])): ?>
                alertify.alert('Note: <?= $_SESSION['msg'] ?>');
            <?php endif; ?>

            <?php if (isset($_SESSION['validator'])): ?>
                alertify.alert('Note: <?= implode($_SESSION['validator']) ?>');
            <?php endif; ?>
        });
        </script>
    