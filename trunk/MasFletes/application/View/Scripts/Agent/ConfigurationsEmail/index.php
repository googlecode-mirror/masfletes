<div class="well">
    <table class="table table-hover"> 
    <tr>
        <td><img src="<?php echo $view->getBaseUrl(); ?>/images/config.png" class="img-rounded" height="120" width="70"></td>
        <td><b><h5>::: Panel de Configuraciones de Env&iacute;o de Correos :::</h5></b></td>
    </tr>
    </table>
   
    <div class="alert alert-info"> Aqu&iacute; podr&aacute;s configurar los correo que son enviados a tu cuenta de email.</div>
    
    
    <form method="post" action="<?php echo $view->url(array('controller' => 'ConfigurationsEmail', 'action' => 'new')); ?>">
    <table class="table table-hover" style="font-size: 12px;">
        <?php
         while ($rowConfigurations = $view->configurationsDetails->fetch(PDO::FETCH_ASSOC))
        {
        $routes=$rowConfigurations['send_routes'];  
        $shipments=$rowConfigurations['send_shipments'];   
        $notifications=$rowConfigurations['send_notifications'];   
        $email=$rowConfigurations['email'];   
        
        if ($email=="")
        {
            $emailView='<input type="email" name="emailAdd" placeholder="correo@tuejemplo.com"  />';
        }
        
        if ($email != "")
        {
            $emailView= '<input type="email" name="emailAdd" placeholder="correo@tuejemplo.com"  value="'.$email.'"/>';
        }
        
        if ($routes==0)
        {
            $routesView='<td><label class="radio">
                         <input type="radio" name="routesLoad" id="optionsRadios1" value="0" checked="checked"> Si
                    </label>
                </td>
                <td>
                     <label class="radio">
                        <input type="radio" name="routesLoad" id="optionsRadios2" value="1"> No
                    </label>
                </td>';
        }
        
        if ($routes==1)
        {
            $routesView= '<td><label class="radio">
                         <input type="radio" name="routesLoad" id="optionsRadios1" value="0" > Si
                    </label>
                </td>
                <td>
                     <label class="radio">
                        <input type="radio" name="routesLoad" id="optionsRadios2" value="1" checked="checked"> No
                    </label>
                </td>';
        }
        
        if ($shipments==0)
        {
            $shipmentsView=' <td><label class="radio">
                        <input type="radio" name="shipmentsLoad" id="optionsRadios1" value="0" checked="checked"> Si
                    </label>
                </td>
                <td>
                    <label class="radio">
                        <input type="radio" name="shipmentsLoad" id="optionsRadios2" value="1"> No
                    </label>  
                </td>';
        }
        
         if ($shipments==1)
        {
            $shipmentsView='<td><label class="radio">
                        <input type="radio" name="shipmentsLoad" id="optionsRadios1" value="0" > Si
                    </label>
                </td>
                <td>
                    <label class="radio">
                        <input type="radio" name="shipmentsLoad" id="optionsRadios2" value="1" checked="checked"> No
                    </label>  
                </td>';
        }
        
         if ($notifications==0)
        {
            $notificationsView=' <td>
                     <label class="radio">
                        <input type="radio" name="notificationsLoad" id="optionsRadios1" value="0" checked="checked"> Si
                    </label>
                </td>
                <td>
                     <label class="radio">
                        <input type="radio" name="notificationsLoad" id="optionsRadios2" value="1"> No
                    </label>
                </td>';
        }
        
         if ($notifications==1)
        {
            $notificationsView='<td>
                     <label class="radio">
                        <input type="radio" name="notificationsLoad" id="optionsRadios1" value="0" > Si
                    </label>
                </td>
                <td>
                     <label class="radio">
                        <input type="radio" name="notificationsLoad" id="optionsRadios2" value="1" checked="checked"> No
                    </label>
                </td>';
        }
        }?>
        <thead>
            <tr>
            <td colspan="3"><b> <h5>::: Configuraciones Generales :::</h5></b></td>
           </tr>
        </thead>
        <tbody>
            <tr>
                <td><label>Deseas recibir notificaciones en tu correo sobre las rutas que estan disponibles en MasFletes:</label> </td>
                <?php echo $routesView; ?>
            </tr>
            <tr>
                <td> <label>Deseas recibir notificaciones en tu correo sobre las cargas que estan disponibles en MasFletes:</label></td>
                <?php echo $shipmentsView; ?>
            </tr>
            <tr>
                <td>
                     <label>Deseas recibir informaci&oacute;n sobre las notificaciones que creaste en tu correo el&eacute;ctronico:</label>
               </td>
               <?php echo $notificationsView; ?>
            </tr>
            <tr>
                <td>
                    <label>Deseas ingresar una cuenta de correo adicional para que se te envien tus notificaciones o modificar la actual: <b><< <?php echo $email; ?> >></b></label>
                    

                </td>
                   
                <td colspan="2">
                    <?php echo $emailView; ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    
                        <button type="submit" class="btn btn-primary">Guardar Cambios...</button>
                   
                </td>
            </tr>
        </tbody>
    </table>
    </form>
</div>