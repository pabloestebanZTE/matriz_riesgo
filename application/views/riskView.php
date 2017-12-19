<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <!--   SWEET ALERT    -->
    <link rel="stylesheet" href="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.css') ?>" />
    <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js') ?>"></script>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">

            <div class='tab-content' id='tab3'><br><br>
                <div class="container">
                    <form class="well form-horizontal" action="" method="post"  id="controls" name="controls">
                        <div class="alert alert-success alert-dismissable hidden">
                            <a href="#" class="close" >&times;</a>
                            <p class="p-b-0" id="text"></p>
                        </div>
                        <legend>Administrador de Riesgo</legend>
                        <fieldset class="col-md-6 control-label">
                            <div class="form-group">
                                <label for="k_id_riesgo" class="col-md-3 control-label">ID:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                        <input type='text' name="k_id_riesgo" id="k_id_riesgo" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="n_responsable" class="col-md-3 control-label">Responsable Riesgo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
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
                                        <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                        <input type="text" name="n_riesgo" id="n_riesgo" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtDescripcionRiesgo" class="col-md-3 control-label">Descripción del Riesgo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
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
        <script src="<?= URL::to("assets/js/modules/gastos.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            var contador = 0;
            function AgregarCampos() {
                contador++;
                campos = '<div id="contenedor' + contador + '">'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="txtCedula">Cedula:</label><br>'
                        + '<input type="text" class="form-control m-r-3" id="txtCedula" name="txtCedula[]" placeholder="" />'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="txtNombre">Nombre:</label><br>'
                        + '<input type="text" class="form-control m-r-3" id="txtNombre" name="txtNombre[]" placeholder="" />'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="txtID">ID:</label><br>'
                        + '<input type="text" class="form-control m-r-3" id="txtID" name="txtID[]" placeholder="" />'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="txtTicket"># Ticket:</label><br>'
                        + '<input type="text" class="form-control m-r-3" id="txtTicket" name="txtTicket[]" />'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="cmbCiudad">Ciudad:</label><br>'
                        + '<select class="form-control m-r-3" id="cmbCiudad" name="cmbCiudad[]">'
                        + '<option value="">Seleccione</option>'
                        + '</select>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="cmbRegion">Región:</label><br>'
                        + '<select class="form-control m-r-3" id="cmbRegion" name="cmbRegion[]">'
                        + '<option value="">Seleccione</option>'
                        + '</select>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="txtFechaGasto">Fecha Gasto:</label><br>'
                        + '<input type="datetime-local" class="form-control m-r-3" id="txtFechaGasto" placeholder="DD/MM/YYYY" name="txtFechaGasto[]" style="width: 195px;"/>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="txtFechaRecibido">Fecha Recibido:</label><br>'
                        + '<input type="datetime-local" class="form-control m-r-3" id="txtFechaRecibido" placeholder="DD/MM/YYYY" name="txtFechaRecibido[]" style="width: 195px;"/>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="txtFechaIMD">Fecha IMD:</label><br>'
                        + '<input type="datetime-local" class="form-control m-r-3" id="txtFechaIMD" placeholder="DD/MM/YYYY" name="txtFechaIMD[]" style="width: 195px;"/>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="cmbDescripcionGeneral">Descripción General:</label><br>'
                        + '<input type="text" class="form-control " id="txtDescripcionGeneral" name="txtDescripcionGeneral[]" value="VIÁTICOS" disabled>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="cmbDescripcion">Descripción:</label><br>'
                        + '<select class="form-control m-r-3" id="cmbDescripcion" name="cmbDescripcion[]">'
                        + '<option value="">Alimentación</option>'
                        + '<option value="">Hospedaje</option>'
                        + '<option value="">Hospedaje y Alimentacion</option>'
                        + '<option value="">Transporte</option>'
                        + '</select>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="txtValorLegalizado">Valor Legalizado:</label><br>'
                        + '<input type="text" class="form-control m-r-3" id="txtValorLegalizado" placeholder="" name="txtValorLegalizado[]"/>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="cmbEstadoRevision">Estado Revision:</label><br>'
                        + '<select class="form-control m-r-3" id="cmbEstadoRevision" name="cmbEstadoRevision[]">'
                        + '<option value="">Seleccione</option>'
                        + '<option value="">Aprovado</option>'
                        + '<option value="">Rechazado</option>'
                        + '<option value="">Revisión</option>'
                        + '</select>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="cmbMes">Mes:</label><br>'
                        + '<select class="form-control m-r-3" id="cmbMes" name="cmbMes[]">'
                        + '<option value="">Seleccione</option>'
                for (var i = 1; i <= 12; i++) {
                    campos += '<option value="">' + i + '</option>'
                }

                campos += '</select>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<label class="m-t-10" for="cmbSemana">Semana:</label><br>'
                        + '<select class="form-control m-r-3" id="cmbSemana" name="cmbSemana[]">'
                        + '<option value="">Seleccione</option>'
                        + '<option value="">SEMANA 1</option>'
                        + '<option value="">SEMANA 2</option>'
                        + '<option value="">SEMANA 3</option>'
                        + '<option value="">SEMANA 4</option>'
                        + '<option value="">SEMANA 5</option>'
                        + '</select>'
                        + '</div>'
                        + '<div class="form-group">'
                        + '<br>'
                        + '<br>'
                        + '<button type="button" class="btn btn-success m-r-3" onclick="AgregarCampos();"><i class="fa fa-plus" aria-hidden="true"></i></button>'
                        + '<button type="button" class="btn btn-danger" onclick="eliminarCampos(' + contador + ');"><i class="fa fa-minus" aria-hidden="true"></i></button>'
                        + '</div>'
                        + '</div>';
                $("#contenedor").append(campos);
            }

            function eliminarCampos(idContenedor) {
                $("#contenedor" + idContenedor).remove();
            }
        </script>
    </script>

</body>
</html>
