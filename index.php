<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>LogIn Gestión de Stock</title>
</head>
<body>
    <?php require 'partials/header.php' ?>

    <h1 id="tituloInicial">Por favor inicia sesión para gestionar el Stock</h1>

    <div id="formulario">
        <form action="index.php" method="post">
            <input type="text" name="email" placeholder="Introduce tu email" required>
            <input type="password" name="contraseña" placeholder="Introduce tu contraseña" required>
            <input type="submit" value="enviar" id="enviar">
        </form>
    </div>

    <div id="respuesta">

    </div>

    <?php
        require_once 'dataBase.php';

        //require_once 'log.php';
        if (!empty($_POST['email']) && !empty($_POST['contraseña'])){
    
            if(!empty($conn)){
    
                    $email = $_POST['email'];
                    $contra = $_POST['contraseña'];
                    $contra = hash('sha256', $contra);
        
                    if(strlen($email)== 0 || strlen($contra)== 0){
                        print("<p>El nombre o la contraseña no pueden contener sólo espacios en blanco.</p>");
                    }else{
                        //print "<p>Tu email es $email y tu contraseña es $contra</P>";
                        //Guardamos la consulta con referencias a las variable
                        $consulta = "select * from usuarios where usuario=:u AND pass=:p";
                        $stmt = $conn->prepare($consulta);
    
                        try {
                            $stmt->execute(
                                [
                                    ':u' => $email,
                                    ':p' => $contra
                                ]
                            );
    
                        } catch (PDOException $e) {
                            print ("Error en la consulta a la BBDD ".getMessage($e));
                        }
    
                        if($stmt->rowCount()==0){
                            print ("<p>Nombre de usuario o contraseña incorrecto.</p>");
                        }else{
                            $_SESSION['nombre'] = $email;
                            //print ("<h1>Correcto.</h1>");
                            //$imp = $_SESSION['nombre'];
                            //print ("<h1>$imp</h1>");
                            header("Location: stock/listado.php");
                            
                        }
    
                    } //Final del else cuando los datos del formulario tienen contenido diferente a espacios
                    
    
    
               
            }
            
    
            
    
        }

    ?>

</body>
</html>