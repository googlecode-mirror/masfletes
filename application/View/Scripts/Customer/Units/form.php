<div class="well" >
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php } ?>
    <form method="post" name="catFrm" id="catFrm" class="form-horizontal">
        <fieldset>
            <legend><?php echo is_null($view->dataRequest) ? "Crear" : "Editar"?> Unidad</legend>
        </fieldset>
        
        <div class="control-group">
            <label class="control-label" for="plates">Placas</label>
            <div class="controls">
              <input type="text" id="plates" name="plates" placeholder="Placas" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getPlates() ); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="economicNumber">N&uacute;mero Econ&oacute;mico</label>
            <div class="controls">
              <input type="text" id="economicNumber" name="economicNumber" placeholder="N&uacute;mero Econ&oacute;mico" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getEconomicNumber() ); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="brand">Marca</label>
            <div class="controls">
              <input type="text" id="brand" name="brand" placeholder="Marca" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getBrand() ); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="model">Modelo</label>
            <div class="controls">
              <input type="text" id="model" name="model" placeholder="Modelo" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getModel() ); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="color">Color</label>
            <div class="controls">
              <input type="text" id="color" name="color" placeholder="Color" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getColor() ); ?>" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label" for="vehicle">Veh&iacute;culo</label>
            <div class="controls">
                <?php echo $view->Forms()->selectCatalogTypes('Vehicle',array('name' => 'vehicle', 'id' => 'vehicle'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getVehicle()->getId())); ?>
            </div>
        </div>
        <br />
        <div class="form-group">
            <label class="control-label" for="vehicleType">Tipo de veh&iacute;culo</label>
            <div class="controls">
                <?php echo $view->Forms()->selectCatalogTypes('VehicleType',array('name' => 'vehicleType', 'id' => 'vehicleType'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getVehicleType()->getId())); ?>
            </div>
        </div>
        <br />
        <div class="form-group">
            <label class="control-label" for="comments">Comentarios</label>
            <div class="controls">
                <textarea id="comments" name="comments" class="form-control" cols="30" rows="3" placeholder="Commentarios"><?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getComments()); ?></textarea>
            </div>
        </div>
        <br />
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" type="submit">Guardar Unidad</button>
            </div>
        </div>
    </form>
        
    <script type="text/javascript">
        $(function(){
            $("#catFrm").validate({
                rules:{
                    plates:"required",
                    economicNumber:"required",
                    brand:"required",
                    color:"required",
                    vehicle:"required",
                    vehicleType:"required"
                },
                messages:{
                    plates:"Campo requerido",
                    economicNumber:"Campo requerido",
                    brand:"Campo requerido",
                    color:"Campo requerido",
                    vehicle:"Campo requerido",
                    vehicleType:"Campo requerido"
                }
            });
        });
    </script>    
</div>