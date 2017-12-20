<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <div class='tab-content contentPrincipal' id='tab1'>
                <div class='container'>
                    <form class="well form-horizontal" action="" method="post">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="k_id_control" class="col-sm-4 control-label">No. Control</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="k_id_control" name="k_id_control" disabled/>
                                    <input type="hidden" class="form-control" id="k_id_control_especifico" name="k_id_control_especifico"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="n_descripcion" class="col-sm-3 control-label"><span class="display-block">Descripción del Control</span></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="n_descripcion" name="n_descripcion" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="widget bg-gray m-t-25 display-block">
                            <h2 class="h4" style="text-align: center;">
                                <i class="fa fa-fw fa-question-circle"></i> Diseño del Control
                            </h2>
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group">
                                    <label for="n_pd1" class="col-md-3 control-label">El Control establece el riesgo a mitigar?</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pd1" id="n_pd1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="n_pd2" class="col-md-3 control-label">El control tiene un alcance definido?</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pd2" id="n_pd2" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form---->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group">
                                    <label for="n_pd3" class="col-md-3 control-label">El control define las actividades específicas a ejecutar?</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pd3" id="n_pd3" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="n_pd4" class="col-md-3 control-label">El control define una frecuencia de ejecución?</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pd4" id="n_pd4" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="n_pd5" class="col-md-3 control-label">El control define un responsable de la ejecución?</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pd5" id="n_pd5" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion derecha form---->
                        </div>
                        
                        <div class="widget bg-gray m-t-25 display-block">
                            <h2 class="h4" style="text-align: center;">
                                <i class="fa fa-fw fa-question-circle"></i> Ejecución del control
                            </h2>
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group">
                                    <label for="n_pe1" class="col-md-3 control-label">El control funciona en la totalidad de los casos?</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pe1" id="n_pe1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="n_pe2" class="col-md-3 control-label">El control se ejecuta  de acuerdo  con la frecuencia establecida?</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pe2" id="n_pe2" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form---->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group">
                                    <label for="n_pe3" class="col-md-3 control-label">El control se ejecuta de forma manual o automática?</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pe3" id="n_pe3" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="n_pe4" class="col-md-3 control-label">El control actúa de forma preventiva o detectiva?</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                            <input type='text' name="n_pe4" id="n_pe4" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="clearfix m-t-20"></div>

                        <center>
                            <div class="form-group">
                                <label class="col-md-12 control-label"></label>
                                <div class="col-md-12">
                                    <button type="submit" id="btnGenerarApertura" class="btn btn-success"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Guardar calificación</button>
                                </div>
                            </div>
                        </center>
                    </form>
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
        <!--<script src="<?= URL::to('assets/js/modules/generalControls.js') ?>" type="text/javascript"></script>-->
    </body>
</html>
