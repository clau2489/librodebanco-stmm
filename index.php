<!DOCTYPE html>
<html lang="es">
<?php include 'header.php';?>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <form class="form-login" action="login.php" method="post">
          <div class="form-group">
            <h5 class="lead">Iniciar Sesión</h5>
            <br>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="usuario" name="usuario" placeholder="Usuario">
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-sm" id="contrasenia" name="contrasenia" placeholder="Contraseña">
          </div>
          <button type="submit" class="btn btn-success btn-block btn-sm">Ingresar</button>
        </form>        
      </div>
    </div>
  </div>  
  <?php include 'footer.php';?>
</body>
</html>