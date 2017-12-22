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
                    <form class= 'well form-horizontal' action='' method='post'  id='' name='' enctype= 'multipart/form-data'>
                        <fieldset>
                            <div class="row">
                                <div class="col col-md-12" >
                                    <a class="btn btn-primary" href="<?= URL::to('Matriz/controlsView') ?>"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Crear control</a>
                                </div>
                                <div class="col col-md-12 p-t-40">
                                    <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                                    <table id="tablaPrincipal" class="table table-hover table-condensed table-striped"></table>
                                    <br/>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        
        <!--modal riesgos asociados-->
        <div id="modalChangeState" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xs">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Cambiar estado</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="states-modal">
                            <li>
                                <a href="javascript:;" data-action="PROR" data-focus="#txtTiempoProrroga"><span class="icon-state theme2"><i class="fa fa-fw fa-pause"></i></span> Crear Prórroga</a>
                                <ul class="content-state hidden">
                                    <li>
                                        <label class="display-block" for="txtTiempoProrroga"><i class="fa fa-fw fa-clock-o"></i> Tiempo de la prórroga (Horas):</label>
                                        <div class="input-control">
                                            <input type="text" class="form-control" placeholder="Horas" id="txtTiempoProrroga"/>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="NEXT"><span class="icon-state theme3"><i class="fa fa-fw fa-forward"></i></span> Cambiar Fase</a>
                                <ul class="content-state hidden">
                                    <li>
                                        <label class="display-block" for="cmbSiguienteFase"><i class="fa fa-fw fa-forward"></i> Seleccione la fase:</label>
                                        <div class="input-control">
                                            <select id="cmbSiguienteFase" class="form-control">
                                                <option value="12h">12H</option>
                                                <option value="24h">24H</option>
                                                <option value="36h">36H</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="PROD" ><span class="icon-state theme1"><i class="fa fa-fw fa-play"></i></span> Producción</a>
                                <ul class="content-state hidden">
                                    <li>
                                        <div class="input-control">
                                            <div class="row">
                                                <select class="form-control" id="cmbEstadosProcesos">
                                                    <option value="">Selecione</option>
                                                    <option value="87">Pendiente Tareas Remedy</option>
                                                    <option value="89">Producción</option>
                                                </select>
                                                <div class="checkbox checkbox-primary" id="productionList">
                                                    <div class="display-block">
                                                        <input id="chk_p_1" type="checkbox" >
                                                        <label for="chk_p_1" class="text-bold">
                                                            Activación Cuarta Portadora.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_2" type="checkbox" >
                                                        <label for="chk_p_2" class="text-bold">
                                                            Pendiente ID RF Tools
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_3" type="checkbox" >
                                                        <label for="chk_p_3" class="text-bold">
                                                            Pendiente Sitio Limpio.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_4" type="checkbox" >
                                                        <label for="chk_p_4" class="text-bold">
                                                            Activación Cuarta Portadora.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_5" type="checkbox" >
                                                        <label for="chk_p_5" class="text-bold">
                                                            Pendiente Testgestión.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_6" type="checkbox" >
                                                        <label for="chk_p_6" class="text-bold">
                                                            Pendiente Pruebas Alarmas.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_7" type="checkbox" >
                                                        <label for="chk_p_7" class="text-bold">
                                                            Error de instalación.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_8" type="checkbox" >
                                                        <label for="chk_p_8" class="text-bold">
                                                            Pendiente Evidencias.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="STANDBY"><span class="icon-state theme2"><i class="fa fa-fw fa-stop-circle"></i></span> Stand By</a>
                            </li>
                            <li>
                                <a href="<?= URL::to("User/scaling?id=" . $_GET['id']); ?>"><span class="icon-state theme4"><i class="fa fa-fw fa-undo"></i></span> Escalar Proceso</a>
                            </li>
                        </ul>
                        <label for="txtObservations">Observaciones:</label>
                        <textarea id="txtObservations" class="form-control" rows="5" placeholder="Escriba aquí las observaciones por las cuales está realizando el cambio."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button id="btnAceptarModal" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-fw fa-check"></i> Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
        <!--modal riesgos asociados-->
        
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script src="<?= URL::to('assets/js/modules/generalControls.js') ?>" type="text/javascript"></script>
    </body>
</html>
