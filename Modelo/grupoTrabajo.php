<?php
    require "conexion.php";
    class grupoTrabajo{


        public function CargarJefeGuardia(){
            global $conexion; 
            $consulta = "SELECT * FROM JEFE_GUARDIAS";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function CargarSubAlterno(){
            global $conexion; 
            $consulta = "SELECT * FROM SUBALTERNO";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function CargarUsuarios(){
            global $conexion; 
            $consulta = "SELECT * FROM usuarios";
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
    }
?>