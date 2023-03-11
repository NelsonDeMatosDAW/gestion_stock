<?php

    $ip="mysql:host=localhost"; //Dirección del servidor
    $nombreBBDD="gestion_stock"; //Nombre de la BBDD
    $nombreUsuario="root"; //usuario para BBDD Proyecto
    $contra=""; //contraseña para BBDD Proyecto

    try {

        $conexion= new PDO('mysql:host=localhost;dbname=gestion_stock', $nombreUsuario, $contra); //Recordar escribir el primer argumento según está

        // Echo "<h4>Conexión exitosa</h4>";

        $conexion->exec("SET CHARACTER SET utf8"); //Seteamos a utf8 La BBDD utiliza Español España

    } catch (Exception $e) {

        die("Error: ".$e->GetMessage());
        
    } finally {

        $base= null;

    }

    





?>