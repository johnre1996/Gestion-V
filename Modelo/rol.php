<?php
    require "conexion.php";
    class rol{

        public function CargarModuloa(){
			global $conexion;
			$consulta = "select * from modulos";
			$resultado=pg_query($conexion,$consulta);
			return $resultado;
		}

        public function CargarSubModuloa($idmodulo){
			global $conexion;
			$consulta = "select
            a.id_sub_modulo,
            b.modulo,
            a.sub_modulo,
            a.id_modulo
            from sub_modulos a
            inner join modulos b on b.id_modulo=a.id_modulo
            where a.id_modulo=$idmodulo";
			$resultado=pg_query($conexion,$consulta);
			return $resultado;
		}
 
        public function Listar(){
            global $conexion; 
            $consulta = "SELECT * FROM roles where id_rol<>1 order by id_rol desc";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function Registrar(
            $txtNombre,
            $idmodulo,
            $idopcion,
            $ind_restric,
            $cboEst
        ){
            global $conexion; 
            $consulta = "
            insert into roles (descripcion,estado)
            values ('$txtNombre',1)
            ";
            $resultado = pg_query($conexion,$consulta);            

            if($resultado){
                if(!empty($ind_restric)){
                    foreach($ind_restric as $i=>$valor){					
                        if($idmodulo[$i]==0){
                            $consulta_detalle = "
                            with idrol as (SELECT MAX(id_rol) FROM roles)
                            INSERT INTO asignacion_rol(id_rol,id_sub_modulo)
                            VALUES((select * from idrol),$idopcion[$i]);"; 
                        }
                       
                       if($idopcion[$i]==0){
                            $consulta_detalle = "
                            with idrolD as (SELECT MAX(id_rol) FROM roles)
                            INSERT INTO asignacion_rol(id_rol,id_modulo)
                            VALUES((select * from idrolD),$idmodulo[$i]);"; 
                           
                       }
                       $resultado2=pg_query($conexion,$consulta_detalle);
                    }
                }else{
                    $consulta_detalle = "select id_rol from roles order by id_rol desc limit 1"; 
                    $resultado2=pg_query($conexion,$consulta_detalle);
                }
            }

            return $resultado2;
        }

        public function Modificar(
            $txtIdRol,
            $txtNombre,
            $idmodulo,
            $idopcion,
            $ind_restric,
            $cboEst
        ){
            global $conexion; 
            $consulta = "update roles set descripcion='$txtNombre',estado=$cboEst where id_rol=$txtIdRol;";
            $resultado = pg_query($conexion,$consulta);

            if($resultado){
                $consulta1 = "delete from asignacion_rol where  id_rol=$txtIdRol;";
                $resultado1 = pg_query($conexion,$consulta1);
            }
            if($resultado1){
                if(!empty($ind_restric)){
                    foreach($ind_restric as $i=>$valor){					
                        if($idmodulo[$i]==0){
                            $consulta_detalle = "insert into asignacion_rol(id_rol,id_sub_modulo)
                            VALUES($txtIdRol,$idopcion[$i]);"; 
                        }
                       
                       if($idopcion[$i]==0){
                            $consulta_detalle = "insert into asignacion_rol(id_rol,id_modulo)
                            VALUES($txtIdRol,$idmodulo[$i]);"; 
                       }
                       $resultado2=pg_query($conexion,$consulta_detalle);          
                    }
                }else{
                    $consulta_detalle = "select id_rol from roles order by id_rol desc limit 1"; 
                    $resultado2=pg_query($conexion,$consulta_detalle);
                }
            }
            return $resultado2;
        }
        
        public function EditarRol($id){
            global $conexion; 
            $consulta = "SELECT * FROM roles where id_rol=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }

        public function CargarDetalleRolModulo($idRol){
			global $conexion;
			$consulta = "SELECT MMM.*,
            CASE WHEN (SELECT MRP.id_modulo FROM asignacion_rol MRP
            WHERE  MRP.id_modulo=MMM.id_modulo AND MRP.id_rol=$idRol) IS NULL THEN 'NO' ELSE 'SI' END AS ind_checked
            FROM modulos MMM";
			$resultado=pg_query($conexion,$consulta);
			return $resultado;
		}

        public function CargarDetalleRolSubModulo($idmodulo,$idrol){
			global $conexion;
			$consulta = "SELECT MO.id_sub_modulo,
            MM.modulo,
             MO.sub_modulo,
             MO.id_modulo,
              CASE WHEN (SELECT MRP.id_sub_modulo FROM asignacion_rol MRP
              WHERE  MRP.id_sub_modulo=MO.id_sub_modulo AND MRP.id_rol=$idrol) IS NULL THEN 'NO' ELSE 'SI' END AS ind_checked
             FROM sub_modulos MO
            INNER JOIN modulos MM ON MO.id_modulo=MM.id_modulo
            where MM.id_modulo=$idmodulo";
			$resultado=pg_query($conexion,$consulta);
			return $resultado;
		}

        public function Eliminar($id){
            global $conexion; 
            $consulta = "delete from asignacion_rol WHERE  id_rol=$id;
            delete from roles WHERE  id_rol=$id;";
            $resultado = pg_query($conexion,$consulta);            
            return $resultado;
        }
    }
?>