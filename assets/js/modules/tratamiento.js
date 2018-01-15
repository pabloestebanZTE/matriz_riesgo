var vista = {
    init: function () {
        vista.events();
        vista.get();
    },
    events: function () {

    },
    get: function () {
        dom.llenarCombo($('#cmbRiesgos'), formData.riesgos, {text: "text", value: "value"});
        $('select').select2({width: '100%'});
    }
};

$(vista.init);