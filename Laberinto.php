<?php

class Laberinto {
    private $tablero, $movimientos, $posicionFila, $posicionColumna;
    
    function __construct() {
        for($i=1;$i<=10;$i++){
            for($j=1;$j<=10;$j++){
                $this->tablero[$i][$j]=0;
            }
        }
        //Bucle para crear el laberinto
        for($i=0;$i<=20;$i++){
            $randomfila=rand(1,10);
            $randomcol=rand(1,10);
            $fantasma = "<img src='Images/ghost.gif'>";     //Se muestra el obstáculo
            if(!(($randomfila==1 && $randomcol==1) || ($randomfila==10 && $randomcol==10))){    //Controlar que no salga un obstaculo en el principio ni en la meta
                $this->tablero[$randomfila][$randomcol]= $fantasma;
            }            
        }
        $this->movimientos = 0;
        $this->posicionFila = 1;
        $this->posicionColumna = 1;
    }
    
    public function mostrarTablero(){
        echo "<div class='laberinto'><table>";
        for($i=1;$i<=10;$i++){
            echo "<tr>";
            for($j=1;$j<=10;$j++){
                echo "<td>";
                if(($i==$this->posicionFila)&& ($j==$this->posicionColumna)){
                    echo "<img src='Images//pacman.gif'>";  //Donde se muestra al personaje jugable
                }elseif($i==10 && $j==10){
                    echo "<img src='Images//cherry.png'>";      //Donde se muestra la meta
                }else{
                    echo $this->tablero[$i][$j];
                }
                
                echo "</td>";    
            }
            echo "</tr>";
        }
        echo "</table></div>";
        echo <<<_END
            <div class="controles">
                <form action="index.php" method="post">
                    <input type="submit" name="move" value="arriba" id='botonup'><br>
                    <input type="submit" name="move" value="izquierda" id='botonleft'>
                    <input type="submit" name="move" value="derecha" id='botonright'><br>
                    <input type="submit" name="move" value="abajo" id='botondown'>
                </form>
            </div>
        
        _END;
    }
    
    public function realizarMovimientos($movimiento){
        $auxFila= $this->posicionFila;
        $auxCol= $this->posicionColumna;
        $this->movimientos++;
        $fantasma = "<img src='Images/ghost.gif'>";
        
        //Depende lo que reciba del formulario realiza acciones diferentes
        if($movimiento == "arriba"){
            $auxFila--;
        }elseif($movimiento == "abajo"){
            $auxFila++;
        }elseif ($movimiento == "izquierda") {
            $auxCol--;
        }else{
            $auxCol++;
        }
        
        //Condiciones del tablero según el movimiento que se realice
        if(($this->movimientos>=25) && !($auxCol==10 && $auxFila==10)){
            return "Perder";
        }elseif(($auxFila==0) || ($auxFila==11) || ($auxCol==0) || ($auxCol==11)){
            return "Incorrecto";
        }elseif(($auxFila==10) && ($auxCol==10)){
            return "Fin";
        }elseif($this->tablero[$auxFila][$auxCol]==$fantasma){
            return "Incorrecto";
        }else{
            $this->posicionFila=$auxFila;
            $this->posicionColumna=$auxCol;
            return "Seguir"; 
        }
    }

    function getMovimientos() {
        return $this->movimientos;
    }
}