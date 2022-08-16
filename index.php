<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>        
        <?php
            include 'Laberinto.php';
            session_start();
            
            //Si no existe la sesión de laberinto se crea
            if(!isset($_SESSION["laberinto"])){
                echo "<link href='css/Inicio.css' rel='stylesheet' type='text/css'>";
                $_SESSION["laberinto"]= new Laberinto();
                
        ?>
                <!-- Código de la primera ventana que se visualiza antes de empezar el juego -->
                <div class="container">
                    <div class="neon">Laberinto </div><br><br><br>
                    <a href="index.php" id="comienzo"><div class="flux">Comenzar</div></a>
                </div>
                
        <?php         
            }else{          //Si está declarada la variable de Sesion
                echo "<link href='css/Laberinto.css' rel='stylesheet' type='text/css'>";
                if(!isset($_REQUEST["move"])){  //Lo que se muestra antes de enviar el formulario
                    echo "<div class='HUD'><h1>Movimientos: ".$_SESSION["laberinto"]->getMovimientos(). "</h1></div>";
                    $_SESSION["laberinto"]->mostrarTablero();
                }else{
                    //Se mete en una variable para mejor manejo de la función
                    $movimiento=$_SESSION["laberinto"]->realizarMovimientos($_REQUEST["move"]);
                    $movimiento;
                    
                    //Que sucede cuando recibe el formulario el objeto Laberinto
                    switch($movimiento){
                        case "Incorrecto":
                            echo "<div class='HUD'><h1>Movimientos: ".$_SESSION["laberinto"]->getMovimientos(). "</h1>";
                            ?>
                
                            <h1>Movimiento Incorrecto!!</h1></div>;
                                
                            <?php
                            $_SESSION["laberinto"]->mostrarTablero();
                            break;
                        case "Seguir":
                            echo "<div class='HUD'><h1>Movimientos: ".$_SESSION["laberinto"]->getMovimientos(). "</h1></div>";
                            $_SESSION["laberinto"]->mostrarTablero();
                            break;
                        case "Fin":
                            echo "<link href='css/Inicio.css' rel='stylesheet' type='text/css'>";
                            //Código que se visualiza al ganar
                            ?>
                            <div class="container">
                                <div class="neon">Has Ganado con <?php echo $_SESSION["laberinto"]->getMovimientos();?> Movimientos!! </div><br><br><br>
                                <a href="index.php" id="comienzo"><div class="flux">Volver <br>a<br> Jugar</div></a>
                            </div>
                            <?php
                            unset($_SESSION["laberinto"]);
                            break;
                        case "Perder":      //Código si se pierde.
                            echo "<link href='css/Perder.css' rel='stylesheet' type='text/css'>";                            
                            ?>
                            
                            <div class="sign">
                                <span class="fast-flicker">Has</span><br>Perdido<span class="flicker"><br><br><br><br>
                                <a href="index.php">Volver</a>
                                </span>
                            </div>
    
                            <?php
                            unset($_SESSION["laberinto"]);
                            break;
                    }
                }
            }
        ?>
    </body>
</html>
