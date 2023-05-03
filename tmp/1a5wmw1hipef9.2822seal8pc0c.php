<header>
  <div id="tools" class="bg-primary d-flex flex-row-reverse align-items-center gap-3 px-3">
    <a href="<?= ($BASE) ?>/disconnect" class="btn btn-danger">Desconectar</a>
    <?php if ($SESSION['user_rol']==1): ?>
        <a href="<?= ($BASE) ?>/fechas" class="btn btn-secondary">Añadir fechas</a>
  <?php endif; ?>
  </div>
</header>
<div id='calendar'></div>
</body>