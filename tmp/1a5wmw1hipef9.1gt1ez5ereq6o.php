<?php echo $this->render('../templates/layout/'.$header,NULL,get_defined_vars(),0); ?>
<section class="vh-100 gradient-form login">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6 d-flex align-items-center bg-dark rounded-start">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">De cofrade para cofrades...</h4>
                <p class="small mb-0">Enterate en todo momento de los eventos de tu cofradía sin necesidad de tener que
                  estar escribiendo por el grupo de tu junta molestando.
                  Desde aquí te podrás apuntar cómodamente y ver todo de un vistazo
                </p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <h4 class="mt-1 mb-5 pb-1"><span class="text-primary">holy</span>Calendar</h4>
                  <span class="text-danger"><?= ($error) ?></span>
                </div>

                <form action="" method="post">
                  <div class="mb-3">
                    <input type="text" name="usuario" class="form-control" placeholder="Usuario"  value="<?= ($nombre) ?>" required/>
                  </div>

                  <div class="mb-3">
                    <input type="email" name="correo" class="form-control" placeholder="Email" value="<?= ($email) ?>" required/>
                  </div>

                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" value="<?= ($password) ?>" required/>
                  </div>

                  <div class="text-center d-flex flex-d flex-column pt-1 mb-5 pb-1">
                    <button class="btn btn-dark btn-block fa-lg mb-3" type="submit">Registrar</button>
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>