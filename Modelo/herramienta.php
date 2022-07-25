<?php
    require "conexion.php";
    class herramienta{

        public function CargarVehiculos(){
            global $conexion; 
            $consulta = "select a.*
            from vehiculos a
            where a.estado_veh=1
            and a.id_vehiculo not in (select distinct id_vehiculo from herramientas)";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function CargarVehiculosEdicion($idVehiculo){
            global $conexion; 
            $consulta = "select a.*
            from vehiculos a
            where a.estado_veh=1
            and a.id_vehiculo not in (select distinct id_vehiculo from herramientas)
            union all 
            select a.*
            from vehiculos a
            where a.id_vehiculo=$idVehiculo
            ";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function ListarHerramienta(){
            global $conexion; 
            $consulta = "select
            (select COUNT(b.id_vehiculo) from herramientas b where b.id_vehiculo = h.id_vehiculo) as num_filas,
            ROW_NUMBER() OVER(PARTITION BY h.id_vehiculo ORDER  BY h.id_vehiculo  ASC)  as num_filas_detalle,
            c.identificador_veh,
            c.nombre_veh,
            h.*
            from herramientas h
            inner join vehiculos c on c.id_vehiculo=h.id_vehiculo";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Registrar(
            $cboVehiculos,
            $detalleHerramienta
        ){
            global $conexion;
            foreach ($detalleHerramienta as $indice => $valor) {
                $consulta = "insert into herramientas
                (id_vehiculo,codigo_her,nombre_her,cantidad_her,area,observacion_her,estado_her)
                values ($cboVehiculos,'$valor[0]','$valor[1]','$valor[2]','$valor[3]','$valor[4]',1)
                ";
                $resultado = pg_query($conexion,$consulta);
            }
            return $resultado;
        }

        public function Modificar(
            $idHerramienta,
            $cboVehiculos,
            $detalleHerramienta,
            $estado
        ){
            global $conexion;
            $consulta1 = "delete from herramientas where id_vehiculo=$cboVehiculos";
            $resultado1 = pg_query($conexion,$consulta1);
            if($resultado1){
                foreach ($detalleHerramienta as $indice => $valor) {
                    $consulta = "insert into herramientas
                    (id_vehiculo,codigo_her,nombre_her,cantidad_her,area,observacion_her,estado_her)
                    values ($cboVehiculos,'$valor[0]','$valor[1]','$valor[2]','$valor[3]','$valor[4]',1)
                    ";
                    $resultado = pg_query($conexion,$consulta);
                }
            }
            return $resultado;
        }
        
        public function EditarHerramienta($id){
            global $conexion; 
            $consulta = "select distinct id_vehiculo,estado_her from herramientas where id_vehiculo=$id";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function EditarHerramientaDetalle($id){
            global $conexion; 
            $consulta = "select * from herramientas where id_vehiculo=$id";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Eliminar($id){
            global $conexion; 
            $consulta = "delete from herramientas where id_vehiculo=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        function RecoveryPasswordEmail($recoveryPassword){
            global $conexion;
            
            $consulta = " SELECT 
            (SELECT COUNT(id_herramienta) FROM herramientas
             WHERE correo='$recoveryPassword'  AND char_length(correo)>2) AS num
            ";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        function EnviarCorreoRecuperarCon($correo){
            global $conexion;
            
            $consulta = "select Herramienta,correo
            from herramientas
            where correo like '%$correo%'
            ";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        function RecoveryXEmail($recoveryPassword){
            global $conexion;
            
            $sql = "select id_herramienta from herramientas where correo='$recoveryPassword';
            ";
            $query = pg_query($conexion,$sql);
    
            return $query;
        }


    }
?>