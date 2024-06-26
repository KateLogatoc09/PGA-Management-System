<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Puerto Galera Academy</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?= base_url() ?>img/pga.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>css/style.css" rel="stylesheet">

    <!-- SWEETALERT2 -->
    <link href="../sweetalert/sweetalert2.css" rel="stylesheet">

    

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        /* Add your styles here */
        .active {
            font-weight: bold; /* or any other style to indicate the active link */
        }
    </style>
    <script>
        $(document).ready(function(){
            // Get the current page URL
            var currentLocation = window.location.pathname;

            // Remove leading slash from the current page URL
            currentLocation = currentLocation.substring(1);

            // Find the corresponding nav link and add the "active" class
            $('.navbar-nav a[href*="' + currentLocation + '"]').addClass('active');
        });
    </script>

    <!-- ONESIGNAL -->
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        window.OneSignalDeferred.push(async function(OneSignal) {
            await OneSignal.init({
                appId: "c18a35ec-6e89-4b4d-965d-53c7e23d53b8",
                notifyButton: {
                    enable: true
                },
                serviceWorkerParam: { scope: "/push/onesignal/" },
                serviceWorkerPath: "push/onesignal/OneSignalSDKWorker.js",
            });
        });
    </script>


</head>