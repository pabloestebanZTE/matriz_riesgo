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
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">

                        <!-- establecer contexto section -->
                        <div class="bhoechie-tab-content active" id="contentTab1">
                            <center>
                                <form class="well form-horizontal" action="" method="post">
                                    <div class="form-group">
                                        <label for="cmbPlataforma" class="col-sm-2 control-label">Plataforma</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbPlataforma" name="cmbPlataforma">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtMacroProceso" class="col-sm-2 control-label">Macro proceso</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtMacroProceso" name="txtMacroProceso">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtProceso" class="col-sm-2 control-label">Proceso</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtProceso" name="txtProceso">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtServicios" class="col-sm-2 control-label">Servicios</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtServicios" name="txtServicios">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtObjetivo" class="col-sm-2 control-label">Objetivo</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="txtObjetivo" name="txtObjetivo"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtResponsablePlataforma" class="col-sm-2 control-label">Responsable Plataforma</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtResponsablePlataforma" name="txtResponsablePlataforma">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>

                        <!-- identificar riesgos section -->
                        <div class="bhoechie-tab-content" id="contentTab2">
                            <center>
                                <form class="well form-horizontal" action="" method="post">
                                    <div class="form-group">
                                        <label for="cmbRiesgoId" class="col-sm-2 control-label">Riesgo</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="txtTipoActividad" class="col-sm-2 control-label">Tipo de Actividad</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtTipoActividad" name="txtTipoActividad">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtTipoEventoNivel1" class="col-sm-2 control-label">Tipo de evento (nivel 1)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtTipoEventoNivel1" name="txtTipoEventoNivel1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtTipoEventoNivel2" class="col-sm-2 control-label">Tipo de evento (nivel 2)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtTipoEventoNivel2" name="txtTipoEventoNivel2">
                                        </div>
                                    </div>
                                    <div id="contenedorCausas">
                                        <div class="form-inline form-group">
                                            <label for="txtCausa" class="col-sm-2 control-label">Causa</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="txtCausa" name="txtCausa[]" style="width: 93%;">
                                                <button type="button" class="btn btn-success" onclick="AgregarCausas()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbFactorRiesgo" class="col-sm-2 control-label">Factor de riesgo</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbFactorRiesgo" name="cmbFactorRiesgo">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbProbabilidad" class="col-sm-2 control-label">Probabilidad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbProbabilidad" name="cmbProbabilidad">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteProbabilidad" class="col-sm-2 control-label">Soporte Probabilidad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteProbabilidad" name="cmbSoporteProbabilidad" onchange="cambiarSoporteImpacto()">
                                                <option value="">Seleccione</option>
                                                <option value="1">Eventualidad que no es probable o es muy poco probable (una vez al año)</option>
                                                <option value="2">Eventualidad poco común  o relativa frecuencia (dos veces al año).</option>
                                                <option value="3">Puede ocurrir en algún momento. Eventualidad con frecuencia moderada. (doce veces al año)</option>
                                                <option value="4">Hay buenas razones para creer que se verificará o sucederá el riesgo en muchas circunstancias. Eventualidad de frecuencia alta. (cuarenta y ocho  veces al año)</option>
                                                <option value="5">Se espera que el riesgo ocurra en la mayoría de las circunstancias. Eventualidad frecuente. (Trescientos sesenta y cinco veces al año)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbImpacto" class="col-sm-2 control-label">Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbImpacto" name="cmbImpacto">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteImpacto1" class="col-sm-2 control-label">Soporte Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteImpacto1" name="cmbSoporteImpacto1">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteImpacto2" class="col-sm-2 control-label">Soporte Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteImpacto2" name="cmbSoporteImpacto2">
                                                <option value="">Seleccione</option>
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
                                            <input type="text" class="form-control" id="txtSeveridadRiesgoInherente" name="txtSeveridadRiesgoInherente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>

                        <!-- analizar riegos section -->
                        <div class="bhoechie-tab-content" id="contentTab3">
                            <center>
                                <!--<div class="row form-md">-->
                                <form class="well form-horizontal" action="" method="post">
                                    <div id="contenedorControles">
                                        <div class="form-inline form-group" >
                                            <label for="cmbControles" class="col-sm-2 control-label">Control</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="cmbControles" name="cmbControles[]" style="width: 93%;">
                                                    <option value="">Seleccione</option>
                                                </select>
                                                <button type="button" class="btn btn-success" onclick="AgregarControles()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Guardar</button>
                                        </div>
                                    </div>
                                </form>
                                <!--</div>-->
                            </center>
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
