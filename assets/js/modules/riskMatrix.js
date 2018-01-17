var modeloControles = $('<select class="form-control m-r-0" data-combox="6" '
        + 'id="cmbControles" name="controles[]" >'
        + '<option value="">Seleccione</option>'
        + '</select>');
var contControles = 0;
var contCausas = 0;
var vista = {
    causasForDelete: [],
    controlsForDelete: [],
    init: function () {
        vista.evetns();
        vista.configView();
        vista.get();
    },
    evetns: function () {
        $("div.bhoechie-tab-menu>div.list-group>a").on('click', vista.onClickTab);
        $('form').on('submit', vista.onSubmitForm);
        $('#cmbTipoEventoNivel1').on('change', vista.onChangeCmbTipoEventoNivel1);
        $('#form3').on('click', '.btn-add-causa', vista.onClickAddCausa);
        $('#form3').on('click', '.btn-remove-causa', vista.onClickRemoveCausa);
        $('#form3').on('click', '.btn-add-control', vista.onClickAddControl);
        $('#form3').on('click', '.btn-remove-control', vista.onClickRemoveControl);
        $('.select-severidad').on('change', vista.onChangeSelectSeveridad);
        $('#tiposDeActividad').on('click', '.btn-add-actividad', vista.onClickBtnAddActividad);
        $('#tiposDeActividad').on('click', '.btn-remove-actividad', vista.onClickBtnRemoveActividad);
        $('#cmbPlataforma').on('change', vista.onChangeCmbPlataforma);
        $('.list-group-item').on('click', function () {
            $('#cmbPlataforma').trigger('change');
        });
    },
    onChangeCmbPlataforma: function () {
        $('.txt-plataforma').val($('#cmbPlataforma option:selected').text());
    },
    onClickBtnAddActividad: function () {
        vista.addTipoActividad().select2({width: '100%'});
    },
    onClickBtnRemoveActividad: function () {
        var btn = $(this);
        var parent = btn.parents('.group-tipo-actividad');
        if ($('.group-tipo-actividad').length > 1) {
            parent.remove();
            var groups = $('.group-tipo-actividad');
            for (var i = 0; i < groups.length; i++) {
                var group = $(groups[i]);
                group.find('label').html('Tipo de Actividad [' + (i + 1) + ']');
            }
        } else {
            parent.find('Tipo de Actividad [1]');
        }
    },
    addTipoActividad: function (value) {
        var num = ((num = $('.group-tipo-actividad').length + 1) > 0) ? ' [' + num + ']' : '';
        var target = (value) ? 'data-target="' + value + '"' : '';
        var html = '<div class="form-group group-tipo-actividad" ' + target + '>'
                + '<label for="txtTipoActividad" class="col-sm-2 control-label">Tipo de Actividad' + num + '</label>'
                + '<div class="col-sm-10"><div class="input-group">'
                + '<select class="form-control" name="riesgo_especifico.n_tipo_activad[]">'
                + '<option value="">Seleccione</option>'
                + '<option value="OT" ' + ((value == "OT") ? 'selected="true"' : '') + '>OT</option>'
                + '<option value="MANTENIMIENTO" ' + ((value == "MANTENIMIENTO") ? 'selected="selected"' : '') + '>MANTENIMIENTO</option>'
                + '<option value="INCIDENCIAS/EVENTOS" ' + ((value == "INCIDENCIAS/EVENTOS") ? 'selected="selected"' : '') + '>INCIDENCIAS/EVENTOS</option>'
                + '<option value="FACTURACIÓN" ' + ((value == "FACTURACIÓN") ? 'selected="selected"' : '') + '>FACTURACIÓN</option>'
                + '<option value="APROVISIONAMIENTO" ' + ((value == "APROVISIONAMIENTO") ? 'selected="selected"' : '') + '>APROVISIONAMIENTO</option>'
                + '</select>'
                + '<div class="input-group-btn">'
                + '<button type="button" class="btn-add-actividad btn btn-primary" title="Agregar" >'
                + '<i class="fa fa-fw fa-plus"></i></button>'
                + '<button type="button" class="btn-remove-actividad btn btn-danger" title="Eliminar" >'
                + '<i class="fa fa-fw fa-minus"></i></button>'
                + '</div>'
                + '</div></div>'
                + '</div>';
        var select = $(html);
        $('#tiposDeActividad').append(select);
        return select.find('select');
    },
    onChangeSelectSeveridad: function () {
        if ($('.select-severidad#cmbProbabilidad').val().trim() != "" && $('.select-severidad#cmbImpacto').val().trim() != "") {
            app.post('Utils/getSeveridad', {
                idProbabilidad: $('#cmbProbabilidad').val(),
                idImpacto: $('#cmbImpacto').val()
            })
                    .success(function (response) {
                        if (response.code > 0) {
                            var input = $('#txtSeveridadRiesgoInherente');
                            input.val(response.data.n_calificacion);
                            input.css('background-color', response.data.n_color);
                            input.css('color', response.data.n_text_color);
                        } else {
                            $('#txtSeveridadRiesgoInherente').val("DESCONOCIDO");
                        }
                    })
                    .error(function () {
                        $('#txtSeveridadRiesgoInherente').val("ERROR INESPERADO");
                    })
                    .send();
        }
    },
    get: function () {
        var id = app.getParamURL('id');
        if (id) {
            if (!dataForm.record) {
                swal("Registro no existe", "Lo sentimos, el registro actual no existe o se ha eliminado.", "warning");
            }
            var formGlobal = $('#formsRisk');
            var data = dataForm.record;
            if (data) {
                formGlobal.attr('data-mode', "FOR_UPDATE");
                formGlobal.fillForm(data);
                formGlobal.find('#cmbSoporteImpacto1').attr('data-value', data["soporte_impacto[]"][0]);
                formGlobal.find('#cmbSoporteImpacto2').attr('data-value', data["soporte_impacto[]"][1]);
                formGlobal.find('button:submit').html('<i class="fa fa-fw fa-save"></i> Actualizar');
                vista.listCausas(data.causas);
                try {
                    var args = dataForm.record.riesgo_especifico.n_tipo_activad;
                    if (args) {
                        var tiposActividad = JSON.parse(args);
                        if (tiposActividad.length) {
                            for (var i = 0; i < tiposActividad.length; i++) {
                                vista.addTipoActividad(tiposActividad[i]).select2({width: '100%'});
                            }
                        }
                    }
                } catch (e) {
                    console.error(e);
                }
            }
        } else {
            vista.addTipoActividad().select2({width: '100%'});
            $('select').select2({width: '100%'});
        }
    },
    listCausas: function (causas) {
        if (Array.isArray(causas)) {
            for (var i = 0; i < causas.length; i++) {
                var causa = causas[i];
                vista.addCausa(causa);
            }
        }
    },
    onClickAddCausa: function () {
        vista.addCausa();
    },
    onClickRemoveCausa: function () {
        var btn = $(this);
        var causaItem = btn.parents('.item-causa');
        if (causaItem.attr('data-id')) {
            var obj = {
                idRecord: causaItem.attr('data-id')
            };
            vista.causasForDelete.push(obj);
        }
        causaItem.remove();
        if ($('.causa-added').length == 0) {
            $('#form3').find('button:submit').addClass('hidden');
            $('#btnAddCausa').removeClass('hidden');
        }
    },
    onClickAddControl: function () {
        var btn = $(this);
        var contentControl = btn.parents('.body-causa');
        vista.addControl(contentControl);
    },
    addControl: function (contentControl, control) {
        var model = $('#controlIndex');
        var run = function () {
            var clon = model.clone();
            contentControl.append(clon);
            clon.find('#numControl').html(contentControl.find('.item-control').length);
            var selects = clon.find('select');
            selects.attr('class', 'form-control input-sm cmb-control');
            selects.removeAttr('tabindex');
            selects.removeAttr('aria-hidden');
            selects.next('.select2').remove();
            selects.select2({width: '100%'});
            if (control) {
                clon.find('select:eq(0)').attr('data-id', control.k_id_control_especifico);
                dom.fillCombo(clon.find('select:eq(0)'), control.k_id_control);
                dom.fillCombo(clon.find('select:eq(1)'), control.k_id_factor_riesgo);
            }
        };
        if (model.find('option').length > 2) {
            run();
        } else {
            var interval = window.setTimeout(function () {
                vista.addControl(contentControl, control);
                clearInterval(interval);
            }, 100);
        }
    },
    onClickRemoveControl: function () {
        var btn = $(this);
        var controlItem = btn.parents('.item-control');
        if (controlItem.find('select:eq(0)').attr('data-id')) {
            var obj = {
                idRecord: controlItem.find('select:eq(0)').attr('data-id')
            };
            vista.controlsForDelete.push(obj);
        }
        controlItem.remove();
    },
    addCausa: function (causa) {
        var model = $('#itemCausaIndex');
        var clon = model.clone();
        clon.removeAttr('id').removeClass('hidden').addClass('causa-added');
        //Jugamos con los select de los controles...
        var select = clon.find('select:eq(0)');
        select.attr('class', 'form-control input-sm notDisabled cmb-control');
        select.removeAttr('tabindex');
        select.removeAttr('aria-hidden');
        select.html(model.find('select:eq(0)').html());
        select.next('.select2').remove();
        select.select2({'width': '100%'});
        var select2 = clon.find('select:eq(1)');
        select2.attr('class', 'form-control input-sm notDisabled cmb-factor-riesgo');
        select2.removeAttr('tabindex');
        select2.removeAttr('aria-hidden');
        select2.html(model.find('select:eq(1)').html());
        select2.next('.select2').remove();
        select2.select2({'width': '100%'});
        $('#contentCausas').append(clon);
        clon.find('#numCausa').html($('.causa-added').length);
        clon.find('input:eq(0)').focus();
        $('#form3').find('button:submit').removeClass('hidden');
        $('#btnAddCausa').addClass('hidden');
        if (causa) {
            clon.find('input:eq(0)').val(causa.n_nombre);
            clon.attr('data-id', causa.k_id_causa);
            //Recorremos los controles...
            for (var i = 0; i < causa.controls.length; i++) {
                var control = causa.controls[i];
                clon.find('.body-causa').html('');
                vista.addControl(clon.find('.body-causa'), control);
            }
        }
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

        var obj = new Object();
        __mergeObj(obj, form1.getFormData());
        __mergeObj(obj, form2.getFormData());
        obj.causas = [];
        var confirmar = false;
        if (vista.causasForDelete.length > 0) {
            confirmar = true;
            obj.causasForDelete = vista.causasForDelete;
        }
        if (vista.controlsForDelete.length > 0) {
            confirmar = true;
            obj.controlsForDelete = vista.controlsForDelete;
        }

        var start = function (obj) {
            //Buscamos las causas agregadas...
            var causasAdded = $('#form3').find('.causa-added');
            for (var i = 0; i < causasAdded.length; i++) {
                var causaItem = $(causasAdded[i]);
                //Buscamos los controles dentro de esa causa...
                var controlsItems = causaItem.find('.content-control');
                var controls = [];
                for (var j = 0; j < controlsItems.length; j++) {
                    var controlItem = $(controlsItems[j]);
                    if (controlItem.find('select:eq(0)').val().trim() != "" && controlItem.find('select:eq(1)').val().trim() != "") {
                        var ctrl = {
                            id: controlItem.find('select:eq(0)').val(),
                            factorRiesgo: controlItem.find('select:eq(1)').val()
                        }
                        if (controlItem.find('select:eq(0)').attr('data-id')) {
                            ctrl.idRecord = controlItem.find('select:eq(0)').attr('data-id');
                        }
                        controls.push(ctrl);
                    }
                }
                if (causaItem.find('input:eq(0)').val().trim("") != "") {
                    var causaObj = {
                        text: causaItem.find('input:eq(0)').val(),
                        controls: controls,
                    };
                    if (causaItem.attr('data-id')) {
                        causaObj.idRecord = causaItem.attr('data-id');
                    }
                    obj.causas.push(causaObj);
                }
            }
            var formGlobal = $('#formsRisk');
            formGlobal.find('input, textarea, button, fieldset, select:not(.notDisabled)').prop('disabled', true);
            var uri = formGlobal.attr('data-action');
            var forUpdate = false;
            if (formGlobal.attr('data-mode') === "FOR_UPDATE") {
                uri = formGlobal.attr('data-action-update');
                obj.idRecord = $('#idRecord').val();
                forUpdate = true;
            }

            obj.riesgo_especifico.n_tipo_activad = JSON.stringify(obj.riesgo_especifico["n_tipo_activad[]"]);

            //Se hace la petición AJAX y se envia el objeto completo con toda la información de los tres formularios para ser procesada...
            console.log(obj);
            obj.soporte_impacto = obj["soporte_impacto[]"];
            delete obj["soporte_impacto[]"];
            app.post(uri, obj)
                    .complete(function () {
                        formGlobal.find('input, textarea, button, fieldset, select').prop('disabled', false);
                    })
                    .success(function (response) {
                        var v = app.validResponse(response);
                        if (v) {
                            swal((forUpdate ? "Actualizado" : "Guardado"), (forUpdate ? "Se ha actualizado correctamente el registro." : "Se ha guardado correctamente el registro."), "success");
                            if (!forUpdate) {
                                $('#idRecord').val(response.data);
                            }
                            formGlobal.attr('data-mode', 'FOR_UPDATE');
                            form.find('button:submit').html('<i class="fa fa-fw fa-save"></i> Actualizar');
                        } else {
                            swal((forUpdate ? "Error al actualizar" : "Error al guardar"), (forUpdate ? "Se ha producido un error al intentar actualizar el registro." : "Se ha producido un error al intentar guardar el registro."), "warning");
                        }
                    })
                    .error(function () {
                        swal("Error inesperado", "Lo sentimos, se ha producido un error inesperado.", "error");
                    }).send();
        };
        if (confirmar) {
            swal({
                title: 'Confirmación',
                text: "Se eliminarán algunas causas y/o controles, ¿está seguro?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then(function (result) {
                if (result.value) {
                    start(obj);
                } else {
                    swal({
                        title: "Cancelado",
                        text: "Se han cancelado los cambios.",
                        type: "warning"
                    }).then(function () {
                        location.reload();
                    });
                }
            });
        } else {
            start(obj);
        }
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
        }
        $('.cmb-control').prop('disabled', false).trigger('selectfilled');
        $('.cmb-factor-riesgo').prop('disabled', false).trigger('selectfilled');
    },
    configView: function () {
        dom.llenarCombo($('#cmbPlataforma'), dataForm.plataforma, {text: "text", value: "value"});
        dom.llenarCombo($('#cmbRiesgoId'), dataForm.riesgos, {text: "text", value: "value"});
        dom.llenarCombo($('#cmbTipoEventoNivel1'), dataForm.tipo_evento1, {text: "text", value: "value"});
        if (dataForm.tipo_evento2) {
            dom.llenarCombo($('#cmbTipoEventoNivel2'), dataForm.tipo_evento2, {text: "text", value: "value"});
        }
        dom.llenarCombo($('#cmbProbabilidad'), dataForm.probabilidad, {text: "text", value: "value"});
        dom.llenarCombo($('#cmbImpacto'), dataForm.impacto, {text: "text", value: "value"});
        dom.llenarCombo($('#cmbFactorRiesgo'), dataForm.factoresriesgo, {text: "text", value: "value"});
        dom.llenarCombo($('#cmbCodControl'), dataForm.listcontrols, {text: "text", value: "value"});
        dom.llenarCombo($('#cmbZonasGeograficas'), dataForm.zonas_geograficas, {text: "text", value: "value"});
        $('select:not(.notDisabled)').select2({width: '100%'});
    }
};
$(document).ready(function () {
    vista.init();
});
function cambiarSoporteImpacto() {
    var impacto = $('#cmbImpacto').val();
    var option = '';
    if (impacto === '5') {
        option = '<option value="">Seleccione</option>'
                + '<option value="1.1  CONTROL: La estructura de control es adecuada">1.1  CONTROL: La estructura de control es adecuada</option>'
                + '<option value="1.2 OPERACIONAL: No hay interrupción de las operaciones">1.2 OPERACIONAL: No hay interrupción de las operaciones</option>'
                + '<option value="1.3 CUMPLIMIENTO: No genera sanciones económicas y/o administrativas">1.3 CUMPLIMIENTO: No genera sanciones económicas y/o administrativas</option>'
                + '<option value="1.4 REPUTACIONAL: No afecta las relaciones con los clientes">1.4 REPUTACIONAL: No afecta las relaciones con los clientes</option>'
                + '<option value="1.5 INFORMACIÓN: No afecta la oportunidad de la información">1.5 INFORMACIÓN: No afecta la oportunidad de la información</option>';
    }
    if (impacto === '4') {
        option = '<option value="">Seleccione</option>'
                + '<option value="2.1 CONTROL: La estructura de control actual es susceptible de mejoras.">2.1 CONTROL: La estructura de control actual es susceptible de mejoras.</option>'
                + '<option value="2.2 OPERACIONAL: Interrupción de las operaciones por 1 hora.">2.2 OPERACIONAL: Interrupción de las operaciones por 1 hora.</option>'
                + '<option value="2.3 REPUTACIONAL: Existen algunos reclamaciones por parte de los clientes, accionistas, proveedores pero no se afecta la continuidad de la relación">2.3 REPUTACIONAL: Existen algunos reclamaciones por parte de los clientes, accionistas, proveedores pero no se afecta la continuidad de la relación</option>';
    }
    if (impacto === '3') {
        option = '<option value="">Seleccione</option>'
                + '<option value="3.1 CONTROL: Existen algunos controles pero no son los suficientes.">3.1 CONTROL: Existen algunos controles pero no son los suficientes.</option>'
                + '<option value="3.2 OPERACIONAL: Interrupción de las operaciones de 2 a 4 horas">3.2 OPERACIONAL: Interrupción de las operaciones de 2 a 4 horas</option>'
                + '<option value="3.3 REPUTACIONAL: Reclamaciones de clientes, accionistas, proveedores que requieren de un plan de acción de corto plazo">3.3 REPUTACIONAL: Reclamaciones de clientes, accionistas, proveedores que requieren de un plan de acción de corto plazo</option>'
                + '<option value="3.4 OPERACIONAL: Reproceso de actividades y aumento de la carga operativa">3.4 OPERACIONAL: Reproceso de actividades y aumento de la carga operativa</option>';
    }
    if (impacto === '2') {
        option = '<option value="">Seleccione</option>'
                + '<option value="4.1 CONTROL: Estructura de control débil">4.1 CONTROL: Estructura de control débil</option>'
                + '<option value="4.2 OPERACIONAL: Interrupción de las operaciones de 4 a 6 horas">4.2 OPERACIONAL: Interrupción de las operaciones de 4 a 6 horas</option>'
                + '<option value="4.3 CUMPLIMIENTO: Observaciones por incumplimiento de las normas establecidas por los entes reguladores que generen un plan de acción a corto plazo">4.3 CUMPLIMIENTO: Observaciones por incumplimiento de las normas establecidas por los entes reguladores que generen un plan de acción a corto plazo</option>'
                + '<option value="4.4 REPUTACIONAL: Afectación de la imagen en el mercado por atención ineficaz o inoportuna.">4.4 REPUTACIONAL: Afectación de la imagen en el mercado por atención ineficaz o inoportuna.</option>'
                + '<option value="4.5 INFORMACIÓN: Inoportunidad de la información ocasionando retrasos en las labores de las áreas, respuesta a los entes reguladores y a los clientes">4.5 INFORMACIÓN: Inoportunidad de la información ocasionando retrasos en las labores de las áreas, respuesta a los entes reguladores y a los clientes</option>';
    }
    if (impacto === '1') {
        option = '<option value="">Seleccione</option>'
                + '<option value="5.1 CONTROL: No existe estructura de control">5.1 CONTROL: No existe estructura de control</option>'
                + '<option value="5.2 OPERACIONAL: Interrupción de las operaciones por más de 6 horas.">5.2 OPERACIONAL: Interrupción de las operaciones por más de 6 horas.</option>'
                + '<option value="5.3 CUMPLIMIENTO:Sanciones económicas por incumplimiento de las normas establecidas por los entes reguladores">5.3 CUMPLIMIENTO:Sanciones económicas por incumplimiento de las normas establecidas por los entes reguladores</option>'
                + '<option value="5.4 REPUTACIONAL: Imagen negativa en el mercado por mal servicio">5.4 REPUTACIONAL: Imagen negativa en el mercado por mal servicio</option>'
                + '<option value="5.5  INFORMACIÓN: Perdida de información crítica de la organización">5.5  INFORMACIÓN: Perdida de información crítica de la organización</option>';
    }

    $('#cmbSoporteImpacto1').empty();
    $('#cmbSoporteImpacto2').empty();
    $('#cmbSoporteImpacto1').append(option);
    $('#cmbSoporteImpacto2').append(option);
    var cmbSoporte1 = $('#cmbSoporteImpacto1');
    var cmbSoporte2 = $('#cmbSoporteImpacto2');
    cmbSoporte1.on('selectfilled', function () {
        if (cmbSoporte1.attr('data-value')) {
            cmbSoporte1.val(cmbSoporte1.attr('data-value')).trigger('change.select2');
            //        cmbSoporte1.removeAttr('data-value');
        }
    });
    cmbSoporte2.on('selectfilled', function () {
        if (cmbSoporte2.attr('data-value')) {
            cmbSoporte2.val(cmbSoporte2.attr('data-value')).trigger('change.select2');
            //        cmbSoporte1.removeAttr('data-value');
        }
    });
    window.setTimeout(function () {
        cmbSoporte1.trigger('selectfilled');
        cmbSoporte2.trigger('selectfilled');
    }, 15);
}

