$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.listActivities();
        },
        //Eventos de la ventana.
        events: function () {

        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listActivities: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('Risk/listAllRisk')
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
                    + '<a href="' + app.urlTo('Matriz/riskMatrixView?id=' + obj.k_id_riesgo_especifico) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar Riesgo"><span class="fa fa-fw fa-pencil-square-o"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (ini.tablaPrincipal) {
                dom.refreshTable(ini.tablaPrincipal, data);
                return;
            }
            ini.tablaPrincipal = $('#tablaPrincipal').DataTable(dom.configTable(data,
                    [
                        {title: "Zona Geográfica", data: "k_id_zona_geografica.n_nombre"},
                        {title: "Macro proceso", data: "n_macro_proceso"},
                        {title: "Objetivo", data: "n_objetivo"},
                        {title: "Responsable", data: "n_responsable"},
                        {title: "Riesgo", data: "k_id_riesgo.n_riesgo"},
                        {title: "Probabilidad", data: "k_id_probabilidad.n_descripcion"},
                        {title: "Impacto", data: "k_id_impacto.n_descripcion"},
                        {title: "Severidad del Riesgo Inherente", data: "n_severidad_riesgo_inherente"},
                        {title: "Opciones", data: ini.getButtons}
                    ],
                    ));
        }
    };

    ini.init();
});
