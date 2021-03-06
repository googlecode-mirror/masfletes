<?php /* @var $view Model3_View */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
        <meta charset="utf-8">
        <title>MasFletes.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="<?php echo $view->getBaseUrl(); ?>/js/application/date_spanish.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

        <!-- Le styles -->
        <link href="<?php echo $view->getBaseUrl(); ?>/bootstrap/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }

            .sidebar-nav {
                padding: 9px 0;
            }

            #contentWrapper {
                padding-top: 15px;
            }
            
            .error{
                color:#e9322d;
            }
        </style>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $view->getBaseUrl(); ?>/bootstrap/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $view->getBaseUrl(); ?>/bootstrap/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $view->getBaseUrl(); ?>/bootstrap/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $view->getBaseUrl(); ?>/bootstrap/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo $view->getBaseUrl(); ?>/bootstrap/ico/favicon.png">

        <?php
        $view->getCssManager()->loadCssFile('smart/smart.css');
        $view->getCssManager()->loadCss();
        
        if ($view->getJsManager()->hasJs())
        {
            $view->getJsManager()->loadJs();
        }
        ?>
    </head>

    <body>
        <div class="container">
            <div style="background: white;" >
                <?php
                echo '<img src="' . $view->getBaseUrl('/images/logo-masfletes.gif') . '" />'
                ?>
            </div>
        </div>
        <div id="menuWrapper">
            <div class="container" >
                <div class="navbar navbar-inverse">
                    <div class="navbar-inner">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse">
                            <p class="navbar-text pull-right">
                                <?php
                                $auth = new Model3_Auth();
                                ?>
                                <!--a href="#" class="navbar-link"><?php echo $auth->getCredentials('username');?></a-->
                                &nbsp;&nbsp;
                                <!--a href="<?php echo $view->getBaseUrl(); ?>/Index/index/logout/1" class="navbar-link">Salir</a-->
                                <a href="<?php echo $view->getBaseUrl(); ?>/Index/index/logout/1" class="navbar-link"><span class="icon-off"></span>&nbsp;Salir</a>
                            </p>
                            <ul class="nav">
                                <li><a href="<?php echo $view->url(array('module' => 'Customer')); ?>">Inicio</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cargas <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $view->url(array('controller' => 'Shipment', 'action' => 'index')); ?>">Listado</a></li>
                                        <li><a href="<?php echo $view->url(array('controller' => 'Shipment', 'action' => 'form')); ?>">Crear</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Rutas <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $view->url(array('controller' => 'Routes', 'action' => 'index')); ?>">Listado</a></li>
                                        <li><a href="<?php echo $view->url(array('controller' => 'Routes', 'action' => 'form')); ?>">Crear</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Operadores <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $view->url(array('controller' => 'Drivers', 'action' => 'index')); ?>">Listado</a></li>
                                        <li><a href="<?php echo $view->url(array('controller' => 'Drivers', 'action' => 'form')); ?>">Crear</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Unidades <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $view->url(array('controller' => 'Units', 'action' => 'index')); ?>">Listado</a></li>
                                        <li><a href="<?php echo $view->url(array('controller' => 'Units', 'action' => 'form')); ?>">Crear</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Notificaciones <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $view->url(array('controller' => 'Notifications', 'action' => 'index')); ?>">Listado</a></li>
                                        <li><a href="<?php echo $view->url(array('controller' => 'Notifications', 'action' => 'form')); ?>">Crear</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Eventos<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                         <li><a href="<?php echo $view->url(array('controller' => 'MyPanel', 'action' => 'index')); ?>">Eventos Recientes</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Perfil<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                         <li><a href="<?php echo $view->url(array('controller' => 'ConfigurationsEmail', 'action' => 'index')); ?>">Configuraciones</a></li>
                                    </ul>
                                </li>
<!--                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">MasFletes.com <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $view->url(array('action' => 'index')); ?>">Nosotros</a></li>
                                        <li><a href="<?php echo $view->url(array('action' => 'index')); ?>">Contacto</a></li>
                                        <li><a href="<?php echo $view->url(array('action' => 'index')); ?>">Enlaces</a></li>
                                    </ul>
                                </li>-->
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
            </div>
        </div>
        <div id="contentWrapper" style="background: #CACACA;">
            <div class="container">
                <?php echo $layoutdata; ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <hr>
                <footer>
                    <p>&copy; MasFletes 2013</p>
                </footer>
            </div>
        </div>

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo $view->getBaseUrl(); ?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo $view->getBaseUrl(); ?>/js/application/jquery.validate.min.js"></script>
    </body>
    
    <!--Start of Zopim Live Chat Script--> <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){ z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
    $.src='//v2.zopim.com/?20RNZxvZHQi8kraQHhgTBLxCUqAtAzqO';z.t=+new Date;$.
    type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
    </script> <!--End of Zopim Live Chat Script-->
</html>
