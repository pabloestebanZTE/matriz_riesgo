/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var vista = {
    init: function () {
        vista.events();
        vista.listPlataforms();        
    },
    events: function () {

    },    
    listPlataforms: function () {
        app.post('Risk/listPlataforms').success(function (response) {
            var data = app.parseResponse(response);
            if (data) {
                vista.fillTable(data);
            } else {
                vista.fillTable([]);
            }
        }).error(function () {

        }).send();
    },
    getButtons: function (obj) {
        return '<div class="btn-group">'
                + '<a href="' + app.urlTo('Matriz/adminPlataform?id=' + obj.k_id_plataforma)
                + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar Control"><span class="fa fa-fw fa-pencil-square-o"></span></a>'
                + '</div>';
    },
    fillTable: function (data) {
        if (vista.tablaPrincipal) {
            dom.refreshTable(vista.tablaPrincipal, data);
            return;
        }
        vista.tablaPrincipal = $('#tablaPrincipal').DataTable(dom.configTable(data,
                [
                    {title: "ID", data: "k_id_plataforma"},
                    {title: "Plataforma", data: "n_nombre"},
                    {title: "Opciones", data: vista.getButtons},
                ],
                ));
    }
};
$(function () {
    vista.init();
});