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

        <li class="menu-item">
            <a href="<?php echo BASE_URL; ?>/views/teacher/AnnotationsSearch.php">
                <i class="fa-solid fa-eye"></i>
                <span>Observador</span>
            </a>
        </li>

        <li class="menu-item has-submenu">
            <a class="submenu-btn">
                <i class="fa-solid fa-book"></i>
                <span>Materias</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo BASE_URL; ?>/views/matter/MtMatter.php?action=listarMATTER">Maestro Materias</a></li>
                <li><a href="<?php echo BASE_URL; ?>/views/matter/MatterXGrade.php">Materias Por Grado</a></li>
                <li><a href="<?php echo BASE_URL; ?>/views/admin/MtMatterxTeacher.php?action=listarMATTERxTEACHER">Maestro Materias x Docente</a></li>
            </ul>
        </li>

        <li class="menu-item has-submenu">
            <a class="submenu-btn">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Notas</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo BASE_URL; ?>/views/score/MtScore.php?action=listar">Maestro Notas</a></li>
                <li><a href="<?php echo BASE_URL; ?>/views/matter/MatterxTeacher.php?action=listarMATTERxTEACHER">Materias Docente</a></li>
                <li><a href="<?php echo BASE_URL; ?>/views/reports/ReportNotas.php">Boletines</a></li>
            </ul>
        </li>

        <li class="menu-item has-submenu">
            <a class="submenu-btn">
                <i class="fa-solid fa-list-ol"></i>
                <span>Grados y Grupos</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo BASE_URL; ?>/views/subject/MtGrades.php?action=listarGRDS">Maestro Grados</a></li>
                <li><a href="<?php echo BASE_URL; ?>/views/subject/MtGroups.php?action=listarGRPS">Maestro Grupos</a></li>
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
                <li><a href="<?php echo BASE_URL; ?>/views/admin/ManageUsers.php?action=listar">Docentes</a></li>
                <li><a href="<?php echo BASE_URL; ?>/views/admin/ManageStudents.php">Estudiantes</a></li>
            </ul>
        </li>

        <li class="menu-item has-submenu">
            <a class="submenu-btn">
                <i class="fa-solid fa-gear"></i>
                <span>Configuración</span>
                <i class="fa-solid fa-chevron-down arrow"></i>
            </a>
            <ul class="submenu">
                <li><a href="<?php echo BASE_URL; ?>/views/AnnotationTrigger.php">Historial Anotaciones</a></li>
            </ul>
        </li>
    </ul>
</aside>