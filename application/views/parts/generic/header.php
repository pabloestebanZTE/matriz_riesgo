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
                <a class="logo" href="<?= URL::to('index.php/Matriz/generalRisksMatrixView') ?>">
                    <img id="logo" src="<?= URL::to('assets/img/logo2.png') ?>"/>
                </a>
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div>
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
                                <a href="<?= URL::to('index.php/Matriz/generalRisksMatrixView') ?>"><i class="fa fa-fw fa-home"></i>&nbsp;&nbsp;Home</a>
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
