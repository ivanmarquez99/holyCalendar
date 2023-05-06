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
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventTitle"></h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Fecha:</strong> <span id="eventDate"></span></p>
        <p><strong>Hora de inicio:</strong> <span id="eventStart"></span></p>
        <p><strong>Hora de fin:</strong> <span id="eventEnd"></span></p>
        <p><strong>Descripción:</strong> <span id="eventDescription"></span></p>
      </div>
      <div class="modal-footer">
        <form action="agenda/inscribirse" method="POST">
          <input type="hidden" name="id-user" id="id-user" value="<?= ($SESSION['user_id']) ?>">
          <input type="hidden" name="id-event" id="id-event" value="">
        <button class="btn btn-primary" id="apuntarse" type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-heart" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5ZM1 14V4h14v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1Zm7-6.507c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z"/>
          </svg>
          Apuntarse
        </button>
        </form>
        <?php if ($SESSION['user_rol']==1): ?>
          <form action="" method="POST">
            <button type="submit" class="btn btn-success" id="editEvent" aria-label="Edit">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path
                  d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z">
                </path>
                <path fill-rule="evenodd"
                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z">
                </path>
              </svg> Editar
            </button>
            <button type="submit" class="btn btn-danger" id="deleteEvent" formmethod="POST">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                viewBox="0 0 16 16">
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                <path
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
              </svg> Eliminar
            </button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<input id="prodId" name="prodId" type="hidden" value="<?= ($json_events) ?>">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"
  integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <!-- <script>
  var events = <?= ($this->raw($json_events)) ?>;
</script> -->