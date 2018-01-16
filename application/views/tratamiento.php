<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <!--   SWEET ALERT    -->
    <link rel="stylesheet" href="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.css') ?>" />
    <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js') ?>"></script>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container">
            <div class='tab-content' id='tab3'>
                <nav class="breadcrumb m-t-20">
                    <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRiskMatrixView") ?>">Home</a>
                    <span class="breadcrumb-item" >Módulos</span>                        
                    <a class="breadcrumb-item" href="<?= URL::to("Matriz/listTratamiento"); ?>">Administración de Tratamientos</a>
                    <span class="breadcrumb-item" >Editar</span>
                </nav>
                <div class="">
                    <form class="well form-horizontal" action="Risk/insertTratamiento" method="post"  id="formTratamiento" name="controls">
                        <div class="alert alert-success alert-dismissable hidden">
                            <a href="#" class="close" >&times;</a>
                            <p class="p-b-0" id="text"></p>
                        </div>
                        <input type="hidden" id="k_id_probabilidad_riesgo_residual" name="k_id_probabilidad_riesgo_residual" />
                        <input type="hidden" id="k_id_impacto_riesgo_residual" name="k_id_impacto_riesgo_residual" />
                        <input type="hidden" id="k_id_riesgo_especifico" name="k_id_riesgo_especifico" />
                        <legend>Tratamiento de riesgos</legend>
                        <fieldset class="col-md-6 control-label">
                            <div class="form-group">
                                <label for="cmbRiesgos" class="col-md-3 control-label">Riesgo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                        <select class="form-control" id="cmbRiesgos" name="k_id_riesgo">
                                            <option>Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtDescripcionRiesgo" class="col-md-3 control-label">Descripción del riesgo:</label>
                                <div class="col-md-8 selectContainer">
                                    <input type="text" class="form-control" disabled="true" id="txtDescripcionRiesgo" name="descripcion_riesgo" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtRiesgoInherente" class="col-md-3 control-label">Riesgo Inherente:</label>
                                <div class="col-md-8 selectContainer">
                                    <input type="text" class="form-control" disabled="true" id="txtRiesgoInherente"  />
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="txtRiesgoResidual" class="col-md-3 control-label">Riesgo Residual:</label>
                                <div class="col-md-8 selectContainer">
                                    <input type="text" class="form-control" disabled="true" id="txtRiesgoResidual" />
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="cmbOpcionesManejo" class="col-md-3 control-label">Opciones de manejo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-wrench"></i></span>
                                        <select class="form-control" id="cmbOpcionesManejo" name="opcion_manejo">
                                            <option value="">Seleccione</option>
                                            <option value="EVT">EVT</option>
                                            <option value="RE">RE</option>
                                            <option value="TR">TR</option>
                                            <option value="AS">AS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtControlPropuesto" class="col-md-3 control-label">Control propuesto:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                        <textarea class="form-control" placeholder="Control propuesto o acciones a tomar" id="txtControlPropuesto" name="control_propuesto"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--  fin seccion izquierda form---->

                        <!--  inicio seccion derecha form---->
                        <fieldset>
                            <div class="form-group">
                                <label for="n_tipo" class="col-md-3 control-label">Tipo de control:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                        <select class="form-control" id="n_tipo" name="tipo_control">
                                            <option value="">Seleccione</option>
                                            <option value="Preventivo">Preventivo</option>
                                            <option value="Detectivo">Detectivo</option>
                                            <option value="Correctivo">Correctivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_control" class="col-md-3 control-label">Fecha Inicio:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                        <input type="date" class="form-control" name="fecha_inicio" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_control" class="col-md-3 control-label">Fecha Fin:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                        <input type="date" class="form-control" name="fecha_fin" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_control" class="col-md-3 control-label">Responsable:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                        <input type="text" class="form-control" name="responsable" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_control" class="col-md-3 control-label">Indicador:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-cny"></i></span>
                                        <textarea class="form-control" placeholder="Indicador para la evaluación de acciones" name="indicador"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--   fin seccion derecha---->

                        <!-- Button -->
                        <center>
                            <div class="form-group">
                                <label class="col-md-12 control-label"></label>
                                <div class="col-md-12">
                                    <button type="submit" id="btnAsignar" class="btn btn-success" onclick = "">Guardar <span class="fa fa-fw fa-save"></span></button>
                                </div>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
            <!--
                        <div class='tab-content' id='tab1'>
                            <div class='container'>
                                <form class= 'well form-horizontal' action='' method='post'>
                                    <fieldset>
                                        <table id="tableAssignMoney" class="table table-hover table-condensed table-striped" width='100%'></table>
                                    </fieldset>
                                </form>
                            </div>
                        </div>-->
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->


        <div class="incorrect-type info-box error-msg" style="display: none;">
            Sorry, the file you selected is not MSG type
        </div>

        <div class="file-api-not-available info-box error-msg" style="display: none;">
            Sorry, your browser isn't supported
        </div>

        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <link href="<?= URL::to("assets/plugins/select2/select2.css") ?>" rel="stylesheet" type="text/css"/>
        <script src="<?= URL::to("assets/plugins/select2/select2.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/FormatDate.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1') ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            var formData = <?= $dataForm; ?>;
        </script>
        <script src="<?= URL::to("assets/js/modules/tratamiento.js?v=" . time()) ?>" type="text/javascript"></script>
    </body>
</html>
