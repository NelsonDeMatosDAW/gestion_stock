
<?php
    $server = 'localhost';
    $username = 'root';
    $password= '';
    $database= 'gestion_stock';

        try {
            $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password );
            //print "<p>Conexión con la BBDD exitosa</p>";
    
        } catch (PDOException $e) {
            die('Fallo en conexión con Base de Datos '.$e->getMessage());
            
        }

?>