<?php
    require "conexion.php";
    class marca{
        public function loguear($user,$contra){
            global $conexion; 
            $consulta = "SELECT * FROM USUARIOS WHERE USUARIO='$user' AND CLAVE='$contra'";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function CargarRoles(){
            global $conexion; 
            $consulta = "SELECT * FROM roles";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function ListarUsuarios(){
            global $conexion; 
            $consulta = "select b.descripcion as rol,a.* from usuarios a
            inner join roles b on b.id_rol=a.id_rol
            order by id_usuario desc";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Registrar(
            $cboIdRol,
            $txtNombre,
            $txtCorreo,
            $txtCelular,
            $txtUsuario,
            $txtClave,
            $cboEst
        ){
            global $conexion; 
            $consulta = "
            insert into usuarios (id_rol,nombres,correo,telefono,usuario,clave,estado)
            values ($cboIdRol,'$txtNombre','$txtCorreo','$txtCelular','$txtUsuario','$txtClave',1)
            ";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Modificar(
            $idUsuario,
            $cboIdRol,
            $txtNombre,
            $txtCorreo,
            $txtCelular,
            $txtUsuario,
            $txtClave,
            $cboEst
        ){
            global $conexion; 
            $consulta = "update usuarios set id_rol=$cboIdRol,nombres='$txtNombre',correo='$txtCorreo',telefono='$txtCelular',
            estado=$cboEst
            where id_usuario=$idUsuario;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }
        
        public function EditarUsuario($id){
            global $conexion; 
            $consulta = "select b.descripcion as rol,a.*
            from usuarios a
            inner join roles b on b.id_rol=a.id_rol
            where a.id_usuario=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Eliminar($id){
            global $conexion; 
            $consulta = "delete FROM usuarios where id_usuario=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        function RecoveryPasswordEmail($recoveryPassword){
            global $conexion;
            
            $consulta = " SELECT 
            (SELECT COUNT(id_usuario) FROM usuarios
             WHERE correo='$recoveryPassword'  AND char_length(correo)>2) AS num
            ";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        function EnviarCorreoRecuperarCon($correo){
            global $conexion;
            
            $consulta = "select usuario,correo
            from usuarios
            where correo like '%$correo%'
            ";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        function RecoveryXEmail($recoveryPassword){
            global $conexion;
            
            $sql = "select id_usuario from usuarios where correo='$recoveryPassword';
            ";
            $query = pg_query($conexion,$sql);
    
            return $query;
        }

        function ModificarPass($correo, $txtConfirmarPass,$usuario){
            global $conexion;
            $sql = "update usuarios set clave = '$txtConfirmarPass' where correo='$correo' AND usuario='$usuario' ";
            $query = pg_query($conexion,$sql);
            return $query;
        }
    }
?>