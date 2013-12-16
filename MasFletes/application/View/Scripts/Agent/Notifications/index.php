<div class="row">
    <div class="span3">
        <div class="well">
            <h3>Busqueda</h3>
            <form name="frmSearch" id="frmSearch" method="post" class="frmSearch">
                <input type="hidden" name="identity" value="Notification" />
                <div>Estado Origen</div>
                <div>
                    <?php echo $view->Forms()->selectStates(array('id' => 'edosOrigen', 'name' => 'edosOrigen', 'class' => 'selState')); ?>
                </div>
                <div>Municipio Origen</div>
                <div>
                    <select name="edosOrigenCity" id="edosOrigenCity"></select>
                </div>
                <div>Estado Destino</div>
                <div>
                    <?php echo $view->Forms()->selectStates(array('id' => 'edosDestino', 'name' => 'edosDestino', 'class' => 'selState')); ?>
                </div>
                <div>Municipio Destino</div>
                <div>
                    <select name="edosDestinoCity" id="edosDestinoCity"></select>
                </div>
                <div>Veh&iacute;culo</div>
                <div>
                    <?php echo $view->Forms()->selectCatalogTypes('Vehicle',array('name' => 'vehicle', 'id' => 'vehicle')); ?>
                </div>
                <!--<div>Fecha Inicio</div>
                <div>
                    <input type="date" id="fechaIniTF" name="fechaIniTF" />
                </div>
                <div>Fecha Final</div>
                <div>
                    <input type="date" id="fechaFinTF" name="fechaFinTF" />
                </div>-->
                <div align='center'>
                    <button name="searchBtn" id="searchBtn" class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="span9">
        <div class="well" id="panelmain">
            <h3>Listado de notificaciones</h3>
            <div class="content_main">
                <?php $view->Notifications()->renderTable($view->notifications); ?>
            </div>
        </div>
        
        <div class="well" id="details" style="display: none;">
            <h3>Detalle de la notificaci&oacute;n:</h3>
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