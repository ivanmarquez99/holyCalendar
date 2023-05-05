<header>
  <div id="tools" class="bg-primary d-flex flex-row-reverse align-items-center gap-3 px-3">
    <a href="<?= ($BASE) ?>/disconnect" class="btn btn-danger">Desconectar</a>
    <?php if ($SESSION['user_rol']==1): ?>
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalFechas">Añadir
        evento</a>
    <?php endif; ?>
  </div>
</header>
<div id='calendar'></div>
<?php if ($SESSION['user_rol']==1): ?>
  <div class="modal fade" tabindex="-1" id="modalFechas" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar evento al calendario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form id="agregar-evento" action="" method="POST">
            <div class="form-group mb-3">
              <label for="titulo">Título:</label>
              <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group mb-3">
              <label for="descripcion">Descripción:</label>
              <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group mb-3">
                  <label for="fecha_inicio">Fecha de inicio:</label>
                  <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="form-group mb-3">
                  <label for="hora_inicio">Hora de inicio:</label>
                  <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group mb-3">
                  <label for="fecha_fin">Fecha de finalización:</label>
                  <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                </div>
                <div class="form-group mb-3">
                  <label for="hora_fin">Hora de finalización:</label>
                  <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                </div>
              </div>
            </div>
            <div class="form-group mb-3">
              <label for="color">Color:</label>
              <input type="color" class="form-control" id="color" name="color" value="#3788d8">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="agregar-evento">Agregar evento</button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<script>
  var events = <?= ($this->raw($json_events)) ?>;
  // Aquí puedes utilizar la variable `events` para configurar FullCalendar
</script>