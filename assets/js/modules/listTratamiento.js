/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var vista = {
    init: function () {
        vista.events();
        vista.listRisk();
        $('#cmbPlataformas').on('selectfilled', function () {
            vista.listRisk();
        });
    },
    events: function () {
        dom.submit($('#formTratamiento'), function () {
            location.href = app.urlTo('Matriz/listTratamiento');
        });

        $('#cmbPlataformas').on('change', function () {
            vista.listRisk();
        });
    },
    listRisk: function () {
        $('#cmbPlataformas').find('option:eq(1)').prop('selected', true).trigger('change.select2');
        app.post('Risk/listRiskByIdPlataform', {
            id: $('#cmbPlataformas').val()
        })
                .success(function (response) {
                    console.log(response);
                    var data = app.parseResponse(response);
                    var cmb = $('#cmbRiesgos');
                    if (data) {
                        dom.llenarCombo(cmb, data, {text: "nombre_riesgo", value: "k_id_riesgo"});
                        cmb.on('selectfilled', vista.listMatrices);
                    } else {
                        dom.comboVacio(cmb);
                    }
                })
                .error(function (e) {
                    console.error(e);
                    swal("Error", "Se ha producido un error inesperado y no se pudo consultar los riesgos", "error");
                })
                .send();
    },
    listMatrices: function () {
        var cmb = $('#cmbRiesgos');
        if (cmb.val().trim() == "" && cmb.find('option').length > 1) {
            cmb.find('option:eq(1)').prop('selected', true);
            cmb.trigger('change.select2');
        }
        app.post('Risk/getListMatricesByRisk', {
            idRisk: cmb.val()
        })
                .success(function (response) {
                    var data = app.parseResponse(response);
                    if (data) {
                        vista.fillTable(data);
                    } else {
                        vista.fillTable([]);
                    }
                })
                .error(function (e) {
                    console.error(e);
                })
                .send();
    },
    fillTable: function (data) {
        if (vista.tablaTratamiento) {
            dom.refreshTable(vista.tablaTratamiento, data);
            return;
        }
        vista.tablaTratamiento = $('#tablaTratamiento').DataTable(dom.configTable(data,
                [
                    {title: "Plataforma", data: "k_id_plataforma.n_nombre"},
                    {title: "Zona Geográfica", data: "k_id_zona_geografica.n_nombre"},
                    {title: "Macro proceso", data: "n_macro_proceso"},
                    {title: "Objetivo", data: "n_objetivo"},
                    {title: "Responsable", data: "n_responsable"},
                    {title: "Riesgo", data: "k_id_riesgo.n_riesgo"},
                    {title: "Probabilidad", data: "k_id_probabilidad.n_descripcion"},
                    {title: "Tipo evento 2", data: "k_id_tipo_evento_2.n_descripcion", visible: false},
                    {title: "Impacto", data: "k_id_impacto.n_descripcion"},
                    {title: "Severidad del Riesgo Inherente", data: "n_severidad_riesgo_inherente"},
                    {title: "Opciones", data: vista.getButtons}
                ],
                ));
    },
    getButtons: function (obj) {
        return '<a href="' + app.urlTo('Matriz/tratamiento?id=' + obj.k_id_riesgo_especifico) + '" class="btn btn-default btn-xs"><i class="fa fa-fw fa-check-square"></i></a>'
                + '<a href="' + app.urlTo('Matriz/riskTratamientos?id=' + obj.k_id_riesgo_especifico) + '" class="btn btn-default btn-xs"><i class="fa fa-fw fa-list"></i></a>';
    }
};

$(vista.init);