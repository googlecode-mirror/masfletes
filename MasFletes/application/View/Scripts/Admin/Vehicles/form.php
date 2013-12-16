<div class="well" >
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <?php
    if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php
    }
    ?>
        <form method="post" name="addVehicleFrm" id="addVehicleFrm" class="form-horizontal">
        <fieldset>
            <legend><?php echo (is_null($view->dataRequest) ? "Alta de" : "Editar") ?> Veh&iacute;culo</legend>
        </fieldset>
        
        <div class="control-group">
            <label class="control-label" for="nameTF">Nombre</label>
            <div class="controls">
              <input type="text" id="nameTF" name="nameTF" placeholder="Nombre del vehículo" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getName()); ?>">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="descriptionTF">Descripción</label>
            <div class="controls">
              <input type="text" id="descriptionTF" name="descriptionTF" placeholder="Descripción" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getDescription()); ?>" >
            </div>
        </div>
            
        <div class="control-group">
            <label class="control-label" for="capacidadTF">Capacidad</label>
            <div class="controls">
                <input type="text" style="width:100px;" id="capacidadTF" name="capacidadTF" placeholder="Capacidad" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getCapacity()); ?>">&nbsp;tons.
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" type="submit"><?php echo (is_null($view->dataRequest) ? "Crear" : "Editar") ?> Vehículo</button>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo $view->getBaseUrl(); ?>/js/application/admin/vehicle/vehicles.js"></script>