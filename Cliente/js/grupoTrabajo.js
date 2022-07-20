$(document).on("ready", Primera);
arrayPersonalG = new Array();

function Primera() {
    $("#formulario").hide();
    ListarGrupoTrabajos();
    CargarJefeGuardia();
    CargarSubAlterno();
    CargarGrupoUsuarios();
    $("#botonNew").click(MostarFormulario);
    $("form#formularioUsu").submit(GuardarGrupoTrabajo);
    $("#cboPersonalG").change(SeleccionarUsuario);
    
}

function MostarFormulario() {
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $("#campoEstado").hide();
    $("#txtGrupoTrabajoId").attr("readonly", false);
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
    $.post('./Controlador/grupoTrabajo.php?chasi=EditarGrupoTrabajo',{id:id}, function(r) {
         var info = $.parseJSON(r);
        $("#txtIdGrupo").val(info.grupo_id);
        $("#txtNombreGrupo").val(info.nombre_grupo);
        $("#cboJefeGuardia").val(info.jefe_guardias_id);
        $("#cboJefeGuardia").trigger("change");
        $("#cboSubAlterno").val(info.subalterno_id);
        $("#cboSubAlterno").trigger("change");
        $("#cboCuartelero").val(info.cuartelero_id);
        $("#cboCuartelero").trigger("change");
        CargarPersonalDetalle(id);
    });
}

function CargarPersonalDetalle(id) {
	$.post("./ajax/VentaAjax.php?op=CargarDetalleEdicion", {
		id: id
	}, function (r) {
		var s = $.parseJSON(r);
		elementos.length = 0;
		for (i = 0; i <= s.length; i++) {
			AgregarDetalle(s[i][0], s[i][1], s[i][2], s[i][3], s[i][4], s[i][5], s[i][6], s[i][7], s[i][8], s[i][9], s[i][10], s[i][11], s[i][12], s[i][13], s[i][14], s[i][15], s[i][16]);
		}
	});
	CargarDetalleFormaPagoVenta(idVenta);
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
