<?php
/* librerias necesarias para que el proyecto pueda enviar emails */
require('class.phpmailer.php');
include("class.smtp.php");

// include("../.env.php");

// $gCorreo= $email;
// $gContrasena=$pass;

/* llamada de las clases necesarias que se usaran en el envio del mail */
require_once("../config/conexion.php");
require_once("../models/ticket.php");

class Email extends PHPMailer{

    //variable que contiene el correo del destinatario
    public $gCorreo = "";
    // protected $gContrasena = 'aqui tu pass';
    public $gContrasena = "";
    

    public function ticket_abierto($tick_id){
        $ticket = new Ticket();

        $datos = $ticket->listar_ticket_x_id($tick_id);

        foreach ($datos as $row){
            $id = $row["ticket_id"];
            $usu = $row["nombres"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["correo"];
        }

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->gCorreo;                     //SMTP username
            $mail->Password   = $this->gContrasena;                    //SMTP password'';                               //SMTP password
            $mail->SMTPSecure = 'ssl'; 
            $mail->Port       = 465;  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
            //Recipients
            $mail->setFrom($this->gCorreo);
            
            $mail->addAddress($correo);     //Add a recipient
          
              //Content
            $mail->isHTML(true);
            $mail->Subject = "Ticket Abierto";
            $cuerpo = file_get_contents('../public/NuevoTicket.html');

            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $mail->Body = $cuerpo;
            $mail->AltBody = strip_tags("Ticket Abierto");
            return $mail->Send();
  
          }catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function ticket_cerrado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);

        foreach ($datos as $row){
            $id = $row["ticket_id"];
            $usu = $row["nombres"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["usu_correo"];
        }

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->gCorreo;                     //SMTP username
            $mail->Password   = $this->gContrasena;                    //SMTP password'';                               //SMTP password
            $mail->SMTPSecure = 'ssl'; 
            $mail->Port       = 465;  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
            //Recipients
            $mail->setFrom($this->gCorreo);
            
            $mail->addAddress($correo);     //Add a recipient
          
              //Content
            $mail->isHTML(true);
            $mail->Subject = "Ticket Cerrado";
            $cuerpo = file_get_contents('../public/CerradoTicket.html');
            // $cuerpo = str_replace('$tbldetalle', $tbody, $cuerpo);

            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $mail->Body = $cuerpo;
            $mail->AltBody = strip_tags("Ticket Cerrado");
            return $mail->Send();
  
          }catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function ticket_asignado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["ticket_id"];
            $usu = $row["nombres"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["usu_correo"];
        }

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->gCorreo;                     //SMTP username
            $mail->Password   = $this->gContrasena;                    //SMTP password'';                               //SMTP password
            $mail->SMTPSecure = 'ssl'; 
            $mail->Port       = 465;  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
            //Recipients
            $mail->setFrom($this->gCorreo);
            
            $mail->addAddress($correo);     //Add a recipient
          
              //Content
            $mail->isHTML(true);
            $mail->Subject = "Ticket Asignado";
            $cuerpo = file_get_contents('../public/AsignarTicket.html');
            // $cuerpo = str_replace('$tbldetalle', $tbody, $cuerpo);

            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

            $mail->Body = $cuerpo;
            $mail->AltBody = strip_tags("Ticket Asignado");
            return $mail->Send();
  
          }catch (Exception $e) {
              echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}

?>