<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>API de Gestión de Proyectos</title>
    <link rel="stylesheet" href="/webcon/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>🔍 Consulta de Clientes y sus Proyectos</h2>

        <form id="formBuscar">
            <label>ID del Cliente:</label>
            <input type="number" id="clienteId" placeholder="Ingrese el ID del cliente">
            <button type="submit">Buscar</button>
        </form>

        <div id="resultado" class="mt-4"></div>
    </div>

    <script>
    document.getElementById('formBuscar').addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('clienteId').value.trim();
        if (!id) return alert("Ingrese un ID válido");

        const res = await fetch(`/webcon/index.php?route=apiProyecto:show&id=${id}`);
        const data = await res.json();

        const cont = document.getElementById('resultado');
        cont.innerHTML = '';

        if (data.error) {
            cont.innerHTML = `<p style="color:red;">${data.error}</p>`;
        } else {
            let html = `
                <h3>Cliente: ${data.razon_social}</h3>
                <p><strong>RUC:</strong> ${data.ruc}</p>
                <p><strong>Correo:</strong> ${data.correo}</p>
                <h4>Proyectos Asociados:</h4>
            `;
            if (data.proyectos.length === 0) {
                html += `<p>No tiene proyectos registrados.</p>`;
            } else {
                html += `<ul>`;
                data.proyectos.forEach(p => {
                    html += `
                        <li>
                            <strong>${p.nombre_proyecto}</strong> — ${p.descripcion} 
                            <br><small>Estado: ${p.estado} | Inicio: ${p.fecha_inicio} | Fin: ${p.fecha_fin}</small>
                        </li>
                    `;
                });
                html += `</ul>`;
            }
            cont.innerHTML = html;
        }
    });
    </script>
</body>
</html>
