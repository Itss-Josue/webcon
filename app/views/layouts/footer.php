<!-- Incluir script de alertas -->
<?php include __DIR__ . '/alerts.php'; ?>

<script>
// Función global para confirmaciones de eliminación
function confirmDelete(event, message = '¿Está seguro de eliminar este registro?') {
    event.preventDefault();
    const url = event.currentTarget.getAttribute('href');
    
    Swal.fire({
        title: '¿Está seguro?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

// Función para confirmaciones de regeneración de token
function confirmRegenerate(event) {
    event.preventDefault();
    const url = event.currentTarget.getAttribute('href');
    
    Swal.fire({
        title: 'Regenerar Token',
        text: '¿Está seguro de regenerar el token? El token anterior dejará de funcionar inmediatamente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f39c12',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Sí, regenerar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

// Función para confirmaciones de formulario
function confirmFormSubmit(form, message = '¿Está seguro de guardar los cambios?') {
    event.preventDefault();
    
    Swal.fire({
        title: 'Confirmar Acción',
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3498db',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
</body>
</html>