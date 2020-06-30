<!DOCTYPE html>
<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}?>

<html lang="es">
<?php include 'header.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.2.1/jquery.quicksearch.js"></script>

<body>  
  <div class="container-fluid mt-4">
    <h6>Libro de Banco</h6>
    <div class="row">
      <div class="col-md-4">
        <input type="text" id="search" class="form-control form-control-sm" placeholder="Escribe para buscar..." />
      </div>
      <div class="col-md-8 text-right">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">+ Nueva Orden</button>
        <a class="btn btn-warning btn-sm" href="logout.php">Cerrar sesión</a>  
      </div>     
    </div>
    <div class="row mt-2">
      <div class="col-md-12">
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Nueva Orden de Egreso</h4><button type="button" class="btn btn-default" data-dismiss="modal">X</button>
              </div>
              <div class="modal-body">
                <form action="procesos/agregarOrden.php" method="post">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Fecha de Orden</label>
                      <input type="date" class="form-control" id="fecha" name="fecha" required>                      
                    </div>
                    <div class="col-md-6">
                      <label>Seleccionar Cuenta</label>
                      <select class="custom-select" name="cuenta" id="cuenta">
                        <option selected required>Seleccionar..</option>
                        <option value="22903-4">Cta. Cte. 22903-4</option>
                        <option value="50123-7">Cta. Cte. 50123-7</option>
                        <option value="52484-9">Cta. Cte. 52484-9</option>
                      </select>                      
                    </div>                                          
                  </div>                       
                  <div class="form-row">
                      <label>Beneficiario</label>
                      <input type="text" class="form-control" id="beneficiario" name="beneficiario" placeholder="Apellido y Nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                  </div>
                  <div class="form-row">
                      <label>Concepto:</label>
                      <input type="text" class="form-control" name="concepto" id="concepto" placeholder="Concepto" required onkeyup="javascript:this.value=this.value.toUpperCase();">        
                  </div>
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Forma de Pago</label>
                      <select class="custom-select" name="forma_pago" id="forma_pago" required>
                        <option selected >Seleccionar..</option>
                        <option value="EFECTIVO">Efectivo</option>
                        <option value="TRANSFERENCIA">Transferencia</option>
                        <option value="CHEQUE">Cheque</option>
                      </select>                      
                    </div>
                    <div class="col-md-6">
                      <label>N° de Cheque</label>
                      <input class="form-control" type="number" name="n_cheque" id="n_cheque">                      
                    </div>       
                  </div>
                  <div class="form-row">
                      <label>Observaciones:</label>
                      <textarea class="form-control" name="obs" id="obs" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea> 
                  </div>                          
                  <div class="form-row">
                      <label>Importe</label>
                      <input type="number" class="form-control" name="importe" id="importe" step="any" placeholder="0,00" required onkeyup="Remplaza(document.subform.texto.value);">
                  </div>
                  <div class="form-row">
                    <button type="submit" class="btn btn-success btn-block">Confirmar Datos</button>
                  </div>            
                </form>
              </div>
            </div>
          </div>
        </div>        
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-sm" id="table">
            <thead>
                <tr>
                  <th >Fecha:</th>
                  <th >Cuenta:</th>
                  <th >Beneficiario</th>
                  <th >Forma de Pago</th>
                  <th >N° de Cheque</th>
                  <th >Concepto</th>
                  <th >Importe</th>
                  <th >Observaciones</th>
                  <th ></th>
                </tr>
              </thead>
                  <?php
                  require_once ("conexion/db.php");
                  require_once ("conexion/conexion.php");
                  $query_ped=mysqli_query($conn,"select * from orden order by fecha DESC");  
                  while($rw=mysqli_fetch_array($query_ped)) {  
                  ?>                
              <tbody>
                <tr>
                    <td><?php $date = $rw['fecha']; $newDate = date("d/m/Y", strtotime($date)); echo $newDate; ?></td>
                    <td><?php echo $rw['cuenta']; ?></td>
                    <td><a href="reporte.php?id=<?php echo $rw['id_orden']; ?>" target="_blank"><?php echo $rw['beneficiario']; ?></a></td>
                    <td><?php echo $rw['forma_pago']; ?></td>
                    <td><?php echo $rw['n_cheque']; ?></td>

                    <td><?php echo $rw['concepto']; ?></td>
                    <td>$ <?php echo $rw['importe']; ?>.-</td>
                    <td><?php echo $rw['obs']; ?></td>
                    <td><a href="procesos/borrarOrden.php?id=<?php echo $rw['id_orden']; ?>" onclick="return confirm('Pulce ACEPTAR para confirmar la eliminacion o CANCELAR la eliminacion');"><img src="img/error.png" style="width: 12px"></a></td> 
                  <?php
                  }
                  ?>
                </tr>
              </tbody>
          </table>
        </div>      
      </div>      
    </div>
  </div>
  <?php include 'footer.php';?>
</body>
<script type="text/javascript">

function Remplaza(entry) {
  out = "."; // reemplazar el .
  add = ","; // por ,
  temp = "" + entry;
  while (temp.indexOf(out)>-1) {
  pos= temp.indexOf(out);
  temp = "" + (temp.substring(0, pos) + add + 
  temp.substring((pos + out.length), temp.length));
  }
  document.subform.texto.value = temp;
}

$("#search").keyup(function(){
    _this = this;
    // Muestra los tr que concuerdan con la busqueda, y oculta los demás.
    $.each($("#table tbody tr"), function() {
        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
           $(this).hide();
        else
           $(this).show();                
    });
}); 
</script> 
</html>

