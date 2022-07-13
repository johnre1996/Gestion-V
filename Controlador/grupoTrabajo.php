<?php
    session_start();
    require_once "../Modelo/grupoTrabajo.php";

    $modelo = new grupoTrabajo();

    switch ($_GET["chasi"]) {

        case "CargarJefeGuardia":
            $info = $modelo->CargarJefeGuardia();
            while ($dataModel = pg_fetch_object($info)) {
                echo '<option value="' . $dataModel->jefe_guardias_id . '">' . $dataModel->apellido . ' ' . $dataModel->nombre . '</option>';
            }
            break;

        case "CargarSubAlterno":
            $info = $modelo->CargarSubAlterno();
            while ($dataModel = pg_fetch_object($info)) {
                echo '<option value="' . $dataModel->subalterno_id . '">' . $dataModel->apellido . ' ' . $dataModel->nombre . '</option>';
            }
            break;

        case "CargarGrupoUsuarios":
            $info = $modelo->CargarGrupoUsuarios();
            while ($dataModel = pg_fetch_object($info)) {
                echo '<option value="' . $dataModel->id_usuario . '">' . $dataModel->nombres . '</option>';
            }
            break;
            
        case "ListarGrupoTrabajos":
            $info = $modelo->ListarGrupoTrabajos();
            while ($dataModel = pg_fetch_object($info)) {
                if($dataModel->estado == 1){
                    $estado='Activo';
                }else{
                    $estado='Inactivo';
                }
                echo '
                <tr>
                    <th>'.$dataModel->nombre_grupo.'</th>
                    <th>'.$dataModel->jefe_guardia.'</th>
                    <th>'.$dataModel->subalterno.'</th>
                    <th></th>
                    <th>'.$dataModel->cuartelero.'</th>
                    <th>'.$estado.'</th>
                    <th>
                        <button type="button" onClick="EditarGrupoTrabajo('.$dataModel->grupo_id.');" class="btn btn-primary btn-xs">Editar</button>
                        <button type="button" onClick="EliminarGrupoTrabajo('.$dataModel->grupo_id.');" class="btn btn-danger btn-xs">Eliminar</button>
                    </th>
                </tr>
                ';
            }
            break;
            

        case 'GuardarGrupoTrabajo':
          
    
            $txtNombreGrupo = $_POST["txtNombreGrupo"];
            $cboJefeGuardia = $_POST["cboJefeGuardia"];
            $cboSubAlterno = $_POST["cboSubAlterno"];
            $cboCuartelero = $_POST["cboCuartelero"];
            $detalleGrupo = json_decode($_POST["detalleGrupo"]);
            
            if (empty($_POST["txtIdGrupo"])) {
    
                if ($modelo->Registrar(
                    $txtNombreGrupo,
                    $cboJefeGuardia,
                    $cboSubAlterno,
                    $cboCuartelero,
                    $detalleGrupo
                )) {
                    echo "Registrado Exitosamente";
                } else {
                    echo "Grupo Trabajo no ha podido ser registado.";
                }
            } else {
                if ($modelo->Modificar(
                    $_POST["txtIdGrupo"],
                    $txtNombreGrupo,
                    $cboJefeGuardia,
                    $cboSubAlterno,
                    $cboCuartelero,
                    $detalleGrupo
                )) {
                    echo "Informacion del Grupo Trabajo ha sido actualizada";
                } else {
                    echo "Informacion del Grupo Trabajo no ha podido ser actualizada.";
                }
            }
    
            break;

        case 'EditarGrupoTrabajo':
              
            $id = $_POST["id"];
            $info = $modelo->EditarGrupoTrabajo($id);
            $dataModel = pg_fetch_object($info);
            echo json_encode($dataModel);
            break;
        
        case 'EliminarGrupoTrabajo':
              
            $id = $_POST["id"];

            if ($modelo->Eliminar(
                $id
            )) {
                echo "Eliminado Exitosamente";
            } else {
                echo "GrupoTrabajo no ha podido ser eliminado.";
            }
            break;

        case 'cerrarsesion':
            //vaciar valores de las sesiones
            session_unset();
            
            session_destroy();
            header("Location:../login.html");
        break;    
    }
