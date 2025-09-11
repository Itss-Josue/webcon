<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente - WebDev Solutions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #3498db, #2ecc71, #f39c12, #e74c3c);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: #2c3e50;
            font-size: 2.2em;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .form-header p {
            color: #7f8c8d;
            font-size: 1.1em;
        }

        .form-header .icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8em;
        }

        .flash-message {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .flash-message i {
            font-size: 1.2em;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 0.95em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label i {
            color: #3498db;
        }

        .form-group input {
            padding: 15px 18px;
            border: 2px solid #ecf0f1;
            border-radius: 12px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            transform: translateY(-2px);
        }

        .form-group input:hover {
            border-color: #bdc3c7;
        }

        .form-group input[required] {
            border-left: 4px solid #e74c3c;
        }

        .form-group input[required]:focus {
            border-left: 4px solid #27ae60;
        }

        .required-indicator {
            color: #e74c3c;
            font-size: 0.8em;
            margin-left: 4px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-width: 140px;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(52, 152, 219, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            color: white;
            box-shadow: 0 8px 20px rgba(149, 165, 166, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(149, 165, 166, 0.4);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .input-help {
            font-size: 0.8em;
            color: #7f8c8d;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .input-help i {
            font-size: 0.9em;
        }

        /* Validation styles */
        .form-group input:valid:not(:focus) {
            border-color: #27ae60;
        }

        .form-group input:invalid:not(:focus):not(:placeholder-shown) {
            border-color: #e74c3c;
        }

        /* Loading animation */
        .btn-loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-loading::after {
            content: '';
            width: 16px;
            height: 16px;
            margin-left: 10px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .form-container {
                padding: 30px 20px;
                margin: 10px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .form-group.full-width {
                grid-column: span 1;
            }

            .form-actions {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                width: 100%;
            }

            .form-header h2 {
                font-size: 1.8em;
            }
        }

        /* Success animation */
        @keyframes success {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-animation {
            animation: success 0.5s ease-in-out;
        }

        /* Form background pattern */
        .form-container::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(46, 204, 113, 0.1));
            border-radius: 50%;
            transform: translate(30px, -30px);
            z-index: -1;
        }

        /* Floating labels effect */
        .form-group {
            position: relative;
        }

        .form-group input:focus + .floating-label,
        .form-group input:not(:placeholder-shown) + .floating-label {
            transform: translateY(-25px) scale(0.8);
            color: #3498db;
        }

        .floating-label {
            position: absolute;
            top: 15px;
            left: 18px;
            background: white;
            padding: 0 5px;
            transition: all 0.3s ease;
            pointer-events: none;
            color: #7f8c8d;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2>Crear Nuevo Cliente</h2>
            <p>Ingresa los datos del cliente para registrarlo en el sistema</p>
        </div>

        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="flash-message">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></span>
            </div>
        <?php endif; ?>

        <form action="/webcon/index.php?route=cliente:create" method="POST" id="clientForm">
            <div class="form-grid">
                <div class="form-group">
                    <label for="dni">
                        <i class="fas fa-id-card"></i>
                        DNI
                        <span class="required-indicator">*</span>
                    </label>
                    <input type="text" 
                           id="dni" 
                           name="dni" 
                           placeholder="Ingrese el DNI" 
                           required 
                           pattern="[0-9]{8}"
                           maxlength="8">
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Debe contener exactamente 8 dígitos
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user"></i>
                        Nombre Completo
                        <span class="required-indicator">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           placeholder="Ingrese el nombre completo" 
                           required
                           minlength="2">
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Nombre y apellidos del cliente
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="company">
                        <i class="fas fa-building"></i>
                        Empresa
                    </label>
                    <input type="text" 
                           id="company" 
                           name="company" 
                           placeholder="Nombre de la empresa (opcional)">
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Empresa o razón social del cliente
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">
                        <i class="fas fa-phone"></i>
                        Teléfono
                    </label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           placeholder="Ej: +51 999 123 456"
                           pattern="[\+]?[0-9\s\-\(\)]+">
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Número de contacto del cliente
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        Email
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           placeholder="ejemplo@correo.com">
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Correo electrónico de contacto
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="/webcon/index.php?route=admin:dashboard" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Guardar Cliente
                </button>
            </div>
        </form>
    </div>

    <script>
        // Form validation and enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('clientForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // DNI input formatting
            const dniInput = document.getElementById('dni');
            dniInput.addEventListener('input', function(e) {
                // Only allow numbers
                this.value = this.value.replace(/[^0-9]/g, '');
                
                // Limit to 8 characters
                if (this.value.length > 8) {
                    this.value = this.value.substr(0, 8);
                }
            });

            // Phone input formatting
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function(e) {
                // Allow numbers, spaces, parentheses, hyphens, and plus sign
                this.value = this.value.replace(/[^0-9\s\-\(\)\+]/g, '');
            });

            // Name input formatting
            const nameInput = document.getElementById('name');
            nameInput.addEventListener('input', function(e) {
                // Capitalize first letter of each word
                this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
            });

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                submitBtn.classList.add('btn-loading');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';
                submitBtn.disabled = true;
            });

            // Real-time validation feedback
            const inputs = form.querySelectorAll('input[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.validity.valid) {
                        this.style.borderColor = '#27ae60';
                    } else {
                        this.style.borderColor = '#e74c3c';
                    }
                });

                input.addEventListener('input', function() {
                    if (this.validity.valid) {
                        this.style.borderColor = '#27ae60';
                    } else if (this.value !== '') {
                        this.style.borderColor = '#e74c3c';
                    } else {
                        this.style.borderColor = '#ecf0f1';
                    }
                });
            });

            // Success animation on valid form
            form.addEventListener('submit', function(e) {
                if (form.checkValidity()) {
                    document.querySelector('.form-container').classList.add('success-animation');
                }
            });

            console.log('Formulario de cliente inicializado correctamente');
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + S to submit form
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('clientForm').dispatchEvent(new Event('submit'));
            }
            
            // Escape to cancel
            if (e.key === 'Escape') {
                window.location.href = '/webcon/index.php?route=admin:dashboard';
            }
        });
    </script>
</body>
</html>