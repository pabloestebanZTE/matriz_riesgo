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
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar Control"><span class="fa fa-fw fa-pencil-square-o"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (ini.tablaPrincipal) {
                dom.refreshTable(ini.tablaPrincipal, data);
                return;
            }
            ini.tablaPrincipal = $('#tablaPrincipal').DataTable(dom.configTable(data,
                    [
                        {title: "ID", data: ini.fillNA},
                        {title: "Descripción del Control", data: ini.fillNA},
                        {title: "Asignación", data: ini.fillNA},
                        {title: "Cargo", data: ini.fillNA},
                        {title: "Tipo de control", data: ini.fillNA},
                        {title: "Funcionalidad tipo de control", data: ini.fillNA},
                        {title: "Naturaleza del Control", data: ini.fillNA},
                        {title: "Periodicidad del control", data: ini.fillNA},
                        {title: "Funcionalidad Frecuencia del Control", data: ini.fillNA},
                        {title: "Opciones", data: ini.getButtons},
                    ],
                    ));
        }
    };

    ini.init();
});
