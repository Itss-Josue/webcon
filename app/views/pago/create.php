<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pago - WebDev Solutions</title>
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
            background: linear-gradient(90deg, #f39c12, #27ae60, #3498db, #9b59b6);
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
            background: linear-gradient(135deg, #f39c12, #e67e22);
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
            color: #f39c12;
        }

        .required-indicator {
            color: #e74c3c;
            font-size: 0.8em;
            margin-left: 4px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 15px 18px;
            border: 2px solid #ecf0f1;
            border-radius: 12px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #f39c12;
            background: white;
            box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1);
            transform: translateY(-2px);
        }

        .form-group input:hover,
        .form-group select:hover,
        .form-group textarea:hover {
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

        /* Currency input styling */
        .currency-input {
            position: relative;
        }

        .currency-input::before {
            content: 'S/.';
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #f39c12;
            font-weight: bold;
            font-size: 1.1em;
            z-index: 1;
        }

        .currency-input input {
            padding-left: 55px;
            font-weight: 600;
            color: #27ae60;
        }

        /* Payment method buttons */
        .method-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .method-btn {
            background: #ecf0f1;
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 12px 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            font-size: 0.85em;
            font-weight: 500;
            color: #2c3e50;
        }

        .method-btn:hover {
            background: #f39c12;
            color: white;
            transform: translateY(-2px);
        }

        .method-btn.active {
            background: #f39c12;
            color: white;
            border-color: #e67e22;
        }

        .method-btn i {
            display: block;
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        /* Payment summary */
        .payment-summary {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid #f39c12;
        }

        .payment-summary h4 {
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 1.1em;
            color: #27ae60;
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
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            box-shadow: 0 8px 20px rgba(243, 156, 18, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(243, 156, 18, 0.4);
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

            .method-buttons {
                grid-template-columns: repeat(2, 1fr);
            }

            .summary-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
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
                <i class="fas fa-credit-card"></i>
            </div>
            <h2>Registrar Nuevo Pago</h2>
            <p>Registra un pago recibido de un cliente por un proyecto</p>
        </div>

        <form method="POST" action="index.php?route=pago:create" id="paymentForm">

            <div class="form-grid">
                <div class="form-group">
                    <label for="client_id">
                        <i class="fas fa-user"></i>
                        Cliente
                        <span class="required-indicator">*</span>
                    </label>
                    <select name="client_id" id="client_id" required>
                        <option value="">-- Selecciona un cliente --</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Cliente que realiza el pago
                    </div>
                </div>

                <div class="form-group">
                    <label for="project_id">
                        <i class="fas fa-project-diagram"></i>
                        Proyecto
                        <span class="required-indicator">*</span>
                    </label>
                    <select name="project_id" id="project_id" required>
                        <option value="">-- Selecciona un proyecto --</option>
                        <?php foreach ($proyectos as $proyecto): ?>
                            <option value="<?= $proyecto['id'] ?>" data-client="<?= $proyecto['client_id'] ?? '' ?>"><?= htmlspecialchars($proyecto['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Proyecto por el cual se recibe el pago
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount">
                        <i class="fas fa-dollar-sign"></i>
                        Monto del Pago
                        <span class="required-indicator">*</span>
                    </label>
                    <div class="currency-input">
                        <input type="number" 
                               name="amount" 
                               id="amount" 
                               step="0.01" 
                               placeholder="0.00"
                               required
                               min="0.01">
                    </div>
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Monto recibido en soles peruanos
                    </div>
                </div>

                <div class="form-group">
                    <label for="paid_at">
                        <i class="fas fa-calendar-alt"></i>
                        Fecha de Pago
                    </label>
                    <input type="date" 
                           name="paid_at" 
                           id="paid_at" 
                           value="<?= date('Y-m-d') ?>"
                           max="<?= date('Y-m-d') ?>">
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Fecha en que se recibió el pago
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="method">
                        <i class="fas fa-credit-card"></i>
                        Método de Pago
                    </label>
                    <input type="text" 
                           name="method" 
                           id="method" 
                           placeholder="Selecciona o escribe el método"
                           readonly>
                    <div class="method-buttons">
                        <div class="method-btn" onclick="selectMethod('Transferencia')">
                            <i class="fas fa-exchange-alt"></i>
                            Transferencia
                        </div>
                        <div class="method-btn" onclick="selectMethod('Tarjeta')">
                            <i class="fas fa-credit-card"></i>
                            Tarjeta
                        </div>
                        <div class="method-btn" onclick="selectMethod('Efectivo')">
                            <i class="fas fa-money-bill-wave"></i>
                            Efectivo
                        </div>
                        <div class="method-btn" onclick="selectMethod('Yape')">
                            <i class="fas fa-mobile-alt"></i>
                            Yape
                        </div>
                        <div class="method-btn" onclick="selectMethod('Plin')">
                            <i class="fas fa-mobile-alt"></i>
                            Plin
                        </div>
                        <div class="method-btn" onclick="selectMethod('Otros')">
                            <i class="fas fa-ellipsis-h"></i>
                            Otros
                        </div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="note">
                        <i class="fas fa-sticky-note"></i>
                        Nota o Comentarios
                    </label>
                    <textarea name="note" 
                              id="note" 
                              placeholder="Información adicional sobre el pago (opcional)"></textarea>
                    <div class="input-help">
                        <i class="fas fa-info-circle"></i>
                        Detalles adicionales, número de operación, observaciones
                    </div>
                </div>
            </div>

            <div class="payment-summary" id="paymentSummary" style="display: none;">
                <h4>
                    <i class="fas fa-clipboard-check"></i>
                    Resumen del Pago
                </h4>
                <div class="summary-row">
                    <span>Cliente:</span>
                    <span id="summaryClient">-</span>
                </div>
                <div class="summary-row">
                    <span>Proyecto:</span>
                    <span id="summaryProject">-</span>
                </div>
                <div class="summary-row">
                    <span>Método:</span>
                    <span id="summaryMethod">-</span>
                </div>
                <div class="summary-row">
                    <span>Monto Total:</span>
                    <span id="summaryAmount">S/. 0.00</span>
                </div>
            </div>

            <div class="form-actions">
                <a href="/webcon/index.php?route=admin:dashboard" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Registrar Pago
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('paymentForm');
            const submitBtn = document.getElementById('submitBtn');
            const clientSelect = document.getElementById('client_id');
            const projectSelect = document.getElementById('project_id');
            const amountInput = document.getElementById('amount');
            const paymentSummary = document.getElementById('paymentSummary');

            // Method selection
            window.selectMethod = function(method) {
                document.getElementById('method').value = method;
                
                // Update active state
                document.querySelectorAll('.method-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                event.target.closest('.method-btn').classList.add('active');
                
                updateSummary();
            };

            // Filter projects by selected client
            clientSelect.addEventListener('change', function() {
                const selectedClient = this.value;
                const projectOptions = projectSelect.querySelectorAll('option');
                
                projectOptions.forEach(option => {
                    if (option.value === '') {
                        option.style.display = 'block';
                        return;
                    }
                    
                    const projectClient = option.dataset.client;
                    if (!selectedClient || projectClient === selectedClient) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });
                
                // Reset project selection
                projectSelect.value = '';
                updateSummary();
            });

            // Update summary when form changes
            [clientSelect, projectSelect, amountInput, document.getElementById('method')].forEach(element => {
                element.addEventListener('change', updateSummary);
                element.addEventListener('input', updateSummary);
            });

            function updateSummary() {
                const clientName = clientSelect.options[clientSelect.selectedIndex]?.text || '-';
                const projectName = projectSelect.options[projectSelect.selectedIndex]?.text || '-';
                const method = document.getElementById('method').value || '-';
                const amount = parseFloat(amountInput.value) || 0;

                document.getElementById('summaryClient').textContent = clientName;
                document.getElementById('summaryProject').textContent = projectName;
                document.getElementById('summaryMethod').textContent = method;
                document.getElementById('summaryAmount').textContent = `S/. ${amount.toFixed(2)}`;

                // Show/hide summary
                if (clientSelect.value || projectSelect.value || amount > 0 || method !== '-') {
                    paymentSummary.style.display = 'block';
                } else {
                    paymentSummary.style.display = 'none';
                }
            }

            // Amount formatting
            amountInput.addEventListener('input', function() {
                const value = parseFloat(this.value);
                if (value && value > 0) {
                    this.style.color = '#27ae60';
                    this.style.fontWeight = 'bold';
                } else {
                    this.style.color = '#e74c3c';
                    this.style.fontWeight = 'normal';
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                // Validate required method selection
                if (!document.getElementById('method').value) {
                    e.preventDefault();
                    alert('Por favor selecciona un método de pago');
                    return;
                }

                submitBtn.classList.add('btn-loading');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Registrando...';
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

            console.log('Formulario de pago inicializado correctamente');
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + S to submit
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('paymentForm').dispatchEvent(new Event('submit'));
            }
            
            // Escape to cancel
            if (e.key === 'Escape') {
                window.location.href = '/webcon/index.php?route=admin:dashboard';
            }

            // Number keys for quick method selection
            const methods = ['Transferencia', 'Tarjeta', 'Efectivo', 'Yape', 'Plin', 'Otros'];
            const keyNum = parseInt(e.key);
            if (keyNum >= 1 && keyNum <= 6) {
                selectMethod(methods[keyNum - 1]);
            }
        });
    </script>
</body>
</html>