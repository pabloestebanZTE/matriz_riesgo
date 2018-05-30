<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20">
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="<?= URL::to("Matriz/generalRisksMatrixView") ?>">Home</a>
                <span class="breadcrumb-item" >Módulos</span>                        
                <span class="breadcrumb-item active">Tratamiento de riesgos</span>
            </nav>
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <div class='tab-content contentPrincipal' id='tab1'>
                <div class=''>
                    <form class= 'well form-horizontal' action='' method='post'  id='' name='' enctype= 'multipart/form-data'>
                        <fieldset>
                            <div class="row">
                                <div class="col col-md-3">
                                    <select class="form-control" id="cmbPlataformas" data-combox="5">
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                                <div class="col col-md-3">
                                    <select class="form-control" id="cmbRiesgos">
                                        <option value="">Seleccione</option>
                                    </select>
                                </div>
                                <div class="col col-md-12 p-t-40">
                                    <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                                    <table id="tablaTratamiento" class="table table-hover table-condensed table-striped"></table>
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
                        <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Riesgos asociados</h4>
                    </div>
                    <div class="modal-body">
                        <table id="tablaRiesgosAsociados" class="table table-hover table-condensed table-striped" width='100%'></table>
                    </div>
                    <div class="modal-footer">
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
        <script src="<?= URL::to('assets/js/modules/listTratamiento.js?v=' . time()) ?>" type="text/javascript"></script>
    </body>
</html>