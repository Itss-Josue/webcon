    </div>

    <script>
        // Establecer fecha actual por defecto
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInput = document.getElementById('fecha_registro');
            if (fechaInput && !fechaInput.value) {
                const today = new Date().toISOString().split('T')[0];
                fechaInput.value = today;
            }

            // Validación de formulario
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const ruc = document.getElementById('ruc');
                    const razonSocial = document.getElementById('razon_social');
                    
                    if (ruc && !ruc.value.trim()) {
                        e.preventDefault();
                        alert('El campo RUC es obligatorio');
                        ruc.focus();
                        return;
                    }
                    
                    if (razonSocial && !razonSocial.value.trim()) {
                        e.preventDefault();
                        alert('El campo Razón Social es obligatorio');
                        razonSocial.focus();
                        return;
                    }
                });
            }
        });
    </script>
</body>
</html>