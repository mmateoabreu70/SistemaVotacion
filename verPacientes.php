<?php
    session_start();
    include_once("libreria/includes.php");

    if($_SESSION['rol'] == 'Asistente')
    {
        $conexion = Conexion::getInstance();

        $con = conexion::getInstance();

        $p = new gente();

        $gente = new gente();

        $sql = "SELECT * FROM pacientes";
        $datos = mysqli_query($con, $sql);

        if($_POST){
            
            //$gente->id = $_POST['id'];
            $gente->nombre = $_POST['nombre'];
            $gente->apellido = $_POST['apellido'];
            $gente->cedula = $_POST['cedula'];
            $gente->nacimiento = $_POST['nacimiento'];
            $gente->tipoSangre = $_POST['tipoSangre'];
            $gente->telefono = $_POST['telefono'];
            $gente->guardar();

            $sql = "INSERT INTO pacientes VALUES ('$gente->cedula', '$gente->nombre', '$gente->apellido','$gente->nacimiento', '$gente->tipoSangre', '$gente->telefono')";
                
        }else if(isset($_GET['cedula'])){
            $gente = new gente($_GET['cedula']);

        }else if(isset($_GET['del'])){
            gente::desactivar($_GET['del']);

        }
        
    }
      else{
          header("Location:index.php");
      }  
?>

<div>
         <h4>Visualizar pacientes</h4>
            <table class="table">
                <thead class="thead-dark">
                    <tr> 
                      <th>Cedula</th>             
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Fecha de nacimiento</th>
                      <th>Tipo de sangre</th>
                      <th>Telefono</th>

                    </tr>
                </thead>
                <tbody>
                 <?php

                    $datos = gente::listado();

                    foreach($datos as $fila){
                        echo "<tr>
                        <td>{$fila->cedula}</td>
                        <td>{$fila->nombre}</td>
                        <td>{$fila->apellido}</td>
                        <td>{$fila->nacimiento}</td>
                        <td>{$fila->tipoSangre}</td>
                        <td>{$fila->telefono}</td>                
                        </tr>";
                    }

                 ?>
                </tbody>
            </table>
        </div>