<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebCon API - Sistema de Consulta de Proyectos</title>
    <style>
        :root {
            --primary-color: #0a192f;
            --secondary-color: #64ffda;
            --accent-color: #ff6b6b;
            --light-color: #ccd6f6;
            --dark-color: #112240;
            --success-color: #64ffda;
            --warning-color: #ffd166;
            --text-primary: #e6f1ff;
            --text-secondary: #8892b0;
            --card-bg: #112240;
            --hover-color: #1d3b5a;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #0a192f 0%, #112240 100%);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background: rgba(10, 25, 47, 0.9);
            backdrop-filter: blur(10px);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid rgba(100, 255, 218, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
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
            font-weight: 700;
            background: linear-gradient(90deg, #64ffda, #4fc3f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .logo-icon {
            font-size: 2rem;
            color: var(--secondary-color);
        }
        
        .status {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(100, 255, 218, 0.1);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            border: 1px solid rgba(100, 255, 218, 0.2);
        }
        
        .status-dot {
            width: 10px;
            height: 10px;
            background-color: var(--success-color);
            border-radius: 50%;
            animation: pulse 2s infinite;
            box-shadow: 0 0 10px rgba(100, 255, 218, 0.5);
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
        }
        
        .info-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            margin: 25px 0;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(100, 255, 218, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }
        
        .info-section h2 {
            color: var(--secondary-color);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(100, 255, 218, 0.2);
            font-weight: 600;
            font-size: 1.5rem;
        }
        
        .search-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            margin: 25px 0;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(100, 255, 218, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .search-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }
        
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .search-input {
            flex: 1;
            min-width: 250px;
            padding: 15px 20px;
            border: 1px solid rgba(100, 255, 218, 0.2);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: rgba(10, 25, 47, 0.5);
            color: var(--text-primary);
        }
        
        .search-input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.2);
        }
        
        .search-input::placeholder {
            color: var(--text-secondary);
        }
        
        .search-type {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            width: 100%;
        }
        
        .search-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .search-option input {
            margin-right: 5px;
            accent-color: var(--secondary-color);
        }
        
        .search-option label {
            color: var(--text-secondary);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .search-option:hover label {
            color: var(--text-primary);
        }
        
        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #64ffda, #4fc3f7);
            color: var(--primary-color);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(100, 255, 218, 0.3);
        }
        
        .btn-secondary {
            background: rgba(136, 146, 176, 0.1);
            color: var(--text-primary);
            border: 1px solid rgba(136, 146, 176, 0.2);
        }
        
        .btn-secondary:hover {
            background: rgba(136, 146, 176, 0.2);
            transform: translateY(-2px);
        }
        
        .results-section {
            display: none;
            background: var(--card-bg);
            border-radius: 12px;
            padding: 30px;
            margin: 25px 0;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(100, 255, 218, 0.1);
        }
        
        .client-card {
            border: 1px solid rgba(100, 255, 218, 0.1);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            background: rgba(10, 25, 47, 0.5);
        }
        
        .client-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            border-color: rgba(100, 255, 218, 0.3);
        }
        
        .client-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .client-name {
            font-size: 1.4rem;
            color: var(--secondary-color);
            font-weight: 600;
        }
        
        .client-id {
            background: rgba(100, 255, 218, 0.1);
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            color: var(--secondary-color);
            border: 1px solid rgba(100, 255, 218, 0.2);
        }
        
        .client-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .detail-item {
            display: flex;
            flex-direction: column;
        }
        
        .detail-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .detail-value {
            font-weight: 500;
            color: var(--text-primary);
        }
        
        .client-actions {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        
        .btn-small {
            padding: 10px 18px;
            font-size: 0.9rem;
        }
        
        .loading {
            display: none;
            text-align: center;
            padding: 40px;
        }
        
        .spinner {
            border: 4px solid rgba(100, 255, 218, 0.2);
            border-left-color: var(--secondary-color);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .no-results {
            text-align: center;
            padding: 60px 40px;
            color: var(--text-secondary);
        }
        
        .no-results h3 {
            margin-bottom: 15px;
            color: var(--text-primary);
        }
        
        .error-message {
            background: rgba(255, 107, 107, 0.1);
            color: var(--accent-color);
            padding: 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
            border: 1px solid rgba(255, 107, 107, 0.2);
        }
        
        footer {
            text-align: center;
            margin-top: 60px;
            padding: 30px;
            color: var(--text-secondary);
            font-size: 0.9rem;
            border-top: 1px solid rgba(100, 255, 218, 0.1);
        }
        
        /* Estilos para el modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 25, 47, 0.9);
            backdrop-filter: blur(5px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        .modal-content {
            background: var(--card-bg);
            padding: 35px;
            border-radius: 12px;
            max-width: 90%;
            max-height: 90%;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            position: relative;
            border: 1px solid rgba(100, 255, 218, 0.2);
        }
        
        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 107, 107, 0.1);
            color: var(--accent-color);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .close-btn:hover {
            background: rgba(255, 107, 107, 0.2);
            transform: rotate(90deg);
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
                gap: 15px;
            }
            
            .client-details {
                grid-template-columns: 1fr;
            }
            
            .client-actions {
                flex-direction: column;
            }
            
            .modal-content {
                padding: 25px;
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <div class="logo-icon"></div>
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
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px;">
                <div>
                    <h3 style="color: var(--secondary-color); margin-bottom: 15px;">Datos del Cliente</h3>
                    <p style="color: var(--text-secondary);">Información completa del cliente: nombre, empresa, contacto y datos de registro.</p>
                </div>
                <div>
                    <h3 style="color: var(--secondary-color); margin-bottom: 15px;">Proyectos Activos</h3>
                    <p style="color: var(--text-secondary);">Lista de todos los proyectos del cliente con estado, progreso y fechas.</p>
                </div>
                <div>
                    <h3 style="color: var(--secondary-color); margin-bottom: 15px;">Estadísticas</h3>
                    <p style="color: var(--text-secondary);">Métricas de avance, total de proyectos y resumen de pagos realizados.</p>
                </div>
                <div>
                    <h3 style="color: var(--secondary-color); margin-bottom: 15px;">Información de Pagos</h3>
                    <p style="color: var(--text-secondary);">Historial completo de pagos realizados por el cliente.</p>
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
        
        // Función para actualizar la URL con el ID del cliente
        function updateURL(clientId = null) {
            const baseUrl = window.location.origin + window.location.pathname;
            
            if (clientId) {
                // Agregar el ID del cliente a la URL
                const newUrl = `${baseUrl}?client_id=${clientId}`;
                window.history.pushState({ client_id: clientId }, '', newUrl);
            } else {
                // Limpiar la URL si no hay cliente
                window.history.pushState({}, '', baseUrl);
            }
        }

        // Función para obtener el ID del cliente desde la URL
        function getClientIdFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('client_id');
        }

        // Función para buscar automáticamente cuando hay un ID en la URL
        async function searchFromURL() {
            const clientId = getClientIdFromURL();
            
            if (clientId && !isNaN(clientId)) {
                // Simular una búsqueda automática
                searchInput.value = clientId;
                document.getElementById('idType').checked = true;
                
                // Mostrar carga
                loadingIndicator.style.display = 'block';
                resultsSection.style.display = 'none';
                errorMessage.style.display = 'none';
                
                try {
                    const results = await searchClients(clientId, 'id');
                    displayResults(results);
                    resultsSection.style.display = 'block';
                    
                    // Si hay exactamente un resultado, mostrar sus detalles automáticamente
                    if (results.length === 1) {
                        setTimeout(() => {
                            viewClientDetails(clientId, true);
                        }, 500);
                    }
                } catch (error) {
                    errorMessage.textContent = 'Error al cargar el cliente desde la URL';
                    errorMessage.style.display = 'block';
                } finally {
                    loadingIndicator.style.display = 'none';
                }
            }
        }
        
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

        // Función para obtener información completa del cliente
        async function getClientDetails(clientId) {
            try {
                const response = await fetch('get_client_details.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ client_id: clientId })
                });
                
                if (!response.ok) {
                    throw new Error('Error al obtener detalles del cliente');
                }
                
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error:', error);
                throw error;
            }
        }

        // Función para obtener proyectos del cliente
        async function getClientProjects(clientId) {
            try {
                const response = await fetch('get_client_projects.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ client_id: clientId })
                });
                
                if (!response.ok) {
                    throw new Error('Error al obtener proyectos del cliente');
                }
                
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error:', error);
                throw error;
            }
        }

        // Función para mostrar modal con información
        function showModal(title, content) {
            // Crear modal si no existe
            let modal = document.getElementById('infoModal');
            if (!modal) {
                modal = document.createElement('div');
                modal.id = 'infoModal';
                modal.className = 'modal';
                
                modal.innerHTML = `
                    <div class="modal-content">
                        <button class="close-btn">×</button>
                        <h2 style="color: var(--secondary-color); margin-bottom: 20px; padding-right: 40px;">${title}</h2>
                        <div class="modal-body"></div>
                    </div>
                `;
                
                document.body.appendChild(modal);
                
                // Cerrar modal al hacer click en la X
                modal.querySelector('.close-btn').addEventListener('click', function() {
                    modal.style.display = 'none';
                });
                
                // Cerrar modal al hacer click fuera del contenido
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            }
            
            // Actualizar título y contenido
            modal.querySelector('h2').textContent = title;
            modal.querySelector('.modal-body').innerHTML = content;
            modal.style.display = 'flex';
        }

        // Función para formatear información del cliente
        function formatClientDetails(data) {
            if (!data.success) {
                return `<div class="error-message">${data.message}</div>`;
            }
            
            const client = data.client;
            const stats = data.stats;
            const payments = data.payments;
            
            return `
                <div class="client-info" style="margin-bottom: 25px;">
                    <h3 style="color: var(--secondary-color); margin-bottom: 15px;">Información Personal</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-bottom: 20px;">
                        <div>
                            <strong>Nombre:</strong> ${client.name || 'No disponible'}
                        </div>
                        <div>
                            <strong>DNI:</strong> ${client.dni || 'No disponible'}
                        </div>
                        <div>
                            <strong>Empresa:</strong> ${client.company || 'No disponible'}
                        </div>
                        <div>
                            <strong>Email:</strong> ${client.email || 'No disponible'}
                        </div>
                        <div>
                            <strong>Teléfono:</strong> ${client.phone || 'No disponible'}
                        </div>
                        <div>
                            <strong>Fecha de Registro:</strong> ${client.created_at || 'No disponible'}
                        </div>
                    </div>
                </div>
                
                <div class="stats-info" style="margin-bottom: 25px;">
                    <h3 style="color: var(--secondary-color); margin-bottom: 15px;">Estadísticas de Proyectos</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                        <div style="background: rgba(100, 255, 218, 0.1); padding: 15px; border-radius: 8px; text-align: center; border: 1px solid rgba(100, 255, 218, 0.2);">
                            <div style="font-size: 24px; font-weight: bold; color: var(--secondary-color);">${stats.total_projects || 0}</div>
                            <div style="color: var(--text-secondary);">Total Proyectos</div>
                        </div>
                        <div style="background: rgba(100, 255, 218, 0.1); padding: 15px; border-radius: 8px; text-align: center; border: 1px solid rgba(100, 255, 218, 0.2);">
                            <div style="font-size: 24px; font-weight: bold; color: var(--secondary-color);">${stats.active_projects || 0}</div>
                            <div style="color: var(--text-secondary);">Proyectos Activos</div>
                        </div>
                        <div style="background: rgba(100, 255, 218, 0.1); padding: 15px; border-radius: 8px; text-align: center; border: 1px solid rgba(100, 255, 218, 0.2);">
                            <div style="font-size: 24px; font-weight: bold; color: var(--secondary-color);">${stats.completed_projects || 0}</div>
                            <div style="color: var(--text-secondary);">Proyectos Completados</div>
                        </div>
                        <div style="background: rgba(100, 255, 218, 0.1); padding: 15px; border-radius: 8px; text-align: center; border: 1px solid rgba(100, 255, 218, 0.2);">
                            <div style="font-size: 24px; font-weight: bold; color: var(--secondary-color);">S/. ${stats.total_paid || '0.00'}</div>
                            <div style="color: var(--text-secondary);">Total Pagado</div>
                        </div>
                    </div>
                </div>
                
                <div class="payments-info">
                    <h3 style="color: var(--secondary-color); margin-bottom: 15px;">Historial de Pagos</h3>
                    ${payments.length > 0 ? `
                        <div style="max-height: 300px; overflow-y: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead>
                                    <tr style="background: rgba(100, 255, 218, 0.1); color: var(--secondary-color);">
                                        <th style="padding: 12px; text-align: left;">Proyecto</th>
                                        <th style="padding: 12px; text-align: left;">Monto</th>
                                        <th style="padding: 12px; text-align: left;">Fecha</th>
                                        <th style="padding: 12px; text-align: left;">Método</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${payments.map(payment => `
                                        <tr style="border-bottom: 1px solid rgba(100, 255, 218, 0.1);">
                                            <td style="padding: 12px;">${payment.project_name || 'N/A'}</td>
                                            <td style="padding: 12px;">S/. ${parseFloat(payment.amount).toFixed(2)}</td>
                                            <td style="padding: 12px;">${payment.paid_date || 'N/A'}</td>
                                            <td style="padding: 12px;">${payment.method || 'N/A'}</td>
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        </div>
                    ` : '<p style="color: var(--text-secondary); text-align: center;">No hay pagos registrados</p>'}
                </div>
            `;
        }

        // Función para formatear proyectos del cliente
        function formatClientProjects(data) {
            if (!data.success) {
                return `<div class="error-message">${data.message}</div>`;
            }
            
            const projects = data.data;
            
            if (projects.length === 0) {
                return `
                    <div style="text-align: center; padding: 40px;">
                        <div style="font-size: 48px; color: var(--text-secondary); margin-bottom: 20px;">📋</div>
                        <h3 style="color: var(--text-primary); margin-bottom: 10px;">No hay proyectos registrados</h3>
                        <p style="color: var(--text-secondary);">Este cliente no tiene proyectos asignados actualmente.</p>
                    </div>
                `;
            }
            
            // Calcular estadísticas generales
            const totalProjects = projects.length;
            const activeProjects = projects.filter(p => p.status === 'active').length;
            const completedProjects = projects.filter(p => p.status === 'completed').length;
            const totalValue = projects.reduce((sum, p) => sum + parseFloat(p.total_price || 0), 0);
            
            return `
                <div class="projects-dashboard">
                    <!-- Resumen de proyectos -->
                    <div class="projects-summary" style="
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                        gap: 15px;
                        margin-bottom: 30px;
                    ">
                        <div style="
                            background: rgba(100, 255, 218, 0.1);
                            padding: 20px;
                            border-radius: 12px;
                            text-align: center;
                            border: 1px solid rgba(100, 255, 218, 0.2);
                        ">
                            <div style="font-size: 28px; font-weight: bold; color: var(--secondary-color);">${totalProjects}</div>
                            <div style="color: var(--text-secondary); font-size: 0.9rem;">Total Proyectos</div>
                        </div>
                        <div style="
                            background: rgba(100, 255, 218, 0.1);
                            padding: 20px;
                            border-radius: 12px;
                            text-align: center;
                            border: 1px solid rgba(100, 255, 218, 0.2);
                        ">
                            <div style="font-size: 28px; font-weight: bold; color: var(--secondary-color);">${activeProjects}</div>
                            <div style="color: var(--text-secondary); font-size: 0.9rem;">Activos</div>
                        </div>
                        <div style="
                            background: rgba(100, 255, 218, 0.1);
                            padding: 20px;
                            border-radius: 12px;
                            text-align: center;
                            border: 1px solid rgba(100, 255, 218, 0.2);
                        ">
                            <div style="font-size: 28px; font-weight: bold; color: var(--secondary-color);">${completedProjects}</div>
                            <div style="color: var(--text-secondary); font-size: 0.9rem;">Completados</div>
                        </div>
                        <div style="
                            background: rgba(100, 255, 218, 0.1);
                            padding: 20px;
                            border-radius: 12px;
                            text-align: center;
                            border: 1px solid rgba(100, 255, 218, 0.2);
                        ">
                            <div style="font-size: 28px; font-weight: bold; color: var(--secondary-color);">S/. ${totalValue.toFixed(2)}</div>
                            <div style="color: var(--text-secondary); font-size: 0.9rem;">Valor Total</div>
                        </div>
                    </div>
                    
                    <!-- Lista de proyectos -->
                    <div style="max-height: 500px; overflow-y: auto; padding-right: 10px;">
                        <div style="display: grid; gap: 20px;">
                            ${projects.map(project => {
                                const statusColors = {
                                    'active': {
                                        bg: 'rgba(100, 255, 218, 0.15)',
                                        border: 'rgba(100, 255, 218, 0.4)',
                                        text: 'var(--secondary-color)',
                                        icon: '🟢'
                                    },
                                    'pending': {
                                        bg: 'rgba(255, 209, 102, 0.15)',
                                        border: 'rgba(255, 209, 102, 0.4)',
                                        text: 'var(--warning-color)',
                                        icon: '🟡'
                                    },
                                    'completed': {
                                        bg: 'rgba(79, 195, 247, 0.15)',
                                        border: 'rgba(79, 195, 247, 0.4)',
                                        text: '#4fc3f7',
                                        icon: '🔵'
                                    },
                                    'cancelled': {
                                        bg: 'rgba(255, 107, 107, 0.15)',
                                        border: 'rgba(255, 107, 107, 0.4)',
                                        text: 'var(--accent-color)',
                                        icon: '🔴'
                                    }
                                };
                                
                                const statusConfig = statusColors[project.status] || {
                                    bg: 'rgba(136, 146, 176, 0.15)',
                                    border: 'rgba(136, 146, 176, 0.4)',
                                    text: 'var(--text-secondary)',
                                    icon: '⚫'
                                };
                                
                                const statusText = {
                                    'active': 'Activo',
                                    'pending': 'Pendiente',
                                    'completed': 'Completado',
                                    'cancelled': 'Cancelado'
                                };
                                
                                const progressColor = project.progress >= 80 ? 'var(--success-color)' : 
                                                    project.progress >= 50 ? 'var(--warning-color)' : 
                                                    'var(--secondary-color)';
                                
                                return `
                                    <div style="
                                        border: 1px solid ${statusConfig.border};
                                        border-radius: 12px;
                                        padding: 25px;
                                        background: rgba(10, 25, 47, 0.6);
                                        transition: all 0.3s ease;
                                    " onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.2)';" 
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        
                                        <!-- Header del proyecto -->
                                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                                            <div style="flex: 1;">
                                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                                    <div style="font-size: 20px;">📁</div>
                                                    <h3 style="margin: 0; color: var(--text-primary); font-size: 1.3rem; font-weight: 600;">${project.name}</h3>
                                                </div>
                                                <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                                    <span style="
                                                        background: ${statusConfig.bg};
                                                        color: ${statusConfig.text};
                                                        padding: 6px 16px;
                                                        border-radius: 20px;
                                                        font-size: 0.85rem;
                                                        font-weight: 500;
                                                        border: 1px solid ${statusConfig.border};
                                                        display: flex;
                                                        align-items: center;
                                                        gap: 6px;
                                                    ">
                                                        ${statusConfig.icon} ${statusText[project.status] || project.status}
                                                    </span>
                                                    <span style="color: var(--text-secondary); font-size: 0.9rem;">
                                                        ${project.type || 'Tipo no especificado'}
                                                    </span>
                                                </div>
                                            </div>
                                            <div style="text-align: right;">
                                                <div style="font-size: 1.5rem; font-weight: bold; color: var(--secondary-color);">
                                                    S/. ${parseFloat(project.total_price || 0).toFixed(2)}
                                                </div>
                                                <div style="color: var(--text-secondary); font-size: 0.85rem;">Presupuesto</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Información del proyecto -->
                                        <div style="
                                            display: grid;
                                            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                                            gap: 20px;
                                            margin-bottom: 20px;
                                            padding: 20px;
                                            background: rgba(17, 34, 64, 0.5);
                                            border-radius: 8px;
                                        ">
                                            <div>
                                                <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 5px;">Fecha de Entrega</div>
                                                <div style="color: var(--text-primary); font-weight: 500; display: flex; align-items: center; gap: 8px;">
                                                    <span>📅</span> ${project.delivery_date_formatted || 'No definida'}
                                                </div>
                                            </div>
                                            <div>
                                                <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 5px;">Fecha de Creación</div>
                                                <div style="color: var(--text-primary); font-weight: 500; display: flex; align-items: center; gap: 8px;">
                                                    <span>🕒</span> ${project.created_at || 'No disponible'}
                                                </div>
                                            </div>
                                            <div>
                                                <div style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 5px;">Progreso Actual</div>
                                                <div style="color: var(--text-primary); font-weight: 500; display: flex; align-items: center; gap: 8px;">
                                                    <span>📊</span> ${project.progress || 0}%
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Barra de progreso -->
                                        <div style="margin-bottom: 15px;">
                                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                                <div style="color: var(--text-secondary); font-size: 0.9rem;">Progreso del proyecto</div>
                                                <div style="color: ${progressColor}; font-weight: 600; font-size: 0.9rem;">${project.progress || 0}%</div>
                                            </div>
                                            <div style="
                                                background: rgba(136, 146, 176, 0.2);
                                                border-radius: 10px;
                                                height: 12px;
                                                overflow: hidden;
                                            ">
                                                <div style="
                                                    background: ${progressColor};
                                                    height: 100%;
                                                    border-radius: 10px;
                                                    width: ${project.progress || 0}%;
                                                    transition: width 0.5s ease;
                                                    box-shadow: 0 0 10px ${progressColor}40;
                                                "></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Información adicional -->
                                        <div style="
                                            display: flex;
                                            justify-content: space-between;
                                            align-items: center;
                                            padding-top: 15px;
                                            border-top: 1px solid rgba(100, 255, 218, 0.1);
                                        ">
                                            <div style="color: var(--text-secondary); font-size: 0.85rem;">
                                                ID: ${project.id} • Creado: ${project.created_at ? project.created_at.split(' ')[0] : 'N/A'}
                                            </div>
                                            <div style="
                                                color: var(--secondary-color);
                                                font-size: 0.9rem;
                                                font-weight: 500;
                                                display: flex;
                                                align-items: center;
                                                gap: 6px;
                                            ">
                                                <span>👁️</span> Detalles del proyecto
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }).join('')}
                        </div>
                    </div>
                    
                    <!-- Pie de página del modal -->
                    <div style="
                        margin-top: 25px;
                        padding-top: 20px;
                        border-top: 1px solid rgba(100, 255, 218, 0.1);
                        text-align: center;
                        color: var(--text-secondary);
                        font-size: 0.9rem;
                    ">
                        Mostrando ${projects.length} proyecto${projects.length !== 1 ? 's' : ''} • Última actualización: ${new Date().toLocaleDateString()}
                    </div>
                </div>
            `;
        }
        
        // Función para mostrar resultados
        function displayResults(clients) {
            resultsContainer.innerHTML = '';
            
            // Mostrar información de la URL actual
            const currentClientId = getClientIdFromURL();
            if (currentClientId) {
                const urlInfo = document.createElement('div');
                urlInfo.className = 'url-info';
                urlInfo.innerHTML = `🔗 <strong>URL actual:</strong> Cliente ID: ${currentClientId}`;
                resultsContainer.appendChild(urlInfo);
            }
            
            if (clients.length === 0) {
                resultsContainer.innerHTML = `
                    <div class="no-results">
                        <h3>No se encontraron clientes</h3>
                        <p>Intenta con otros términos de búsqueda</p>
                    </div>
                `;
                updateURL(); // Limpiar URL si no hay resultados
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
                        <button class="btn btn-primary btn-small" onclick="viewClientDetails(${client.id}, true)">Ver Información Completa</button>
                        <button class="btn btn-secondary btn-small" onclick="viewClientProjects(${client.id}, true)">Ver Proyectos</button>
                    </div>
                `;
                
                resultsContainer.appendChild(clientCard);
            });
            
            // Si hay exactamente un resultado, actualizar la URL con ese ID
            if (clients.length === 1) {
                updateURL(clients[0].id);
            } else {
                updateURL(); // Limpiar URL si hay múltiples resultados
            }
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
            updateURL(); // Limpiar la URL
        });
        
        // Funciones para los botones de acción
        window.viewClientDetails = async function(clientId, updateUrl = false) {
            try {
                if (updateUrl) {
                    updateURL(clientId);
                }
                const data = await getClientDetails(clientId);
                const content = formatClientDetails(data);
                showModal(`Información Completa - Cliente ID: ${clientId}`, content);
            } catch (error) {
                alert('Error al cargar la información del cliente');
                console.error('Error:', error);
            }
        };
        
        window.viewClientProjects = async function(clientId, updateUrl = false) {
            try {
                if (updateUrl) {
                    updateURL(clientId);
                }
                const data = await getClientProjects(clientId);
                const content = formatClientProjects(data);
                showModal(`Proyectos - Cliente ID: ${clientId}`, content);
            } catch (error) {
                alert('Error al cargar los proyectos del cliente');
                console.error('Error:', error);
            }
        };

        // Buscar automáticamente si hay un ID en la URL al cargar la página
        setTimeout(() => {
            searchFromURL();
        }, 100);

        // Manejar el evento de navegación hacia atrás/adelante
        window.addEventListener('popstate', function(event) {
            searchFromURL();
        });
    });
</script>
</body>
</html>