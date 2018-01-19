<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <!--   SWEET ALERT    -->
    <link rel="stylesheet" href="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.css') ?>" />
    <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js') ?>"></script>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <nav class="breadcrumb m-t-15">
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksMatrixView") ?>">Home</a>
                <span class="breadcrumb-item" >Módulos</span>                        
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksView"); ?>">Administración de Riesgos</a>
                <span class="breadcrumb-item" ><?= isset($duplicar) ? "Duplicar riesgo" : "Editar" ?></span>
            </nav>
            <div class='tab-content' id='tab3'>
                <div class="">
                    <form class="well form-horizontal" action="Risk/insertRisk" method="post"  id="risks" name="risks">
                        <div class="alert alert-success alert-dismissable hidden">
                            <a href="#" class="close" >&times;</a>
                            <p class="p-b-0" id="text"></p>
                        </div>
                        <legend>Administrador de Riesgo</legend>
                        <fieldset class="col-md-6 control-label">
                            <div class="form-group">
                                <label for="k_id_plataforma" class="col-md-3 control-label">Plataforma:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                        <select class="form-control" id="k_id_plataforma" name="k_id_plataforma" required>
                                            <option>Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre_riesgo" class="col-md-3 control-label">ID:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                        <input type='text' name="nombre_riesgo" id="nombre_riesgo" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="n_responsable" class="col-md-3 control-label">Responsable Riesgo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                        <input type='text' name="n_responsable" id="n_responsable" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--  fin seccion izquierda form---->

                        <!--  inicio seccion derecha form---->
                        <fieldset>
                            <div class="form-group">
                                <label for="n_riesgo" class="col-md-3 control-label">Riesgo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-exclamation-triangle"></i></span>
                                        <input type="text" name="n_riesgo" id="n_riesgo" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtDescripcionRiesgo" class="col-md-3 control-label">Descripción del Riesgo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-exclamation-triangle"></i></span>
                                        <textarea id="n_riesgo_descripcion" name="n_riesgo_descripcion" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>    
                        </fieldset>
                        <input type='hidden' name="k_id_ticket" id="k_id_ticket" class="form-control" >
                        <!--   fin seccion derecha---->

                        <!-- Button -->
                        <center>
                            <div class="form-group">
                                <label class="col-md-12 control-label"></label>
                                <div class="col-md-12">
                                    <button type="submit" id="btnGuardar" class="btn btn-success" onclick = ""><?= isset($duplicar) ? "Duplicar" : "Guardar" ?> <span class="fa fa-fw fa-save"></span></button>
                                </div>
                            </div>
                        </center>
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
                var riesgo = <?php echo (isset($riesgo) ? $riesgo : 'null'); ?>;
                var duplicar = <?= isset($duplicar) ? "true" : "false" ?>;
                console.log(riesgo);

                if (riesgo !== null) {
                    $("#risks").attr("action", ((duplicar) ? "Risk/insertRisk" : "Risk/updateGeneralRisk"));
                    $('#risks').fillForm(riesgo);
                    if (!duplicar) {
                        $('#risks').append('<input type="hidden" name="k_id_registro" value="' + riesgo.k_id + '" id="k_id_registro" />');
                    }
                }

                if ($("#risks").attr("action") === "Risk/insertRisk") {
                    dom.submit($('#risks'));
                } else {
                    dom.submit($('#risks'), function () {
                        location.href = app.urlTo('Matriz/generalRisksView');
                    });
                }

                var plataformas = <?= $plataformas; ?>
                //Listamos las plataformas...
                dom.llenarCombo($('#k_id_plataforma'), plataformas, {text: "n_nombre", value: "k_id_plataforma"});
            });
        </script>
    </script>

</body>
</html>
