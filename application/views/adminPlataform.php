<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <!--   SWEET ALERT    -->
    <link rel="stylesheet" href="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.css') ?>" />
    <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js') ?>"></script>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <div class='tab-content' id='tab3'>
                <div class="">
                    <nav class="breadcrumb m-t-20">
                        <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksMatrixView") ?>">Home</a>
                        <span class="breadcrumb-item" >Módulos</span>                        
                        <a class="breadcrumb-item" href="<?= URL::to("Matriz/listPlataforms"); ?>">Lista Plataformas</a>
                        <span class="breadcrumb-item" ><?= isset($_GET["id"]) ? "Editar" : "Registrar" ?></span>
                    </nav>
                    <form class="well form-horizontal" action="Risk/insertPlataform" data-action-update="Risk/updatePlataform" method="post"  id="risks" >
                        <div class="alert alert-success alert-dismissable hidden">
                            <a href="#" class="close" >&times;</a>
                            <p class="p-b-0" id="text"></p>
                        </div>
                        <legend>Administrador de Plataformas</legend>
                        <fieldset class="col-md-8 control-label col-md-offset-2">
                            <div class="form-group">
                                <label for="n_nombre" class="col-md-3 control-label">Nombre plataforma:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                        <input type='text' name="n_nombre" id="n_nombre" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="n_responsable" class="col-md-3 control-label">Responsable plataforma:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                        <input type='text' name="n_responsable" id="n_responsable" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--  fin seccion izquierda form -->                       
                        <!-- Button -->
                        <center>
                            <div class="form-group">
                                <label class="col-md-12 control-label"></label>
                                <div class="col-md-12">
                                    <button type="submit" id="btnGuardar" class="btn btn-success" onclick = "">Guardar <span class="fa fa-fw fa-save"></span></button>
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
                dom.submit($('#risks'), function () {
                    location.href = app.urlTo('Matriz/listPlataforms');
                });

                var formData = <?= ($formData) ? $formData : 'null' ?>

                var id = app.getParamURL('id');
                if (id && formData) {
                    var form = $('#risks');
                    form.fillForm(formData);
                    form.attr('data-action', 'FOR_UPDATE');
                    form.find('button[type="submit"]').html('<i class="fa fa-fw fa-save"></i> Actualizar');
                    form.append('<input type="hidden" name="k_id_plataforma" id="k_id_plataforma" value="' + formData.k_id_plataforma + '" />');
                }
            });
        </script>

    </body>
</html>