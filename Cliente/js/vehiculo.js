$(document).on("ready", Primera);


function Primera() {
    $("#formulario").hide();
    CargarRoles();
    ListarUsuarios();
    $("#botonNew").click(MostarFormulario);
    $("form#formularioUsu").submit(GuardarUsuario);
    
}

function MostarFormulario() {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").hide();
    $("#campoClave").show();
    $("#txtUsuarioId").attr("readonly", false);
}

function OcultarFormulario() {
    $("#formulario").hide();
    $("#botonNew").show();
    $("#lista").show();
}

function LimpiarFormulario() {
    $("#txtIdUsuId").val("");
    $("#txtNombreId").val("");
    $("#txtCorreoId").val("");
    $("#txtCelularId").val("");
    $("#txtUsuarioId").val("");
    $("#txtClaveId").val("");
    $("#cboEstId").val(1);
    
}

function CargarRoles() {
    $.post('./Controlador/vehiculo.php?chasi=CargarRoles',function(r) {
        $("#cboIdRol").html(r);
    });
}

function ListarUsuarios() {
    $.post('./Controlador/vehiculo.php?chasi=ListarUsuarios',function(r) {
        $("#dataUsuario").html(r);
    });
}

function GuardarUsuario(a) {
    a.preventDefault();
    //console.log($("#formularioUsu").serialize());
    $.post('./Controlador/vehiculo.php?chasi=GuardarUsuario',$("#formularioUsu").serialize(), function(r) {
        swal("Mensaje del Sistema", r, "success");
        OcultarFormulario();
        LimpiarFormulario();
        ListarUsuarios();
    });
}

function EditarUsuario(id) {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").show();
    $("#campoClave").hide();
    $("#txtUsuarioId").attr("readonly", true);
    $.post('./Controlador/vehiculo.php?chasi=EditarUsuario',{id:id}, function(r) {
         var info = $.parseJSON(r);
        $("#txtIdUsuId").val(info.id_usuario);
        $("#txtNombreId").val(info.nombres);
        $("#txtCorreoId").val(info.correo);
        $("#txtCelularId").val(info.telefono);
        $("#txtUsuarioId").val(info.usuario);
        $("#txtClaveId").val("dsdsds5d");
        
        $("#cboIdRol").val(info.id_rol);
        $("#cboIdRol").trigger("change");
        $("#cboEstId").val(info.estado);
        $("#cboEstId").trigger("change");
    });
}

function EliminarUsuario(id) {
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
            $.post('./Controlador/vehiculo.php?chasi=EliminarUsuario', { id: id }, function(r) {
                swal("Mensaje del Sistema", r, "success");
                ListarUsuarios();
            });
        });
}

