<!-- Navigation -->
<header>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" href="<?= URL::to('Matriz/generalRisksMatrixView') ?>">
                    <img id="logo" src="<?= URL::to('assets/img/logo2.png') ?>"/>
                </a><br>
                <span style="color: white; margin-left: -4px;">Matriz de Riesgo - Claro</span>
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown">
                        <a class="dropdown">
                            <i class="fa fa-fw fa-bar-chart-o"></i> Mapas
                        </a>
                        <ul>
                            <li>
                                <a href="<?= URL::to('Matriz/gridRiesgosInherentes') ?>"><i class="fa fa-fw fa-line-chart"></i>&nbsp;&nbsp;Riesgos Inherentes</a>
                            </li>
                            <li>
                                <a href="<?= URL::to('Matriz/gridRiesgosResiduales') ?>"><i class="fa fa-fw fa-line-chart"></i>&nbsp;&nbsp;Riesgos Residuales</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">                    
                    <li class="dropdown">
                        <div class="">
                            <div id="divImg"><img id="imgRol" src="<?= URL::to('assets/img/' . Auth::getRole() . '.png') ?>"/></div>
                            <div id="infoUsu">
                                <span>
                                    <?php echo Auth::user()->n_nombre_usuario . ' ' . Auth::user()->n_apellido_usuario; ?><br>
                                    <?php echo Auth::getRole(); ?>
                                </span>
                            </div>
                        </div>
                        <ul class="m-t-20">
                            <li>
                                <a href="<?= URL::to('Matriz/generalRisksMatrixView') ?>"><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Home</a>
                            </li>
                            <li>
                                <a href="<?= URL::to('Matriz/listPlataforms') ?>"><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Plataformas</a>
                            </li>
                            <li>
                                <a href="<?= URL::to('Matriz/generalControlsView') ?>"><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Controles</a>
                            </li>
                            <li>
                                <a href="<?= URL::to('Matriz/generalRisksView') ?>"><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Riesgos</a>
                            </li>                            
                            <li>
                                <a href="<?= URL::to('Reports/downloadReportMatriz') ?>"><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Exportar Informe</a>
                            </li>
                            <li>
                                <a href="<?= URL::to('Matriz/listTratamiento') ?>"><i class="fa fa-fw fa-asterisk"></i>&nbsp;&nbsp;Tratamiento</a>
                            </li>
                            <li>
                                <a id="exitLink" href="<?= URL::to('Matriz/logout') ?>" /><i class="fa fa-fw fa-power-off"></i>&nbsp;&nbsp;Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<br>
<!--End Navigation -->
