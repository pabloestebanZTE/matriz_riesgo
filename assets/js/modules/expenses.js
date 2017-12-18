$(function () {
    vista = {
        timers: [],
        init: function () {
            vista.events();
            vista.listGastos();
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
        listGastos: function () {
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
                            vista.fillTableGastos(response.data.pendingList);
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
        fillTableGastos: function (data) {
            if (vista.tablaGastos) {
                dom.refreshTable(vista.tablaGastos, data);
                return;
            }
            console.log(data);
            vista.tablaGastos = $('#tablaGastos').DataTable(dom.configTable(data,
                    [
                        {title: "Cedula", data: vista.fillNA},
                        {title: "Nombre", data: vista.fillNA},
                        {title: "ID", data: vista.fillNA},
                        {title: "Ticket", data: vista.fillNA},
                        {title: "Ciudad", data: vista.fillNA},
                        {title: "Región", data: vista.fillNA},
                        {title: "Fecha Gasto", data: vista.fillNA},
                        {title: "Fecha Recibido", data: vista.fillNA},
                        {title: "Fecha IMD", data: vista.fillNA},
                        {title: "Descripción General", data: vista.fillNA},
                        {title: "Descripción", data: vista.fillNA},
                        {title: "Valor Legalizado", data: vista.fillNA},
                        {title: "Estado Revision", data: vista.fillNA},
                        {title: "Mes", data: vista.fillNA},
                        {title: "Semana", data: vista.fillNA},
                    ]
                    ));
        }
    };

    vista.init();
});
