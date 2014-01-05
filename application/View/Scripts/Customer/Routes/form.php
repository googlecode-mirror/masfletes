<div class="well">
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <h3><?php echo is_null($view->dataRequest) ? "Crear" : "Editar"; ?> Ruta</h3>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php } ?>
    <form method="post" name="RouteFrm" id="RouteFrm" role="form">
        <div class="row">
            <div class="span11 last">
                <fieldset>
                    <legend>Informaci&oacute;n de la Ruta</legend>
                </fieldset>
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
            
            <div class="span4">
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
            
            <div class="span3 last">
                <div class="form-group">
                    <label class="control-label" for="startDate">Fecha de disponibilidad</label>
                    <div class="controls">
                        <input type="text" id="startDate" name="startDate" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getLoadAvailabilityDate()->format('Y-m-d')); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="effectiveDays">D&iacute;as de vigencia</label>
                    <div class="controls">
                        <input type="text" name="effectiveDays" id="effectiveDays" placeholder="Dias de vigencia" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getEffectiveDays()); ?>" />
                    </div>
                </div>
            </div>
            
            <div class="span4 last">
                <div class="form-group">
                    <label class="control-label" for="frequency">Frecuencia</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'frequency', 'id' => 'frequency'),
                                array('1' => 'Ninguna', '2' => 'Eventual', '3' => 'Diario',
                                      '4' => 'Semanal', '5' => '1 a 5 por semana', '6' => 'Quincenal',
                                      '7' => 'Mensual'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getFrequency()));
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="span11 last">
                <fieldset>
                    <legend>Informaci&oacute;n del Veh&iacute;culo</legend>
                </fieldset>
            </div>
            
            <div class="span4">
                <div class="form-group">
                    <label class="control-label" for="vehicleCB">Veh&iacute;culo</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectCatalogTypes('Vehicle',array('name' => 'vehicleCB', 'id' => 'vehicleCB'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getVehicle()->getId())); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="vehicleTypeCB">Tipo de veh&iacute;culo</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectCatalogTypes('VehicleType',array('name' => 'vehicleTypeCB', 'id' => 'vehicleTypeCB'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getVehicleType()->getId())); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="unit">Unidad Propia (Si ya esta registrada)</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'unit', 'id' => 'unit'), 
                                $view->units,(is_null($view->dataRequest) ? "" : $view->dataRequest->getUnit()->getId()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="driver">Operador (Si ya esta registrado)</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'driver', 'id' => 'driver'), 
                                $view->drivers,(is_null($view->dataRequest) ? "" : $view->dataRequest->getDriver()->getId()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="driverPhone">N&uacute;mero celular</label>
                    <div class="controls">
                        <input type="text" name="driverPhone" id="driverPhone" placeholder="N&uacute;mero celular" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getCellularPhone()); ?>" />
                    </div>
                </div>
            </div>
            
            <div class="span4">
                <div class="form-group">
                    <label class="control-label" for="email">Correo electr&oacute;nico</label>
                    <div class="controls">
                        <input type="text" name="email" id="email" placeholder="Correo electr&oacute;nico" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getEmail()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="availableUnits">Unidades disponibles</label>
                    <div class="controls">
                        <input type="text" name="availableUnits" id="availableUnits" placeholder="Unidades disponibles" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getEffectiveDays()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="tireCondition">Condici&oacute;n de las Llantas</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'tireCondition', 'id' => 'tireCondition'),
                                array('1' => 'Buena','2' => 'Media', '3' => 'Mala'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getTiresCondition()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="mechanicalCondition">Condiciones Mec&aacute;nicas</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'mechanicalCondition', 'id' => 'mechanicalCondition'),
                                array('1' =>'Buena','2'=>'Media','3'=>'Mala'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getLetterMechanicalConditions()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="activePlates">Placas Federales Vigentes</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'activePlates', 'id' => 'activePlates'),
                                array('1' => 'Si','2' => 'No'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getPlates()));
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="span3 last">
                <div class="form-group">
                    <label class="control-label" for="activeLicense">Licencia Federal Vigente</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'activeLicense', 'id' => 'activeLicense'),
                                array('1' =>'Si','2'=>'No'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getDriverLicence()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="tarpaulin">Lona</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'tarpaulin', 'id' => 'tarpaulin'),
                                array('1' => 'Si','2' => 'No'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getOwnTarpaulin()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="satelitalTracking">Rastreo satelital</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'satelitalTracking', 'id' => 'satelitalTracking'),
                                array('1' => 'Si','2' => 'No'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getSatelitalTracking()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="letterCarry">Carta porte n&uacute;mero</label>
                    <div class="controls">
                        <input type="text" name="letterCarry" id="letterCarry" placeholder="Carta porte n&uacute;mero" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getLetters_carry()); ?>" />
                    </div>
                </div>
            </div>
            
            <div class="span11 last">
                <div class="form-group">
                    <label class="control-label" for="comments">Comentarios</label>
                    <div class="controls">
                        <textarea style="width:100%;" id="comments" name="comments" class="form-control" cols="30" rows="3" placeholder="Comentarios"><?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getComments()); ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="span11 last">
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit"><?php echo is_null($view->dataRequest) ? "Guardar" : "Editar"; ?> Ruta</button>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>

<script type="text/javascript">
$(function(){
    $("#startDate").datepicker({
        dateFormat: "yy-mm-dd"
    });
    
    $("#RouteFrm").validate({
        rules:{
            tireCondition:"required",
            mechanicalCondition:"required",
            activePlates:"required",
            activeLicense:"required",
            tarpaulin:"required",
            satelitalTracking:"required",
            driverPhone:"required",
            frequency:"required",
            letterCarry:"required",
            effectiveDays:{required:true, digits:true},
            vehicleTypeCB:"required",
            vehicleCB:"required",
            sourceStateCity:"required",
            destinyStateCity:"required",
            sourceState:"required",
            destinyState:"required",
            startDate:"required"
        },
        messages:{
            tireCondition:"Campo requerido",
            mechanicalCondition:"Campo requerido",
            activePlates:"Campo requerido",
            activeLicense:"Campo requerido",
            tarpaulin:"Campo requerido",
            satelitalTracking:"Campo requerido",
            driverPhone:"Campo requerido",
            frequency:"Campo requerido",
            letterCarry:"Campo requerido",
            effectiveDays:{
                required:"Campo requerido",
                digits:"Solo n&uacute;meros"
            },
            vehicleTypeCB:"Campo requerido",
            vehicleCB:"Campo requerido",
            sourceStateCity:"Campo requerido",
            destinyStateCity:"Campo requerido",
            sourceState:"Campo requerido",
            destinyState:"Campo requerido",
            startDate:"Campo requerido"
        }
   });
});
</script>