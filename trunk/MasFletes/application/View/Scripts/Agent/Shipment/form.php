<div class="well">
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <h3><?php echo is_null($view->dataRequest) ? "Crear" : "Editar"; ?> Carga</h3>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php } ?>
    <form method="post" name="addShipmentFrm" id="addShipmentFrm" role="form">
        <div class="row">
            <div class="span11 last">
                <fieldset>
                    <legend>Informaci&oacute;n del origen / destino de la carga</legend>
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
                
                <div class="form-group">
                    <label class="control-label" for="sourceAddress">Direcci&oacute;n de la carga</label>
                    <div class="controls">
                        <textarea id="sourceAddress" name="sourceAddress" class="form-control" cols="30" rows="3" placeholder="Direcci&oacute;n de la carga"><?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getSourceAddress()); ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="sourceDate">Fecha de carga</label>
                    <div class="controls">
                        <input type="text" id="sourceDate" name="sourceDate" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getSourceDate()->format('Y-m-d')); ?>" />
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
                
                <div class="form-group">
                    <label class="control-label" for="destinyAddress">Direcci&oacute;n de entrega</label>
                    <div class="controls">
                        <textarea id="destinyAddress" name="destinyAddress" class="form-control" cols="30" rows="3" placeholder="Direcci&oacute;n de entrega"><?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getDestinyAddress()); ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="destinyDate">Fecha destino</label>
                    <div class="controls">
                        <input type="text" id="destinyDate" name="destinyDate" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getDestinyDate()->format('Y-m-d')); ?>" />
                    </div>
                </div>
            </div>
            
            <div class="span3 last">
                
                <div class="form-group">
                    <label class="control-label" for="effectiveDays">D&iacute;as de vigencia</label>
                    <div class="controls">
                        <input type="text" name="effectiveDays" id="effectiveDays" placeholder="Días de vigencia" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getEffectiveDays()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="deliveryCities">Ciudades de reparto</label>
                    <div class="controls">
                        <select name="deliveryCities" id="deliveryCities">
                            <option value="" >Seleccionar</option>
                            <option value="1" >No</option>
                            <option value="2" >Si</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="deliveryCount">N&uacute;mero de repartos</label>
                    <div class="controls">
                        <input type="text" name="deliveryCount" id="effectiveDays" placeholder="N&uacute;mero de repartos" />
                    </div>
                </div>
            </div>
            <div class="span11 last">&nbsp;</div>
            
            <div class="span11 last">
                <fieldset>
                    <legend>Informaci&oacute;n del veh&iacute;culo</legend>
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
                    <label class="control-label" for="unitCountTF">Unidades requeridas</label>
                    <div class="controls">
                        <input type="text" name="unitCountTF" id="unitCountTF" placeholder="Unidades requeridas" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="shipmentTypeCB">Tipo de carga</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectCatalogTypes('ShipmentType',array('name' => 'shipmentTypeCB', 'id' => 'shipmentTypeCB'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getShipmentType()->getId())); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="operationTypeCB">Tipo de operaci&oacute;n</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectCatalogTypes('OperationType',array('name' => 'operationTypeCB', 'id' => 'operationTypeCB')); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="packingTypeCB">Tipo de empaque</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectCatalogTypes('PackingType',array('name' => 'packingTypeCB', 'id' => 'packingTypeCB')); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="frequency">Frecuencia</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'frequency', 'id' => 'frequency'),
                                array('1' => 'Ninguna', '2' => 'Eventual', '3' => 'Diario',
                                      '4' => 'Semanal', '5' => '1 a 5 por semana', '6' => 'Quincenal',
                                      '7' => 'Mensual'),(is_null($view->dataRequest) ? "" : $view->dataRequest->getFrequency()));
                        ?>
                    </div>
                </div>  
                
            </div>
            
            <div class="span4">
                <div class="form-group">
                    <label class="control-label" for="dimenciones">Dimensiones</label>
                    <div class="controls">
                        <input type="text" name="dimenciones" id="dimenciones" placeholder="Largo x Ancho x Alto" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="cantidad">Cantidad</label>
                    <div class="controls">
                        <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="tonnage">Tonelaje</label>
                    <div class="controls">
                        <input type="text" name="tonnage" id="tonnage" placeholder="Tonelaje" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="estimatedValue">Valor estimado</label>
                    <div class="controls">
                        <input type="text" name="estimatedValue" id="estimatedValue" placeholder="Valor estimado" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="travelCost">Casetas</label>
                    <div class="controls">
                        <input type="text" name="travelCost" id="travelCost" style="width:110px;" placeholder="Valor de casetas" />
                        <a href="http://aplicaciones4.sct.gob.mx/sibuac_internet/ControllerUI?action=cmdEscogeRuta" onclick="window.open(this.href, 'window', 'params');
                            return false">Cotizar casetas</a>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="stayDays">D&iacute;as de estad&iacute;a</label>
                    <div class="controls">
                        <input type="text" name="stayDays" id="stayDays" placeholder="D&iacute;as de estadía" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="distance">Kilometraje</label>
                    <div class="controls">
                        <input type="text" name="distance" id="distance" placeholder="Kilometraje" />
                    </div>
                </div>
            </div>
            
            <div class="span3 last">
                <div class="form-group">
                    <label class="control-label" for="other">Otros</label>
                    <div class="controls">
                        <textarea style="width:100%;" id="other" name="other" class="form-control" cols="30" rows="3" placeholder="Otros"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="other">Documentaci&oacute;n</label>
                    <div class="controls">
                        <textarea style="width:100%;" id="documentation" name="documentation" class="form-control" cols="30" rows="3" placeholder="Documentaci&oacute;n"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="closed">Cerrada</label>
                    <label class="checkbox">
                        <input type="checkbox" name="closed" id="closed">
                    </label>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="other">Requiere maniobras especiales</label>
                    <div class="controls">
                        <input type="checkbox" id="inlineCheckbox1" value="option1">
                    </div>
                </div>                
            </div>
            
            <div class="span11 last">
                <div class="form-group">
                    <label class="control-label" for="comments">Comentarios</label>
                    <div class="controls">
                        <textarea style="width:100%;" id="comments" name="comments" class="form-control" cols="30" rows="3" placeholder="Comentarios"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="span11 last">
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit"><?php echo is_null($view->dataRequest) ? "Guardar" : "Editar"; ?> Carga</button>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>
<script type="text/javascript">
$(function(){
    $("#sourceDate").datepicker({
        dateFormat: "yy-mm-dd",
        onClose:function(selectedDate){
            $("#destinyDate").datepicker("option","minDate",selectedDate)
        }
    });
    
    $("#destinyDate").datepicker({
        dateFormat: "yy-mm-dd",
        onClose:function(selectedDate){
            $("#sourceDate").datepicker("option","maxDate",selectedDate)
        }
    });
    
    $("#addShipmentFrm").validate({
        rules:{
            frequency:"required",
            effectiveDays: { required : true, digits:true },
            sourceDate:"required",
            destinyDate:"required",
            sourceAddress:"required",
            destinyAddress:"required",
            sourceState:"required",
            sourceStateCity:"required",
            destinyState:"required",
            destinyStateCity:"required",
            vehicleCB:"required",
            vehicleTypeCB:"required",
            shipmentTypeCB:"required"
        },
        messages:{
            frequency:"Campo requerido",
            effectiveDays:{
                required:"Campo requerido",
                digits:"Solo dígitos"
            },
            sourceDate:"Campo requerido",
            destinyDate:"Campo requerido",
            sourceAddress:"Campo requerido",
            destinyAddress:"Campo requerido",
            sourceState:"Campo requerido",
            sourceStateCity:"Campo requerido",
            destinyState:"Campo requerido",
            destinyStateCity:"Campo requerido",
            vehicleCB:"Campo requerido",
            vehicleTypeCB:"Campo requerido",
            shipmentTypeCB:"Campo requerido"
        }
   });
});
</script>