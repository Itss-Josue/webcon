-- Base de datos para WebDev Solutions
CREATE DATABASE webdev_solutions;
USE webdev_solutions;

-- Tabla de usuarios del sistema
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    rol ENUM('admin', 'desarrollador', 'cliente') DEFAULT 'cliente',
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(8) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(15),
    email VARCHAR(100),
    empresa VARCHAR(100),
    direccion TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo'
);

-- Tabla de tipos de proyecto
CREATE TABLE tipos_proyecto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    precio_base DECIMAL(10,2) NOT NULL,
    descripcion TEXT
);

-- Tabla de proyectos
CREATE TABLE proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    tipo_proyecto_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_entrega DATE NOT NULL,
    progreso INT DEFAULT 0,
    estado ENUM('pendiente', 'en_progreso', 'completado', 'cancelado') DEFAULT 'pendiente',
    caracteristicas JSON,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (tipo_proyecto_id) REFERENCES tipos_proyecto(id)
);

-- Tabla de pagos
CREATE TABLE pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    proyecto_id INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    fecha_pago DATE NOT NULL,
    metodo_pago ENUM('efectivo', 'transferencia', 'tarjeta') DEFAULT 'efectivo',
    comprobante VARCHAR(100),
    observaciones TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (proyecto_id) REFERENCES proyectos(id) ON DELETE CASCADE
);

-- Insertar datos iniciales
INSERT INTO usuarios (username, password, nombre, email, rol) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador Sistema', 'admin@webdevsolutions.com', 'admin'),
('dev01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Luis Rodriguez', 'luis@webdevsolutions.com', 'desarrollador');

INSERT INTO tipos_proyecto (nombre, precio_base, descripcion) VALUES
('Website Corporativo', 3500.00, 'Sitio web empresarial con diseño profesional'),
('E-commerce', 4200.00, 'Tienda online con carrito de compras'),
('Landing Page', 1500.00, 'Página de aterrizaje para campañas'),
('Portal Web', 2800.00, 'Portal web con múltiples funcionalidades');

INSERT INTO clientes (dni, nombre, telefono, email, empresa, direccion) VALUES
('12345678', 'Juan Carlos Pérez Mendoza', '+51 987 654 321', 'juan.perez@email.com', 'Pérez & Asociados SAC', 'Av. Los Olivos 123, Lima'),
('87654321', 'María Elena González Rojas', '+51 912 345 678', 'maria.gonzalez@gmail.com', 'Boutique Elena', 'Jr. La Unión 456, Huancayo'),
('45678912', 'Roberto Silva Castillo', '+51 998 765 432', 'roberto.silva@empresa.com', 'Constructora Silva SAC', 'Av. Real 789, Huanta');

INSERT INTO proyectos (cliente_id, tipo_proyecto_id, nombre, descripcion, precio, fecha_inicio, fecha_entrega, progreso, estado, caracteristicas) VALUES
(1, 1, 'Página Web Corporativa', 'Desarrollo de página web corporativa con sistema de citas online', 3500.00, '2024-01-15', '2024-02-28', 75, 'en_progreso', '["Diseño responsive", "Sistema de citas", "Panel administrativo", "Optimización SEO", "Certificado SSL"]'),
(2, 2, 'Tienda Online de Ropa', 'Plataforma e-commerce para venta de ropa con carrito de compras', 4200.00, '2024-02-01', '2024-03-15', 100, 'completado', '["Catálogo de productos", "Carrito de compras", "Pasarela de pagos", "Panel de administración", "Sistema de inventario"]'),
(3, 4, 'Portal Inmobiliario', 'Portal web para mostrar proyectos inmobiliarios con galería virtual', 2800.00, '2024-02-10', '2024-03-25', 45, 'pendiente', '["Galería de proyectos", "Tour virtual 360°", "Formulario de contacto", "Mapa interactivo", "Blog de noticias"]');

INSERT INTO pagos (proyecto_id, monto, fecha_pago, metodo_pago) VALUES
(1, 1750.00, '2024-01-15', 'transferencia'),
(2, 4200.00, '2024-03-15', 'transferencia');