function cambiarSoporteProbabilidad() {
    var probabilidad = $('#cmbProbabilidad').val();
    var option = '';
    if (probabilidad === '5') {
        option = '<option value="">Seleccione</option>'
                + '<option value="1. Eventualidad que no es probable o es muy poco probable (una vez al año).">1. Eventualidad que no es probable o es muy poco probable (una vez al año).</option>';
    }
    if (probabilidad === '4') {
        option = '<option value="">Seleccione</option>'
                + '<option value="2. Eventualidad poco común  o relativa frecuencia (dos veces al año).">2. Eventualidad poco común  o relativa frecuencia (dos veces al año).</option>';
    }
    if (probabilidad === '3') {
        option = '<option value="">Seleccione</option>'
                + '<option value="3. Puede ocurrir en algún momento. Eventualidad con frecuencia moderada. (doce veces al año)">3. Puede ocurrir en algún momento. Eventualidad con frecuencia moderada. (doce veces al año)</option>';
    }
    if (probabilidad === '2') {
        option = '<option value="">Seleccione</option>'
                + '<option value="4. Hay buenas razones para creer que se verificará o sucederá el riesgo en muchas circunstancias. Eventualidad de frecuencia alta. (cuarenta y ocho  veces al año)">4. Hay buenas razones para creer que se verificará o sucederá el riesgo en muchas circunstancias. Eventualidad de frecuencia alta. (cuarenta y ocho  veces al año)</option>';
    }
    if (probabilidad === '1') {
        option = '<option value="">Seleccione</option>'
                + '<option value="5. Se espera que el riesgo ocurra en l<a mayoría de las circunstancias. Eventualidad frecuente. (Trescientos sesenta y cinco veces al año)">5. Se espera que el riesgo ocurra en la mayoría de las circunstancias. Eventualidad frecuente. (Trescientos sesenta y cinco veces al año)</option>';
    }

    $('#cmbSoporteProbabilidad').empty();
    $('#cmbSoporteProbabilidad').append(option);
    $('#cmbSoporteProbabilidad').trigger('selectfilled');
}
