<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <style type="text/css">
        table{
            border: 1px solid #ccc;
        }
        table td{
            border: 1px solid #ccc;
            min-width: 100px;
            min-height: 60px;
            width: 100px;
            height: 60px;
        }
        table .item{
            border: 1px solid #ccc;
            width: 80px;
            height: 80px;
            float: right;
            font-size: 12px;
        }
    </style>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <div class='tab-content contentPrincipal' id='tab1'>
                <div class='container'>
                    <table>
                        <tr>
                            <td style="border: 0px; height: 30px; min-height: 30px;" colspan="7" class="text-center text-bold"> Mapa de Riesgos Inherentes</td>                            
                        </tr>
                        <tr>
                            <td rowspan="5">LEFT VERTICAL</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td rowspan="6">
                                <div class="item">
                                    asjdfklasdjfsadjf
                                </div>
                                <div class="item">
                                    asjdfklasdjfsadjf
                                </div>
                                <div class="item">
                                    asjdfklasdjfsadjf
                                </div>
                                <div class="item">
                                    asjdfklasdjfsadjf
                                </div>
                                <div class="item">
                                    asjdfklasdjfsadjf
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="5"></td>
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
