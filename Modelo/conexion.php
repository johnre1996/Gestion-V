<?php

    $conexion = pg_connect("host=localhost dbname=GESTION_VEHICULAR user=postgres password=root");
    if ($conexion) {
        //echo "conexion exitosa";
    }else{
        echo "no se conecto";

    }




?>