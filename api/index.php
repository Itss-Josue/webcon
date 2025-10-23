<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebCon API - Sistema de Consulta de Proyectos</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #34495e;
            --success-color: #27ae60;
            --warning-color: #f39c12;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .logo-icon {
            font-size: 2rem;
        }
        
        .status {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: var(--success-color);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        .info-section {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .info-section h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-color);
        }
        
        .search-section {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .search-input {
            flex: 1;
            min-width: 250px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border 0.3s;
        }
        
        .search-input:focus {
            border-color: var(--secondary-color);
            outline: none;
        }
        
        .search-type {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .search-option {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .search-option input {
            margin-right: 5px;
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .btn-secondary {
            background-color: var(--light-color);
            color: var(--dark-color);
        }
        
        .btn-secondary:hover {
            background-color: #d5dbdb;
        }
        
        .results-section {
            display: none;
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .client-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .client-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .client-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .client-name {
            font-size: 1.4rem;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .client-id {
            background-color: var(--light-color);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            color: var(--dark-color);
        }
        
        .client-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .detail-item {
            display: flex;
            flex-direction: column;
        }
        
        .detail-label {
            font-size: 0.8rem;
            color: #7f8c8d;
            margin-bottom: 5px;
        }
        
        .detail-value {
            font-weight: 500;
        }
        
        .client-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .btn-small {
            padding: 8px 15px;
            font-size: 0.9rem;
        }
        
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }
        
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: var(--secondary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .no-results {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }
        
        .error-message {
            background-color: #ffeaa7;
            color: #d35400;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }
        
        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .search-form {
                flex-direction: column;
            }
            
            .client-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .client-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <div class="logo-icon">🔍</div>
                    <h1>WebCon API - Sistema de Consulta</h1>
                </div>
                <div class="status">
                    <div class="status-dot"></div>
                    <span>Sistema Online - Solo Consulta</span>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <section class="info-section">
            <h2>Información Importante</h2>
            <p>Esta API es de solo consulta. No permite modificar, eliminar o agregar datos.</p>
            <p>Todos los endpoints requieren autenticación mediante token.</p>
        </section>
        
        <section class="search-section">
            <h2>Búsqueda de Clientes</h2>
            <p>Buscar cliente por DNI, nombre completo, empresa o ID.</p>
            
            <div class="error-message" id="errorMessage"></div>
            
            <form class="search-form" id="searchForm">
                <input type="text" class="search-input" id="searchInput" placeholder="Ingresa DNI, nombre, empresa o ID..." required>
                
                <div class="search-type">
                    <div class="search-option">
                        <input type="radio" id="autoType" name="searchType" value="auto" checked>
                        <label for="autoType">Detección automática</label>
                    </div>
                    <div class="search-option">
                        <input type="radio" id="dniType" name="searchType" value="dni">
                        <label for="dniType">DNI</label>
                    </div>
                    <div class="search-option">
                        <input type="radio" id="nameType" name="searchType" value="nombre">
                        <label for="nameType">Nombre</label>
                    </div>
                    <div class="search-option">
                        <input type="radio" id="companyType" name="searchType" value="empresa">
                        <label for="companyType">Empresa</label>
                    </div>
                    <div class="search-option">
                        <input type="radio" id="idType" name="searchType" value="id">
                        <label for="idType">ID</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Buscar Cliente</button>
                <button type="button" class="btn btn-secondary" id="clearBtn">Limpiar</button>
            </form>
            
            <div class="loading" id="loadingIndicator">
                <div class="spinner"></div>
                <p>Buscando información del cliente...</p>
            </div>
        </section>
        
        <section class="results-section" id="resultsSection">
            <h2>Resultados de la Búsqueda</h2>
            <div id="resultsContainer"></div>
        </section>
        
        <section class="info-section">
            <h2>Qué Puedes Consultar</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div>
                    <h3 style="color: var(--secondary-color); margin-bottom: 10px;">Datos del Cliente</h3>
                    <p>Información completa del cliente: nombre, empresa, contacto y datos de registro.</p>
                </div>
                <div>
                    <h3 style="color: var(--secondary-color); margin-bottom: 10px;">Proyectos Activos</h3>
                    <p>Lista de todos los proyectos del cliente con estado, progreso y fechas.</p>
                </div>
                <div>
                    <h3 style="color: var(--secondary-color); margin-bottom: 10px;">Estadísticas</h3>
                    <p>Métricas de avance, total de proyectos y resumen de pagos realizados.</p>
                </div>
                <div>
                    <h3 style="color: var(--secondary-color); margin-bottom: 10px;">Información de Pagos</h3>
                    <p>Historial completo de pagos realizados por el cliente.</p>
                </div>
            </div>
        </section>
    </div>
    
    <footer>
        <div class="container">
            <p>WebCon API - Sistema de Consulta de Proyectos</p>
            <p>© 2025 Todos los derechos reservados</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const searchInput = document.getElementById('searchInput');
            const resultsSection = document.getElementById('resultsSection');
            const resultsContainer = document.getElementById('resultsContainer');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const errorMessage = document.getElementById('errorMessage');
            const clearBtn = document.getElementById('clearBtn');
            
            // Función para determinar el tipo de búsqueda
            function determineSearchType(value, selectedType) {
                if (selectedType !== 'auto') return selectedType;
                
                // Detección automática
                if (/^[CI]?\d+$/.test(value.toUpperCase())) return 'id';
                if (/^\d{8}$/.test(value)) return 'dni';
                if (value.toLowerCase().includes('team') || 
                    value.toLowerCase().includes('corp') || 
                    value.toLowerCase().includes('solutions') ||
                    value.toLowerCase().includes('s.a.') ||
                    value.toLowerCase().includes('sac') ||
                    value.toLowerCase().includes('eirl')) return 'empresa';
                
                return 'nombre';
            }
            
            // Función para buscar clientes en la base de datos
            async function searchClients(query, type) {
                try {
                    const response = await fetch('search_clients.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `query=${encodeURIComponent(query)}&type=${type}`
                    });
                    
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    
                    const data = await response.json();
                    return data;
                } catch (error) {
                    console.error('Error al buscar clientes:', error);
                    throw error;
                }
            }
            
            // Función para mostrar resultados
            function displayResults(clients) {
                resultsContainer.innerHTML = '';
                
                if (clients.length === 0) {
                    resultsContainer.innerHTML = `
                        <div class="no-results">
                            <h3>No se encontraron clientes</h3>
                            <p>Intenta con otros términos de búsqueda</p>
                        </div>
                    `;
                    return;
                }
                
                clients.forEach(client => {
                    const clientCard = document.createElement('div');
                    clientCard.className = 'client-card';
                    
                    clientCard.innerHTML = `
                        <div class="client-header">
                            <div class="client-name">${client.name}</div>
                            <div class="client-id">ID: ${client.id}</div>
                        </div>
                        <div class="client-details">
                            <div class="detail-item">
                                <span class="detail-label">DNI</span>
                                <span class="detail-value">${client.dni || 'No disponible'}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Empresa</span>
                                <span class="detail-value">${client.company || 'No disponible'}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Email</span>
                                <span class="detail-value">${client.email || 'No disponible'}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Teléfono</span>
                                <span class="detail-value">${client.phone || 'No disponible'}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Fecha de Registro</span>
                                <span class="detail-value">${client.created_at || 'No disponible'}</span>
                            </div>
                        </div>
                        <div class="client-actions">
                            <button class="btn btn-primary btn-small" onclick="viewClientDetails(${client.id})">Ver Información Completa</button>
                            <button class="btn btn-secondary btn-small" onclick="viewClientProjects(${client.id})">Ver Proyectos</button>
                        </div>
                    `;
                    
                    resultsContainer.appendChild(clientCard);
                });
            }
            
            // Manejar envío del formulario
            searchForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const query = searchInput.value.trim();
                if (!query) return;
                
                const selectedType = document.querySelector('input[name="searchType"]:checked').value;
                const searchType = determineSearchType(query, selectedType);
                
                // Mostrar carga
                loadingIndicator.style.display = 'block';
                resultsSection.style.display = 'none';
                errorMessage.style.display = 'none';
                
                try {
                    const results = await searchClients(query, searchType);
                    displayResults(results);
                    resultsSection.style.display = 'block';
                } catch (error) {
                    errorMessage.textContent = 'Error al realizar la búsqueda. Intenta nuevamente.';
                    errorMessage.style.display = 'block';
                } finally {
                    loadingIndicator.style.display = 'none';
                }
            });
            
            // Limpiar búsqueda
            clearBtn.addEventListener('click', function() {
                searchInput.value = '';
                resultsSection.style.display = 'none';
                errorMessage.style.display = 'none';
            });
            
            // Funciones para los botones de acción
            window.viewClientDetails = function(clientId) {
                alert(`Mostrando información completa del cliente ID: ${clientId}\n\nEn una implementación real, esto cargaría la vista detallada del cliente.`);
            };
            
            window.viewClientProjects = function(clientId) {
                alert(`Mostrando proyectos del cliente ID: ${clientId}\n\nEn una implementación real, esto cargaría la lista de proyectos del cliente.`);
            };
        });
    </script>
</body>
</html>