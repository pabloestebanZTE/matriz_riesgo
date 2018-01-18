<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <!--   SWEET ALERT    -->
    <link rel="stylesheet" href="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.css') ?>" />
    <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js') ?>"></script>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container">
            <nav class="breadcrumb m-t-15">
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksMatrixView") ?>">Home</a>
                <span class="breadcrumb-item" >Módulos</span>                        
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalControlsView"); ?>">Administración de Controles</a>
                <span class="breadcrumb-item" ><?= isset($duplicar) ? "Duplicar control" : "Editar" ?></span>
            </nav>
            <div class='tab-content' id='tab3'>
                <div class="">
                    <form class="well form-horizontal" action="Control/insertControl" method="post"  id="controls" name="controls">
                        <div class="alert alert-success alert-dismissable hidden">
                            <a href="#" class="close" >&times;</a>
                            <p class="p-b-0" id="text"></p>
                        </div>
                        <legend>Administrador de Controles</legend>
                        <fieldset class="col-md-6 control-label">
                            <div class="form-group">
                                <label for="k_id_plataforma" class="col-md-3 control-label">Plataforma:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                        <select class="form-control" id="k_id_plataforma" name="k_id_plataforma">
                                            <option>Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_control" class="col-md-3 control-label">ID:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                        <input type='text' name="nombre_control" id="nombre_control" class="form-control" required>
                                        <span class="input-group-addon"><i class="fa fa-fw fa-hashtag"></i></span>
                                        <input type='text' name="k_id_control" id="k_id_control" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="n_descripcion" class="col-md-3 control-label">Descripción del Control:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                        <textarea class="form-control" id="n_descripcion" name="n_descripcion"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="n_asignacion" class="col-md-3 control-label">Asignación:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                        <select class="form-control" id="n_asignacion" name="n_asignacion">
                                            <option value="">Seleccione</option>
                                            <option value="Asignado">Asignado</option>
                                            <option value="No asiganado">No asiganado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="n_cargo" class="col-md-3 control-label">Cargo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                        <input type='text' name="n_cargo" id="n_cargo" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="n_tipo" class="col-md-3 control-label">Tipo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                        <select class="form-control" id="n_tipo" name="n_tipo">
                                            <option value="">Seleccione</option>
                                            <option value="Detectivo">Detectivo</option>
                                            <option value="Preventivo">Preventivo</option>
                                            <option value="Correctivo">Correctivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_funcionalidad_tipo" class="col-md-3 control-label">Funcionalidad:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                        <select class="form-control" id="n_funcionalidad_tipo" name="n_funcionalidad_tipo">
                                            <option value="">Seleccione</option>
                                            <option value="Adecuado">Adecuado</option>
                                            <option value="Inadecuado">Inadecuado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_naturaleza_control" class="col-md-3 control-label">Naturaleza del Control:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                        <select class="form-control" id="n_naturaleza_control" name="n_naturaleza_control">
                                            <option value="">Seleccione</option>
                                            <option value="Manual">Manual</option>
                                            <option value="Automático">Automático</option>
                                            <option value="Dependiente de T.I">Dependiente de T.I</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_periodicidad" class="col-md-3 control-label">Periodicidad:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                        <select class="form-control" id="n_periodicidad" name="n_periodicidad">
                                            <option value="">Seleccione</option>
                                            <option value="Diario">Diario</option>
                                            <option value="Semanal">Semanal</option>
                                            <option value="Quincenal">Quincenal</option>
                                            <option value="Mensual">Mensual</option>
                                            <option value="Bimestral">Bimestral</option>
                                            <option value="Trimestral">Trimestral</option>
                                            <option value="Semestral">Semestral</option>
                                            <option value="Anual">Anual</option>
                                            <option value="Esporádico/Sorpresivo">Esporádico/Sorpresivo</option>
                                            <option value="Cuando se requiera">Cuando se requiera</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                            
                        </fieldset>
                        <!--  fin seccion izquierda form---->

                        <!--  inicio seccion derecha form---->
                        <fieldset>
                            <div class="form-group">
                                <label for="n_funcionalidad_frecuencia" class="col-md-3 control-label">Funcionalidad:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                        <select name="n_funcionalidad_frecuencia" id="n_funcionalidad_frecuencia" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="Adecuado">Adecuado</option>
                                            <option value="Inadecuado">Inadecuado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="n_documentacion" class="col-md-3 control-label">Documentación del Control:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                        <select class="form-control" name="n_documentacion" id="n_documentacion">
                                            <option value="">Seleccione</option>
                                            <option value="Documentado">Documentado</option>
                                            <option value="No documentado">No documentado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_actividades" class="col-md-3 control-label">Actividades que componen el Control:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                        <select class="form-control" name="n_actividades" id="n_actividades">
                                            <option value="">Seleccione</option>
                                            <option value="Adecuadas">Adecuadas</option>
                                            <option value="Inadecuadas">Inadecuadas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_ejecucion" class="col-md-3 control-label">Ejecución del Control:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                        <select class="form-control" name="n_ejecucion" id="n_ejecucion">
                                            <option value="">Seleccione</option>
                                            <option value="Fuerte">Fuerte</option>
                                            <option value="Moderado">Moderado</option>
                                            <option value="Débil">Débil</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_importancia" class="col-md-3 control-label">Importancia del Control:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                        <select class="form-control" name="n_importancia" id="n_importancia">
                                            <option value="">Seleccione</option>
                                            <option value="Muy Importante">Muy Importante</option>
                                            <option value="Importante">Importante</option>
                                            <option value="Poco importante">Poco importante</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_disminuye_probabilidad" class="col-md-3 control-label">Disminuye la Probabilidad:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                        <select class="form-control" name="n_disminuye_probabilidad" id="n_disminuye_probabilidad">
                                            <option value="">Seleccione</option>
                                            <option value="Sí">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_disminuye_impacto" class="col-md-3 control-label">Disminuye el Impacto:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                        <select class="form-control" name="n_disminuye_impacto" id="n_disminuye_impacto">
                                            <option value="">Seleccione</option>
                                            <option value="Sí">Sí</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--                            <div class="form-group">
                                                            <label for="n_riesgo_residual" class="col-md-3 control-label">Riesgo Residual</label>
                                                            <div class="col-md-8 inputGroupContainer">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                                    <input type="text" class="form-control" name="n_riesgo_residual" id="n_riesgo_residual">
                                                                </div>
                                                            </div>
                                                        </div>-->
                        </fieldset>
                        <!--   fin seccion derecha---->

                        <!-- Button -->
                        <center>
                            <div class="form-group">
                                <label class="col-md-12 control-label"></label>
                                <div class="col-md-12">
                                    <button type="submit" id="btnAsignar" class="btn btn-success" onclick = ""><span class="fa fa-fw fa-save"></span> <?= isset($duplicar) ? "Duplicar" : "Guardar" ?></button>
                                </div>
                            </div>
                        </center>
                    </form>
                </div>
            </div>

            <div class='tab-content' id='tab1'>
                <div class='container'>
                    <form class= 'well form-horizontal' action='' method='post'>
                        <fieldset>
                            <table id="tableAssignMoney" class="table table-hover table-condensed table-striped" width='100%'></table>
                        </fieldset>
                    </form>
                </div>
            </div>
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
            $(function () {
                var control = <?php echo (isset($control) ? $control : 'null'); ?>;
                var duplicar = <?= isset($duplicar) ? "true" : "false"; ?>;
                if (control !== null) {
                    $("#controls").attr("action", ((duplicar) ? "Control/insertControl" : app.urlTo('Control/updateControl')));
                    $('#controls').append('<input type="hidden" value="' + control.k_id + '" name="k_id_registro" id="k_id_registro" />');
                    $('#controls').fillForm(control);
                }

                if ($("#controls").attr("action") === "Control/insertControl") {
                    dom.submit($('#controls'), function () {
                        if (duplicar) {
                            location.href = app.urlTo('Matriz/generalControlsView');
                        }
                    });
                } else {
                }


                var plataformas = <?= $plataformas; ?>
                //Listamos las plataformas...
                dom.llenarCombo($('#k_id_plataforma'), plataformas, {text: "n_nombre", value: "k_id_plataforma"});
            });
        </script>
    </script>

</body>
</html>
