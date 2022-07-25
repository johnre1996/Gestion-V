<?php
    session_start();
    require_once "../Modelo/vehiculo.php";
    $modelo = new vehiculo();

    switch ($_GET["chasi"]) {

        case 'SaveOrUpdatePass':

            $pass = $_POST["txtConfirmarPass"];
            $correo = $_POST["mail"];
            $vehiculo = $_POST["vehiculo"];
            $query = $modelo->ModificarPass($correo, $pass, $vehiculo);
            if ($query) {
                $data = array("ind" => '1', "Mensaje" => "Exitoso");
            } else {
                $data = array("ind" => '0', "Mensaje" => "Error  ");
            }
            echo json_encode($data);
            break;

       

        case "CargarMarcas":
            $info = $modelo->CargarMarcas();
            while ($dataModel = pg_fetch_object($info)) {
                echo '<option value="' . $dataModel->id_marca . '">' . $dataModel->nombre_mar . '</option>';
            }
            break;
            
        case "ListarVehiculos":
            $info = $modelo->ListarVehiculos();
            while ($dataModel = pg_fetch_object($info)) {
                if($dataModel->estado_veh == 1){
                    $estado='Activo';
                }else{
                    $estado='Inactivo';
                }
                echo '
                <tr>
                    <th>'.$dataModel->identificador_veh.'</th>
                    <th>'.$dataModel->nombre_veh.'</th>
                    <th>'.$dataModel->placa_veh.'</th>
                    <th>'.$dataModel->modelo_veh.'</th>
                    <th>'.$dataModel->marca.'</th>
                    <th>'.$estado.'</th>
                    <th>
                        <button type="button" onClick="EditarVehiculo('.$dataModel->id_vehiculo.');" class="btn btn-primary btn-xs">Editar</button>
                        <button type="button" onClick="EliminarVehiculo('.$dataModel->id_vehiculo.');" class="btn btn-danger btn-xs">Eliminar</button>
                    </th>
                </tr>
                ';
            }
            break;
            

        case 'GuardarVehiculo':
          
    
            $txtIdentificador = $_POST["txtIdentificador"];
            $txtNombre = $_POST["txtNombre"];
            $txtPlaca = $_POST["txtPlaca"];
            $cboMarca = $_POST["cboMarca"];
            $txtModelo = $_POST["txtModelo"];
            $txtClase = $_POST["txtClase"];
            $txtColor = $_POST["txtColor"];
            $txtAnio = $_POST["txtAnio"];
            $txtCilindraje = $_POST["txtCilindraje"];
            $txtMotor = $_POST["txtMotor"];
            $txtChasis = $_POST["txtChasis"];
            $txtCombustible = $_POST["txtCombustible"];
            $cboEst = $_POST["cboEst"];
            
            if (empty($_POST["txtIdVehiculo"])) {
    
                if ($modelo->Registrar(
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
                )) {
                    echo "Registrado Exitosamente";
                } else {
                    echo "Vehiculo no ha podido ser registado.";
                }
            } else {
                if ($modelo->Modificar(
                    $_POST["txtIdVehiculo"],
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
                )) {
                    echo "Informacion del Vehiculo ha sido actualizada";
                } else {
                    echo "Informacion del vehiculo no ha podido ser actualizada.";
                }
            }
    
            break;

        case 'EditarVehiculo':
              
            $id = $_POST["id"];
            $info = $modelo->EditarVehiculo($id);
            $dataModel = pg_fetch_object($info);
            echo json_encode($dataModel);
            break;
        
        case 'EliminarVehiculo':
              
            $id = $_POST["id"];

            if ($modelo->Eliminar(
                $id
            )) {
                echo "Eliminado Exitosamente";
            } else {
                echo "Vehiculo no ha podido ser eliminado.";
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
