<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-custom-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-globe-asia"></i>
                </div>
                <div class="sidebar-brand-text mx-3">xyz <sup>app</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <?php foreach ($menu as $val) :; ?>
            <div class="sidebar-heading">
                <?= $val['menu'] ?>
            </div>

            <?php foreach ($val['submenu'] as $ven) :; ?>
            <!-- Nav Item - Dashboard -->
            <?php if (strtolower($title) == strtolower($ven['title'])) : ?>
            <li class="nav-item active">
                <?php else : ?>
            <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url() . $ven['field_url']; ?>">
                    <i class="<?= $ven['icon']; ?>"></i>
                    <span><?= ucfirst($ven['title']); ?></span></a>
            </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <?php endforeach; ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->