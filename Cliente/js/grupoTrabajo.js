$(document).on("ready", Primera);
arrayPersonalG = new Array();

function Primera() {
    $("#formulario").hide();
    ListarGrupoTrabajos();
    $("#botonNew").click(MostarFormulario);
    $("form#formularioUsu").submit(GuardarGrupoTrabajo);
    $("#cboPersonalG").change(SeleccionarUsuario);
    
}

function MostarFormulario() {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").hide();
    $("#campoClave").show();
    $("#txtGrupoTrabajoId").attr("readonly", false);
    CargarJefeGuardia();
    CargarSubAlterno();
    CargarGrupoUsuarios();
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
    $("#txtGrupoTrabajoId").val("");
    $("#txtClaveId").val("");
    $("#cboEstId").val(1);
    
}

function CargarJefeGuardia() {
    $.post('./Controlador/grupoTrabajo.php?chasi=CargarJefeGuardia',function(r) {
        $("#cboJefeGuardia").html(r);
    });
}

function CargarSubAlterno() {
    $.post('./Controlador/grupoTrabajo.php?chasi=CargarSubAlterno',function(r) {
        $("#cboSubAlterno").html(r);
    });
}

function CargarGrupoUsuarios() {
    $.post('./Controlador/grupoTrabajo.php?chasi=CargarGrupoUsuarios',function(r) {
        $("#cboCuartelero").html(r);
        $("#cboPersonalG").html(r);
    });
}

function ListarGrupoTrabajos() {
    $.post('./Controlador/grupoTrabajo.php?chasi=ListarGrupoTrabajos',function(r) {
        $("#datagrupoTrabajo").html(r);
    });
}

function GuardarGrupoTrabajo(a) {
    a.preventDefault();
    //console.log($("#formularioUsu").serialize());
    $.post('./Controlador/grupoTrabajo.php?chasi=GuardarGrupoTrabajo',$("#formularioUsu").serialize()  + '&detalleGrupo=' + JSON.stringify(arrayPersonalG) , function(r) {
        swal("Mensaje del Sistema", r, "success");
        OcultarFormulario();
        LimpiarFormulario();
        ListarGrupoTrabajos();
    });
}

function EditarGrupoTrabajo(id) {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").show();
    $("#campoClave").hide();
    $("#txtGrupoTrabajoId").attr("readonly", true);
    $.post('./Controlador/grupoTrabajo.php?chasi=EditarGrupoTrabajo',{id:id}, function(r) {
         var info = $.parseJSON(r);
        $("#txtIdUsuId").val(info.id_usuario);
        $("#txtNombreId").val(info.nombres);
        $("#txtCorreoId").val(info.correo);
        $("#txtCelularId").val(info.telefono);
        $("#txtGrupoTrabajoId").val(info.usuario);
        $("#txtClaveId").val("dsdsds5d");
        
        $("#cboJefeGuardia").val(info.id_rol);
        $("#cboJefeGuardia").trigger("change");
        $("#cboEstId").val(info.estado);
        $("#cboEstId").trigger("change");
    });
}

function EliminarGrupoTrabajo(id) {
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
            $.post('./Controlador/grupoTrabajo.php?chasi=EliminarGrupoTrabajo', { id: id }, function(r) {
                swal("Mensaje del Sistema", r, "success");
                ListarGrupoTrabajos();
            });
        });
}

function SeleccionarUsuario(){
    var id = $(this).val();
    $.post('./Controlador/usuario.php?chasi=EditarUsuario',{id:id}, function(r) {
        var info = $.parseJSON(r);
        data = {
            idUsuario: id,
            NombreUsuario: info.nombres
        }
        AggDet(data);
   });
}

function AggDet({idUsuario = "",NombreUsuario = ""}) {
    var parametros = new Array(idUsuario,NombreUsuario);
    arrayPersonalG.push(parametros);
    htmlArray();
}

function htmlArray() {
    var pos = arrayPersonalG.length - 1;
    var posSeg = arrayPersonalG.length;
    $("table#dataPersonalGuardia").append("<tr>" +
        "<td>" + posSeg + "</td>" +
        "<td>" + arrayPersonalG[pos][1] + " </td>" +
        "<td>" +
        "<button type='button' title='Quitar Item' onclick='eliminarDetalle(" + pos + ")' class='btn btn-outline-secondary btn-rounded'><i class='fa fa-remove' ></i> </button>" +
        "</td></tr>");

    window.scrollTo(0, document.querySelector("#dataPersonalGuardia").scrollHeight);
}

function htmlArrayAct() {
    $("table#dataPersonalGuardia tbody").html("");
    for (pos = 0; pos < arrayPersonalG.length; pos++) {
        posSeg = pos + 1;
        $("table#dataPersonalGuardia").append("<tr>" +
            "<td>" + posSeg + "</td>" +
            "<td>" + arrayPersonalG[pos][1] + " </td>" +
            "<td>" +
            "<button type='button' title='Quitar Item' onclick='eliminarDetalle(" + pos + ")' class='btn btn-outline-secondary btn-rounded'><i class='fa fa-remove' ></i> </button>" +
            "</td></tr>");

        window.scrollTo(0, document.querySelector("#dataPersonalGuardia").scrollHeight);
    }
}

function eliminarDetalle(ele) {
    ele > -1 && arrayPersonalG.splice(parseInt(ele), 1);
    htmlArrayAct();
}
