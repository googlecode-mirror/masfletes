<div class="well">
    <table class="table table-hover"> 
    <tr>
        <td><img src="<?php echo $view->getBaseUrl(); ?>/images/eventPanel.png" class="img-rounded" height="120" width="70"></td>
        <td><b><h5>::: Detalle de eventos :::</h5></b></td>
    </tr>
    </table>
 
    <?php 
    echo $view->titleDetails;
    echo $view->Message;
    ?>
     
    <br /> <br /> 
    <table class="table table-hover" style="font-size: 12px;">
        <thead>
            <tr>
                <td><b><?php echo $view->Head; ?></b></td>
                <td><b>Origen</b></td>
                <td><b>Destino</b></td>
                <td><b>Veh&iacute;culo</b></td>
                <td><b>Disponible</b></td>
                <td><b>Comentarios</b></td>
                <td><b>Usuario</b></td>
            </tr>
        </thead>
        <tbody>
        <?php echo $view->Body; ?>
        </tbody>
    </table>
                
   </div>
