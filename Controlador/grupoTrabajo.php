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

        case "CargarUsuarios":
            $info = $modelo->CargarUsuarios();
            while ($dataModel = pg_fetch_object($info)) {
                echo '<option value="' . $dataModel->id_usuario . '">' . $dataModel->nombres . '</option>';
            }
            break;
            
        case "ListarUsuarios":
            $info = $modelo->ListarUsuarios();
            while ($dataModel = pg_fetch_object($info)) {
                if($dataModel->estado == 1){
                    $estado='Activo';
                }else{
                    $estado='Inactivo';
                }
                echo '
                <tr>
                    <th>'.$dataModel->nombres.'</th>
                    <th>'.$dataModel->correo.'</th>
                    <th>'.$dataModel->telefono.'</th>
                    <th>'.$dataModel->usuario.'</th>
                    <th>'.$dataModel->rol.'</th>
                    <th>'.$estado.'</th>
                    <th>
                        <button type="button" onClick="EditarUsuario('.$dataModel->id_usuario.');" class="btn btn-primary btn-xs">Editar</button>
                        <button type="button" onClick="EliminarUsuario('.$dataModel->id_usuario.');" class="btn btn-danger btn-xs">Eliminar</button>
                    </th>
                </tr>
                ';
            }
            break;
            

        case 'GuardarUsuario':
          
    
            $cboIdRol = $_POST["cboIdRol"];
            $txtNombre = $_POST["txtNombre"];
            $txtCorreo = $_POST["txtCorreo"];
            $txtCelular = $_POST["txtCelular"];
            $txtUsuario = $_POST["txtUsuario"];
            $txtClave = $_POST["txtClave"];
            $cboEst = $_POST["cboEst"];
            
            if (empty($_POST["txtIdUsu"])) {
    
                if ($modelo->Registrar(
                    $cboIdRol,
                    $txtNombre,
                    $txtCorreo,
                    $txtCelular,
                    $txtUsuario,
                    $txtClave,
                    $cboEst
                )) {
                    echo "Registrado Exitosamente";
                } else {
                    echo "Usuario no ha podido ser registado.";
                }
            } else {
    
                if ($modelo->Modificar(
                    $_POST["txtIdUsu"],
                    $cboIdRol,
                    $txtNombre,
                    $txtCorreo,
                    $txtCelular,
                    $txtUsuario,
                    $txtClave,
                    $cboEst
                )) {
                    echo "Informacion del Usuario ha sido actualizada";
                } else {
                    echo "Informacion del usuario no ha podido ser actualizada.";
                }
            }
    
            break;

        case 'EditarUsuario':
              
            $id = $_POST["id"];
            $info = $modelo->EditarUsuario($id);
            $dataModel = pg_fetch_object($info);
            echo json_encode($dataModel);
            break;
        
        case 'EliminarUsuario':
              
            $id = $_POST["id"];

            if ($modelo->Eliminar(
                $id
            )) {
                echo "Eliminado Exitosamente";
            } else {
                echo "Usuario no ha podido ser eliminado.";
            }
            break;

        case 'cerrarsesion':
            //vaciar valores de las sesiones
            session_unset();
            
            session_destroy();
            header("Location:../login.html");
        break;    
    }
