<?php
require_once('../models/peliculas.models.php');

error_reporting(0);
$peliculas = new Clase_Peliculas();

switch ($_GET['op']) {

    case 'todos':
        $datos = array();
        $datos = $peliculas->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $id = $_POST['id'];
        $datos = array();
        $datos = $peliculas->uno($id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $titulo = $_POST['titulo'];
        $director = $_POST['director'];
        $anio_estreno = $_POST['anio_estreno'];
        $genero = $_POST['genero'];
        $sinopsis = $_POST['sinopsis'];
        $datos = array();
        $datos = $peliculas->insertar($titulo, $director, $anio_estreno, $genero, $sinopsis);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $director = $_POST['director'];
        $anio_estreno = $_POST['anio_estreno'];
        $genero = $_POST['genero'];
        $sinopsis = $_POST['sinopsis'];
        $datos = array();
        $datos = $peliculas->actualizar($id, $titulo, $director, $anio_estreno, $genero, $sinopsis);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id = $_POST['id'];
        $datos = array();
        $datos = $peliculas->eliminar($id);
        echo json_encode($datos);
        break;

    case 'contar':
        $datos = array();
        $datos = $peliculas->contar();
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'detalles':
        $id = $_POST['id'];
        $datos = $peliculas->uno($id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
}
?>

