// public/js/geolocate.js
document.addEventListener('DOMContentLoaded', function(){
  const btn = document.getElementById('locateBtn');
  const out = document.getElementById('nearResults');

  btn.addEventListener('click', function(){
    out.innerHTML = 'Obteniendo ubicación…';
    if (!navigator.geolocation) {
      out.innerHTML = 'Geolocalización no soportada por este navegador.';
      return;
    }
    navigator.geolocation.getCurrentPosition(success, error, {timeout:10000});
  });

  function success(pos) {
    const lat = pos.coords.latitude;
    const lng = pos.coords.longitude;
    out.innerHTML = 'Buscando hoteles cerca de ('+lat.toFixed(5)+','+lng.toFixed(5)+')...';
    fetch(`/api/nearby.php?lat=${lat}&lng=${lng}&radius=10`)
      .then(r=>r.json()).then(data=>{
        if (data.error) { out.innerHTML = 'Error: '+data.error; return; }
        if (data.count === 0) { out.innerHTML = 'No se encontraron hoteles cerca en 10km.'; return; }
        const list = document.createElement('ul');
        data.hotels.forEach(h=>{
          const li = document.createElement('li');
          li.innerHTML = `<strong>${h.name}</strong> — ${h.address || ''} (dist: ${parseFloat(h.distance).toFixed(2)} km) <a href="/?route=hotel:view&id=${h.id}">Ver</a>`;
          list.appendChild(li);
        });
        out.innerHTML = `<p>Encontrados ${data.count} hoteles:</p>`;
        out.appendChild(list);
      }).catch(err=>{
        out.innerHTML = 'Error al llamar a API: '+err;
      });
  }

  function error(e) {
    out.innerHTML = 'Error al obtener ubicación: ' + (e.message || 'permiso denegado');
  }
});
