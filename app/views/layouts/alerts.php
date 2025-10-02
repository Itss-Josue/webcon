<?php
// Script para manejar alertas SweetAlert2
if (isset($_SESSION['flash'])): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '<?= addslashes($_SESSION['flash']) ?>',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#3498db'
    });
});
</script>
<?php unset($_SESSION['flash']); endif; ?>

<?php if (isset($_SESSION['error'])): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'error',
        title: '¡Error!',
        text: '<?= addslashes($_SESSION['error']) ?>',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#e74c3c'
    });
});
</script>
<?php unset($_SESSION['error']); endif; ?>

<?php if (isset($_SESSION['new_token'])): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'info',
        title: 'Nuevo Token Generado',
        html: `
            <div style="text-align: left;">
                <p><strong>Token:</strong></p>
                <code style="background: #f8f9fa; padding: 10px; border-radius: 5px; display: block; word-break: break-all; font-size: 12px;">
                    <?= addslashes($_SESSION['new_token']) ?>
                </code>
                <p style="color: #e74c3c; margin-top: 10px; font-size: 12px;">
                    ⚠️ <strong>Importante:</strong> Guarde este token en un lugar seguro. No podrá verlo nuevamente.
                </p>
            </div>
        `,
        confirmButtonText: 'Copiar Token',
        showCancelButton: true,
        cancelButtonText: 'Cerrar',
        confirmButtonColor: '#3498db'
    }).then((result) => {
        if (result.isConfirmed) {
            // Copiar token al portapapeles
            const token = '<?= addslashes($_SESSION['new_token']) ?>';
            navigator.clipboard.writeText(token).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Token Copiado',
                    text: 'El token ha sido copiado al portapapeles',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        }
    });
});
</script>
<?php unset($_SESSION['new_token']); endif; ?>