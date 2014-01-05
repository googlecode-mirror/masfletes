<div class="well">
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <h3><?php echo is_null($view->dataRequest) ? "Crear" : "Editar"; ?> Operaci&oacute;n</h3>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php } ?>
      
    <form method="post" name="OperationFrm" id="OperationFrm" role="form">
        <div class="row">
            <div class="span11 last">
                <fieldset>
                    <legend>Informaci&oacute;n de la operaci&oacute;n</legend>
                </fieldset>
            </div>
            
            <div class="span11 last">
                <div class="form-group">
                    <label class="control-label" for="shipment">Carga</label>
                    <div class="controls">
                        <select id="shipment" name="shipment" style="width: 100%;">
                            <option value="">Seleccionar</option>
                            <?php foreach($view->shipments as $row){ ?>
                            <option value="<?php echo $row->getId(); ?>" <?php echo (is_null($view->dataRequest) ? "" : ( ($view->dataRequest->getShipment()->getId() == $row->getId()) ? 'selected="selected"' : "" ) )?> >
                                #<?php echo $row->getId(); ?>, 
                                <?php echo utf8_decode($row->getMunicipalityOrigin()->getName()); ?>
                                (<?php echo utf8_decode($row->getStateOrigin()->getName()); ?>) >> 
                                <?php echo utf8_decode($row->getMunicipalityDestiny()->getName()); ?>
                                (<?php echo utf8_decode($row->getStateDestiny()->getName()); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="span11 last">
                <div class="form-group">
                    <label class="control-label" for="sourceStateCity">Ruta</label>
                    <div class="controls">
                        <select id="route" name="route" style="width: 100%;">
                            <option value="">Seleccionar</option>
                            <?php foreach($view->routes as $row){ ?>
                            <option value="<?php echo $row->getId(); ?>" <?php echo (is_null($view->dataRequest) ? "" : ( ($view->dataRequest->getRoute()->getId() == $row->getId()) ? 'selected="selected"' : "" ) )?>>
                                #<?php echo $row->getId(); ?>, 
                                <?php echo utf8_decode($row->getMunicipalityOrigin()->getName()); ?>
                                (<?php echo utf8_decode($row->getStateOrigin()->getName()); ?>) >> 
                                <?php echo utf8_decode($row->getMunicipalityDestiny()->getName()); ?>
                                (<?php echo utf8_decode($row->getStateDestiny()->getName()); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="span3 last">
                <div class="form-group">
                    <label class="control-label" for="operationDate">Fecha de operaci&oacute;n</label>
                    <div class="controls">
                        <input type="text" id="operationDate" name="operationDate" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getOperationDate()->format('Y-m-d')); ?>" />
                    </div>
                </div>
            </div>
            
            <div class="span11 last">
                
            </div>
            
            <div class="span4">
                <div class="form-group">
                    <label class="control-label" for="costo">Costo de flete</label>
                    <div class="controls">
                        <input type="text" name="costo" id="costo" placeholder="Costo de flete" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getCost()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="comision">Comisi&oacute;n de enviador</label>
                    <div class="controls">
                        <input type="text" name="comision" id="comision" placeholder="Comisi&oacute;n de enviador" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getCostoEnviador()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="maniobras">Maniobras</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'maniobras', 'id' => 'maniobras'),
                                array('1' => 'Si','2' => 'No'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getManiobras()));
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="opectr">Comisi&oacute;n transportista</label>
                    <div class="controls">
                        <input type="text" name="opectr" id="opectr" placeholder="Comisi&oacute;n transportista" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getCostoTrans()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="opeseg">Seguro de carga</label>
                    <div class="controls">
                        <input type="text" name="opeseg" id="opeseg" placeholder="Seguro de carga" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getSeguro()); ?>" />
                    </div>
                </div>
            </div>
            
            <div class="span4">
                <div class="form-group">
                    <label class="control-label" for="opecus">Custodia</label>
                    <div class="controls">
                        <input type="text" name="opecus" id="opecus" placeholder="Custodia" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getCustodia()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="operpe">Referencia pago enviador</label>
                    <div class="controls">
                        <input type="text" name="operpe" id="operpe" placeholder="Referencia pago enviador" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getRefEnviador()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="operpt">Referencia pago transportista</label>
                    <div class="controls">
                        <input type="text" name="operpt" id="operpt" placeholder="Referencia pago transportista" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getRefTrans()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="opecae">Cal. Enviador</label>
                    <div class="controls">
                        <input type="text" name="opecae" id="opecae" placeholder="Cal. Enviador" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getCalEnviador()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="opecat">Cal. Transportista</label>
                    <div class="controls">
                        <input type="text" name="opecat" id="opecat" placeholder="Cal. Transportista" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getCalTrans()); ?>" />
                    </div>
                </div>
            </div>
            
            <div class="span3 last">
                <div class="form-group">
                    <label class="control-label" for="opein1">Indicador del Transportista</label>
                    <div class="controls">
                        <input type="text" name="opein1" id="opein1" placeholder="Indicador del Transportista" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getIndTrans()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="opein2">Indicador del Enviador</label>
                    <div class="controls">
                        <input type="text" name="opein2" id="opein2" placeholder="Indicador del Enviador" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getIndEnviador()); ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="status">Cerrada</label>
                    <div class="controls">
                        <?php echo $view->Forms()->selectHtml(
                                array('name' => 'status', 'id' => 'status'),
                                array('1' => 'Si','2' => 'En proceso', '3' => 'No'),
                                (is_null($view->dataRequest) ? "" : $view->dataRequest->getStatus()));
                        ?>
                    </div>
                </div>
                
            </div>
            <div class="span11 last">
                <div class="form-group">
                    <label class="control-label" for="docs">Documentaci&oacute;n</label>
                    <div class="controls">
                        <textarea style="width:100%;" id="docs" name="docs" class="form-control" cols="30" rows="3" placeholder="Documentaci&oacute;n"><?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getDocuments()); ?></textarea>
                    </div>
                </div>
            </div>
           <div class="span11 last">
                <div class="form-group">
                    <label class="control-label" for="comments">Comentario</label>
                    <div class="controls">
                        <textarea style="width:100%;" id="comments" name="comments" class="form-control" cols="30" rows="3" placeholder="Comentarios"><?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getComments()); ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="span11 last">
                <div class="control-group">
                    <div class="controls">
                        <button class="btn btn-primary" type="submit"><?php echo is_null($view->dataRequest) ? "Guardar" : "Editar"; ?> Operaci&oacute;n</button>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</div>

<script type="text/javascript">
$(function(){
    $("#operationDate").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $("#OperationFrm").validate({
        rules:{
            shipment:"required",
            route:"required",
            operationDate:"required",
            status:"required",
            maniobras:"required",
            comision:{
                digits:true
            },
            opectr:{
                digits:true
            },
            opeseg:{
                digits:true
            },
            costo:{
                required:true,
                digits:true
            }
        },
        messages:{
            shipment:"Campo requerido",
            route:"Campo requerido",
            maniobras:"Campo requerido",
            operationDate:"Campo requerido",
            status:"Campo requerido",
            comision:{
                digits:"Solo números"
            },
            opectr:{
                digits:"Solo números"
            },
            opeseg:{
                digits:"Solo números"
            },
            costo:{
                required:"Campo requerido",
                digits:"Solo números"
            }
        }
   });
});
</script>
