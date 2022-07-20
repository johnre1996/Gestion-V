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

        public function CargarGrupoUsuarios(){
            global $conexion; 
            $consulta = "SELECT * FROM usuarios";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function ListarGrupoTrabajos(){
            global $conexion; 
            $consulta = "SELECT
            A.GRUPO_ID,
            A.NOMBRE AS NOMBRE_GRUPO,
            CONCAT_WS(' ',B.APELLIDO,B.NOMBRE) AS JEFE_GUARDIA,
            CONCAT_WS(' ',C.APELLIDO,C.NOMBRE) AS SUBALTERNO,
            CONCAT_WS(' ',D.NOMBRES,' ') AS CUARTELERO,
            '' AS FECHA_CREACION,
            A.ESTATUS AS ESTADO
            FROM GRUPO_TRABAJO A
            LEFT JOIN JEFE_GUARDIAS B ON B.JEFE_GUARDIAS_ID=A.JEFE_GUARDIAS_ID
            LEFT JOIN SUBALTERNO C ON C.SUBALTERNO_ID=A.SUBALTERNO_ID
            LEFT JOIN USUARIOS D ON D.ID_USUARIO=A.CUARTELERO_ID";
            $resultado = pg_query($conexion,$consulta);
            return $resultado;
        }

        public function Registrar(
            $txtNombreGrupo,
            $cboJefeGuardia,
            $cboSubAlterno,
            $cboCuartelero,
            $detalleGrupo
        ){
            global $conexion; 
            $consulta = "insert into grupo_trabajo (nombre,jefe_guardias_id,subalterno_id,cuartelero_id,fecha_creacion,estatus)
            values ('$txtNombreGrupo',$cboJefeGuardia,$cboSubAlterno,$cboCuartelero,now(),1)
            ";
            $resultado = pg_query($conexion,$consulta);

            if($resultado){
                if(!empty($detalleGrupo)){
                    foreach ($detalleGrupo as $indice => $val) {
                        $consulta2 = "with grupo_id as (select max(grupo_id) from grupo_trabajo)
                                    insert into grupo_trabajo_detalle(grupo_id,personal_id)
                                     values((select * from grupo_id),$val[0])";
                        $resultado2 = pg_query($conexion, $consulta2);
                    }

                }else{
                    $consulta2 = "select id_rol from roles order by id_rol desc limit 1";
                    $resultado2 = pg_query($conexion,$consulta2);
                }
            }

            return $resultado2;
        }

        public function Modificar(
            $txtIdGrupo,
            $txtNombreGrupo,
            $cboJefeGuardia,
            $cboSubAlterno,
            $cboCuartelero,
            $detalleGrupo
        ){
            global $conexion; 
            $consulta = "update usuarios ";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }
        
        public function EditarGrupoTrabajo($id){
            global $conexion; 
            $consulta = "SELECT
            A.GRUPO_ID,
            A.NOMBRE AS NOMBRE_GRUPO,
			A.JEFE_GUARDIAS_ID,
            CONCAT_WS(' ',B.APELLIDO,B.NOMBRE) AS JEFE_GUARDIA,
			A.SUBALTERNO_ID,
            CONCAT_WS(' ',C.APELLIDO,C.NOMBRE) AS SUBALTERNO,
			A.CUARTELERO_ID,
            CONCAT_WS(' ',D.NOMBRES,' ') AS CUARTELERO,
            A.FECHA_CREACION AS FECHA_CREACION,
            A.ESTATUS AS ESTADO
            FROM GRUPO_TRABAJO A
            LEFT JOIN JEFE_GUARDIAS B ON B.JEFE_GUARDIAS_ID=A.JEFE_GUARDIAS_ID
            LEFT JOIN SUBALTERNO C ON C.SUBALTERNO_ID=A.SUBALTERNO_ID
            LEFT JOIN USUARIOS D ON D.ID_USUARIO=A.CUARTELERO_ID
			WHERE A.GRUPO_ID=$id;";
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