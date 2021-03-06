$(function () {
    vista = {
        timers: [],
        init: function () {
            vista.events();
            vista.listActivities();
        },
        //Eventos de la ventana.
        events: function () {
            $('#tab1default').on('click', '.btn-preview', vista.onClickPreviewBtn);
        },
        onClickPreviewBtn: function () {
            console.log("Click preview");
            var btn = $(this);
            var tr = btn.parents('tr');
            if (!vista.tablaAsignados) {
                return;
            }
            console.log("TR", tr);
            var record = vista.tablaPendientes.row(tr).data();
            console.log(tr, record);
            $('#formDetallesBasicos').fillForm(record);
            $('#modalPreview').modal('show');
        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listActivities: function () {
            //Invoca fillTable para configurar la TABLA.
            // principal.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('Precheck/getListPrecheckCoordinador')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        if (app.successResponse(response)) {
                            vista.fillTablePending(response.data.pendingList);
                            vista.fillTableAssing(response.data.assingList);
                        } else {
                            vista.fillTable([]);
                        }
                    }).error(function (e) {
                console.error(e);
            }).send();
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        getButtonsPending: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="javascript:;" class="btn btn-default btn-xs btn-preview" data-toggle="tooltip" title="Vista previa"><span class="fa fa-fw fa-eye"></span></a>'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ir al Detalle"><span class="fa fa-fw fa-search"></span></a>'
                    + '<a href="' + app.urlTo('User/assignEngineer?idOnair=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Asignar"><span class="fa fa-fw fa-tag"></span></a>'
                    + '</div>';
        },
        getButtonsAssing: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Detalle"><span class="fa fa-fw fa-eye"></span></a>'
                    + '</div>';
        },
        setTimer: function (obj, style, none, settings) {
            var time = obj.k_id_status_onair.time;
            var timer = {time: time, settings: settings, idTimer: 'timer_' + obj.k_id_onair + settings.row + '-' + settings.col};
            vista.timers.push(timer);
            return '<span id="' + timer.idTimer + '"><i class="fa fa-fw fa-clock-o"></i> No asignado</span>';
        },
        fillTablePending: function (data) {
            if (vista.tablaPendientes) {
                dom.refreshTable(vista.tablaPendientes, data);
                return;
            }
            console.log(data);
            vista.tablaPendientes = $('#tablaPendientes').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                        {title: "Tiempo", data: vista.setTimer},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                        {title: "Encargado", data: 'i_actualEngineer'},
                        {title: "Opciones", data: vista.getButtonsPending},
                    ]
                    ));
        },
        fillTableAssing: function (data) {
            if (vista.tablaAsignados) {
                dom.refreshTable(vista.tablaAsignados, data);
                return;
            }
            vista.tablaAsignados = $('#tablaAsignados').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                        {title: "Tiempo", data: vista.setTimer},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                        {title: "Encargado", data: 'i_actualEngineer.n_name_user'},
                        {title: "Opciones", data: vista.getButtonsAssing},
                    ], vista.runTimers
                    ));
        },
        runTimers: function () {
            var max = vista.timers.length;
            for (var i = 0; i < max; i++) {
                var obj = vista.timers[i];
                if (obj.time != null) {
                    dom.timer($('#' + obj.idTimer), null, null, obj.time);
                }
            }
        }
    };

    vista.init();
});
