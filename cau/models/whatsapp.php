<?php
/* llamada de las clases necesarias que se usaran en el envio del mail */
require_once("../config/conexion.php");
require_once("../models/ticket.php");

class Whastapp extends Conectar{

    public function w_ticket_abierto($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);

        // file_put_contents('../logs/log.log', print_r($datos, true));

        foreach ($datos as $row){
            $id = $row["ticket_id"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $subcategoria = $row["cats_nom"];
            $telefono = $row["usu_telf"];
        }

        $apiURL = 'https://api.chat-api.com/instance413970/';
        $token = '';

        $data = json_encode(
            array(
                // 'chatId'=>"".$telefono."@c.us",
                "phone" => "".$telefono. "",
                'body'=>"Ticket Abierto ".$id." : ".$titulo." Categoria : ".$categoria." SubCategoria : ".$subcategoria.""
            )
        );

        $url = $apiURL.'sendMessage?token='.$token;

        file_put_contents('../logs/log.log', print_r($url, true));

        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );

        $response = file_get_contents($url,false,$options);

        echo $response; exit;
    }

    public function w_ticket_cerrado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $telefono = $row["usu_telf"];
        }

        $apiURL = 'https://api.chat-api.com/instance413970/';
        $token = '';

        $data = json_encode(
            array(
                'chatId'=>"".$telefono."@c.us",
                'body'=>"Ticket Cerrado ".$id." : ".$titulo.""
            )
        );

        $url = $apiURL.'message?token='.$token;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );

        $response = file_get_contents($url,false,$options);
        echo $response; exit;
    }

    public function w_ticket_asignado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $telefono = $row["usu_telf"];
        }

        $apiURL = 'https://api.chat-api.com/instance413970/';
        $token = '';

        $data = json_encode(
            array(
                'chatId'=>"".$telefono."@c.us",
                'body'=>"Ticket Asignado ".$id." : ".$titulo.""
            )
        );

        $url = $apiURL.'message?token='.$token;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );

        $response = file_get_contents($url,false,$options);
        echo $response; exit;
    }


}

?>