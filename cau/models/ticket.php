<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id,$cat_id,$cats_id,$tick_titulo,$tick_descrip,$prio_id){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO 
            tm_ticket (
                ticket_id,
                usu_id,
                cat_id,
                cats_id,
                tick_titulo,
                tick_description,
                est,
                fech_crea,
                tick_estado,
                usu_asig,
                fech_asig,
                prio_id
                ) 
            VALUES (
                NULL,
                $usu_id,
                $cat_id,
                $cats_id,
                '$tick_titulo',
                '$tick_descrip',
                '1',
                now(),
                'Abierto',
                NULL,
                NULL,
                $prio_id             
                );";

            $sql=$conectar->prepare($sql);

            $sql->execute();
            
            $sql1="select last_insert_id() as 'tick_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_ticket_x_usu($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.ticket_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_description,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.fech_cierre,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_usuarios.nombres,
                tm_usuarios.apellidos,
                -- tm_ticket.est,
                -- tm_ticket.tick_estado,
                tm_ticket.prio_id,
                tm_prioridad.prio_nom,
                tm_categoria.cat_nom
                FROM
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuarios on tm_ticket.usu_id = tm_usuarios.id
                INNER join tm_prioridad on tm_ticket.prio_id = tm_prioridad.prio_id
                WHERE
                tm_ticket.est = 1
                AND tm_usuarios.id=$usu_id";
           
           $sql=$conectar->prepare($sql);
           $sql->bindValue(1, $usu_id);
           $sql->execute();

           return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_id($tick_id){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.ticket_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.cats_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_description,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.fech_cierre,
                tm_ticket.tick_estre,
                tm_ticket.tick_comment,
                tm_usuarios.nombres,
                tm_usuarios.apellidos,
                tm_usuarios.correo,
                tm_usuarios.usu_telf,
                tm_categoria.cat_nom,
                tm_subcategoria.cats_nom,
                tm_ticket.prio_id,
                tm_prioridad.prio_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_subcategoria on tm_ticket.cats_id = tm_subcategoria.cats_id
                INNER join tm_usuarios on tm_ticket.usu_id = tm_usuarios.id
                INNER join tm_prioridad on tm_ticket.prio_id = tm_prioridad.prio_id
                WHERE
                tm_ticket.est = 1
                AND tm_ticket.ticket_id = $tick_id";

            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                tm_ticket.ticket_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_description,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.fech_cierre,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_usuarios.nombres,
                tm_usuarios.apellidos,
                tm_categoria.cat_nom,
                tm_ticket.prio_id,
                tm_prioridad.prio_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuarios on tm_ticket.usu_id = tm_usuarios.id
                INNER join tm_prioridad on tm_ticket.prio_id = tm_prioridad.prio_id
                WHERE
                tm_ticket.est = 1
                ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                td_ticketdetalle.tickd_id,
                td_ticketdetalle.tickd_descrip,
                td_ticketdetalle.fech_crea,
                tm_usuarios.nombres,
                tm_usuarios.apellidos,
                tm_usuarios.id
                FROM 
                td_ticketdetalle
                INNER join tm_usuarios on td_ticketdetalle.usu_id = tm_usuarios.id
                WHERE 
                tick_id =$tick_id";

            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
/*
        public function insert_ticketdetalle($tick_id,$usu_id,$tickd_descrip){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="INSERT INTO td_ticketdetalle (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $tickd_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
*/
        public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="call sp_i_ticketdetalle_01($tick_id,$usu_id)";
            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $tick_id);
            // $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function update_ticket($tick_id){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    tick_estado = 'Cerrado',
                    fech_cierre = now()
                where
                    ticket_id = $tick_id";

            file_put_contents('../logs/log.log', print_r($sql, true));

            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function reabrir_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();

            $sql="update tm_ticket 
                set	
                    tick_estado = 'Abierto'
                where
                    ticket_id = $tick_id";
            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $tick_id);
            file_put_contents('../logs/log.log', print_r($sql, true));

            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket_asignacion($tick_id,$usu_asig){
            
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    usu_asig = $usu_asig,
                    fech_asig = now()
                where
                    ticket_id = $tick_id";

            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
/*
        public function get_ticket_total(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_grafico(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM   tm_ticket  JOIN  
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
                WHERE    
                tm_ticket.est = 1
                GROUP BY 
                tm_categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 
*/
        public function insert_encuesta($tick_id,$tick_estre,$tick_comment){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    tick_estre = $tick_estre,
                    tick_comment = $tick_comment
                where
                    tick_id = $tick_id";

            $sql=$conectar->prepare($sql);

            // $sql->bindValue(1, $tick_estre);
            // $sql->bindValue(2, $tick_comment);
            // $sql->bindValue(3, $tick_id);

            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>