$(document).on("ready", Primera);
arrayHerramientas = new Array();

function Primera() {
    $("#formulario").hide();
    $("#btnAgregarHerramienta").click(AgregarHerramienta);
    
    
    ListarHerramienta();
    $("#botonNew").click(MostarFormulario);
    $("form#formularioHerr").submit(GuardarHerramienta);
    
}

function CargarVehiculos() {
    $.post('./Controlador/herramienta.php?chasi=CargarVehiculos',function(r) {
        $("#cboVehiculos").html(r);
    });
}

function CargarVehiculosEdicion(idVehiculo) {
    $.post('./Controlador/herramienta.php?chasi=CargarVehiculosEdicion',{idVehiculo:idVehiculo},function(r) {
        $("#cboVehiculos").html(r);
    });
}

function MostarFormulario() {
    CargarVehiculos();
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $(".campoEstado").hide();
    $("#campoClave").show();
    AgregarHerramienta();
}

function OcultarFormulario() {
    $("#formulario").hide();
    $("#botonNew").show();
    $("#lista").show();
}

function LimpiarFormulario() {

    $("#txtIdVehiculo").val("");
    $("#cboEst").val(1);
    $("#cboEst").trigger("change");
    arrayHerramientas.length = 0;
    htmlArrayAct();
}

function ListarHerramienta() {
    $.post('./Controlador/herramienta.php?chasi=ListarHerramienta',function(r) {
        $("#dataHerramienta").html(r);
    });
}

function GuardarHerramienta(a) {
    a.preventDefault();
    //console.log($("#formularioHerr").serialize());
    $.post('./Controlador/herramienta.php?chasi=GuardarHerramienta',
    $("#formularioHerr").serialize() + '&detalleHerramienta=' + JSON.stringify(arrayHerramientas)
    , function(r) {
        swal("Mensaje del Sistema", r, "success");
        OcultarFormulario();
        LimpiarFormulario();
        ListarHerramienta();
    });
}

function EditarHerramienta(id) {
    CargarVehiculosEdicion(id);
    $("#formulario").show();
    $("#botonNew").hide();
    $("#lista").hide();
    $(".campoEstado").show();
    $.post('./Controlador/herramienta.php?chasi=EditarHerramienta',{id:id}, function(r) {
         var info = $.parseJSON(r);
         console.log(info);
        $("#txtIdVehiculo").val(info.id_vehiculo);
        $("#cboVehiculos").val(info.id_vehiculo);
        $("#cboVehiculos").trigger("change");   
        $("#cboEst").val(info.estado_her);
        $("#cboEst").trigger("change");
        CargarDetalleHerramienta(id);
    });
}

function CargarDetalleHerramienta(idVehiculo) {
    $.post("./Controlador/herramienta.php?chasi=EditarHerramientaDetalle", {
        id: idVehiculo
    }, function (r) {
        var s = $.parseJSON(r);
        for (i = 0; i <= s.length; i++) {
            parametros = {codigo : s[i][0],detalle : s[i][1],cantidad : s[i][2],area : s[i][3],observacion : s[i][4] }
            AggDet(parametros);
        }
 
    });
}

function EliminarHerramienta(id) {
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
            $.post('./Controlador/herramienta.php?chasi=EliminarHerramienta', { id: id }, function(r) {
                swal("Mensaje del Sistema", r, "success");
                ListarHerramienta();
            });
        });
}

// ###### DETALLE HERRAMIENTAS

function AgregarHerramienta(){
    /* data = {
        codigo: id,
        detalle: info.nombres
    } */
    AggDet({});
}

function AggDet({codigo = "",detalle = "",cantidad = "",area = "",observacion = "" }) {
    var parametros = new Array(codigo,detalle,cantidad,area,observacion);
    arrayHerramientas.push(parametros);
    htmlArray();
}

function htmlArray() {
    var pos = arrayHerramientas.length - 1;
    var posSeg = arrayHerramientas.length;
    $("table#dataHerramientasDetalle").append("<tr>" +
        "<td>" + posSeg + "</td>" +
        "<td> <input type='text' class='form-control txtCodigo"+pos+" ' id='txtCodigo[]' name='txtCodigo' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][0]+"' required> </td>" +
        "<td> <input type='text' class='form-control txtDetalle"+pos+" ' id='txtDetalle[]' name='txtDetalle' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][1]+"' required> </td>" +
        "<td> <input type='text' class='form-control txtCantidad"+pos+" ' id='txtCantidad[]' name='txtCantidad' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][2]+"' required> </td>" +
        "<td> <input type='text' class='form-control txtArea"+pos+" ' id='txtArea[]' name='txtArea' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][3]+"' required> </td>" +
        "<td> <input type='text' class='form-control txtObservacion"+pos+" ' id='txtObservacion[]' name='txtObservacion' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][4]+"' required> </td>" +
        "<td>" +
        "<button type='button' title='Quitar Item' onclick='eliminarDetalle(" + pos + ")' class='btn btn-outline-secondary btn-rounded'><i class='fa fa-remove' ></i> </button>" +
        "</td></tr>");
}

function htmlArrayAct() {
    $("table#dataHerramientasDetalle tbody").html("");
    for (pos = 0; pos < arrayHerramientas.length; pos++) {
        posSeg = pos + 1;
        $("table#dataHerramientasDetalle").append("<tr>" +
        "<td>" + posSeg + "</td>" +
        "<td> <input type='text' class='form-control txtCodigo"+pos+" ' id='txtCodigo[]' name='txtCodigo' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][0]+"' required> </td>" +
        "<td> <input type='text' class='form-control txtDetalle"+pos+" ' id='txtDetalle[]' name='txtDetalle' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][1]+"' required> </td>" +
        "<td> <input type='text' class='form-control txtCantidad"+pos+" ' id='txtCantidad[]' name='txtCantidad' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][2]+"' required> </td>" +
        "<td> <input type='text' class='form-control txtArea"+pos+" ' id='txtArea[]' name='txtArea' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][3]+"' required> </td>" +
        "<td> <input type='text' class='form-control txtObservacion"+pos+" ' id='txtObservacion[]' name='txtObservacion' onkeyup='CambiarArray("+pos+");' value='"+arrayHerramientas[pos][4]+"' required> </td>" +
        "<td>" +
        "<button type='button' title='Quitar Item' onclick='eliminarDetalle(" + pos + ")' class='btn btn-outline-secondary btn-rounded'><i class='fa fa-remove' ></i> </button>" +
        "</td></tr>");
    }
}

function eliminarDetalle(ele) {
    ele > -1 && arrayHerramientas.splice(parseInt(ele), 1);
    htmlArrayAct();
}

function CambiarArray(ele){

    var codigo = document.getElementsByName("txtCodigo");
    var detalle = document.getElementsByName("txtDetalle");
    var cantidad = document.getElementsByName("txtCantidad");
    var area = document.getElementsByName("txtArea");
    var observacion = document.getElementsByName("txtObservacion");

    arrayHerramientas[ele][0] = codigo[ele].value;
    arrayHerramientas[ele][1] = detalle[ele].value;
    arrayHerramientas[ele][2] = cantidad[ele].value;
    arrayHerramientas[ele][3] = area[ele].value;
    arrayHerramientas[ele][4] = observacion[ele].value;
    //$(".precioconIva" + pos).val(precioConImp.toFixed(2));
}

