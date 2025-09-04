// js/principal.js
// Funcionalidad de navegación
document.addEventListener('DOMContentLoaded', function() {
    // Manejar mensajes de sesión PHP
    if (typeof PHP_MESSAGES !== 'undefined') {
        mostrarMensaje(PHP_MESSAGES.tipo, PHP_MESSAGES.mensaje);
    }
    
    // Funcionalidad de búsqueda en tablas
    const inputsBusqueda = document.querySelectorAll('input[data-busqueda]');
    inputsBusqueda.forEach(input => {
        input.addEventListener('keyup', function() {
            const tablaId = this.getAttribute('data-busqueda');
            buscarEnTabla(this.value, tablaId);
        });
    });
});

function buscarEnTabla(query, tableId) {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    const rows = table.getElementsByTagName('tr');
    const searchQuery = query.toLowerCase();
    
    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');
        let found = false;
        
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().includes(searchQuery)) {
                found = true;
                break;
            }
        }
        
        row.style.display = found ? '' : 'none';
    }
}

function confirmarEliminacion(mensaje) {
    return confirm(mensaje || '¿Está seguro de eliminar este registro?');
}

function mostrarMensaje(tipo, mensaje) {
    // Implementar lógica para mostrar mensajes estilo toast
    console.log(tipo + ': ' + mensaje);
}