<div class="container mt-5">
    <h3 class="mb-4">Nuevo Token API</h3>

    <form method="POST" action="index.php?route=tokens/create">
        <div class="mb-3">
            <label for="client_id" class="form-label">Seleccionar Cliente</label>
            <input type="number" class="form-control" id="client_id" name="client_id" placeholder="ID del cliente" required>
        </div>

        <button type="submit" class="btn btn-primary">Generar Token</button>
        <a href="index.php?route=tokens" class="btn btn-secondary">Volver</a>
    </form>
</div>
