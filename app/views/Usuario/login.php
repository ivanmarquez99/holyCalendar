<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../../css/login.css">
</head>
<body>
<div class="login-container">
  <div class="logo-container vertical-center">
    <img src="https://i.ibb.co/D5t6vhf/LOGO-ERNESTO-01-1.png" alt="">
  </div>
  <div class=" vertical-center text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <form>
            <img class="mb-4" src="https://i.ibb.co/D5t6vhf/LOGO-ERNESTO-01-1.png" width="200">
            <h1 class="h3 mb-3 fw-normal">Inicio de sesión</h1>

            <div class="form-floating">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Correo electronico</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Contraseña</label>
            </div>

            <div class="checkbox mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Recuerdame
              </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="button">Sign in</button>
            <p class="mt-5 mb-3 text-muted">
              <a id="forgot-password" href="#">¿Ha olvidado su contraseña?</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
