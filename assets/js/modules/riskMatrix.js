var modeloControles = $('<select class="form-control m-r-0" data-combox="6" id="cmbControles" name="controles[]" >'
        + '<option value="">Seleccione</option>'
        + '</select>');
var contControles = 0;
var contCausas = 0;

var vista = {
    init: function () {
        vista.evetns();
        vista.configView();
        dom.getListCombox(modeloControles, true);
    },
    evetns: function () {
        $("div.bhoechie-tab-menu>div.list-group>a").on('click', vista.onClickTab);
        $('form').on('submit', vista.onSubmitForm);
        $('#cmbTipoEventoNivel1').on('change', vista.onChangeCmbTipoEventoNivel1);
        $('#form3').on('click', '.btn-add-causa', vista.onClickAddCausa);
        $('#form3').on('click', '.btn-remove-causa', vista.onClickRemoveCausa);
        $('#form3').on('click', '.btn-add-control', vista.onClickAddControl);
        $('#form3').on('click', '.btn-remove-control', vista.onClickRemoveControl);
    },
    onClickAddCausa: function () {
        console.log("ADD CAUSA");
        vista.addCausa();
    },
    onClickRemoveCausa: function () {
        console.log("REMOVE CAUSA");
        var btn = $(this);
        btn.parents('');
    },
    onClickAddControl: function () {
        console.log("ADD CONTROL");
    },
    onClickRemoveControl: function () {
        console.log("REMOVE CAUSA");
    },
    addCausa: function () {
        var model = $('#itemCausaIndex');
        var clon = model.clone();
        clon.removeAttr('id').removeClass('hidden');
        var select = clon.find('select');
        select.html(model.find('select').html()).select2({'width': '100%'});
        select.next().remove();
        $('#contentCausas').append(clon);
    },
    onSubmitForm: function (e) {
        var form = $(this);
        form.validate();

        if (e.isDefaultPrevented())
        {
            return;
        }

        //Se envia la información de los formularios...
        app.stopEvent(e);

        var form1 = $('#form1');
        var form2 = $('#form2');
        var form3 = $('#form3');

        var obj = new Object();
        __mergeObj(obj, form1.getFormData());
        __mergeObj(obj, form2.getFormData());
        __mergeObj(obj, form3.getFormData());

        var formGlobal = $('#formsRisk');
        var uri = formGlobal.attr('data-action');
        var forUpdate = false;
        if (formGlobal.attr('data-mode') === "FOR_UPDATE") {
            uri = formGlobal.attr('data-action-update');
            forUpdate = true;
        }

        //Se hace la petición AJAX y se envia el objeto completo con toda la información de los tres formularios para ser procesada...
        app.post(uri, obj)
                .success(function (response) {
                    console.log(response);
                    var v = app.validResponse(response);
                    if (v) {
                        swal((forUpdate ? "Actualizado" : "Guardado"), (forUpdate ? "Se ha actualizado correctamente el registro." : "Se ha guardado correctamente el registro."), "success");
                        $('#idRecord').val(response.data);
                        formGlobal.attr('data-mode', 'FOR_UPDATE');
                        form.find('button:submit').html('<i class="fa fa-fw fa-save"></i> Actualizar');
                    } else {
                        swal((forUpdate ? "Error al actualizar" : "Error al guardar"), (forUpdate ? "Se ha producido un error al intentar actualizar el registro." : "Se ha producido un error al intentar guardar el registro."), "warning");
                    }
                })
                .error(function () {
                    swal("Error inesperado", "Lo sentimos, se ha producido un error inesperado.", "error");
                }).send();
    },
    onChangeCmbTipoEventoNivel1: function () {
        if ($('#cmbTipoEventoNivel1').val().trim("") === "") {
            return;
        }
        var cmb = $('#cmbTipoEventoNivel2');
        app.get('Utils/getListComboxCmbTipoEventoNvl2', {
            idNivel1: $('#cmbTipoEventoNivel1').val(),
        }).success(function (response) {
            var data = app.parseResponse(response);
            if (data) {
                dom.llenarCombo(cmb, data, {text: "text", value: "value"});
            }
            if (typeof callback === "function") {
                callback(data);
            }
        }).error(function () {
            dom.comboVacio(cmb);
        }).send();
    },
    onClickTab: function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab-content").eq(index).addClass("active");
        if ($(this).attr("id") === 'contentAll') {
            $("div.bhoechie-tab-content").addClass("active");
//            $("button").css("display","none");
        }
    },
    configView: function () {
        $('select').select2({width: '100%'});
    }
};

$(document).ready(function () {
    vista.init();
});


function AgregarCampos() {
    AgregarControles();
}

function AgregarControles() {
    contControles++;
    var cmb = modeloControles.clone();
    cmb.select2({width: '100%'});
    var campos = '<div class="form-group" id="contenedorControles' + contControles + '">'
            + '<label for="cmbControles" class="col-sm-2 control-label">Control</label>'
            + '<div class="col-sm-10"><div class="input-group" id="contentCmb">'
            + modeloControles[0].outerHTML
            + '<div class="input-group-btn"><button type="button" class="btn btn-success m-r-0" onclick="AgregarCampos()"><i class="fa fa-plus" aria-hidden="true"></i></button>'
            + '<button type="button" class="btn btn-danger" onclick="eliminarControles(' + contControles + ');"><i class="fa fa-minus" aria-hidden="true"></i></button>'
            + '</div></div>'
            + '</div>'
            + '</div>';
    campos = $(campos);
    campos.find('select').select2({width: '100%'});
    $("#contenedorControles").append(campos);
}

function eliminarControles(idControl) {
    $("#contenedorControles" + idControl).remove();
}

function AgregarCausas() {
    contCausas++;
    campos = '<div class="form-inline form-group" id="contenedorCausas' + contCausas + '">'
            + '<label for="cmbControles" class="col-sm-2 control-label">Causa</label>'
            + '<div class="col-sm-10">'
            + '<input type="text" class="form-control m-r-5" id="txtCausa" name="causas[]" style="width: 87%;">'
            + '<button type="button" class="btn btn-success m-r-5" onclick="AgregarCausas()"><i class="fa fa-plus" aria-hidden="true"></i></button>'
            + '<button type="button" class="btn btn-danger" onclick="eliminarCausas(' + contCausas + ');"><i class="fa fa-minus" aria-hidden="true"></i></button>'
            + '</div>'
            + '</div>';
    $("#contenedorCausas").append(campos);
}

function eliminarCausas(idCausa) {
    $("#contenedorCausas" + idCausa).remove();
}

function clickButtonSubmit(form) {
    var form = $('#form' + form);
    form.validate();
//    console.log(form)
}