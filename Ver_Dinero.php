<?php
session_start();
include('libreria/includes.php');
//// Aqui es el select para la tabla de citas y asi mostrar algunos campos
$conexion = Conexion::getInstance();
$sql="SELECT id, paciente,fechaCita, costo from citas";
$result = $conexion->query($sql);
 /// Aqui es la suma de todos los campos de la celda
$consulta="SELECT SUM(costo) as TotalPrecios FROM citas";
$resultado=$conexion -> query($consulta);
$fila=$resultado->fetch_assoc();

if(isset($_GET['id']))
    {
        $user = new Usuario();
        $user->Id = $_GET['id'];

        $user->eliminarUsuario();
    }
?>
<html>
<caption><h1><center>Dinero recaudado</caption></h1></center>
</br>
<table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Cedula paciente</th>
                <th scope="col">Fecha de cita</th>
                <th scope="col">Pago</th>
           
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($result as $fila)
                {
                    echo "
                        <tr>
                            <td>{$fila['id']}</td>
                            <td>{$fila['paciente']}</td>
                            <td>{$fila['fechaCita']}</td>
                            <td>{$fila['costo']}</td>
                        </tr>
                    ";
                }
                /// Aqui se esta haciendo el mostrar del total

                foreach ($resultado as $fila) {
                    $TotalPrecios=$fila['TotalPrecios'];

                }

                echo "<tr>
                <th colspan ='3'></th>
        <th>Total: $TotalPrecios </th>
                </tr>              
                "
            ?>
        </tbody>
    </table>
</div>
<?php
include('libreria/foot.php');
?>