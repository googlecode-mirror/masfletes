<div class="well" >
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php }
    if( is_null($view->dataRequest) )
        echo $view->Forms()->catalogForm("Nuevo Tipo de Operaci&oacute;n","Tipo de operaci&oacute;n","Descripci&oacute;n","Crear Tipo de Operaci&oacute;n");
    else
        echo $view->Forms()->catalogForm("Editar Tipo de Operaci&oacute;n","Tipo de operaci&oacute;n","Descripci&oacute;n","Editar Tipo de Operaci&oacute;n",$view->dataRequest);
    ?>
</div>