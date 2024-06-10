<?php
$current_route = $_SERVER['REQUEST_URI'];
?>

<aside class="main-sidebar sidebar-dark-info elevation-4 position-fixed">
    <!-- Logo de la marque -->
    <div class="d-flex flex-column align-items-center">
        <a href="/view/home.php" class="brand-link d-block">
            <img src="/view/assets/images/logo.png" class="brand-image img-circle elevation-3" alt="Image de groupe">
        </a>
        <span class="brand-text text-light font-weight-light text-center h6">CNMH</span>
    </div>

    <!-- Barre latérale -->
    <div class="sidebar">
        <!-- Menu latéral -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/view/home.php"
                        class="nav-link <?php echo (strpos($current_route, 'home') !== false) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Accueil
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="fa-solid fa-hospital-user"></i>
                        <p class="pl-2">
                            Dentiste
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="">
                        <li class="nav-item">

                            <a href="/view/Consultation/Dentiste/index.php"
                                class="nav-link <?php echo (strpos($current_route, 'index') !== false) ? 'active' : ''; ?>">
                                <p>Consultation</p>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href="/view/Consultation/Dentiste/seance.php" class="nav-link">
                                <p>Suiver de seance</p>
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