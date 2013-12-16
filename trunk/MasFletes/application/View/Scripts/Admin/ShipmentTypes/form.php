<div class="well" >
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <?php
    if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php
    }
    if( is_null($view->dataRequest) )
        echo $view->Forms()->catalogForm("Nuevo Tipo de Carga","Tipo de carga","Descripci&oacute;n","Crear Tipo de Carga");
    else
        echo $view->Forms()->catalogForm("Editar Tipo de Carga","Tipo de carga","Descripci&oacute;n","Editar Tipo de Carga",$view->dataRequest);
    ?>
</div>