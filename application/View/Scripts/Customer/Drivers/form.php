<div class="well" >
    <a href="<?php echo $view->url(array('action' => 'index')); ?>">Volver</a>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php } ?>
    <form method="post" name="catFrm" id="catFrm" class="form-horizontal">
        <fieldset>
            <legend><?php echo is_null($view->dataRequest) ? "Crear" : "Editar"?> Operador</legend>
        </fieldset>
        
        <div class="control-group">
            <label class="control-label" for="nameTF">Nombre completo</label>
            <div class="controls">
              <input type="text" id="nameTF" name="nameTF" placeholder="Nombre completo" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getName() ); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="licence">Licencia federal</label>
            <div class="controls">
              <input type="text" id="licence" name="licence" placeholder="Licencia federal" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getLicence() ); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="licenceDuration">Vigencia de licencia federal</label>
            <div class="controls">
              <input type="text" name="licenceDuration" id="licenceDuration" value="<?php echo (is_null($view->dataRequest) ? "" : $view->dataRequest->getLicenceDuration()->format('Y-m-d')); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" type="submit">Guardar operador</button>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        $(function(){
            $("#licenceDuration").datepicker({
                dateFormat: "yy-mm-dd"
            });
            $("#catFrm").validate({
                rules:{
                    nameTF:"required",
                    licence:"required",
                    licenceDuration:"required"
                },
                messages:{
                    nameTF:"Campo requerido",
                    licence:"Campo requerido",
                    licenceDuration:"Campo requerido"
                }
            });
        });
    </script>    
</div>