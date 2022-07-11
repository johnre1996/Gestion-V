$(document).on("ready", Primera);


function Primera() {
    $("#formulario").hide();
    ListarRols();
    $("#botonNew").click(MostarFormulario);
    $("form#formularioUsu").submit(GuardarRol);
    
}

function MostarFormulario() {
    CargarModuloa();
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").hide();
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
    $("#txtRolId").val("");
    $("#txtClaveId").val("");
    $("#cboEstId").val(1);
    
}

function CargarModuloa(){
    $.post('./Controlador/rol.php?chasi=CargarModuloa', function(r){
        $("#bodyperfil").html(r);
    });
}

function ListarRols() {
    $.post('./Controlador/rol.php?chasi=Listar',function(r) {
        $("#dataRol").html(r);
    });
}

function GuardarRol(a) {
    a.preventDefault();
    //console.log($("#formularioUsu").serialize());
    $.post('./Controlador/rol.php?chasi=GuardarRol',$("#formularioUsu").serialize(), function(r) {
        swal("Mensaje del Sistema", r, "success");
        OcultarFormulario();
        LimpiarFormulario();
        ListarRols();
    });
}

function EditarRol(id) {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").show();
    $.post('./Controlador/rol.php?chasi=EditarRol',{id:id}, function(r) {
         var info = $.parseJSON(r);
        $("#txtIdRolId").val(info.id_rol);
        $("#txtNombreId").val(info.descripcion);
        $("#cboEst").val(info.estado);
        $("#cboEst").trigger("change");
        CargarDetalleRol(id);
    });
}

function CargarDetalleRol(id) {
    $.post('./Controlador/rol.php?chasi=CargarDetalleRol',{id:id}, function(r) {
        $("#bodyperfil").html(r);
    });
}

function EliminarRol(id) {
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
            $.post('./Controlador/rol.php?chasi=EliminarRol', { id: id }, function(r) {
                swal("Mensaje del Sistema", r, "success");
                ListarRols();
            });
        });
}

