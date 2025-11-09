<div class="row mb-3">
  <div class="col-md-3"><div class="card text-white bg-primary"><div class="card-body"><h5>Total Clientes</h5><h3><?= $totalClients ?></h3></div></div></div>
  <div class="col-md-3"><div class="card text-white bg-success"><div class="card-body"><h5>Total Proyectos</h5><h3><?= $totalProjects ?></h3></div></div></div>
  <div class="col-md-3"><div class="card text-white bg-info"><div class="card-body"><h5>Total Pagos (S/)</h5><h3><?= number_format($totalPayments,2) ?></h3></div></div></div>
  <div class="col-md-3"><div class="card text-white bg-secondary"><div class="card-body"><h5>Requests API</h5><h3><?= $totalRequests ?></h3></div></div></div>
</div>

<div class="card">
  <div class="card-header"><h5>Últimos proyectos</h5></div>
  <div class="card-body">
    <table class="table datatable">
      <thead><tr><th>ID</th><th>Nombre</th><th>Cliente</th><th>Fechas</th><th>Estado</th></tr></thead>
      <tbody>
        <?php foreach($recentProjects as $p): ?>
          <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['client_name']) ?></td>
            <td><?= htmlspecialchars($p['start_date']) ?> → <?= htmlspecialchars($p['end_date']) ?></td>
            <td><?= htmlspecialchars($p['status']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
