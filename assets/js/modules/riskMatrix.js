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
        vista.addCausa();
    },
    onClickRemoveCausa: function () {
        var btn = $(this);
        btn.parents('.item-causa').remove();
        if ($('.causa-added').length == 0) {
            $('#form3').find('button:submit').addClass('hidden');
            $('#btnAddCausa').removeClass('hidden');
        }
    },
    onClickAddControl: function () {
        var btn = $(this);
        var contentControl = btn.parents('.body-causa');
        var model = $('#controlIndex');
        var clon = model.clone();
        contentControl.append(clon);
        clon.find('#numControl').html(contentControl.find('.item-control').length);
    },
    onClickRemoveControl: function () {
        var btn = $(this);
        btn.parents('.item-control').remove();
    },
    addCausa: function () {
        var model = $('#itemCausaIndex');
        var clon = model.clone();
        clon.removeAttr('id').removeClass('hidden').addClass('causa-added');
        //Jugamos con los select de los controles...
        var select = clon.find('select:eq(0)');
        select.attr('class', 'form-control');
        select.removeAttr('tabindex');
        select.removeAttr('aria-hidden');
        select.html(model.find('select:eq(0)').html());
        select.next().remove();
        select.select2({'width': '100%'});
        var select2 = clon.find('select:eq(1)');
        select2.attr('class', 'form-control');
        select2.removeAttr('tabindex');
        select2.removeAttr('aria-hidden');
        select2.html(model.find('select:eq(1)').html());
        select2.next().remove();
        select2.select2({'width': '100%'});
        $('#contentCausas').append(clon);
        clon.find('#numCausa').html($('.causa-added').length);
        clon.find('input:eq(0)').focus();
        $('#form3').find('button:submit').removeClass('hidden');
        $('#btnAddCausa').addClass('hidden');
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
//        var form3 = $('#form3');

        var obj = new Object();
        __mergeObj(obj, form1.getFormData());
        __mergeObj(obj, form2.getFormData());

        obj.causas = [];

        //Buscamos las causas agregadas...
        var causasAdded = $('#form3').find('.causa-added');
        for (var i = 0; i < causasAdded.length; i++) {
            var causaItem = $(causasAdded[i]);
            //Buscamos los controles dentro de esa causa...
            var controlsItems = causaItem.find('.content-control');
            var controls = [];
            for (var j = 0; j < controlsItems.length; j++) {
                var controlItem = $(controlsItems[i]);
                if (controlItem.find('select:eq(0)').val().trim() != "" && controlItem.find('select:eq(1)').val().trim() != "") {
                    controls.push({
                        id: controlItem.find('select:eq(0)').val(),
                        factorRiesgo: controlItem.find('select:eq(1)').val()
                    });
                }
            }
            if (causaItem.find('input:eq(0)').val().trim("") != "") {
                obj.causas.push({
                    text: causaItem.find('input:eq(0)').val(),
                    controls: controls
                });
            }
        }
        var formGlobal = $('#formsRisk');
        formGlobal.find('input, textarea, button, fieldset').prop('disabled', true);
        var uri = formGlobal.attr('data-action');
        var forUpdate = false;
        if (formGlobal.attr('data-mode') === "FOR_UPDATE") {
            uri = formGlobal.attr('data-action-update');
            obj.idRecord = $('#idRecord').val();
            forUpdate = true;
        }

        //Se hace la petición AJAX y se envia el objeto completo con toda la información de los tres formularios para ser procesada...
        app.post(uri, obj)
                .complete(function () {
                    formGlobal.find('input, textarea, button, fieldset').prop('disabled', false);
                })
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

        console.log(obj);
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