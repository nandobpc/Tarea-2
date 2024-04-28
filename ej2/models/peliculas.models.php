<?php
require_once('../config/conexion.php');

class Clase_Peliculas
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->ProcedimientoConectar();
        $sql = "SELECT * FROM peliculas";
        $datos = mysqli_query($con, $sql);
        $con->close();
        return $datos;
    }

    public function uno($id)
    {
        $con = new Clase_Conectar();
        $con = $con->ProcedimientoConectar();
        $sql = "SELECT * FROM peliculas WHERE id=$id";
        $datos = mysqli_query($con, $sql);
        $con->close();
        return $datos;
    }

    public function insertar($titulo, $director, $anio_estreno, $genero, $sinopsis)
    {
        $con = new Clase_Conectar();
        $con = $con->ProcedimientoConectar();
        $sql = "INSERT INTO peliculas (titulo, director, anio_estreno, genero, sinopsis) VALUES ('$titulo', '$director', $anio_estreno, '$genero', '$sinopsis')";
        $datos = mysqli_query($con, $sql);
        $con->close();
        return $datos;
    }

    public function actualizar($id, $titulo, $director, $anio_estreno, $genero, $sinopsis)
    {
        $con = new Clase_Conectar();
        $con = $con->ProcedimientoConectar();
        $sql = "UPDATE peliculas SET titulo='$titulo', director='$director', anio_estreno=$anio_estreno, genero='$genero', sinopsis='$sinopsis' WHERE id=$id";
        $datos = mysqli_query($con, $sql);
        $con->close();
        return $datos;
    }

    public function eliminar($id)
    {
        $con = new Clase_Conectar();
        $con = $con->ProcedimientoConectar();
        $sql = "DELETE FROM peliculas WHERE id=$id";
        $datos = mysqli_query($con, $sql);
        $con->close();
        return $datos;
    }

    public function contar()
    {
        $con = new Clase_Conectar();
        $con = $con->ProcedimientoConectar();
        $sql = "SELECT COUNT(*) FROM peliculas";
        $datos = mysqli_query($con, $sql);
        $con->close();
        return $datos;
    }
}
?>













