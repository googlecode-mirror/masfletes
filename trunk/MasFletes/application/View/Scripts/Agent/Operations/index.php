<div class="row">
    <div class="span3">
        <div class="well">
            <h3>Busqueda</h3>
            <form name="frmSearch" id="frmSearch" method="post" class="frmSearch">
                <input type="hidden" name="identity" value="Operation" />
                <div>Carga</div>
                <div>
                    <select id="shipment" name="shipment" style="width: 100%;">
                        <option value="">Seleccionar</option>
                        <?php foreach($view->shipments as $row){ ?>
                            <option value="<?php echo $row->getId(); ?>">
                                #<?php echo $row->getId(); ?>, 
                                <?php echo utf8_decode($row->getMunicipalityOrigin()->getName()); ?>
                                (<?php echo utf8_decode($row->getStateOrigin()->getName()); ?>) >> 
                                <?php echo utf8_decode($row->getMunicipalityDestiny()->getName()); ?>
                                (<?php echo utf8_decode($row->getStateDestiny()->getName()); ?>)
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>Ruta</div>
                <div>
                    <select id="route" name="route" style="width: 100%;">
                            <option value="">Seleccionar</option>
                            <?php foreach($view->routes as $row){ ?>
                            <option value="<?php echo $row->getId(); ?>">
                                #<?php echo $row->getId(); ?>, 
                                <?php echo utf8_decode($row->getMunicipalityOrigin()->getName()); ?>
                                (<?php echo utf8_decode($row->getStateOrigin()->getName()); ?>) >> 
                                <?php echo utf8_decode($row->getMunicipalityDestiny()->getName()); ?>
                                (<?php echo utf8_decode($row->getStateDestiny()->getName()); ?>)
                            </option>
                            <?php } ?>
                        </select>
                </div>
                <div>Status</div>
                <div>
                    <?php echo $view->Forms()->selectHtml(
                                array('name' => 'status', 'id' => 'status'),
                                array('1' => 'Si','2' => 'En proceso', '3' => 'No'));
                        ?>
                </div>                
                <div>Fecha Inicio</div>
                <div>
                    <input type="text" id="fechaIniTF" name="fechaIniTF" value="" />
                </div>
                <div>Fecha Final</div>
                <div>
                    <input type="text" id="fechaFinTF" name="fechaFinTF" value="" />
                </div>
                <div align='center'>
                    <button name="searchBtn" id="searchBtn" class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="span9">
        <div class="well" id="panelmain">
            <h3>Listado de operaciones</h3>
             <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">×</a>
                    <?php echo $resp; ?>
                </div>
            <?php } ?>
            <div class="content_main">
                <?php $view->Operations()->renderTable($view->operations); ?>
            </div>
        </div>
        
        <div class="well" id="details" style="display: none;">
            <h3>Detalle de la operaci&oacute;n:</h3>
            <div class="details">
            </div>
            <div class="control-group">
                <div class="controls" align="right">
                    <button class="btn btn-primary" type="button" id="closeDetails">Regresar</button>
                </div>
            </div>
        </div>
    </div>
</div>