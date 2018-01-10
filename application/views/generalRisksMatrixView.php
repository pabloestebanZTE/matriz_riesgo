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
                                    <a class="btn btn-primary" href="<?= URL::to('Matriz/riskMatrixView') ?>"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Crear Matriz Riesgo</a>
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
        <br>
        <br>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script src="<?= URL::to('assets/js/modules/generalRisksMatrix.js?v=' . time()) ?>" type="text/javascript"></script>
    </body>
</html>
