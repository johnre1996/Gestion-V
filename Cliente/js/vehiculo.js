$(document).on("ready", Primera);


function Primera() {
    $("#formulario").hide();
    CargarMarcas();
    ListarVehiculos();
    $("#botonNew").click(MostarFormulario);
    $("form#formularioUsu").submit(GuardarVehiculo);
    
}

function MostarFormulario() {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").hide();
    $("#campoClave").show();
    $("#txtVehiculo").attr("readonly", false);
}

function OcultarFormulario() {
    $("#formulario").hide();
    $("#botonNew").show();
    $("#lista").show();
}

function LimpiarFormulario() {
    $("#txtIdVehiculo").val("");
    $("#txtIdentificador").val("");
    $("#txtNombre").val("");
    $("#txtPlaca").val("");
    $("#txtModelo").val("");
    $("#txtClase").val("");
    $("#txtColor").val("");
    $("#txtAnio").val("");
    $("#txtCilindraje").val("");
    $("#txtMotor").val("");
    $("#txtChasis").val("");
    $("#txtCombustible").val("");
    $("#cboEst").val(1);
    
}

function CargarMarcas() {
    $.post('./Controlador/vehiculo.php?chasi=CargarMarcas',function(r) {
        $("#cboMarca").html(r);
    });
}

function ListarVehiculos() {
    $.post('./Controlador/vehiculo.php?chasi=ListarVehiculos',function(r) {
        $("#dataVehiculo").html(r);
    });
}

function GuardarVehiculo(a) {
    a.preventDefault();
    $.post('./Controlador/vehiculo.php?chasi=GuardarVehiculo',$("#formularioUsu").serialize(), function(r) {
        swal("Mensaje del Sistema", r, "success");
        OcultarFormulario();
        LimpiarFormulario();
        ListarVehiculos();
    });
}

function EditarVehiculo(id) {
    CargarMarcas();
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").show();
    $("#campoClave").hide();
    $("#txtVehiculo").attr("readonly", true);
    $.post('./Controlador/vehiculo.php?chasi=EditarVehiculo',{id:id}, function(r) {
         var info = $.parseJSON(r);
         $("#txtIdVehiculo").val(info.id_vehiculo);
         $("#txtIdentificador").val(info.identificador_veh);
         $("#txtNombre").val(info.nombre_veh);
         $("#txtPlaca").val(info.placa_veh);
         $("#cboMarca").val(info.id_marca);
         $("#cboMarca").trigger("change");
         $("#txtModelo").val(info.modelo_veh);
         $("#txtClase").val(info.clase_veh);
         $("#txtColor").val(info.color_veh);
         $("#txtAnio").val(info.anio_veh);
         $("#txtCilindraje").val(info.cilindraje_veh);
         $("#txtMotor").val(info.c_motor_veh);
         $("#txtChasis").val(info.c_chasis_veh);
         $("#txtCombustible").val(info.t_combustible_veh);
         $("#cboEst").val(info.estado_veh);
         $("#cboEst").trigger("change");
    });
}

function EliminarVehiculo(id) {
    swal({
        title: "¿Seguro que deseas eliminar el registro?",
        text: "Esta acción no se puede revertir...",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Confirmar",
        closeOnConfirm: false },
        function(){
            $.post('./Controlador/vehiculo.php?chasi=EliminarVehiculo', { id: id }, function(r) {
                swal("Mensaje del Sistema", r, "success");
                ListarVehiculos();
            });
        });
}

