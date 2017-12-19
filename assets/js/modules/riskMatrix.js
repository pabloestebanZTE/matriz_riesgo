var modeloControles = $('<select class="form-control m-r-0" data-combox="6" id="cmbControles" name="controles[]" >'
        + '<option value="">Seleccione</option>'
        + '</select>');
var contControles = 0;
var contCausas = 0;

var vista = {
    init: function () {
        vista.evetns();
        vista.configView();
        dom.getListCombox(modeloControles, true);
    },
    evetns: function () {
        $("div.bhoechie-tab-menu>div.list-group>a").on('click', vista.onClickTab);
        dom.submit($('#formsRisk'), null, false);
    },
    onClickTab: function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab-content").eq(index).addClass("active");
        if ($(this).attr("id") === 'contentAll') {
            $("div.bhoechie-tab-content").addClass("active");
//            $("button").css("display","none");
        }
    },
    configView: function () {
        $('select').select2({width: '100%'});
    }
};

$(document).ready(function () {
    vista.init();
});


function AgregarCampos() {
    AgregarControles();
}

function AgregarControles() {
    contControles++;
    var cmb = modeloControles.clone();
    cmb.select2({width: '100%'});
    var campos = '<div class="form-group" id="contenedorControles' + contControles + '">'
            + '<label for="cmbControles" class="col-sm-2 control-label">Control</label>'
            + '<div class="col-sm-10"><div class="input-group" id="contentCmb">'
            + modeloControles[0].outerHTML
            + '<div class="input-group-btn"><button type="button" class="btn btn-success m-r-0" onclick="AgregarCampos()"><i class="fa fa-plus" aria-hidden="true"></i></button>'
            + '<button type="button" class="btn btn-danger" onclick="eliminarControles(' + contControles + ');"><i class="fa fa-minus" aria-hidden="true"></i></button>'
            + '</div></div>'
            + '</div>'
            + '</div>';
    campos = $(campos);
    campos.find('select').select2({width: '100%'});
    $("#contenedorControles").append(campos);
}

function eliminarControles(idControl) {
    $("#contenedorControles" + idControl).remove();
}

function AgregarCausas() {
    contCausas++;
    campos = '<div class="form-inline form-group" id="contenedorCausas' + contCausas + '">'
            + '<label for="cmbControles" class="col-sm-2 control-label">Causa</label>'
            + '<div class="col-sm-10">'
            + '<input type="text" class="form-control m-r-5" id="txtCausa" name="causas[]" style="width: 87%;">'
            + '<button type="button" class="btn btn-success m-r-5" onclick="AgregarCausas()"><i class="fa fa-plus" aria-hidden="true"></i></button>'
            + '<button type="button" class="btn btn-danger" onclick="eliminarCausas(' + contCausas + ');"><i class="fa fa-minus" aria-hidden="true"></i></button>'
            + '</div>'
            + '</div>';
    $("#contenedorCausas").append(campos);
}

function eliminarCausas(idCausa) {
    $("#contenedorCausas" + idCausa).remove();
}