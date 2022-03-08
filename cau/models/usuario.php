<?php
    class Usuario extends Conectar{

        public function login(){
            $conectar=parent::conexion();
            parent::set_names();

            if(isset($_POST["enviar"])){
                $correo = $_POST["usu_correo"];
                $pass = $_POST["usu_pass"];
                $rol = $_POST["rol_id"];
                
                if(empty($correo) and empty($pass)){
                    header("Location:".conectar::ruta()."index.php?m=2");
					exit();
                }else{
                    $sql = "SELECT * FROM tm_usuarios WHERE correo='$correo' and pass=MD5('$pass') and rol_id=$rol and estado=1";

                    $stmt=$conectar->prepare($sql);
                    $stmt->execute();

                    $resultado = $stmt->fetch();                   

                    // $var = print_r(is_array($resultado)) and (count($resultado)>0);
                    $var = $stmt->RowCount();

                    if ($var == 1){
                        $_SESSION["usu_id"]=$resultado["id"];
                        $_SESSION["usu_nom"]=$resultado["nombres"];
                        $_SESSION["usu_ape"]=$resultado["apellidos"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];

                        header("Location:".Conectar::ruta()."view/home/");
                        exit(); 
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }

        public function insert_usuario($usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id,$usu_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuarios 
                (id, 
                nombres, 
                apellidos, 
                correo, 
                pass, 
                rol_id,
                usu_telf,
                created_at, 
                updated_at, 
                deleted_at, 
                estado) VALUES 
                (NULL,'$usu_nom','$usu_ape','$usu_correo',MD5('$usu_pass'),$rol_id,$usu_telf,now(), NULL, NULL, '1');";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_usuario($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id,$usu_telf){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuarios set
                nombres = '$usu_nom',
                apellidos = '$usu_ape',
                correo = '$usu_correo',
                pass = MD5('$usu_pass'),
                rol_id = $rol_id,
                usu_telf = $usu_telf

                WHERE
                id = $usu_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();

            return $resultado=$sql->fetchAll();
        }

        public function delete_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_d_usuario_01($usu_id)";
            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario_01()";
            
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_x_rol(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuarios where estado=1 and rol_id=2";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario_02($usu_id)";
            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_total_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = $usu_id";
            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalabierto_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = $usu_id and tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalcerrado_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = $usu_id and tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_grafico($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM tm_ticket JOIN  
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
                WHERE    
                tm_ticket.est = 1
                and tm_ticket.usu_id = $usu_id
                GROUP BY 
                tm_categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function update_usuario_pass($usu_id,$usu_pass){
            $conectar= parent::conexion();
            parent::set_names();

            $sql="UPDATE tm_usuarios
                SET
                    pass = MD5($usu_pass)
                WHERE
                    id = $usu_id";

            file_put_contents('../logs/log.log', print_r($sql, true));


            $sql=$conectar->prepare($sql);
            // $sql->bindValue(1, $usu_pass);
            // $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>