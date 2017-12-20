<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <link rel="stylesheet" href="<?= URL::to('assets/css/styleRiskMatrix.css') ?>" />    
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item active text-center">
                                <h4 class="glyphicon glyphicon-plane"></h4><br/>Establecer Contexto
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-road"></h4><br/>Identificar Riesgos
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
                            <input type="hidden" value="" id="idRecord" />
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
                                            <select class="form-control" id="cmbPlataforma" name="riesgo_especifico.k_id_plataforma" data-combox="5">
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
                                        <label for="txtResponsablePlataforma" class="col-sm-2 control-label">Responsable Plataforma</label>
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
                                        <label for="cmbRiesgoId" class="col-sm-2 control-label">Riesgo</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbRiesgoId" name="riesgo_especifico.k_id_riesgo" data-combox="1">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtTipoActividad" class="col-sm-2 control-label">Tipo de Actividad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="riesgo_especifico.n_tipo_activad">
                                                <option>Seleccione</option>
                                                <option value="1. Fraude Interno">1. Fraude Interno</option>
                                                <option value="2. Fraude Externo">2. Fraude Externo</option>
                                                <option value="3. Relaciones Laborales">3. Relaciones Laborales</option>
                                                <option value="4. Clientes">4. Clientes</option>
                                                <option value="5. Daños a activos físicos">5. Daños a activos físicos</option>
                                                <option value="6. Fallas tecnológicas">6. Fallas tecnológicas</option>
                                                <option value="7. Ejecución y administración de procesos">7. Ejecución y administración de procesos</option>
                                                <option value="8. Lavado de Activos">8. Lavado de Activos</option>
                                                <option value="9. Reputacional">9. Reputacional</option>
                                                <option value="10. Legal">10. Legal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbTipoEventoNivel1" class="col-sm-2 control-label">Tipo de evento (nivel 1)</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbTipoEventoNivel1" name="riesgo_especifico.k_id_tipo_evento_1" data-combox="7" >
                                                <option>Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbTipoEventoNivel2" class="col-sm-2 control-label">Tipo de evento (nivel 2)</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbTipoEventoNivel2" name="riesgo_especifico.k_id_tipo_evento_2" >
                                                <option>Seleccione un tipo de evento (nivel 1)</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="cmbProbabilidad" class="col-sm-2 control-label">Probabilidad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbProbabilidad" name="riesgo_especifico.k_id_probabilidad" data-combox="3">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteProbabilidad" class="col-sm-2 control-label">Soporte Probabilidad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteProbabilidad" name="soporte_probabilidad" >
                                                <option value="">Seleccione</option>
                                                <option value="Soporte probabilidad 1">Soporte probabilidad 1</option>
                                                <option value="Soporte probabilidad 2">Soporte probabilidad 2</option>
                                                <option value="Soporte probabilidad 3">Soporte probabilidad 3</option>
                                                <option value="Soporte probabilidad 4">Soporte probabilidad 4</option>
                                                <option value="Soporte probabilidad 5">Soporte probabilidad 5</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="cmbImpacto" class="col-sm-2 control-label">Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbImpacto" name="riesgo_especifico.k_id_impacto" data-combox="4">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteImpacto1" class="col-sm-2 control-label">Soporte Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteImpacto1" name="soporte_impacto[]" >
                                                <option value="">Seleccione</option>
                                                <option value="Soporte impacto 1">Soporte impacto 1</option>
                                                <option value="Soporte impacto 2">Soporte impacto 2</option>
                                                <option value="Soporte impacto 3">Soporte impacto 3</option>
                                                <option value="Soporte impacto 4">Soporte impacto 4</option>
                                                <option value="Soporte impacto 5">Soporte impacto 5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteImpacto2" class="col-sm-2 control-label">Soporte Impacto2</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteImpacto2" name="soporte_impacto[]">
                                                <option value="">Seleccione</option>
                                                <option value="Soporte impacto 1">Soporte impacto 1</option>
                                                <option value="Soporte impacto 2">Soporte impacto 2</option>
                                                <option value="Soporte impacto 3">Soporte impacto 3</option>
                                                <option value="Soporte impacto 4">Soporte impacto 4</option>
                                                <option value="Soporte impacto 5">Soporte impacto 5</option>
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
                                                            <label class="small">Control <span id="numControl">1:</span></label>
                                                            <div class="input-group">
                                                                <select class="form-control input-sm" id="cmbCodControl" data-combox="6">
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                                <div class="input-group-btn">
                                                                    <button type="button" class="btn btn-primary btn-sm btn-add-control" title="Agregar control"><i class="fa fa-fw fa-plus"></i></button>
                                                                    <button type="button" class="btn btn-danger btn-sm btn-remove-control" title="Remover causa"><i class="fa fa-fw fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                            <!--</div>-->
                                                            <!--<div class="col-md-6">-->
                                                            <div class="display-block with-300 m-t-10">
                                                                <label class="small">Factor de riesgo:</label>
                                                                <select class="form-control input-sm" id="cmbFactorRiesgo" name="cmbFactorRiesgo" data-combox="2">
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                            </div>
                                                            <!--</div>-->
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
        <script src="<?= URL::to('assets/js/modules/riskMatrix.js') ?>" type="text/javascript"></script>
    </body>
</html>
