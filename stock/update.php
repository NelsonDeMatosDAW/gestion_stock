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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update</title>
</head>
<body class="bg-info">

    <?php


        //Obtenemos la variable id a consultar pasada por la IP con GET
        $resultadoGet = $_GET["id"];

        //Una vez pulsado el botón modificar
        if(isset($_POST["modificar"])){
            //Guardamos todos los datos introducidos en el formulario en variables que pasaremos a la consulta
            $nombre= $_POST["nombre"];
            // echo"$nombre";
            $nombre_corto= $_POST["nombre-corto"];
            $precio = $_POST["precio"];
            $familia = $_POST["familia"];
            $descripcion = $_POST["descripcion"];

            //Creamos la sentencia SQL con LOS MARCADORES :nombre ...
            $sql= "update productos set nombre=:nombre, nombre_corto=:nombre_corto, descripcion=:descripcion, 
                pvp=:precio, familia=:familia where id=$resultadoGet"; 


            $resultadoPdoStatement=$conexion->prepare($sql); //guardamos en $resultado el resultado que nos devuelve el método prepare al pasarle la modificación
            /**
             * Utilizamod el método execute asociando los marcadores con las variables que contienen los datos introducidos en el form
             */
            $resultadoPdoStatement->execute(array(":nombre"=>$nombre, ":nombre_corto"=>nombre_corto, ":descripcion"=>$descripcion, ":precio"=>$precio, ":familia"=>$familia));
            
        ?>

        <!-- Div para imprimir el resultado del update -->
        <div class="container w-75 text-center p-5">

            <?php
                if($resultadoPdoStatement == true){
                    echo"<h5>La modificación se realizó correctamente</h5>";

                }else{
                    echo"<h5>No se pudo realizar la modificación.</h5>";
                }

        } //Final del if de isset
            ?>

        </div>


    

    
    <div class="container w-75"> <!-- Container para el formulario -->

        <div class="h1 text-center p-5">
            <h1>Modificar Producto</h1>
        </div>


        <div class="col-12 bg-info" >
        
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="actualizar" id="actualizar">
                <div class="row"> <!-- 1º fila nombre y nombre corto-->
                    <div class="col mb-2">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                    <div class="col mb-2">
                        <label for="nombre-corto" class="form-label">Nombre Corto</label>
                        <input type="text" class="form-control" name="nombre-corto">
                    </div>
                </div>

                <div class="row"> <!-- 2º fila precio y familia-->
                    <div class="col mb-2">
                        <label for="Precio(€)" class="form-label">Precio</label>
                        <input type="text" class="form-control" name="precio">
                    </div>
                    <div class="col mb-2"> 
                        <label for="Familia" class="form-label">Familia</label>

                        <!-- Rellenar de forma dinámica -->
                        <select class="form-control" name="familia"> <!-- Rellenar select -->
                            <option value="CAMARA" selected>Cámaras digitales</option>
                            <option value="CONSOL">Consolas</option>
                            <option value="EBOOK">Libros electrónicos</option>
                            <option value="IMPRES">Impresoras</option>
                            <option value="MEMFLA">Memorias Flash</option>
                            <option value="MP3">Reproductores MP3</option>
                            <option value="MULTIF">Equipos multifunción</option>
                            <option value="NETBOK">Netbooks</option>
                            <option value="ORDENA">Ordenadores</option>
                            <option value="PORTAT">Ordenadores portátiles</option>
                            <option value="ROUTER">Routers</option>
                            <option value="SAI">Sistemas de alimentación ininterrumpida</option>
                            <option value="SOFTWA">Software</option>
                            <option value="TV">Televisores</option>
                            <option value="VIDEOC">Videocámaras</option>
                        </select>

                    </div>
                </div>

                <div class="row"> <!-- 3º fila descripcion-->
                    <div class="row">
                        <div class="col mb-2">
                            <label for="precio" class="form-label">Descripcion</label>
                            <textarea class="form-control" rows="10" cols="40" name="descripcion"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col mb-2"> <!-- 4º fila botones -->

                    <!-- input type="submit" name="enviando" id="enviando" value="Enviar" -->
                    <button type="submit" class="btn btn-primary m-3" name="modificar">Modificar</button>
                    <a href="listado.php" class="btn btn-primary mb-1 text-start p-3">Volver</a>
                </div>

                

            </form>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>