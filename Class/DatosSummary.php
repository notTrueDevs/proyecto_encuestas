<?php
require("Conexion.php");
class DatosSummary extends Conexion{
    private $comment_with_date;
    private $notaAvg;
    public function __construct($profesor){
        parent::__construct();
        if($this->db_conexion!=NULL){
            /*DATO COMENTARIO*/
            $consulta = "SELECT comentario,fecha from encuesta where idProfesor=(select id from usuarios where usuario = '$profesor')";
            $resultado = $this->db_conexion->query($consulta);
            $this->comment_with_date = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $resultado->closeCursor();
            /*DATOS GENERALES*/
            $consulta = "select sum(nota)/count(nota) from encuesta where idProfesor = (select id from usuarios where usuario='$profesor')";
            $resultado = $this->db_conexion->query($consulta);
            $notaAvg = $resultado->fetch();
            $notaAvg = round($notaAvg[0],1);
            $this->notaAvg = $notaAvg;
            $resultado->closeCursor();
        }else{
            $this->notaAvg= NULL;
            $this->comment_with_date = NULL;
        }
    }
    /*GETTERS*/
    public function getDatosComentario(){
        $resultado = $this->comment_with_date;
        return $resultado;
    }
    public function getDatosGenerales(){
        $resultado = $this->notaAvg;
        return $resultado;
    }


    /*IMPRIMIR E ITERAR COMENTARIO IZQ Y DERECHA*/
    public function printCommentAndDate($lado){
        $guardado="";
        if($this->comment_with_date!==NULL && ( $lado=="izquierda" ||$lado=="derecha" || $lado=="todos") ){
            switch ($lado){
                case "izquierda":
                    for($i=0;$i<count($this->comment_with_date);$i++){
                        if($i==0 || $i%2==0){
                            $guardado.="
                            <div class='comment box'>
                            <p id='comment-text'>".$this->comment_with_date[$i]["comentario"]."</p>
                            <p id='date'>".$this->comment_with_date[$i]["fecha"]."</p>
                            </div>";
                        }
                    }
                    return $guardado;
                case "derecha":
                    for($i=0;$i<count($this->comment_with_date);$i++){
                        if($i%2!=0){
                            $guardado.="
                            <div class='comment box'>
                            <p id='comment-text'>".$this->comment_with_date[$i]["comentario"]."</p>
                            <p id='date'>".$this->comment_with_date[$i]["fecha"]."</p>
                            </div>";
                        }
                    }
                    return $guardado;
                    case "todos":
                        for($i=0;$i<count($this->comment_with_date);$i++){
                                $guardado.="
                                <div class='comment box'>
                                <p id='comment-text'>".$this->comment_with_date[$i]["comentario"]."</p>
                                <p id='date'>".$this->comment_with_date[$i]["fecha"]."</p>
                                </div>";
                        }
                    return $guardado;
            }
        }else{
            return "<div class='comment box'>
            <p id='comment-text'>ERROR</p>
            <p id='date'>ERROR</p>
            </div>";
        }
    }

    

/*STATIC METHOD*/

    /*IMPRIMIR MENSAJE DEPENDE DE SI ES NULL O NO*/
    public static function switchPrintNullOrValueMessage($valorCompNull,$no_conecta,$conecta){
        if($valorCompNull==NULL){
            echo $no_conecta;
        }else{
            echo $conecta;
        }
    }
    
}

?>