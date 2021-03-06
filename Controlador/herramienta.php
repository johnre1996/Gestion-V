<?php
    session_start();
    require_once "../Modelo/herramienta.php";
    $modelo = new herramienta();

    switch ($_GET["chasi"]) {

        case "CargarVehiculos":
            $info = $modelo->CargarVehiculos();
            while ($dataModel = pg_fetch_object($info)) {
                echo '<option value="' . $dataModel->id_vehiculo . '">' . $dataModel->identificador_veh . ' - ' .$dataModel->nombre_veh.'</option>';
            }
        break;

        case "CargarVehiculosEdicion":
            $info = $modelo->CargarVehiculosEdicion($_POST["idVehiculo"]);
            while ($dataModel = pg_fetch_object($info)) {
                echo '<option value="' . $dataModel->id_vehiculo . '">' . $dataModel->identificador_veh . ' - ' .$dataModel->nombre_veh.'</option>';
            }
        break;

        
  
        case "ListarHerramienta":
            $info = $modelo->ListarHerramienta();
            while ($dataModel = pg_fetch_object($info)) {
                if($dataModel->estado_her == 1){
                    $estado='Activo';
                }else{
                    $estado='Inactivo';
                }
                if ($dataModel->num_filas_detalle == 1) {
                    echo '<tr>
                            <td  rowspan="' . $dataModel->num_filas . '">' . $dataModel->identificador_veh . ' - ' . $dataModel->nombre_veh . '</a></td>';
                    $i++;
                }
                if ($dataModel->num_filas_detalle == 1) {
                    echo '  <td>' . $dataModel->codigo_her . '</td>
                            <td>' . $dataModel->nombre_her . '</td>
                            <td>' . $dataModel->cantidad_her . '</td>
                            <td>' . $dataModel->area . '</td>
                            <td rowspan="' . $dataModel->num_filas . '">'.$estado.'</td>                                
                            <td rowspan="' . $dataModel->num_filas . '">
                                <button type="button" onClick="EditarHerramienta('.$dataModel->id_vehiculo.');" class="btn btn-primary btn-xs">Editar</button>
                                <button type="button" onClick="EliminarHerramienta('.$dataModel->id_vehiculo.');" class="btn btn-danger btn-xs">Eliminar</button>
                            </td>
                            </tr>';
                } else {
    
                    echo '<tr>
                            <td>' . $dataModel->codigo_her . '</td>
                            <td>' . $dataModel->nombre_her . '</td>
                            <td>' . $dataModel->cantidad_her . '</td>
                            <td>' . $dataModel->area . '</td>
                    </tr>';
                }

            }
            break;
            

        case 'GuardarHerramienta':
            $cboVehiculos = $_POST["cboVehiculos"];
            $estado = $_POST["cboEst"];
            $detalleHerramienta = json_decode($_POST["detalleHerramienta"]);

            if (empty($_POST["txtIdVehiculo"])) {
    
                if ($modelo->Registrar(
                    $cboVehiculos,
                    $detalleHerramienta
                )) {
                    echo "Registrado Exitosamente";
                } else {
                    echo "No ha podido ser registado.";
                }
            } else {
    
                if ($modelo->Modificar(
                    $_POST["txtIdVehiculo"],
                    $cboVehiculos,
                    $detalleHerramienta,
                    $estado
                )) {
                    echo "Informacion del Herramienta ha sido actualizada";
                } else {
                    echo "Informacion del No ha podido ser actualizada.";
                }
            }
    
            break;

        case 'EditarHerramienta':
              
            $id = $_POST["id"];
            $info = $modelo->EditarHerramienta($id);
            $dataModel = pg_fetch_object($info);
            echo json_encode($dataModel);
            break;

        case "CargarDatosDetallePedido":

            $idEmpresa = $_SESSION["idempresa"];
            $query = $obj->CargarDatosDetallePedido($_POST["idPedido"], $idEmpresa, $_SESSION["idusuario"]);
            $replace = array(
                '??' => 'S', '??' => 's', '??' => 'Z', '??' => 'z', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'C', '??' => 'E', '??' => 'E',
                '??' => 'E', '??' => 'E', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'U',
                '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'Y', '??' => 'B', '??' => 'Ss', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'c',
                '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'o', '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o',
                '??' => 'o', '??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'y', '??' => 'b', '??' => 'y', '"' => '', '<' => ' ', '>' => ' '
            );
    
    
            while ($reg =  sqlsrv_fetch_object($query)) {
                $data[] = array($reg->ID_PRODUCTO, $reg->COD_IVA, $reg->VAL_IVA, strtr($reg->NOMBRE, $replace), $reg->CANTIDAD, $reg->STOCK, $reg->PRECIO, $reg->DESCUENTO, $reg->PRECIO_TOTAL, $reg->TIPO, $reg->PORCENTAJE_DCTO, $reg->PRECIO_IVA, $reg->IVAOP, $reg->COD_PRODUCTO, $reg->DESCUENTO_UNITARIO, $reg->DES_REMPLAZO, $reg->COMENTARIO, $reg->OFERTA, $reg->ID_CENTRO_COSTOS, $reg->CENTRO_COSTOS, $reg->ID_CATEGORIA, $reg->IND_HONORARIO, $reg->PRECIO_VARIABLE, $reg->IND_LIBERAR_STOCK, $reg->ID_PEDIDO, $reg->IND_CONTROL_SERIE, $reg->IND_CONTROL_LOTE, $reg->ID_PROMOCION_CONSOLIDADO);
            }
            echo json_encode($data);
            break;

        case 'EditarHerramientaDetalle':
              
            $id = $_POST["id"];
            $info = $modelo->EditarHerramientaDetalle($id);
            while ($dataModel =  pg_fetch_object($info)) {
                $data[] = array($dataModel->codigo_her, $dataModel->nombre_her, $dataModel->cantidad_her,$dataModel->area,$dataModel->observacion_her);
            }
            echo json_encode($data);
            break;
        
        case 'EliminarHerramienta':
              
            $id = $_POST["id"];

            if ($modelo->Eliminar(
                $id
            )) {
                echo "Eliminado Exitosamente";
            } else {
                echo "Herramienta no ha podido ser eliminado.";
            }
            break;

        case "RecoveryPasswordEmail":
            $recoveryPassword = $_POST["recoveryPassword"];
            $query = $modelo->RecoveryPasswordEmail($recoveryPassword);
            $reg = pg_fetch_object($query);
        
            if ($reg->num == 1) {
    
                EnviarCorreoRecuperarPass($recoveryPassword);
    
                $query1 = $modelo->RecoveryXEmail($recoveryPassword);
    
                if ($query1) {
                    $data = array("ind" => '1', "Mensaje" => "Correo con link de recuperaci??n enviado");
                } else {
                    $data = array("ind" => '0', "Mensaje" => "Error al Encontrar Informacione.");
                }
            } else {
    
                $data = array("ind" => '0', "Mensaje" => "Error al Encontrar Informaci??n.");
            }
            echo json_encode($data);
            break;

        case 'cerrarsesion':
            //vaciar valores de las sesiones
            session_unset();
            
            session_destroy();
            header("Location:../index.html");
        break;    
    }
