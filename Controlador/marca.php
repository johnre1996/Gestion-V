<?php
    session_start();
    require_once "../Modelo/marca.php";
    $modelo = new marca();

    switch ($_GET["chasi"]) {
  
        case "ListarMarca":
            $info = $modelo->ListarMarca();
            while ($dataModel = pg_fetch_object($info)) {
                if($dataModel->estado_mar == 1){
                    $estado='Activo';
                }else{
                    $estado='Inactivo';
                }
                echo '
                <tr>
                    <th>'.$dataModel->nombre_mar.'</th>
                    <th>'.$estado.'</th>
                    <th>
                        <button type="button" onClick="EditarMarca('.$dataModel->id_marca.');" class="btn btn-primary btn-xs">Editar</button>
                        <button type="button" onClick="EliminarMarca('.$dataModel->id_marca.');" class="btn btn-danger btn-xs">Eliminar</button>
                    </th>
                </tr>
                ';
            }
            break;
            

        case 'GuardarMarca':
            $txtMarca = $_POST["txtMarca"];
            $estado = $_POST["cboEst"];

            if (empty($_POST["txtIdMarca"])) {
    
                if ($modelo->Registrar(
                    $txtMarca
                )) {
                    echo "Registrado Exitosamente";
                } else {
                    echo "No ha podido ser registado.";
                }
            } else {
    
                if ($modelo->Modificar(
                    $_POST["txtIdMarca"],
                    $txtMarca,
                    $estado
                )) {
                    echo "Informacion del Marca ha sido actualizada";
                } else {
                    echo "Informacion del No ha podido ser actualizada.";
                }
            }
    
            break;

        case 'EditarMarca':
              
            $id = $_POST["id"];
            $info = $modelo->EditarMarca($id);
            $dataModel = pg_fetch_object($info);
            echo json_encode($dataModel);
            break;
        
        case 'EliminarMarca':
              
            $id = $_POST["id"];

            if ($modelo->Eliminar(
                $id
            )) {
                echo "Eliminado Exitosamente";
            } else {
                echo "Marca no ha podido ser eliminado.";
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
                    $data = array("ind" => '1', "Mensaje" => "Correo con link de recuperación enviado");
                } else {
                    $data = array("ind" => '0', "Mensaje" => "Error al Encontrar Informacione.");
                }
            } else {
    
                $data = array("ind" => '0', "Mensaje" => "Error al Encontrar Información.");
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
