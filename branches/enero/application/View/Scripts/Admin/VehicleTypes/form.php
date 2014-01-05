<div class="well" >
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <?php
    if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php
    }
    if( is_null($view->dataRequest) )
        echo $view->Forms()->catalogForm("Nuevo Tipo de Veh&iacute;culo","Tipo de veh&iacute;culo","Descripci&oacute;n","Crear Tipo de Veh&iacute;culo");
    else
        echo $view->Forms()->catalogForm("Editar Tipo de Veh&iacute;culo","Tipo de veh&iacute;culo","Descripci&oacute;n","Editar Tipo de Veh&iacute;culo",$view->dataRequest);
    ?>
</div>