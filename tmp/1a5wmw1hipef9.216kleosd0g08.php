<div class="vh-100 d-flex justify-content-center align-items-center" id="background">
<div class="w-75 bg-dark p-5 rounded-5 text-white">
<form action="<?= ($BASE) ?>/agenda/actualizar" method="POST">
    <input type="hidden" name="id" value="<?= ($evento['id']) ?>">
    <div class="mb-3">
        <label for="titulo" class="form-label">Título:</label>
        <input type="text" name="titulo" id="titulo" class="form-control" value="<?= ($evento['titulo']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required><?= ($evento['descripcion']) ?></textarea>
    </div>
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?= ($evento['fecha_inicio']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="<?= ($evento['hora_inicio']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="fecha_fin" class="form-label">Fecha de fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="<?= ($evento['fecha_fin']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora de fin:</label>
        <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="<?= ($evento['hora_fin']) ?>" required>
    </div>
    <button type="submit" class="btn btn-light">Actualizar evento</button>
</form>
</div>
</div>