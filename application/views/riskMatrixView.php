<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <link rel="stylesheet" href="<?= URL::to('assets/css/styleRiskMatrix.css') ?>" />    
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <nav class="breadcrumb m-t-20 m-b-0">
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksMatrixView") ?>">Home</a>
                <span class="breadcrumb-item" >Módulos</span>                        
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksMatrixView"); ?>">Admistración de Matrices</a>
                <span class="breadcrumb-item" ><?= isset($_GET["id"]) ? "Editar" : "Registrar" ?></span>
            </nav>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item active text-center">
                                <h4 class="glyphicon glyphicon-plane"></h4><br/>Establecer Contexto
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-road"></h4><br/>Tipificar Riesgos
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-home"></h4><br/>Analizar Riesgos
                            </a>
                            <a href="#" class="list-group-item text-center" id="contentAll">
                                <h4 class="glyphicon glyphicon-eye-open"></h4><br/>Ver Todo
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab" >
                        <div id="formsRisk" data-action="Risk/insertRiskFull" data-action-update="Risk/updateRiskFull" >
                            <input type="hidden" id="idRecord" value="<?= isset($_GET["id"]) ? $_GET["id"] : "" ?>" />
                            <!-- establecer contexto section -->
                            <div class="bhoechie-tab-content active" id="contentTab1">
                                <form class="content-center m-b-20 well form-horizontal" id="form1">
                                    <div class="alert alert-success alert-dismissable hidden">
                                        <a href="#" class="close" >&times;</a>
                                        <p class="p-b-0" id="text"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbPlataforma" class="col-sm-2 control-label">Plataforma</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbPlataforma" name="riesgo_especifico.k_id_plataforma" >
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbPlataforma" class="col-sm-2 control-label">Zona Geográfica</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbZonasGeograficas" name="riesgo_especifico.k_id_zona_geografica" >
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtMacroProceso" class="col-sm-2 control-label">Macro proceso</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtMacroProceso" name="riesgo_especifico.n_macro_proceso">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtProceso" class="col-sm-2 control-label">Proceso</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtProceso" name="riesgo_especifico.n_proceso" name="riesgo_especifico.n_proceso">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtServicios" class="col-sm-2 control-label">Servicios</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtServicios" name="riesgo_especifico.n_servicio">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtObjetivo" class="col-sm-2 control-label">Objetivo</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="txtObjetivo" name="riesgo_especifico.n_objetivo"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtResponsablePlataforma" class="col-sm-2 control-label">Responsable Riesgo</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtResponsablePlataforma" name="riesgo_especifico.n_responsable">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- identificar riesgos section -->
                            <div class="bhoechie-tab-content" id="contentTab2">
                                <form class="content-center m-b-20 well form-horizontal" id="form2" >
                                    <div class="alert alert-success alert-dismissable hidden">
                                        <a href="#" class="close" >&times;</a>
                                        <p class="p-b-0" id="text"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Plataforma</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control txt-plataforma disabled" disabled="disabled" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbRiesgoId" class="col-sm-2 control-label">Riesgo</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbRiesgoId" name="riesgo_especifico.k_id_riesgo" >
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--                                    <div class="form-group">
                                                                            <label for="cmbRiesgoDescripcion" class="col-sm-2 control-label">Descripción Riesgo</label>
                                                                            <div class="col-sm-10">
                                                                                <select class="form-control" id="cmbRiesgoDescripcion" name="cmbRiesgoDescripcion" disabled>
                                                                                    <option value=""></option>
                                                                                </select>
                                                                            </div>
                                                                        </div>-->
                                    <div id="tiposDeActividad">                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbTipoEventoNivel1" class="col-sm-2 control-label">Tipo de evento (nivel 1)</label>
                                        <div class="col-sm-10">
                                            <select class="form-control helper-change" id="cmbTipoEventoNivel1" name="riesgo_especifico.k_id_tipo_evento_1" >
                                                <option>Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbTipoEventoNivel2" class="col-sm-2 control-label">Tipo de evento (nivel 2)</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbTipoEventoNivel2" name="riesgo_especifico.k_id_tipo_evento_2" >
                                                <option value="">Seleccione un tipo de evento (nivel 1)</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="cmbProbabilidad" class="col-sm-2 control-label">Probabilidad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control helper-change select-severidad" id="cmbProbabilidad" name="riesgo_especifico.k_id_probabilidad" onchange="cambiarSoporteProbabilidad()">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteProbabilidad" class="col-sm-2 control-label">Soporte Probabilidad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteProbabilidad" name="soporte_probabilidad">
                                                <option value="">Seleccione la probabilidad</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cmbImpacto" class="col-sm-2 control-label">Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control helper-change select-severidad" id="cmbImpacto" name="riesgo_especifico.k_id_impacto" onchange="cambiarSoporteImpacto();">
                                                <option value="">Seleccione el impacto</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteImpacto1" class="col-sm-2 control-label">Soporte Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteImpacto1" name="soporte_impacto[]" >
                                                <option value="">Seleccione el impacto</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteImpacto2" class="col-sm-2 control-label">Soporte Impacto2</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteImpacto2" name="soporte_impacto[]">
                                                <option value="">Seleccione el impacto</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--                                    <div class="form-group">
                                                                            <label for="txtConsecuencia" class="col-sm-2 control-label">Consecuencia</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="text" class="form-control" id="txtConsecuencia" name="txtConsecuencia">
                                                                            </div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label for="txtSeveridadRiesgoInherente" class="col-sm-2 control-label">Severidad del Riesgo Inherente</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtSeveridadRiesgoInherente" name="riesgo_especifico.n_severidad_riesgo_inherente" disabled="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- analizar riegos section -->
                            <div class="bhoechie-tab-content" id="contentTab3">
                                <form class="m-b-20 content-center well form-horizontal" id="form3">
                                    <!--<div class="widget bg-gray text-left m-t-25 display-block">-->
                                    <h2 class="h4"><i class="fa fa-fw fa-check-square-o"></i> Causas y controles.</h2>
                                    <p class="muted m-b-0">Por favor, verifique los procesos a continuación y complete el checklist según sea el caso.</p>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Plataforma</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control txt-plataforma disabled" disabled="disabled" />
                                        </div>
                                    </div>
                                    <div class="widget bg-white" id="contentCausas">
                                        <div class="item-causa hidden" id="itemCausaIndex">
                                            <div class="item-icon">
                                                <i class="fa fa-fw fa-warning"></i>
                                            </div>
                                            <div class="item-content">
                                                <div class="header-causa">
                                                    <label>Causa <span id="numCausa">1</span>:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm" />
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-primary btn-sm btn-add-causa" title="Agregar causa"><i class="fa fa-fw fa-plus"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm btn-remove-causa" title="Remover causa"><i class="fa fa-fw fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="body-causa" id="content_controls">
                                                    <div class="item-control bg-gray" id="controlIndex">
                                                        <!--<span class="icon-control"><i class="fa fa-fw fa-tag"></i></span>-->
                                                        <div class="content-control p-r-15">
                                                            <!--<div class="col-md-6">-->
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <label class="small">Control <span id="numControl">1:</span></label>
                                                                    <div class="input-group-custom display-block">
                                                                        <div class="select-section">
                                                                            <select class="form-control input-sm notDisabled cmb-control" id="cmbCodControl" >
                                                                                <option value="">Seleccione</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="input-group-btn">
                                                                            <button type="button" class="btn btn-primary btn-sm btn-add-control" title="Agregar control"><i class="fa fa-fw fa-plus"></i></button>
                                                                            <button type="button" class="btn btn-danger btn-sm btn-remove-control" title="Remover causa"><i class="fa fa-fw fa-minus"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                            
                                                                <!--</div>-->
                                                                <!--<div class="col-md-6">-->
                                                                <div class="col-xs-12">
                                                                    <div class="display-block with-300 m-t-10">
                                                                        <label class="small">Factor de riesgo:</label>
                                                                        <select class="form-control input-sm notDisabled cmb-factor-riesgo" id="cmbFactorRiesgo" name="cmbFactorRiesgo" >
                                                                            <option value="">Seleccione</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!--</div>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="btnAddCausa" onclick="vista.addCausa()"><i class="fa fa-fw fa-plus"></i> Agregar causa</button>
                                    </div>
                                    <div class="form-group p-t-15">
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-primary hidden"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Guardar</button>
                                        </div>
                                    </div>
                                    <!--</div>-->
                                </form>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script type="text/javascript">
            var dataForm = <?= $dataForm; ?>;
        </script>
        <script src="<?= URL::to('assets/js/modules/riskMatrix.js?v=' . time()) ?>" type="text/javascript"></script>
    </body>
</html>
