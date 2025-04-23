<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed" ng-app="apps">

<head>
    <title>Empire | B4+ admin template by Srthemesvilla</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Empire Bootstrap admin template made using Bootstrap 4, it has tons of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="Empire, bootstrap admin template, bootstrap admin panel, bootstrap 4 admin template, admin template">
    <meta name="author" content="Srthemesvilla" />
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="/assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="/assets/fonts/ionicons.css">
    <link rel="stylesheet" href="/assets/fonts/linearicons.css">
    <link rel="stylesheet" href="/assets/fonts/open-iconic.css">
    <link rel="stylesheet" href="/assets/fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="/assets/fonts/feather.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="/assets/css/bootstrap-material.css">
    <link rel="stylesheet" href="/assets/css/shreerang-material.css">
    <link rel="stylesheet" href="/assets/css/uikit.css">

    <!-- Libs -->
    <link rel="stylesheet" href="/assets/libs/perfect-scrollbar/perfect-scrollbar.css">
</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ Layout wrapper ] Start -->
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            <!-- [ Layout sidenav ] Start -->
             <?= view('layout/menu')?>
            <!-- [ Layout sidenav ] End -->
            <!-- [ Layout container ] Start -->
            <div class="layout-container">
                <!-- [ Layout navbar ( Header ) ] Start -->
                <?= view('layout/header')?>
                <!-- [ Layout navbar ( Header ) ] End -->

                <!-- [ Layout content ] Start -->
                <div class="layout-content">

                    <!-- [ content ] Start -->
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <h4 class="font-weight-bold py-3 mb-0">Layouts and elements</h4>
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item">Forms</li>
                                <li class="breadcrumb-item active">Layouts and elements</li>
                            </ol>
                        </div>
                        <?= $this->renderSection('content');?>
                    </div>
                    <!-- [ content ] End -->

                    <!-- [ Layout footer ] Start -->
                    <nav class="layout-footer footer bg-white">
                        <div class="container-fluid d-flex flex-wrap justify-content-between text-center container-p-x pb-3">
                            <div class="pt-3">
                                <span class="footer-text font-weight-semibold">&copy; <a href="https://srthemesvilla.com" class="footer-link" target="_blank">Srthemesvilla</a></span>
                            </div>
                            <div>
                                <a href="javascript:" class="footer-link pt-3">About Us</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Help</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Contact</a>
                                <a href="javascript:" class="footer-link pt-3 ml-4">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </nav>
                    <!-- [ Layout footer ] End -->

                </div>
                <!-- [ Layout content ] Start -->

            </div>
            <!-- [ Layout container ] End -->

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- [ Layout wrapper ] end -->

    <!-- Core scripts -->
    <script src="/assets/js/pace.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/libs/popper/popper.js"></script>
    <script src="/assets/js/bootstrap.js"></script>
    <script src="/assets/js/sidenav.js"></script>
    <script src="/assets/js/layout-helpers.js"></script>
    <script src="/assets/js/material-ripple.js"></script>

    <!-- Libs -->
    <script src="/assets/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <!-- Demo -->
    <script src="/assets/js/demo.js"></script><script src="/assets/js/analytics.js"></script>
    <script src="/angular/angular.js"></script>
    <script src="/js/apps.js"></script>
    <script src="<?= base_url() ?>/libs/angular/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.8.2/angular-sanitize.min.js" integrity="sha512-JkCv2gG5E746DSy2JQlYUJUcw9mT0vyre2KxE2ZuDjNfqG90Bi7GhcHUjLQ2VIAF1QVsY5JMwA1+bjjU5Omabw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.30/angular-ui-router.min.js" integrity="sha512-HdDqpFK+5KwK5gZTuViiNt6aw/dBc3d0pUArax73z0fYN8UXiSozGNTo3MFx4pwbBPldf5gaMUq/EqposBQyWQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-animate/1.8.2/angular-animate.min.js" integrity="sha512-jZoujmRqSbKvkVDG+hf84/X11/j5TVxwBrcQSKp1W+A/fMxmYzOAVw+YaOf3tWzG/SjEAbam7KqHMORlsdF/eA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url() ?>/js/apps.js"></script>
    <script src="<?= base_url() ?>/js/services/helper.services.js"></script>
    <script src="<?= base_url() ?>/js/services/auth.services.js"></script>
    <script src="<?= base_url() ?>/js/services/admin.services.js"></script>
    <script src="<?= base_url() ?>/js/services/pesan.services.js"></script>
    <script src="<?= base_url() ?>/js/controllers/admin.controllers.js"></script>
    <script src="<?= base_url() ?>/js/components/components.js"></script>
    <script src="<?= base_url() ?>/libs/angular-ui-select2/src/select2.js"></script>
    <script src="<?= base_url() ?>/libs/angular-datatables/dist/angular-datatables.js"></script>
    <script src="<?= base_url() ?>/libs/angular-locale_id-id.js"></script>
    <script src="<?= base_url() ?>/libs/input-mask/angular-input-masks-standalone.min.js"></script>
    <script src="<?= base_url() ?>/libs/jquery.PrintArea.js"></script>
    <script src="<?= base_url() ?>/libs/angular-base64-upload/dist/angular-base64-upload.min.js"></script>
    <script src="<?= base_url() ?>/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/btn.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/print.js"></script>
    <script src="<?= base_url() ?>/libs/loading/dist/loadingoverlay.min.js"></script>
    <script src="<?= base_url() ?>/libs/angularjs-currency-input-mask/dist/angularjs-currency-input-mask.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
</body>

</html>
