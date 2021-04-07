<?php
require_once("abstract.databoundobject.php");
require_once("class.Twitter.php");
require_once("class.pdofactory.php");

//Conexión a la base de datos Postgres

$servername = "localhost";
$dbname = "postgres";
$username = "postgres";
$password = "P@ssw0rd";
$port = "5432";

$conexion = pg_connect("host=".$servername." port=".$port." dbname=".$dbname." user=".$username." password=".$password."") or die("Connection failed: ".pg_last_error());

?>

<!DOCTYPE html>
<html>
<head>
        <title>Tabla de los Tweets obtenidos</title>
        <style type="text/css">
                table, th, td{
                        border: 1px solid black;
                        border-collapse: collapse;
                }
                .campos{
                        background-color: #00CED1;
                        font-weight: bold;
                        font-size: 25px;
                        text-align: center;
                        padding: 10px;
                }
                h1{
                        text-align: center;
                }
        </style>
</head>
<body>
<h1>Tabla de los Tweets obtenidos del usuario escogido</h1>

<br>
        <table>
                <tr>
                        <td class="campos">Fecha</td>
                        <td class="campos">Usuario</td>
                        <td class="campos">Tweet</td>
                </tr>

                <?php
                        $sql = "SELECT * from twitter";
                        $result = pg_query($conexion, $sql);

                        while ($mostrar=pg_fetch_array($result)) {
                ?>

                <tr>
                        <td><?php echo $mostrar['fecha'] ?></td>
                        <td><?php echo $mostrar['usuario'] ?></td>
                        <td><?php echo $mostrar['tweet'] ?></td>
                </tr>
                <?php 
                        }
                ?>
        </table>
</body>
</html>