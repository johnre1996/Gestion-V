<?php
    require "conexion.php";
    class marca{

        public function ListarMarca(){
            global $conexion; 
            $consulta = "select * from marca order by 1 desc";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Registrar(
            $txtMarca
        ){
            global $conexion; 
            $consulta = "
            insert into marca (nombre_mar,estado_mar)
            values ('$txtMarca',1)
            ";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Modificar(
            $idMarca,
            $txtMarca,
            $estado
        ){
            global $conexion; 
            $consulta = "update marca set nombre_mar='$txtMarca',estado_mar=$estado
            where id_marca=$idMarca;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }
        
        public function EditarMarca($id){
            global $conexion; 
            $consulta = "select * from marca where id_marca=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Eliminar($id){
            global $conexion; 
            $consulta = "delete FROM marca where id_marca=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        function RecoveryPasswordEmail($recoveryPassword){
            global $conexion;
            
            $consulta = " SELECT 
            (SELECT COUNT(id_marca) FROM marcas
             WHERE correo='$recoveryPassword'  AND char_length(correo)>2) AS num
            ";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        function EnviarCorreoRecuperarCon($correo){
            global $conexion;
            
            $consulta = "select Marca,correo
            from marcas
            where correo like '%$correo%'
            ";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        function RecoveryXEmail($recoveryPassword){
            global $conexion;
            
            $sql = "select id_marca from marcas where correo='$recoveryPassword';
            ";
            $query = pg_query($conexion,$sql);
    
            return $query;
        }


    }
?>