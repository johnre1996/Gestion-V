<?php
    session_start();
    require_once "../Modelo/rol.php";

    $modelo = new rol();

    switch ($_GET["chasi"]) {

        case "CargarModuloa":

            $info = $modelo->CargarModuloa();
            while ( $reg = pg_fetch_object( $info ) ) {
                echo '<tr style="color:#1e88e5;">
                        <td  colspan="2" >' . $reg->modulo . '</td>
                        <td align="center">
                            <div class="switch">
                                <label>
                                    <input type="checkbox" id="ChkRestricion" name="ChkRestricion[' . $reg->id_modulo . ']"  value="Activo" >
                                    <span class="lever switch-col-cyan"></span>
                                </label>
                                <input type="hidden" name="idopcion[' . $reg->id_modulo . ']" value="0" >
                                <input type="hidden" name="idmodulo[' . $reg->id_modulo . ']" value="' . $reg->id_modulo . '" >
                        </td>
                    </tr>';
                $info2 = $modelo->CargarSubModuloa( $reg->id_modulo );
                while ( $reg1 = pg_fetch_object( $info2 ) ) {
                    $i = 100 + $reg1->id_sub_modulo;
                    echo '<tr>
                            <td></td>
                            <td>' . $reg1->sub_modulo . '</td>
                            <td align="center"> 
                                <div class="switch">
                                    <label>
                                        <input type="checkbox"  id="ChkRestricion" name="ChkRestricion[' . $i . ']"  value="Activo" >
                                        <span class="lever switch-col-cyan"></span>
                                    </label>
                                </div>
                                <input type="hidden" name="idopcion[' . $i . ']" value="' . $reg1->id_sub_modulo . '" >
                                <input type="hidden" name="idmodulo[' . $i . ']" value="0" >
                            </td>
                            </tr>';
                }
            }
            break;
    
            
        case "Listar":
            $info = $modelo->Listar();
            while ($dataModel = pg_fetch_object($info)) {
                if($dataModel->estado == 1){
                    $estado='Activo';
                }else{
                    $estado='Inactivo';
                }
                echo '
                <tr>
                    <th>'.$dataModel->descripcion.'</th>
                    <th>'.$estado.'</th>
                    <th>
                        <button type="button" onClick="EditarRol('.$dataModel->id_rol.');" class="btn btn-primary btn-xs">Editar</button>
                        <button type="button" onClick="EliminarRol('.$dataModel->id_rol.');" class="btn btn-danger btn-xs">Eliminar</button>
                    </th>
                </tr>
                ';
            }
            break;
            

        case 'GuardarRol':
          
            error_reporting(0);
            $txtNombre = $_POST["txtNombre"];
            $idmodulo = $_POST[ "idmodulo" ];
            $idopcion = $_POST[ "idopcion" ];
            $ind_restric = $_POST[ "ChkRestricion" ];
            $cboEst = $_POST["cboEst"];
            
            if (empty($_POST["txtIdRol"])) {
                if ($modelo->Registrar(
                    $txtNombre,
                    $idmodulo,
                    $idopcion,
                    $ind_restric,
                    $cboEst
                )) {
                    echo "Registrado Exitosamente";
                } else {
                    echo "Rol no ha podido ser registado.";
                }
            } else {
    
                if ($modelo->Modificar(
                    $_POST["txtIdRol"],
                    $txtNombre,
                    $idmodulo,
                    $idopcion,
                    $ind_restric,
                    $cboEst
                )) {
                    echo "Informacion del Rol ha sido actualizada";
                } else {
                    echo "Informacion del Rol no ha podido ser actualizada.";
                }
            }
    
            break;

        case 'EditarRol':
              
            $id = $_POST["id"];
            $info = $modelo->EditarRol($id);
            $dataModel = pg_fetch_object($info);
            echo json_encode($dataModel);
            break;

        case "CargarDetalleRol":

            $info = $modelo->CargarDetalleRolModulo( $_POST[ 'id' ] );
            while ( $dataModel = pg_fetch_object( $info ) ) {
    
                if ( $dataModel->ind_checked == 'SI' ) {
                    $chk_modulo = 'checked';
                } else {
                    $chk_modulo = '';
                }
    
                echo '<tr style="color:#1e88e5;">
                         <td colspan="2">' . $dataModel->modulo . '</td>
                           <td align="center">
                        <div class="switch">
                                                <label>
                                                    <input type="checkbox"  id="ChkRestricion" name="ChkRestricion[' . $dataModel->id_modulo . ']"  value="Activo" ' . $chk_modulo . ' ><span class="lever switch-col-cyan"></span></label>
                                            </div>
                        
                        <input type="hidden" name="idopcion[' . $dataModel->id_modulo . ']" value="0" >
                         <input type="hidden" name="idmodulo[' . $dataModel->id_modulo . ']" value="' . $dataModel->id_modulo . '" >
                        </td>
                            </tr>';
                $info_op = $modelo->CargarDetalleRolSubModulo( $dataModel->id_modulo, $_POST[ 'id' ] );
                while ( $dataModel1 = pg_fetch_object( $info_op ) ) {
                    if ( $dataModel1->ind_checked == 'SI' ) {
                        $chk_opcion = 'checked';
                    } else {
                        $chk_opcion = '';
                    }
                    $i = 100 + $dataModel1->id_sub_modulo;
    
                    echo '<tr>
                              <td></td>
                            <td>' . $dataModel1->sub_modulo . '</td>
                            <td align="center">
                                <div class="switch">
                                    <label>
                                        <input type="checkbox"  id="ChkRestricion" name="ChkRestricion[' . $i . ']" value="Activo" ' . $chk_opcion . ' >
                                        <span class="lever switch-col-cyan"></span>
                                    </label>
                                </div>
                                <input type="hidden" name="idopcion[' . $i . ']" value="' . $dataModel1->id_sub_modulo . '" >
                                <input type="hidden" name="idmodulo[' . $i . ']" value="0" >
                            </td>
                            </tr>';
                }
            }
            break;

        case 'EliminarRol':
            $id = $_POST["id"];
            if ($modelo->Eliminar(
                $id
            )) {
                echo "Eliminado Exitosamente";
            } else {
                echo "Rol no ha podido ser eliminado.";
            }
            break;

    }
