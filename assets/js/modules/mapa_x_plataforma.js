var vista = {
    data: [],
    points: {},
    grids: {},
    init: function () {
        vista.events();
    },
    events: function () {
        $('#cmbPlataforma').on('change', vista.onChangePlataforma);
        $('#listRiesgos').on('change', '.chk-risk-item', vista.onClickItemRiskList);
        $('td.item-grid').on('click', vista.onClickItemGrid);
        $('#tableRiskList').off('click', '.btn-view', vista.onClickItemTableGrid);
        $('#tableRiskList').on('click', '.btn-view', vista.onClickItemTableGrid);
    },
    onClickItemTableGrid: function () {
        var button = $(this);
        var tr = button.parents('tr');
        var registro = vista.grids[tr.attr('data-index')];
        registro = registro[tr.attr('data-i')];
        console.log(registro);
        vista.getDetailItemGrid(tr.attr('data-index'), registro);
    },
    onClickItemGrid: function () {
        var grid = $(this);
        //Verificamos si es un registro...
        if (grid.find('.point').length > 0) {
            if (grid.find('.point').attr('data-value') == 1) {
                vista.getDetailItemGrid(grid.attr('data-index'));
            } else {
                vista.getListItemGrid(grid.attr('data-index'));
            }
        }
    },
    getDetailItemGrid: function (index, data) {
        var modal = $('#modalRiskDetail');
        if (!data) {
            data = vista.grids[index];
            data = data[0];
        } else {
            console.log(data);
        }
        modal.fillForm(data);
        modal.find('select').trigger('change.select2');
        if (data) {
            $('#modalRiskList').modal('hide');
        }
        window.setTimeout(function () {
            modal.modal('show');
        }, 15);
    },
    getListItemGrid: function (index) {
        var modal = $('#modalRiskList');
        var data = vista.grids[index];
        var tabla = $('#tableRiskList tbody');
        tabla.html('');
        for (var i = 0; i < data.length; i++) {
            tabla.append('<tr data-i="' + i + '" data-index="' + index + '"><td>' + (i + 1) + '</td><td style="max-width: 30px; text-align: center;">' + data[i].n_riesgo + '</td><td><div class="btn-group"><button type="button" title="Ver detalles" class="btn btn-xs btn-view btn-default"><i class="fa fa-fw fa-search"></i></button></div></td></tr>');
        }
        modal.modal('show');
    },
    onClickItemRiskList: function () {
        $('#resumen').html($('.chk-risk-item:checked').length + ' seleccionados de ' + vista.data.length);
        var check = $(this);
        vista.addPoint(check);
    },
    addPoint: function (check) {
        var index = check.attr('data-index');
        var registro = vista.data[index];
        var point = $('table td[data-index="' + registro.k_id_probabilidad + '_' + registro.k_id_impacto + '"]');
        var pointSection = point.find('.point');
        if (vista.points[index]) {
            if (!check.is(':checked')) {
                if (pointSection.attr('data-value') == 1) {
                    pointSection.remove();
                } else {
                    var pts = (parseInt(pointSection.attr('data-value')) - 1);
                    pointSection.attr('data-value', pts);
                    pointSection.html(pts);
                }
                delete vista.points[index];
                vista.removeItemGrid(registro.k_id_probabilidad + '_' + registro.k_id_impacto, registro);
                console.log("SE REMUEVE");
            }
            return;
        }
        vista.points[index] = index;
        if (pointSection.length) {
            //Reemplazamos el punto y agregamos un detalle nuevo...
            var i = parseInt(pointSection.attr('data-value')) + 1;
            pointSection.attr('data-value', i);
            if (!Array.isArray(vista.grids[registro.k_id_probabilidad + '_' + registro.k_id_impacto])) {
                vista.grids[registro.k_id_probabilidad + '_' + registro.k_id_impacto] = [];
            }
            vista.addGrid(registro);
            if (i > 10) {
                i += "10+";
            }
            pointSection.html(i);
        } else {
            if (!Array.isArray(vista.grids[registro.k_id_probabilidad + '_' + registro.k_id_impacto])) {
                vista.grids[registro.k_id_probabilidad + '_' + registro.k_id_impacto] = [];
            }
            vista.addGrid(registro);
            //Creamos el punto...
            var htmlPoint = '<div class="point" data-value="1"><span class="title">' + registro.k_id_riesgo + '</span></div>';
            point.append(htmlPoint);
        }
    },
    addGrid: function (registro) {
        var list = vista.grids[registro.k_id_probabilidad + '_' + registro.k_id_impacto];
        if (list.length == 0) {
            vista.grids[registro.k_id_probabilidad + '_' + registro.k_id_impacto].push(registro);
        } else {
            for (var i = 0; i < list.length; i++) {
                if (list[i].k_id_riesgo_especifico != registro.k_id_riesgo_especifico) {
                    vista.grids[registro.k_id_probabilidad + '_' + registro.k_id_impacto].push(registro);
                } else {
                    console.log(list[i].k_id_riesgo_especifico, "vs", registro.k_id_riesgo_especifico);
                }
            }
        }
    },
    removeItemGrid: function (index, registro) {
        for (var i = 0; i < vista.grids[index].length; i++) {
            var v = vista.grids[index].k_id_riesgo_especifico == registro.k_id_riesgo_especifico;
            if (v) {
                vista.grids[index].splice(i, 1);
            }
        }
    },
    onChangePlataforma: function () {
        $('#listRiesgos').html('<div class="risk-item"><div class="checkbox checkbox-primary"><i class="fa fa-fw fa-refresh fa-spin"></i> Consultando...</div></div>');
        $('table td .point').remove();
        app.post('Risk/getRiskByIdPlataform', {id: $('#cmbPlataforma').val()})
                .success(function (response) {
                    var data = app.parseResponse(response);
                    if (data && data.length > 0) {
                        $('#listRiesgos').html('');
                        vista.data = data;
                        vista.points = {};
                        $('#resumen').html('0 seleccionados de ' + data.length);
                        for (var i = 0; i < data.length; i++) {
                            vista.addItem(data[i], i);
                        }
                    } else {
                        vista.noFoundRecords();
                    }
                })
                .error(function () {
                    vista.noFoundRecords();
                }).send();
    },
    addItem: function (obj, i) {
        var item = '<div class="risk-item"><div class="checkbox checkbox-primary">'
                + '<div class="display-block">'
                + '<input id="chk_p_' + obj.k_id_riesgo_especifico + '" type="checkbox" data-index="' + i + '" class="chk-risk-item">'
                + '<label for="chk_p_' + obj.k_id_riesgo_especifico + '" class="text-bold">'
                + obj.n_riesgo
                + '</label>'
                + '</div>'
                + '</div></div>';
        item = $(item);
        $('#listRiesgos').append(item);
        item.find('input.chk-risk-item').trigger('click');
    },
    noFoundRecords: function () {
        vista.data = [];
        vista.points = {};
        $('#listRiesgos').html('<div class="risk-item"><div class="checkbox checkbox-primary"><i class="fa fa-fw fa-warning"></i> No hay riesgos.</div></div>');
    }
};
$(function ()
{
    vista.init();
});