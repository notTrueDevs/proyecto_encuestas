<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="./Styles/style.css" rel="stylesheet"></link>
    <link href="./Styles/main.css" rel="stylesheet" >
    <link href="./Styles/form.css" rel="stylesheet" >
    <script src="./Scripts/filterBadWords.js"></script>
    <title>formulario</title>
</head>
<body>
    <?php
    require("./Class/Form.php");
    session_start();
    $conexion = new Form();
    if(isset($_POST["enviar"])){
        $conexion->setProfesor($_POST["profesor"]);
        $conexion->setComment($_POST["comentario"],$_POST["nota"]);
        $conexion->enviarFormulario();
        header("Location: index.html");
    }
    ?>




    <div class="page">
        <div class="hamburger-menu">
            <div id="menuToggle" class="no-selectable">
                <input type="checkbox"/>
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu">
                  <a href="./index.html"><li>Inicio</li></a>
                  <a href="./summary.html"><li>Resumen</li></a>
                  <a href="#"><li>Contacto</li></a>
                </ul>
            </div>
        </div>
        
        <div class="menu">
            <img src="./Resources/logo-example.png" alt="logo">
            <a href="./index.html">Inicio</a>
            <a href="./summary.html">Resumen</a>
            <a href="">Contacto</a>
        </div>

        <div class="content">
            <div class="form-box"> 
                <form id="myForm" action="<?php echo $_SERVER ["PHP_SELF"];?>" method="post" id="form">
                    <select name="profesor">
                        <?php $conexion->PrintProfesoresHTMLSelect(); ?>
                    </select>

                    <p>Nota</p>
                    <div class="nota">
                        <input id="notaInput" type="range" name="nota" value="1" min="1" max="10" oninput="updateNotaNumber(event)" required>    
                        <p id="number">1</p>
                    </div>
                    

                    <span></span>

                    <p>Comentario</p>
                    <textarea type="text" name="comentario" maxlength="200" placeholder="Escribe un comentario para el profesor"></textarea>

                    <input type="submit" name="enviar">Enviar</input>
                    <span></span>
    
                </form>
            </div>
        </div>
        <div class="footer">
            <p>Texto de ejemplo en el footer</p>
        </div>
    </div>
    <script>
setTimeout(() => {noWLogo()}, 0);
</script>
</body>
</html>