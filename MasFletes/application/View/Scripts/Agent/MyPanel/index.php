<?php

/*!-- Agregado por mi para los nuevos cambios -->
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="well">
  <table class="table table-hover"> 
    <tr>
        <td><img src="<?php echo $view->getBaseUrl(); ?>/images/eventPanel.png" class="img-rounded" height="120" width="70"></td>
        <td><b><h5>::: Actividades Recientes En Tu Cuenta :::</h5></b></td>
    </tr>
    </table>
     
    <h5>Rutas que coinciden con Cargas <div class="h4">:::: Tienes ( <?php echo $view->countRoutesNoRead; ?> ) mensajes sin leer ::::</div></h5> 
    
    <table class="table table-hover" style="font-size: 12px;">
        <tbody>
            <?php
            echo $view->routePanel;
            echo  $view->routeNotificationPanel
            ?>
            
        </tbody>
    </table>
     <br /> 
     <h5>Cargas que coinciden con rutas <div class="h4">:::: Tienes ( <?php echo $view->countShipmentsNoRead; ?> ) mensajes sin leer ::::</div></h5> 
  
    <table class="table table-hover" style="font-size: 12px;">
        <tbody>
            <?php 
            echo $view->shipmentPanel; 
            echo $view->shipmentNotificationPanel;
            ?>
        </tbody>
    </table>
     <br /> 
     <h5>Notificaciones que coinciden con cargas y rutas <div class="h4">:::: Tienes ( <?php echo $view->countNotificationsNoRead; ?> ) mensajes sin leer ::::</div> </h5> 
   <table class="table table-hover" style="font-size: 12px;">
        <tbody>
            <?php echo $view->notificationsPanel; ?>
        </tbody>
    </table>
    <b>Glosario de Identificadores:</b>
    <br />
    <b>CR:</b> (Carga que coincide con una Ruta) + N&uacute;mero consecutivo
    <br />
    <b>RC:</b> (Ruta que coincide con una Carga) + N&uacute;mero consecutivo
    <br />
    <b>RN:</b> (Ruta que coincide con una notificaci&oacute;n) + N&uacute;mero consecutivo
    <br />
    <b>CN:</b> (Carga que coincide con una notificaci&oacute;n) + N&uacute;mero consecutivo
    <br />
    <b>NC o NR:</b> (Notificaci&oacute;n que coincide con una carga o ruta) + N&uacute;mero consecutivo
</div>
