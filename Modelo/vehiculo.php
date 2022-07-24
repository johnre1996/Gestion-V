<?php
    require "conexion.php";
    class vehiculo{
   
        public function CargarMarcas(){
            global $conexion; 
            $consulta = "SELECT * FROM marca where estado_mar=1";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function ListarVehiculos(){
            global $conexion; 
            $consulta = "select
            b.nombre_mar as marca,
            a.*
            from vehiculos a
            inner join marca b on b.id_marca=a.id_marca
            order by a.id_vehiculo desc
            ";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Registrar(
            $txtIdentificador,
            $txtNombre,
            $txtPlaca,
            $cboMarca,
            $txtModelo,
            $txtClase,
            $txtColor,
            $txtAnio,
            $txtCilindraje,
            $txtMotor,
            $txtChasis,
            $txtCombustible,
            $cboEst
        ){
            global $conexion; 
            $consulta = "insert into vehiculos (id_marca,nombre_veh,identificador_veh,placa_veh,modelo_veh,clase_veh,color_veh,anio_veh,
            cilindraje_veh,c_motor_veh,c_chasis_veh,t_combustible_veh,estado_veh)
            values ('$cboMarca','$txtNombre','$txtIdentificador','$txtPlaca','$txtModelo','$txtClase','$txtColor',$txtAnio,
            '$txtCilindraje','$txtMotor','$txtChasis','$txtCombustible',1)";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Modificar(
            $idVehiculo,
            $txtIdentificador,
            $txtNombre,
            $txtPlaca,
            $cboMarca,
            $txtModelo,
            $txtClase,
            $txtColor,
            $txtAnio,
            $txtCilindraje,
            $txtMotor,
            $txtChasis,
            $txtCombustible,
            $cboEst
        ){
            global $conexion; 
            $consulta = "update vehiculos
            SET
            id_marca = '$cboMarca',
            nombre_veh = '$txtNombre',
            identificador_veh = '$txtIdentificador',
            placa_veh = '$txtPlaca',
            modelo_veh = '$txtModelo',
            clase_veh = '$txtClase',
            color_veh = '$txtColor',
            anio_veh = $txtAnio,
            cilindraje_veh = '$txtCilindraje',
            c_motor_veh = '$txtMotor',
            c_chasis_veh = '$txtChasis',
            t_combustible_veh = '$txtCombustible',
            estado_veh = $cboEst
            where id_vehiculo=$idVehiculo;";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }
        
        public function EditarVehiculo($id){
            global $conexion; 
            $consulta = "select
            b.nombre_mar as marca,
            a.*
            from vehiculos a
            inner join marca b on b.id_marca=a.id_marca
            where a.id_vehiculo=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Eliminar($id){
            global $conexion; 
            $consulta = "delete FROM vehiculos where id_vehiculo=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        function RecoveryPasswordEmail($recoveryPassword){
            global $conexion;
            
            $consulta = " SELECT 
            (SELECT COUNT(id_vehiculo) FROM vehiculos
             WHERE correo='$recoveryPassword'  AND char_length(correo)>2) AS num
            ";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        function EnviarCorreoRecuperarCon($correo){
            global $conexion;
            
            $consulta = "select vehiculo,correo
            from vehiculos
            where correo like '%$correo%'
            ";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        function RecoveryXEmail($recoveryPassword){
            global $conexion;
            $sql = "select id_vehiculo from vehiculos where correo='$recoveryPassword';
            ";
            $resultado = pg_query($conexion,$sql);
    
            return $resultado;
        }

        function ModificarPass($correo, $txtConfirmarPass,$vehiculo){
            global $conexion;
            $sql = "update vehiculos set clave = '$txtConfirmarPass' where correo='$correo' AND vehiculo='$vehiculo' ";
            $query = pg_query($conexion,$sql);
            return $query;
        }
    }
?>