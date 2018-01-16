var vista = {
    init: function () {
        vista.events();
        vista.get();
    },
    events: function () {
        dom.submit($('#formTratamiento'), function () {
            location.href = app.urlTo('Matriz/listTratamiento');
        });
    },
    get: function () {
        dom.llenarCombo($('#cmbRiesgos'), formData.riesgos, {text: "text", value: "value"});
        $('select').select2({width: '100%'});
        var form = $('#formTratamiento');
        form.fillForm(formData.record.riesgo_especifico);
        form.find('#k_id_riesgo_especifico').val(formData.record.riesgo_especifico.k_id_riesgo_especifico);
        form.find('#txtDescripcionRiesgo').val(formData.record.riesgo.n_riesgo_descripcion);
        if (formData.record.riesgo_inherente) {
            form.find('#txtRiesgoInherente').val(formData.record.riesgo_inherente.n_calificacion);
            form.find('#txtRiesgoInherente').css('background', formData.record.riesgo_inherente.n_color);
            form.find('#txtRiesgoInherente').css('color', formData.record.riesgo_inherente.n_text_color);
        } else {
            form.find('#txtRiesgoInherente').val("Indefinido");
        }
        if (formData.record.riesgo_residual) {
            form.find('#txtRiesgoResidual').val(formData.record.riesgo_residual.n_calificacion);
            form.find('#txtRiesgoResidual').css('background', formData.record.riesgo_residual.n_color);
            form.find('#txtRiesgoResidual').css('color', formData.record.riesgo_residual.n_text_color);
        } else {
            form.find('#txtRiesgoResidual').val("Indefinido");
        }
        form.find('#k_id_probabilidad_riesgo_residual').val(formData.record.cmpl_riesgo_residual.k_id_probabilidad);
        form.find('#k_id_impacto_riesgo_residual').val(formData.record.cmpl_riesgo_residual.k_id_impacto);
    }
};

$(vista.init);