function exportarExcel() {
    var ruta = window.location.pathname;
    var archivo = ruta.substring(ruta.lastIndexOf("/") + 1).replace(".php", "") + ".xlsx";

    var tabla = document.querySelector(".Custom_Table");
    var wb = XLSX.utils.table_to_book(tabla, { sheet: "Tabla_Exportada" });

    XLSX.writeFile(wb, archivo);
}
