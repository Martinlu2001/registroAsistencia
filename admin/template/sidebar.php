<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon ">
            <img src="" alt="logo" width="50" height="50">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">[]</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Pagina de inicio -->
    <li class="nav-item ">
        <a class="nav-link abe" href="./dashboard.php">
            <i class="fas fa-home"></i>
            <span>Inicio</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Usuarios
    </div>

    <!-- Administrar usuarios -->
    <li class="nav-item">
        <a class="nav-link collapsed abe" href="#" data-toggle="collapse" data-target="#collapseEstado"
            aria-expanded="true" aria-controls="collapseEstado">
            <i class="fas fa-user"></i>
            <span>Administrar usuarios</span>
        </a>
        <div id="collapseEstado" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-footer py-2 collapse-inner rounded">
                <a class="collapse-item" href="administrar_personal_seguridad.php">Personal de seguridad</a>
                <a class="collapse-item" href="administrar_abogados.php">Abogados</a>
                <a class="collapse-item userlink" href="administrar_usuarios.php">Usuarios</a>
            </div>
        </div>
    </li>
</ul>
<!-- End of Sidebar -->