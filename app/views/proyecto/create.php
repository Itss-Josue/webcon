<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proyecto - WebDev Solutions</title>
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
            max-width: 700px;
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
            background: linear-gradient(90deg, #2ecc71, #3498db, #9b59b6, #e74c3c);
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
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8em;
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
            color: #2ecc71;
        }

        .required-indicator {
            color: #e74c3c;
            font-size: 0.8em;
            margin-left: 4px;
        }

        .form-group input,
        .form-group select {
            padding: 15px 18px;
            border: 2px solid #ecf0f1;
            border-radius: 12px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #2ecc71;
            background: white;
            box-shadow: 0 0 0 3px rgba(46, 204, 113, 0.1);
            transform: translateY(-2px);
        }

        .form-group input:hover,
        .form-group select:hover {
            border-color: #bdc3c7;
        }

        .form-group input[required],
        .form-group select[required] {
            border-left: 4px solid #e74c3c;
        }

        .form-group input[required]:focus,
        .form-group select[required]:focus {
            border-left: 4px solid #27ae60;
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

        /* Custom select styling */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }

        /* Progress bar styling */
        .progress-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 8px;
        }

        .progress-bar {
            flex: 1;
            height: 8px;
            background: #ecf0f1;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2ecc71, #27ae60);
            transition: width 0.3s ease;
            border-radius: 4px;
        }

        .progress-value {
            font-weight: bold;
            color: #2c3e50;
            min-width: 45px;
            text-align: right;
        }

        /* Status badges */
        .status-preview {
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-active { background: #d1ecf1; color: #0c5460; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }

        /* Price formatting */
        .currency-input {
            position: relative;
        }

        .currency-input::before {
            content: 'S/.';
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            font-weight: 600;
            z-index: 1;
        }

        .currency-input input {
            padding-left: 50px;
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
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(46, 204, 113, 0.4);
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

        /* Loading state */
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

        /* Project type suggestions */
        .type-suggestions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
        }

        .type-suggestion {
            background: #ecf0f1;
            color: #2c3e50;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8em;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .type-suggestion:hover {
            background: #2ecc71;
            color: white;
            transform: translateY(-1px);
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

            .progress-container {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .progress-value {
                text-align: left;
            }
        }

        /* Validation styles */
        .form-group input:valid:not(:focus) {
            border-color: #27ae60;
        }

        .form-group input:invalid:not(:focus):not(:placeholder-shown) {
            border-color: #e74c3c;
        }

        .form-group select:valid {
            border-color: #27ae60;
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <div class="icon">
                <i class="fas fa-project-diagram"></i>
            </div>
            <h2>Agregar Nuevo Proyecto</h2>
            <p>Crea un nuevo proyecto asignándolo a un cliente existente</p>
        </div>

        <form method="POST" action="/webcon/index.php?route=proyecto:create" id="projectForm">
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="client_id">
                        <i class="fas fa-user"></i>
                        Cliente
                        <span class="required-indicator">*</span>
                    </label>
                    <select name="client_id" id="client_id" required>
                        <option value="">-- Selecciona un cliente --</option>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Selecciona el cliente para quien se realizará el proyecto
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="name">
                        <i class="fas fa-tasks"></i>
                        Nombre del Proyecto
                        <span class="required-indicator">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           placeholder="Ej: Página Web Corporativa" 
                           required
                           minlength="3">
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Nombre descriptivo del proyecto a desarrollar
                    </div>
                </div>

                <div class="form-group">
                    <label for="type">
                        <i class="fas fa-tag"></i>
                        Tipo de Proyecto
                    </label>
                    <input type="text" 
                           name="type" 
                           id="type" 
                           placeholder="Ej: Website Corporativo">
                    <div class="type-suggestions">
                        <span class="type-suggestion" onclick="setType('Website Corporativo')">Website Corporativo</span>
                        <span class="type-suggestion" onclick="setType('E-commerce')">E-commerce</span>
                        <span class="type-suggestion" onclick="setType('Landing Page')">Landing Page</span>
                        <span class="type-suggestion" onclick="setType('Portal Web')">Portal Web</span>
                        <span class="type-suggestion" onclick="setType('Aplicación Web')">App Web</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">
                        <i class="fas fa-flag"></i>
                        Estado del Proyecto
                    </label>
                    <select name="status" id="status">
                        <option value="pending">Pendiente</option>
                        <option value="active">Activo</option>
                        <option value="completed">Finalizado</option>
                        <option value="cancelled">Cancelado</option>
                    </select>
                    <div class="status-preview" id="statusPreview">Pendiente</div>
                </div>

                <div class="form-group">
                    <label for="progress">
                        <i class="fas fa-chart-line"></i>
                        Progreso del Proyecto
                    </label>
                    <input type="number" 
                           name="progress" 
                           id="progress" 
                           value="0" 
                           min="0" 
                           max="100"
                           placeholder="0-100">
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-fill" id="progressFill" style="width: 0%"></div>
                        </div>
                        <div class="progress-value" id="progressValue">0%</div>
                    </div>
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Porcentaje de avance del proyecto (0-100%)
                    </div>
                </div>

                <div class="form-group">
                    <label for="delivery_date">
                        <i class="fas fa-calendar-alt"></i>
                        Fecha de Entrega
                    </label>
                    <input type="date" 
                           name="delivery_date" 
                           id="delivery_date"
                           min="<?= date('Y-m-d') ?>">
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Fecha estimada de entrega del proyecto
                    </div>
                </div>

                <div class="form-group">
                    <label for="total_price">
                        <i class="fas fa-dollar-sign"></i>
                        Precio Total
                    </label>
                    <div class="currency-input">
                        <input type="number" 
                               step="0.01" 
                               name="total_price" 
                               id="total_price"
                               placeholder="0.00"
                               min="0">
                    </div>
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Precio total acordado para el proyecto
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
                    Guardar Proyecto
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('projectForm');
            const submitBtn = document.getElementById('submitBtn');
            const progressInput = document.getElementById('progress');
            const progressFill = document.getElementById('progressFill');
            const progressValue = document.getElementById('progressValue');
            const statusSelect = document.getElementById('status');
            const statusPreview = document.getElementById('statusPreview');
            const nameInput = document.getElementById('name');
            const priceInput = document.getElementById('total_price');

            // Progress bar update
            progressInput.addEventListener('input', function() {
                const value = Math.max(0, Math.min(100, parseInt(this.value) || 0));
                this.value = value;
                progressFill.style.width = value + '%';
                progressValue.textContent = value + '%';

                // Auto-update status based on progress
                if (value === 0) {
                    statusSelect.value = 'pending';
                } else if (value === 100) {
                    statusSelect.value = 'completed';
                } else {
                    statusSelect.value = 'active';
                }
                updateStatusPreview();
            });

            // Status preview update
            function updateStatusPreview() {
                const status = statusSelect.value;
                const statusMap = {
                    'pending': { text: 'Pendiente', class: 'status-pending' },
                    'active': { text: 'Activo', class: 'status-active' },
                    'completed': { text: 'Finalizado', class: 'status-completed' },
                    'cancelled': { text: 'Cancelado', class: 'status-cancelled' }
                };

                statusPreview.textContent = statusMap[status].text;
                statusPreview.className = 'status-preview ' + statusMap[status].class;
            }

            statusSelect.addEventListener('change', updateStatusPreview);

            // Name input formatting
            nameInput.addEventListener('input', function() {
                this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
            });

            // Price formatting
            priceInput.addEventListener('input', function() {
                const value = parseFloat(this.value);
                if (value && value > 0) {
                    this.style.color = '#27ae60';
                    this.style.fontWeight = 'bold';
                } else {
                    this.style.color = '';
                    this.style.fontWeight = '';
                }
            });

            // Set default delivery date (30 days from today)
            const deliveryDate = document.getElementById('delivery_date');
            const futureDate = new Date();
            futureDate.setDate(futureDate.getDate() + 30);
            deliveryDate.value = futureDate.toISOString().split('T')[0];

            // Form submission
            form.addEventListener('submit', function(e) {
                submitBtn.classList.add('btn-loading');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';
                submitBtn.disabled = true;
            });

            // Real-time validation
            const requiredInputs = form.querySelectorAll('input[required], select[required]');
            requiredInputs.forEach(input => {
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

            // Initialize
            updateStatusPreview();
            console.log('Formulario de proyecto inicializado correctamente');
        });

        // Type suggestion function
        function setType(type) {
            document.getElementById('type').value = type;
            document.getElementById('type').focus();
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + S to submit
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('projectForm').dispatchEvent(new Event('submit'));
            }
            
            // Escape to cancel
            if (e.key === 'Escape') {
                window.location.href = '/webcon/index.php?route=admin:dashboard';
            }
        });

        // Auto-complete project name based on client and type
        document.getElementById('client_id').addEventListener('change', function() {
            updateProjectName();
        });

        document.getElementById('type').addEventListener('input', function() {
            updateProjectName();
        });

        function updateProjectName() {
            const clientSelect = document.getElementById('client_id');
            const typeInput = document.getElementById('type');
            const nameInput = document.getElementById('name');

            if (clientSelect.value && typeInput.value && !nameInput.value) {
                const clientName = clientSelect.options[clientSelect.selectedIndex].text.split(' ')[0];
                const projectType = typeInput.value;
                nameInput.value = `${projectType} - ${clientName}`;
            }
        }
    </script>
</body>
</html>