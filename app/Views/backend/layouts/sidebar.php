<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <!-- <img src="assets/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">HFD APP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url(); ?>assets/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info text-center">
                <a href="#" class="d-block text-white"><?= strlen(session()->get('name')) > 22 ? substr(session()->get('name'), 0, 22) . ".." : session()->get('name') ?> <br>(<?= strtoupper(session()->get('level')) ?>)</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= url_to('backend.dashboard.view'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <?php $level = session()->get('level') ?>
                <?php if ($level == 'admin' || $level == 'superadmin') : ?>
                    <!-- <li class="nav-header">MASTER DATA</li> -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Master Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('backend.category.view') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('backend.item.view'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Items</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- ===== -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Transaksi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('backend.transaction.form.view'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Form</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('backend.transaction.lists.view') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lists</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>

                <?php if ($level == 'pimpinan' || $level == 'superadmin') : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Reports
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= url_to('backend.report.a_reports.view') ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Report A</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= url_to('backend.report.b_reports.view'); ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Report B</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>

                <?php if ($level == 'superadmin') : ?>
                    <li class="nav-item">
                        <a href="<?= url_to('backend.user.view'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                <?php endif ?>

                <li class="nav-item">
                    <a href="<?= url_to('backend.setting.view'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>