<button id="sidebarCollapse" class="toggle-btn">
    <i class="fa-solid fa-sliders"></i>
</button>

<aside class="sidebar" id="sidebar">
    <div class="sidebar__logo">
        <i class="fa-solid fa-graduation-cap"></i>
        <span>DocuEstudia</span>
    </div>

    <ul class="sidebar__menu">

        <li class="menu-item">
            <a href="<?php echo BASE_URL; ?>/views/reports/DashboardGeneral.php">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="menu-title">Gestión Académica</li>

        <li class="menu-item has-submenu">
            <a class="submenu-btn">
                <i class="fa-solid fa-book"></i>
                <span>Materias</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo BASE_URL; ?>/views/matter/MtMatter.php?action=listarMATTER">Maestro Materias</a></li>
                <li><a href="<?php echo BASE_URL; ?>/views/subject/MtGroups.php?action=listarGRPS">Materias Por Grado</a></li>
            </ul>
        </li>

        <li class="menu-item has-submenu">
            <a class="submenu-btn">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Notas</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="#">Registrar Nota</a></li>
                <li><a href="#">Boletines</a></li>
                <li><a href="#">Histórico</a></li>
            </ul>
        </li>

        <li class="menu-title">Administración</li>

        <li class="menu-item has-submenu">
            <a class="submenu-btn">
                <i class="fa-solid fa-user-gear"></i>
                <span>Usuarios</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo BASE_URL; ?>/views/subject/MtGroups.php?action=listarGRPS">Maestro Grupos</a></li>
                <li><a href="<?php echo BASE_URL; ?>/views/subject/MtGrades.php?action=listarGRDS">Maestro Grados</a></li>
                <li><a href="<?php echo BASE_URL; ?>/controllers/admin/ManageUsers.php?action=listar">Maestros</a></li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="#">
                <i class="fa-solid fa-gear"></i>
                <span>Configuración</span>
            </a>
        </li>
    </ul>
</aside>