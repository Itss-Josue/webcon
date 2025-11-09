<div class="d-flex justify-content-between mb-2">
  <h4>Registro de Requests API</h4>
</div>
<table class="table datatable">
<thead><tr><th>ID</th><th>Token</th><th>Endpoint</th><th>Response</th><th>Fecha</th></tr></thead>
<tbody>
<?php foreach($requests as $r): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= htmlspecialchars($r['api_token']) ?></td>
  <td><?= htmlspecialchars($r['endpoint']) ?></td>
  <td><?= $r['response_code'] ?></td>
  <td><?= $r['request_date'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
