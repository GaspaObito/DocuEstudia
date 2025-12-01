document.addEventListener("DOMContentLoaded", () => {

    const sidebarToggle = document.getElementById("sidebarCollapse");
    const sidebar = document.getElementById("sidebar");

    // Abrir/cerrar sidebar
    sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("active");
    });

    // Submenus
    const submenuButtons = document.querySelectorAll(".submenu-btn");

    submenuButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const parent = btn.closest(".has-submenu");
            parent.classList.toggle("open");
        });
    });

});
