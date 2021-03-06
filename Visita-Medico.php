<?php
  session_start();
  include('libreria/includes.php');

  if($_SESSION['rol'] == 'Medico')
  {
    $conexion = Conexion::getInstance();

    $sql="SELECT apellido,nombre from pacientes";
    $result = $conexion->query($sql);
    
    if($_POST){

      extract($_POST);
      $id = 1;

      $sql = "INSERT INTO visitas VALUES (0,'{$nombre}','{$fecha}','{$motivo}','{$comentario}','{$receta}','{$fechaVisita}')";
      mysqli_query($conexion, $sql);

      $id = mysqli_insert_id($conexion);
      
      $report = new ReporteSistema();
      $report->RegistrarEvento(9);

      header("Location: receta.php?idVisita={$id}");
    }
    
  }
  else {
    header("Location: index.php");
  } 

  include_once("libreria/head.php");
?>  

<caption><h1><center>Visitas</caption></h1></center>
    </br>
    <center>
    
<form enctype = "multipart/form-data" class="col-md-6" method="post">
  <select class="form-control form-control-sm" class="col-md-4 " name="nombre" readonly>
    <option selected>Elegir paciente</option>
    <?php
     
      foreach($result as $row)
      {
        echo "
          <option>{$row['nombre']} {$row['apellido']}</option>
       ";}
   
    ?>
  </select>
  <div class="form-group">
    <label for="fecha1">Fecha Actual</label>
    <input type="date" class="form-control" id="fecha1" name="fecha" value="<?php echo date('Y-m-d'); ?>">
  </div>
  <div class="form-group">
    <label for="mot">Motivo de la visita</label>
    <textarea class="form-control" id="mot" rows="3" name = "motivo"></textarea>
  </div>
  <div class="form-group">
    <label for="com">Comentario</label>
    <textarea class="form-control" id="com" rows="3" name = "comentario"></textarea>
  </div>
  <div class="form-group">
    <label for="res">Receta</label>
    <textarea class="form-control" id="res" rows="3" name = "receta"></textarea>
  </div>
  <div class="form-group">
    <label for="fecha2">Fecha Proxima Visita</label>
    <input type="date" class="form-control" id="fecha2" name = "fechaVisita">
  </div>
</center>

<center><button type="Submit" class="btn btn-success" name="action">Agregar</button></center>
    </br>
</form>
<?php
include('libreria/foot.php');
?>