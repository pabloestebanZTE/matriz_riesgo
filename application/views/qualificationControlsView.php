<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20">
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksMatrixView") ?>">Home</a>
                <span class="breadcrumb-item" >Módulos</span>                        
                <span class="breadcrumb-item active">Calificación de controles</span>
            </nav>
            <div class='tab-content contentPrincipal' id='tab1'>
                <div class=''>
                    <form class="well form-horizontal" id="qualification" action="Qualification/insertQualification" data-action-update="Qualification/updateQualification" method="post">
                        <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                            <a href="#" class="close">&times;</a>
                            <p id="text" class="m-b-0 p-b-0"></p>
                        </div>
                        <fieldset>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="k_id_control" class="col-sm-4 control-label">No. Control</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="k_id_control" name="nombre_control" disabled/>
                                        <input type="hidden" class="form-control" id="k_id_control_especifico" name="k_id_control_especifico"/>
                                        <input type="hidden" class="form-control" id="k_id_calificacion" name="k_id_calificacion"/>
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
                                                <!--<input type='text' name="n_pd1" id="n_pd1" class="form-control">-->
                                                <select name="n_pd1" id="n_pd1" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 8; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="n_pd2" class="col-md-3 control-label">El control tiene un alcance definido?</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <!--<input type='text' name="n_pd2" id="n_pd2" class="form-control">-->
                                                <select name="n_pd2" id="n_pd2" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 8; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
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
                                                <!--<input type='text' name="n_pd3" id="n_pd3" class="form-control">-->
                                                <select name="n_pd3" id="n_pd3" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 8; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="n_pd4" class="col-md-3 control-label">El control define una frecuencia de ejecución?</label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <!--<input type='text' name="n_pd4" id="n_pd4" class="form-control">-->
                                                <select name="n_pd4" id="n_pd4" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 8; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="n_pd5" class="col-md-3 control-label">El control define un responsable de la ejecución?</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <!--<input type='text' name="n_pd5" id="n_pd5" class="form-control">-->
                                                <select name="n_pd5" id="n_pd5" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 8; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
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
                                                <!--<input type='text' name="n_pe1" id="n_pe1" class="form-control">-->
                                                <select name="n_pe1" id="n_pe1" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 15; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="n_pe2" class="col-md-3 control-label">El control se ejecuta  de acuerdo  con la frecuencia establecida?</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <!--<input type='text' name="n_pe2" id="n_pe2" class="form-control">-->
                                                <select name="n_pe2" id="n_pe2" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 15; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
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
                                                <!--<input type='text' name="n_pe3" id="n_pe3" class="form-control">-->
                                                <select name="n_pe3" id="n_pe3" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 15; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="n_pe4" class="col-md-3 control-label">El control actúa de forma preventiva o detectiva?</label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <!--<input type='text' name="n_pe4" id="n_pe4" class="form-control">-->
                                                <select name="n_pe4" id="n_pe4" class="form-control" onchange="realizarCalificacion()">
                                                    <?php
                                                    for ($i = 1; $i <= 15; $i++) {
                                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="widget bg-gray m-t-25 display-block">
                                <h2 class="h4" style="text-align: center;">
                                    <i class="fa fa-fw fa-question-circle"></i> Calificación
                                </h2>
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="totalDisenio" class="col-md-3 control-label">Total Diseño</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <input type='text' name="totalDisenio" id="totalDisenio" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="totalEjecucion" class="col-md-3 control-label">Total Ejecución</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <input type='text' name="totalEjecucion" id="totalEjecucion" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="totalCalificacion" class="col-md-3 control-label">Total Calificación</label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <input type='text' name="totalCalificacion" id="totalCalificacion" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nivelesDisminuye" class="col-md-3 control-label">Niveles Disminuye</label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                                                <input type='text' name="nivelesDisminuye" id="nivelesDisminuye" class="form-control">
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
        <script type="text/javascript">
            $(function () {
                var control = <?php echo json_encode($control); ?>;
                if (!control) {
                    swal("Error", "No se encontró el registro de control.", "error");
                    $('#qualification').find('fieldset, select, input, button').prop('disabled', true);
                    return;
                }
                calificacion = <?php echo json_encode($calificacion); ?>;
                var form = $('#qualification');
                form.fillForm(control);
                if (calificacion) {
                    form.fillForm(calificacion);
                    form.attr('data-action', 'FOR_UPDATE');
                }
                dom.submit($('#qualification'), function () {
                    location.href = app.urlTo('Matriz/generalControlsView');
                });
            });
            
            function realizarCalificacion() {
                var total_disenio = parseInt($('#n_pd1').val()) + parseInt($('#n_pd2').val()) + parseInt($('#n_pd3').val()) + parseInt($('#n_pd4').val()) + parseInt($('#n_pd5').val());
                var total_ejecucion = parseInt($('#n_pe1').val()) + parseInt($('#n_pe2').val()) + parseInt($('#n_pe3').val()) + parseInt($('#n_pe4').val());
                var total_calificacion = total_disenio + total_ejecucion;
                var niveles_disminuye = 0;
                if (parseInt(total_calificacion) <= 100 && parseInt(total_calificacion) >= 76) {
                    niveles_disminuye = 2;
                } else {
                    if (parseInt(total_calificacion) <= 75 && parseInt(total_calificacion) >= 51) {
                        niveles_disminuye = 1;
                    } else {
                        niveles_disminuye = 0;
                    }
                }
                $('#totalDisenio').val(total_disenio);
                $('#totalEjecucion').val(total_ejecucion);
                $('#totalCalificacion').val(total_calificacion);
                $('#nivelesDisminuye').val(niveles_disminuye);
            }
        </script>
    </body>
</html>
