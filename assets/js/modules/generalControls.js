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
            app.post('Control/getALLControls')
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

            var m = "";
            if (obj.k_control_asinado) {
                if (obj.k_control_asinado === "0") {
                    m = "style= 'display: none'";
                }
            }
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('Control/findControlById?idControl=' + obj.k_id_control) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar Control"><span class="fa fa-fw fa-pencil-square-o"></span></a>'
                    + '<a onclick="showModalqualificationControls(\'' + obj.k_id_control + '\')" class="btn btn-default btn-xs" data-toggle="tooltip" title="ver Riesgos Asociados"' + m + '><span class="fa fa-fw fa-list-ul"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (ini.tablaPrincipal) {
                dom.refreshTable(ini.tablaPrincipal, data);
                return;
            }
            ini.tablaPrincipal = $('#tablaPrincipal').DataTable(dom.configTable(data,
                    [
                        {title: "ID", data: "k_id_control"},
                        {title: "Descripción del Control", data: "n_descripcion"},
                        {title: "Asignación", data: "n_asignacion"},
                        {title: "Cargo", data: "n_cargo"},
                        {title: "Tipo de control", data: "n_tipo"},
                        {title: "Funcionalidad tipo de control", data: "n_funcionalidad_tipo"},
                        {title: "Naturaleza del Control", data: "n_naturaleza_control"},
                        {title: "Periodicidad del control", data: "n_periodicidad"},
                        {title: "Funcionalidad Frecuencia del Control", data: "n_funcionalidad_frecuencia"},
                        {title: "Opciones", data: ini.getButtons},
                    ],
                    ));
        }

    };

    ini.init();
});

function showModalqualificationControls(idControl) {
    var obj = {
        idControl: idControl
    };
    app.post('Risk/getRiskAssociatedControl', obj)
            .success(function (response) {
                console.log(response);
                var v = app.validResponse(response);
                if (v) {
                    swal("Guardado", "Se ha terminado la fase correctamente.", "success");
                    vista.getDetails();
                } else {
                    swal("Atención", response.message, "warning");
                }
            }).error(function (e) {
        swal("Error", "Se ha producido un error desconocido, compruebe su conexión y vuelva a intentarlo.", "error");
        console.log(e);
    }).send();

}
