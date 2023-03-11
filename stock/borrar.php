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

    <title>Borrar</title>
</head>

<!-- ........................................................................................................  -->

<body class="bg-info">

<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$  -->
    <?php


        $resultadoGet = $_GET["id"];

        if(isset($_POST["borrar"])){
            $decision= $_POST["pregunta"];

            if($decision == "si"){
                //echo "Se borra el registro seleccionado";

                $sql= "delete from productos where id=?"; //Creamos la sentencia SQL

                $resultadoPdoStatement=$conexion->prepare($sql); //guardamos en $resultado el resultado que nos devuelve el método prepare al pasarle la consulta

                $resultadoPdoStatement->execute(array($resultadoGet)); //Metodo para ejecutar la sentencia preparada pasandole al array el valor del $_GET

                $fila=$resultadoPdoStatement->fetch(PDO::FETCH_ASSOC);

                if(($resultadoPdoStatement=$conexion->prepare($sql))==true){ //Comprobamos que la sentencia se ha ejecutado correctamente

    ?>
                    <div class="container w-75 text-center p-5">
                        <h4>Se ha borrado el registro seleccionado</h4>

                        <a href="listado.php" class="btn btn-primary mb-1 text-start p-3">Volver</a>
                    </div>
    <?php
                }else {
    ?>
                    <div class="container w-75 text-center p-5">
                        <h4>NO se ha borrado el registro seleccionado</h4>
                    </div>
    <?php   
                }//Final del if else de comprobar que se ha ingresado el borrado correctamente

            }elseif ($decision == "no") {
    ?>
                <a href="listado.php" class="btn btn-primary mb-1 text-start p-3">Volver</a>
    <?php
            } //Final del if decision si o no
            
        } //Final del if ISSET pulsar boton borrar
    ?>
    
    <div class="container 75 p-5">
        <div class="col-12 bg-info" >
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="borrar">

                <div class="row text-center"> <!-- 1º select-->
                    <div class="col mb-2"> 

                        <label for="pregunta" class="form-label"><h5>¿Estas seguro que quieres borrar el registro con id = <?php echo $resultadoGet; ?>?</h5></label>
                            <select class="form-control" name="pregunta"> <!-- Rellenar select -->
                                <option value="no" selected>NO</option>
                                <option value="si">SI</option>
                            </select>

                        <button type="submit" class="btn btn-danger m-3" name="borrar">BORRAR</button>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>