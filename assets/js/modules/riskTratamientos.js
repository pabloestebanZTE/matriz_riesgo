/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var vista = {
    init: function () {
        vista.events();
        vista.listTratamientos();
    },
    events: function () {

    },
    listTratamientos: function () {
        app.post('Risk/getListTratamientoByMatriz', {
            k_id_riesgo_especifico: app.getParamURL('id')
        }).success(function (response) {
            var data = app.parseResponse(response);
            if (data) {
                vista.fillTable(data);
                var r = data[0];
                $('#txtNamePlataforma').val(r.k_id_riesgo_especifico.k_id_plataforma.n_nombre);
                $('#txtNameRiesgo').val(r.k_id_riesgo.nombre_riesgo);
            } else {
                vista.fillTable([]);
            }
        }).send();
    },
    fillTable: function (data) {
        if (vista.tablaTratamiento) {
            dom.refreshTable(vista.tablaTratamiento, data);
            return;
        }
        vista.tablaTratamiento = $('#tablaTratamiento').DataTable(dom.configTable(data,
                [
                    {title: "Riesgo", data: "k_id_riesgo.nombre_riesgo"},
                    {title: "Riesgo Inherente", data: "k_id_riesgo_especifico.n_severidad_riesgo_inherente.n_calificacion"},
                    {title: "Riesgo Residual", data: "k_id_probabilidad.n_calificacion"},
                    {title: "Opciones de manejo", data: "opcion_manejo", visible: false},
                    {title: "Control propuesto", data: "control_propuesto", visible: false},
                    {title: "Tipo de control", data: "tipo_control"},
                    {title: "Fecha inicio", data: "fecha_inicio"},
                    {title: "Fecha fin", data: "fecha_fin"},
                    {title: "Responsable", data: "responsable"},
                    {title: "Indicador", data: "indicador", visible: false},
                    {title: "Opciones", data: vista.getButtons}
                ],
                ));
    },
    getButtons: function (obj) {
        return '<a class="btn btn-default btn-xs" href="' + app.urlTo('Matriz/editarTratamiento?id=' + obj.k_id_tratamiento) + '" title="Editar tratamiento"><i class="fa fa-fw fa-edit"></i></a>';
    }
};

$(function () {
    vista.init();
});