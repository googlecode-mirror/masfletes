<div class="well">
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <h3><?php echo is_null($view->dataRequest) ? "Crear" : "Editar"; ?> Notificaci&oacute;n</h3>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php } ?>
      
    <form method="post" name="NotificationsFrm" id="NotificationsFrm" role="form">
        <div class="row">
            <div class="span11 last">
                <fieldset>
                    <legend>Informaci&oacute;n de la notificaci&oacute;n</legend>
                </fieldset>
            </div>
            
            <div class="span3">
                
                <div class="form-group">
                    <label class="control-label" for="actionType">Tipo de notificaci&oacute;n</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'actionType', 'id' => 'actionType'),
                                array('1' => 'Carga','2' => 'Ruta'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getActionType()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="vehicle">Veh&iacute;culo</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectCatalogTypes('Vehicle',array('name' => 'vehicle', 'id' => 'vehicle'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getVehicle()->getId())); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="vehicleType">Tipo de veh&iacute;culo</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectCatalogTypes('VehicleType',array('name' => 'vehicleType', 'id' => 'vehicleType'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getVehicleType()->getId())); ?>
                    </div>
                </div>
                
            </div>
            
            <div class="span4">
                
                <div class="form-group">
                    <label class="control-label" for="sourceState">Estado de origen</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectStates(array('id' => 'sourceState', 'name' => 'sourceState', 'class' => 'selState'), (is_null($view->dataRequest) ? "" : $view->dataRequest->getStateOrigin()->getId()) ); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="sourceStateCity">Municipio de origen</label>
                    <div class="controls">
                        <?php if( is_null($view->dataRequest) ){ ?>
                            <select id="sourceStateCity" name="sourceStateCity">
                            </select>
                        <?php }else{ 
                            echo $view->Forms()->selectCitys($view->dataRequest->getStateOrigin()->getId(), 
                                 array('name' => 'sourceStateCity', 'id' => 'sourceStateCity'),
                                 $view->dataRequest->getMunicipalityOrigin()->getId());
                        }
                        ?>
                    </div>
                </div>
                
            </div>
            
            <div class="span4 last">
                
                <div class="form-group">
                    <label class="control-label" for="destinyState">Estado destino</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectStates(array('id' => 'destinyState', 'name' => 'destinyState', 'class' => 'selState'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getStateDestiny()->getId())); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="destinyStateCity">Municipio destino</label>
                    <div class="controls">
                        <?php if( is_null($view->dataRequest) ){ ?>
                        <select id="destinyStateCity" name="destinyStateCity" >
                        </select>
                        <?php }else{ 
                            echo $view->Forms()->selectCitys($view->dataRequest->getStateDestiny()->getId(), 
                                 array('name' => 'destinyStateCity', 'id' => 'destinyStateCity'),
                                 $view->dataRequest->getMunicipalityDestiny()->getId());
                        }
                        ?>
                    </div>
                </div>
                
            </div>
            
            <div class="span11 last">
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit"><?php echo is_null($view->dataRequest) ? "Guardar" : "Editar"; ?> Notificaci&oacute;n</button>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>

<script type="text/javascript">
$(function(){
    $("#NotificationsFrm").validate({
        rules:{
            actionType:"required",
            vehicle:"required",
            vehicleType:"required",
            sourceState:"required",
            sourceStateCity:"required",
            destinyState:"required",
            destinyStateCity:"required"
        },
        messages:{
            actionType:"Campo requerido",
            vehicle:"Campo requerido",
            vehicleType:"Campo requerido",
            sourceState:"Campo requerido",
            sourceStateCity:"Campo requerido",
            destinyState:"Campo requerido",
            destinyStateCity:"Campo requerido"
        }
   });
});
</script>