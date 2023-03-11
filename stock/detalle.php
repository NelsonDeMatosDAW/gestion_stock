<?php
    session_start();

    require("conexion.php"); //Requerimos el archivo donde se guardan las variables de conexión
    
    if(!isset($_SESSION['nombre'])){ //determina si una variable NO ha sido declarada y su valor es NULO.
        print("<p>Session no creada. Debes iniciar sesión</p>");
        header("Location: index.php"  );
    }else{
        $imp = $_SESSION['nombre'];
        print ("<h2>Bienvenido $imp, aquí podrás gestionar tu BBDD</h2>");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Detalle</title>
</head>
<body class="bg-info">

    <?php

            //Obtenemos la variable id a consultar pasada por la IP con GET
            $resultadoGet = $_GET["id"];
    
            $sql = "select * from productos where id= ?";
    
            $resultadoPdoStatement=$conexion->prepare($sql); //guardamos en $resultado el resultado que nos devuelve el método prepare al pasarle la consulta
            $resultadoPdoStatement->execute(array($resultadoGet));

            $fila=$resultadoPdoStatement->fetch(PDO::FETCH_ASSOC);
    ?>
    
    
        <div class="text-center m-5 border-2 border-dark">
        <h1>Detalle Producto</h1>
    </div>

    <div class="container w-75" >
        <div class="row border border-dark rounded">
            <div class="col w-12 bg-primary text-center p-3">
                
                <tr>
                    <td> <?php echo $fila['nombre'];?> </td>
                </tr>
                
            </div>
            
        </div>
        <div class="row border border-dark rounded">
        <div class="col w-12 bg-primary p-3">
    
            <!-- Zona PHP -->
                <?php

                        
                        foreach ($fila as $clave => $value) {
                                //imprimimos los datos de $fila
                ?>
                            <tr>
                                
                                <td> <?php echo "$clave: ".$value."<br>"; ?> </td>
                                
                            </tr>

                            <?php echo "<br>"; ?>    
                <?php                
                        } //Cerramos la llave del foreach
                
                ?>
                
            </div>
        </div>

        <div class="text-center m-5 border-2 border-dark">
            <a href="listado.php" class="btn btn-primary mb-1 text-start p-3">Volver</a>
        </div>
        
         

    </div>
                        


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>