<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <link rel="stylesheet" href="<?= URL::to('assets/css/stylegridView.css?v=1') ?>" />
    <body data-base="<?= URL::base() ?>" class="bg-gray">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <nav class="breadcrumb m-t-15 m-b-1">
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksMatrixView") ?>">Home</a>
                <span class="breadcrumb-item" >Mapas</span>                        
                <span class="breadcrumb-item active">Mapa de Riesgos Inherentes</span>
            </nav>
            <div class="row vh">
                <div class="col-md-3 bg-gray left-panel p-t-25 p-r-25">
                    <label>Plataforma:</label>
                    <select class="form-control" id="cmbPlataforma" data-combox="5">Seleccione</select>
                    <div class="list-riesgos" id="listRiesgos">                        
                    </div>
                    <span id="resumen" class="text-right text-muted help-block label-footer">0 seleccionados de 0</span>
                </div>
                <div class="col-md-9 bg-white p-t-15">
                    <table class="display-block" width="100%" >
                        <tr>
                            <td class="item-border"></td>
                            <td style="border: 0px; height: 30px; min-height: 30px;" colspan="5" class="text-center text-bold"> Mapa de Riesgos Inherentes</td>
                            <td class="item-border"></td>
                        </tr>
                        <tr>
                            <td class="item-left-vertical" rowspan="5">
                                <img src="<?= URL::to('assets/img/probabilidad.PNG') ?>" class="img-probabilidad"/>
                            </td>
                            <td class="item-grid item-green" data-index="1_5"></td>
                            <td class="item-grid item-blue" data-index="1_4"></td>
                            <td class="item-grid item-yellow" data-index="1_3"></td>
                            <td class="item-grid item-red" data-index="1_2"></td>
                            <td class="item-grid item-red" data-index="1_1"></td>
                            <td class="item-right-vertical" rowspan="5">
                                <div class="item item-red">
                                    Riesgo Inherente Extremo
                                </div>
                                <div class="item item-yellow">
                                    Riesgo Inherente Alto
                                </div>
                                <div class="item item-blue">
                                    Riesgo Inherente Moderado
                                </div>
                                <div class="item item-green">
                                    Riesgo Inherente Bajo
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="item-grid item-green" data-index="2_5"></td>
                            <td class="item-grid item-blue" data-index="2_4"></td>
                            <td class="item-grid item-yellow" data-index="2_3"></td>
                            <td class="item-grid item-yellow" data-index="2_2"></td>
                            <td class="item-grid item-red" data-index="2_1"></td>
                        </tr>
                        <tr>
                            <td class="item-grid item-green" data-index="3_5"></td>
                            <td class="item-grid item-blue" data-index="3_4"></td>
                            <td class="item-grid item-blue" data-index="3_3"></td>
                            <td class="item-grid item-yellow" data-index="3_2"></td>
                            <td class="item-grid item-red" data-index="3_1"></td>
                        </tr>
                        <tr>
                            <td class="item-grid item-green" data_index="4_5"></td>
                            <td class="item-grid item-green" data-index="4_4"></td>
                            <td class="item-grid item-blue" data-index="4_3"></td>
                            <td class="item-grid item-yellow" data-index="4_2"></td>
                            <td class="item-grid item-red" data-index="4_1"></td>
                        </tr>
                        <tr>                            
                            <td class="item-grid item-green" data-index="5_5"></td>
                            <td class="item-grid item-green" data-index="5_4"></td>
                            <td class="item-grid item-blue" data-index="5_3"></td>
                            <td class="item-grid item-yellow" data-index="5_2"></td>
                            <td class="item-grid item-red" data-index="5_1"></td>
                        </tr>
                        <tr>
                            <td class="item-border"></td>
                            <td class="item-border" colspan="5">
                                <img src="<?= URL::to('assets/img/impacto.PNG') ?>" class="img-impacto"/>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!--MODALS--> 
        <div class="modal fade" id="modalRiskDetail">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title"><i class="fa fa-fw fa-edit"></i> Detalles del riesgo</h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="formRiskDetail" >
                            <fieldset disabled="true">
                                <div class="form-group">
                                    <label class="col-md-3 text-right">Riesgo:</label>
                                    <div class="col-md-9">
                                        <select disabled="true" class="form-control" data-combox="1" name="k_id_riesgo">Seleccione</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 text-right">Plataforma:</label>
                                    <div class="col-md-9">
                                        <select disabled="true" class="form-control" data-combox="5" name="k_id_plataforma">Seleccione</select>
                                    </div>
                                </div>                              
                                <div class="form-group">
                                    <label class="col-md-3 text-right">Probabilidad riesgo:</label>
                                    <div class="col-md-9">
                                        <select disabled="true" class="form-control" data-combox="3" name="k_id_probabilidad">Seleccione</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 text-right">Impacto:</label>
                                    <div class="col-md-9">
                                        <select disabled="true" class="form-control" data-combox="4" name="k_id_impacto">Seleccione</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 text-right">Severidad riesgo:</label>
                                    <div class="col-md-9">
                                        <input disabled="true" class="form-control" name="n_severidad_riesgo_inherente" />
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalRiskList">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title"><i class="fa fa-fw fa-list"></i> Lista Riesgos</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table table-condensed table-striped table-bordered table-hover table-sm" id="tableRiskList">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Riesgo</td>
                                    <td><i class="fa fa-fw fa-list"></i> Detalle</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="fa fa-fw fa-warning"></i> No hay registros.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODALS-->


        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <script type="text/javascript" src="<?= URL::to("assets/js/modules/mapa_x_plataforma.js?v=".time()); ?>"></script>
        <!-- CUSTOM SCRIPT   -->
    </body>
</html>