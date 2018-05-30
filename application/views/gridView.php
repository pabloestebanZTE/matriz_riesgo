<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <link rel="stylesheet" href="<?= URL::to('assets/css/stylegridView.css') ?>" />
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <div class='tab-content contentPrincipal' id='tab1'>
                <div class='container align-center'>
                    <table>
                        <tr>
                            <td class="item-border"></td>
                            <td style="border: 0px; height: 30px; min-height: 30px;" colspan="5" class="text-center text-bold"> Mapa de Riesgos Inherentes</td>
                            <td class="item-border"></td>
                        </tr>
                        <tr>
                            <td class="item-left-vertical" rowspan="5">
                                <img src="<?= URL::to('assets/img/probabilidad.PNG') ?>"/>
                            </td>
                            <td class="item-green"></td>
                            <td class="item-blue"></td>
                            <td class="item-yellow"></td>
                            <td class="item-red"></td>
                            <td class="item-red"></td>
                            <td class="item-right-vertical" rowspan="5">
                                <div class="item item-red">
                                    Riesgo Inherente Extremo
                                </div>
                                <div class="item item-yellow">
                                    Riesgo Inherente Alto
                                </div>
                                <div class="item item-blue">
                                    Riesgo Inherente Moderado
                                </div>
                                <div class="item item-green">
                                    Riesgo Inherente Bajo
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="item-green"></td>
                            <td class="item-blue"></td>
                            <td class="item-yellow"></td>
                            <td class="item-yellow"></td>
                            <td class="item-red"></td>
                        </tr>
                        <tr>
                            <td class="item-green"></td>
                            <td class="item-blue"></td>
                            <td class="item-blue"></td>
                            <td class="item-yellow"></td>
                            <td class="item-red"></td>
                        </tr>
                        <tr>
                            <td class="item-green"></td>
                            <td class="item-green"></td>
                            <td class="item-blue"></td>
                            <td class="item-yellow"></td>
                            <td class="item-red"></td>
                        </tr>
                        <tr>                            
                            <td class="item-green"></td>
                            <td class="item-green"></td>
                            <td class="item-blue"></td>
                            <td class="item-yellow"></td>
                            <td class="item-red"></td>
                        </tr>
                        <tr>
                            <td class="item-border"></td>
                            <td class="item-border" colspan="5">
                                <img src="<?= URL::to('assets/img/impacto.PNG') ?>"/>
                            </td>
                        </tr>
                    </table>
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
    </body>
</html>
