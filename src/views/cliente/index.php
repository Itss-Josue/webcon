<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Búsqueda de Cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{font-family:system-ui,Arial,sans-serif;margin:20px;color:#1f2937}
    .box{border:1px solid #e5e7eb;border-radius:12px;padding:16px;max-width:720px}
    label{display:block;margin-bottom:6px}
    input,select,button{padding:10px;border:1px solid #d1d5db;border-radius:10px;width:100%}
    button{cursor:pointer}
    .row{display:grid;grid-template-columns:160px 1fr;gap:10px;align-items:center}
    .mt{margin-top:12px}
    pre{background:#0b1020;color:#e5e7eb;padding:12px;border-radius:10px;overflow:auto}
    .muted{color:#6b7280}
    a{color:#111}
    ul{margin-top:0}
  </style>
</head>
<body>
  <h1>Módulo de Clientes</h1>
  <p><a href="?controller=admin&action=index">← Panel de administración</a></p>
  <div class="box">
    <form id="form-busqueda" class="mt" onsubmit="return false;">
      <div class="row">
        <label for="tipo">Buscar por</label>
        <select id="tipo" name="tipo">
          <option value="dni">DNI</option>
          <option value="nombre">Nombre</option>
        </select>
      </div>
      <div class="row mt">
        <label for="query">Criterio</label>
        <input type="text" id="query" name="query" placeholder="Ej: 12345678 o Juan Pérez">
      </div>
      <div class="mt">
        <button id="btnBuscar">Buscar</button>
      </div>
    </form>

    <div id="resultado" class="mt"></div>
  </div>

  <script>
    const el = (s) => document.querySelector(s);

    el('#btnBuscar').addEventListener('click', async () => {
      const formData = new FormData();
      formData.append('tipo', el('#tipo').value);
      formData.append('query', el('#query').value.trim());

      const res = await fetch('?controller=cliente&action=buscar', {
        method: 'POST',
        body: formData
      });

      const data = await res.json();
      const out = el('#resultado');

      if (!data.success) {
        out.innerHTML = '<p class="muted">' + (data.message || 'Sin resultados') + '</p>';
        return;
      }

      const c = data.data;
      let html = `
        <h3>Cliente</h3>
        <p><strong>${c.nombre}</strong> — DNI/RUC: ${c.dni}</p>
        <p class="muted">${c.empresa ?? ''} — ${c.email ?? ''} — ${c.telefono ?? ''}</p>
        <h3>Proyectos</h3>
      `;

      if (!c.proyectos || c.proyectos.length === 0) {
        html += '<p class="muted">Sin proyectos asociados.</p>';
      } else {
        html += '<ul>';
        c.proyectos.forEach(p => {
          html += `
            <li>
              <strong>${p.nombre}</strong> (${p.tipo || 'Sin tipo'}) — S/ ${Number(p.precio).toFixed(2)}<br>
              Estado: ${p.estado} — Progreso: ${p.progreso}% — Entrega: ${p.fecha_entrega}<br>
              Características: ${Array.isArray(p.caracteristicas) ? p.caracteristicas.join(', ') : ''}
            </li>
          `;
        });
        html += '</ul>';
      }

      out.innerHTML = html;
    });
  </script>
</body>
</html>
