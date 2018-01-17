$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.configView();
        },
        //Eventos de la ventana.
        events: function () {
            $('#cmbPlataformas').on('change', ini.onChangeCmbPlataformas);
            $('#cmbPlataformas').on('selectfilled', function () {
                $('#cmbPlataformas option:eq(1)').prop('selected', true);
                $('#cmbPlataformas').trigger('change.select2');
                ini.listRisks();
            });
        },
        onChangeCmbPlataformas: function () {
            ini.listRisks();
        },
        configView: function () {
            //Listamos las plataformas...
            plataformas.push({"k_id_plataforma": "-1", "n_nombre": "Todos"});
            dom.llenarCombo($('#cmbPlataformas'), plataformas, {text: "n_nombre", value: "k_id_plataforma"});
        }, /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listRisks: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('Risk/getALLRisks', {idPlataforma: $('#cmbPlataformas').val()})
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        console.log(response);
                        if (app.successResponse(response)) {
                            ini.fillTable(response.data);
                        } else {
                            ini.fillTable([]);
                        }
                    }).error(function (e) {
                console.error(e);
            }).send();
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        getButtons: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('Risk/findRiskById?idRiesgo=' + obj.k_id_riesgo) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar Control"><span class="fa fa-fw fa-pencil-square-o"></span></a>'
                    + '<a href="' + app.urlTo('Risk/duplicarRiesgo?idRiesgo=' + obj.k_id_riesgo) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Duplicar"><span class="fa fa-fw fa-copy"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (ini.tablaPrincipal) {
                dom.refreshTable(ini.tablaPrincipal, data);
                return;
            }
            ini.tablaPrincipal = $('#tablaPrincipal').DataTable(dom.configTable(data,
                    [
                        {title: "ID", data: "nombre_riesgo"},
                        {title: "Riesgo", data: "n_riesgo"},
                        {title: "Descripción del Riesgo", data: "n_riesgo_descripcion"},
                        {title: "Responsable Riesgo", data: "n_responsable"},
                        {title: "Opciones", data: ini.getButtons},
                    ],
                    ));
        }
    };
    ini.init();
});
