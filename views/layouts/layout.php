<?php use App\Services\Service; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://kit.fontawesome.com/6e56039614.js" crossorigin="anonymous"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-closed sidebar-collapse">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="." class="nav-link">Home</a>
            </li>
            <?php if (isset($items)) :;
                foreach ($items as $href => $title): ?>
                    <li class="nav-item mr-2">
                        <a href="<?= $href ?>" class="btn btn-success mb-1"><?= $title ?></a>
                    </li>
                <?php endforeach;
            endif; ?>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/logout" class="nav-link">Logout</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="/assets/dist/img/AdminLTELogo.png" alt="CRM" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">CRM</span>
        </a>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/index3.html" class="brand-link">
                <img src="/assets/dist/img/AdminLTELogo.png" alt="CRM" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">CRM</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/#"
                           class="d-block"><?= Service::findUserById($_SESSION['user_id'] ?? 0)['username'] ?? '' ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                               aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <?php  if ($_SESSION['user_role'] ?? 0 === 5 || !ENABLE_PERMISSION_CHECK) : ?>
                        <li class="nav-item">
                            <a href="/" class="nav-link <?= Service::is_active('/') ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users" class="nav-link <?= Service::is_active('/users') ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/roles" class="nav-link  <?= Service::is_active('/roles') ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Roles
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pages" class="nav-link <?= Service::is_active('/pages') ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Pages
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-header">ToDo</li>
                        <li class="nav-item">
                            <a href="/todo/categories" class="nav-link <?= Service::is_active('/todo/categories') ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Categories
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Tasks
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/todo/tasks" class="nav-link <?= Service::is_active('/todo/tasks') ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Opened</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/todo/tasks/completed"
                                       class="nav-link <?= Service::is_active('/todo/tasks/completed') ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Completed</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/todo/tasks/expired"
                                       class="nav-link <?= Service::is_active('/todo/tasks/expired') ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Expired</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $titlePage ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active"><?= $titlePage ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= $content ?>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>CRM <a href="/"></a></strong>

        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="/assets/dist/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/assets/dist/js/pages/dashboard.js"></script>
<!--<script src="/assets/js/main.js"></script>-->
<!--<script>-->
<!--    function updateRemainingTime() {-->
<!---->
<!--        const dueDateElements = document.querySelectorAll('.due-date');-->
<!--        const now = new Date();-->
<!---->
<!--        dueDateElements.forEach((element) => {-->
<!--            const dueDate = new Date(element.textContent);-->
<!--            const timeDiff = dueDate - now;-->
<!---->
<!--            if (timeDiff > 0) {-->
<!--                const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));-->
<!--                const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));-->
<!--                const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));-->
<!---->
<!--                element.textContent = `Days: ${days}  Hours: ${hours}`;-->
<!--            } else {-->
<!--                element.textContent = 'Time is up';-->
<!--            }-->
<!--        });-->
<!--    }-->
<!--    updateRemainingTime();-->
<!--    setInterval(updateRemainingTime, 60000); // Update every minute-->
<!--    document.addEventListener('DOMContentLoaded', function() {-->
<!---->
<!--        const sortButtons = document.querySelectorAll('.sort-btn');-->
<!---->
<!--        sortButtons.forEach((button) => {-->
<!--            button.addEventListener('click', function() {-->
<!--                const priority = button.getAttribute('data-priority');-->
<!--                sortTasksByPriority(priority);-->
<!--            });-->
<!--        });-->
<!--    });-->
<!---->
<!--    function sortTasksByPriority(priority) {-->
<!--        const tasksAccordion = document.querySelector('#task-container');-->
<!--        const tasks = Array.from(tasksAccordion.querySelectorAll('#task-container__item'));-->
<!---->
<!--        tasks.sort((a, b) => {-->
<!--            const aPriority = a.querySelector('.btn-priority').getAttribute('data-priority');-->
<!--            const bPriority = b.querySelector('.btn-priority').getAttribute('data-priority');-->
<!---->
<!--            if (aPriority === priority && bPriority !== priority) {-->
<!--                return -1;-->
<!--            } else if (aPriority !== priority && bPriority === priority) {-->
<!--                return 1;-->
<!--            } else {-->
<!--                return 0;-->
<!--            }-->
<!--        });-->
<!---->
<!--        tasks.forEach((task) => {-->
<!--            tasksAccordion.appendChild(task);-->
<!--        });-->
<!--    }-->
<!--</script>-->
<!--// Время-->
<!--<script>-->
<!--    document.addEventListener("DOMContentLoaded", function(){-->
<!--        flatpickr("#finish_date",{-->
<!--            enableTime: true,-->
<!--            noCalendar: false,-->
<!--            dateFormat: "Y-m-d H:00:00", // Дата и время без минут и секунд-->
<!--            time_24hr: true,-->
<!--            minuteIncrement: 30 // Интервал времени 1 час-->
<!--        });-->
<!--    });-->
<!--</script>-->

<style>
    body {
        /*overflow: hidden;*/
    }
</style>


</body>
</html>
