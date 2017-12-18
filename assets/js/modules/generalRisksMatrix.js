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
            app.post('TicketOnair/ticketUser')
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
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar Riesgo"><span class="fa fa-fw fa-pencil-square-o"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (ini.tablaPrincipal) {
                dom.refreshTable(ini.tablaPrincipal, data);
                return;
            }
            ini.tablaPrincipal = $('#tablaPrincipal').DataTable(dom.configTable(data,
                    [
                        {title: "Zona Geográfica", data: ini.fillNA},
                        {title: "Macro proceso", data: ini.fillNA},
                        {title: "SubEstado", data: ini.fillNA},
                        {title: "Objetivo", data: ini.fillNA},
                        {title: "Responsable", data: ini.fillNA},
                        {title: "Riesgo", data: ini.fillNA},
                        {title: "Probabilidad", data: ini.fillNA},
                        {title: "Impacto", data: ini.fillNA},
                        {title: "Severidad del Riesgo Inherente", data: ini.fillNA},
                        {title: "Opciones", data: ini.getButtons},
                    ],
                    ));
        }
    };

    ini.init();
});
