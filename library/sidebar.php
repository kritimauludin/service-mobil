<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-text mx-3">Service APP</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url?>master/showdashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master
            </div>
            <?php if($_SESSION['akun']['role'] == 'superadmin'): ?>
            <!-- Nav Item - Admin -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url?>master/showAdmin.php">
                    <i class="fas fa-fw fa-user-shield"></i>
                    <span>Data Admin</span></a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php endif;?>
 
            <!-- Nav Item - Montir -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url?>master/showMontir.php">
                    <i class="fas fa-fw fa-user-injured"></i>
                    <span>Data Montir</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pelanggan -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url?>master/showPelanggan.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Pelanggan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Service -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url?>master/showService.php">
                    <i class="fas fa-fw fa-car-side"></i>
                    <span>Data Service</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
 
            <!-- Nav Item - Sparepart -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url?>master/showSparepart.php">
                    <i class="fas fa-fw fa-hammer"></i>
                    <span>Data Sparepart</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
 
            <?php if($_SESSION['akun']['role'] == 'superadmin'): ?>
            <!-- Nav Item - Report -->
            <li class="nav-item">
                <a class="nav-link" href="<?= $base_url?>master/showReport.php">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>Data Report</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <?php endif;?>
            
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>