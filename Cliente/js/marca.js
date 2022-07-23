$(document).on("ready", Primera);


function Primera() {
    $("#formulario").hide();
    ListarMarca();
    $("#botonNew").click(MostarFormulario);
    $("form#formularioUsu").submit(GuardarMarca);
    
}

function MostarFormulario() {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $(".campoEstado").hide();
    $("#campoClave").show();
}

function OcultarFormulario() {
    $("#formulario").hide();
    $("#botonNew").show();
    $("#lista").show();
}

function LimpiarFormulario() {
    $("#txtIdMarca").val("");
    $("#txtMarcaId").val("");

    $("#cboEst").val(1);
    
}

function ListarMarca() {
    $.post('./Controlador/marca.php?chasi=ListarMarca',function(r) {
        $("#dataMarca").html(r);
    });
}

function GuardarMarca(a) {
    a.preventDefault();
    //console.log($("#formularioUsu").serialize());
    $.post('./Controlador/marca.php?chasi=GuardarMarca',$("#formularioUsu").serialize(), function(r) {
        swal("Mensaje del Sistema", r, "success");
        OcultarFormulario();
        LimpiarFormulario();
        ListarMarca();
    });
}

function EditarMarca(id) {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $(".campoEstado").show();
    $.post('./Controlador/marca.php?chasi=EditarMarca',{id:id}, function(r) {
         var info = $.parseJSON(r);
         console.log(info);
        $("#txtIdMarca").val(info.id_marca);
        $("#txtMarcaId").val(info.nombre_mar);
      
        $("#cboEst").val(info.estado_mar);
        $("#cboEst").trigger("change");
    });
}

function EliminarMarca(id) {
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
            $.post('./Controlador/marca.php?chasi=EliminarMarca', { id: id }, function(r) {
                swal("Mensaje del Sistema", r, "success");
                ListarMarca();
            });
        });
}

