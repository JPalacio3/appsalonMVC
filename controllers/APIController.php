<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;
use Model\CitaServicio;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();

        echo json_encode($servicios);
    }

    public static function guardar()
    {
        // Almacena la cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];

        // Almacena los servicios con el Id de la cita
        $idServicios = explode(",", $_POST['servicios']);

        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }


        echo json_encode(['resultado' => $resultado]);
    }

    // Eliminar un registro
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Leemos el id
            $id = $_POST['id'];

            // Creamos una instancia del objeto completo
            $cita = Cita::find($id);

            // Asignamos la función eliminar desde Active Record
            $cita->eliminar;

            //Redireccionamos hacia la página en donde estábamos previamente a ejecutar la función de eliminar
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}