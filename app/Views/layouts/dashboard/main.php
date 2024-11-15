<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> <?= isset($title) ? $title : 'TITLE' ?> - <?= getenv('app.name') ?? 'APP NAME' ?></title>

    <link rel="icon" href="<?= base_url('/') ?>images/logo-sekolah.jpg" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('/') ?>sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('/') ?>sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('/') ?>sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- other -->
    <link href="<?= base_url('/') ?>select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?= base_url('/') ?>css/style.css" rel="stylesheet">
    <style>
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding: 0.375rem 0.7rem;
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px);
            padding: 0 0.75rem;
        }

        .select2-container--default .select2-results__option {
            padding-left: 0.7rem;
            padding-right: 0.7rem;
        }
    </style>

    <?= $this->renderSection('style') ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('layouts/dashboard/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= $this->include('layouts/dashboard/topbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?= $this->renderSection('content') ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?= $this->include('layouts/dashboard/footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?= $this->include('layouts/dashboard/logout-modal'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('/') ?>sbadmin2/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('/') ?>sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('/') ?>sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('/') ?>sbadmin2/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('/') ?>sbadmin2/vendor/chart.js/Chart.min.js"></script>
    <script src="<?= base_url('/') ?>sbadmin2/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('/') ?>sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('/') ?>sbadmin2/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url('/') ?>sbadmin2/js/demo/chart-pie-demo.js"></script>
    <script src="<?= base_url('/') ?>sbadmin2/js/demo/datatables-demo.js"></script>

    <!-- other -->
    <script src="<?= base_url('/') ?>select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <?= $this->renderSection('script') ?>
</body>

</html>