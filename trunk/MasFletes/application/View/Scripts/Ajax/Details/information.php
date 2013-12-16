<?php
$frecuencia = array(1 => 'Ninguna', 2 => 'Eventual', 3 => 'Diario',
      4 => 'Semanal', 5 => '1 a 5 por semana', 6 => 'Quincenal',7 => 'Mensual');
switch ($view->nameEntity)
{
    case 'DefaultDb_Entity_Shipment':
    ?>
    <ul>
        <li><b>ID de Carga </b><?php echo $view->entity->getId(); ?></li>
        <li><b>Origen </b><?php echo utf8_decode($view->entity->getMunicipalityOrigin()->getName().', '.$view->entity->getStateOrigin()->getName()); ?></li>
        <li><b>Destino </b><?php echo utf8_decode($view->entity->getMunicipalityDestiny()->getName().', '.$view->entity->getStateDestiny()->getName()); ?></li>
        <li><b>D&iacute;as de vigencia </b><?php echo $view->entity->getEffectiveDays(); ?></li>
        <li><b>Direcci&oacute;n de carga </b><?php echo $view->entity->getSourceAddress(); ?></li>
        <li><b>Direcci&oacute;n de entrega </b><?php echo $view->entity->getDestinyAddress(); ?></li>
        <li><b>Fecha de carga </b><?php echo $view->entity->getSourceDate()->format('d-m-Y'); ?></li>
        <li><b>Fecha destino </b><?php echo $view->entity->getDestinyDate()->format('d-m-Y'); ?></li>
        <li><b>Veh&iacute;culo </b><?php echo $view->entity->getVehicle()->getName().' de '.$view->entity->getVehicleType()->getName(); ?></li>
        <!--<li><b>Tipo de veh&iacute;culo </b><?php echo $view->entity->getVehicleType()->getName(); ?> </li>-->
        <li><b>Tipo de carga </b><?php echo $view->entity->getShipmentType()->getName(); ?> </li>
        <li><b>Frecuencia </b><?php echo $frecuencia[$view->entity->getFrequency()]; ?> </li>
        <li><b>Comentarios </b><?php echo $view->entity->getComments(); ?></li>
    </ul>
    <?php
    break;
    case 'DefaultDb_Entity_Route':
        $bmm = array(1 => 'Buena',2 => 'Media', 3 => 'Mala');
    ?>
    <ul>
        <li><b>ID de Ruta </b><?php echo $view->entity->getId(); ?></li>
        <li><b>Origen </b><?php echo utf8_decode($view->entity->getMunicipalityOrigin()->getName() . ', ' . $view->entity->getStateOrigin()->getName()); ?></li>
        <li><b>Destino </b><?php echo utf8_decode($view->entity->getMunicipalityDestiny()->getName() . ', ' . $view->entity->getStateDestiny()->getName()); ?></li>
        <li><b>Fecha de disponibilidad </b><?php echo $view->entity->getLoadAvailabilityDate()->format('d-m-Y'); ?></li>
        <li><b>D&iacute;as de vigencia </b><?php echo $view->entity->getEffectiveDays(); ?></li>
        <li><b>Veh&iacute;culo </b><?php echo $view->entity->getVehicle()->getName().' de '.$view->entity->getVehicleType()->getName(); ?></li>
        <!--<li><b>Tipo de veh&iacute;culo </b><?php echo $view->entity->getVehicleType()->getName(); ?></li>-->
        <li><b>Ruta aceptada </b><?php if( $view->entity->getRouteAccepted()==1 ){ ?><span class="icon-ok"></span><?php } ?></li>
        <li><b>Tel&eacute;fono </b><?php echo $view->entity->getCellularPhone(); ?></li>
        <li><b>Frecuencia </b><?php echo $frecuencia[$view->entity->getFrequency()]; ?></li>
        <li><b>Correo Electr&oacute;nico </b><?php echo $view->entity->getEmail(); ?></li>
        <li><b>Condici&oacute;n de llantas </b><?php echo $bmm[$view->entity->getTiresCondition()]; ?></li>
        <li><b>Condici&oacute;nes mecanicas </b><?php echo $bmm[$view->entity->getLetterMechanicalConditions()]; ?></li>
        <li><b>Placas federales </b><?php echo ($view->entity->getPlates() == 1) ? "Si" : "No"; ?></li>
        <li><b>Licencia federal vigente </b><?php echo ($view->entity->getDriverLicence() == 1) ? "Si" : "No"; ?></li>
        <li><b>Lona </b><?php echo ($view->entity->getOwnTarpaulin() == 1) ? "Si" : "No"; ?></li>
        <li><b>Rastreo satelital </b><?php echo $view->entity->getSatelitalTracking(); ?></li>
        <li><b>Placas </b><?php echo ($view->entity->getLetters_carry() == 1) ? "Si" : "No"; ?></li>
        <li><b>Comentarios </b><?php echo $view->entity->getComments(); ?></li>
    </ul>
    <?php
    break;
    
    case 'DefaultDb_Entity_Operation':
        $stat = array(1 => 'Si', 2 => 'En proceso', 3 => 'No');
    ?>
    <ul>
        <li><b>ID de operaci&oacute;n</b> #<?php echo $view->entity->getId(); ?></li>
        <li><b>Carga </b>
            <?php echo $view->entity->getShipment()->getId(); ?>
            <?php echo utf8_decode($view->entity->getShipment()->getMunicipalityOrigin()->getName()); ?>
            (<?php echo utf8_decode($view->entity->getShipment()->getStateOrigin()->getName()); ?>) >>
            <?php echo utf8_decode($view->entity->getShipment()->getMunicipalityDestiny()->getName()); ?>
            (<?php echo utf8_decode($view->entity->getShipment()->getStateDestiny()->getName()); ?>)
        </li>
        <li><b>Ruta </b>
            <?php echo $view->entity->getRoute()->getId(); ?>
            <?php echo utf8_decode($view->entity->getRoute()->getMunicipalityOrigin()->getName()); ?>
            (<?php echo utf8_decode($view->entity->getRoute()->getStateOrigin()->getName()); ?>) >>
            <?php echo utf8_decode($view->entity->getRoute()->getMunicipalityDestiny()->getName()); ?>
            (<?php echo utf8_decode($view->entity->getRoute()->getStateDestiny()->getName()); ?>)
        </li>
        <li><b>Status </b><?php echo $stat[$view->entity->getStatus()]; ?></li>
        <li><b>Documentaci&oacute;n </b><?php echo $view->entity->getDocuments(); ?></li>
        <li><b>Costo de flete </b>$<?php echo number_format($view->entity->getCost(),2); ?></li>
        <li><b>Comisi&oacute;n de enviador </b>$<?php echo number_format($view->entity->getCostoEnviador(),2); ?></li>
        <li><b>Comisi&oacute;n de transportista </b>$<?php echo number_format($view->entity->getCostoTrans(),2); ?></li>
        <li><b>Maniobras </b><?php echo ($view->entity->getManiobras() == '1') ? 'Si' : 'No'; ?></li>
        <li><b>Seguro de carga </b>$<?php echo number_format($view->entity->getSeguro(),2); ?></li>
        <li><b>Custodia </b><?php echo $view->entity->getCustodia(); ?></li>
        <li><b>Referencia pago enviador </b><?php echo $view->entity->getRefEnviador(); ?></li>
        <li><b>Referencia pago transportista </b><?php echo $view->entity->getRefTrans(); ?></li>
        <li><b>Cal. Enviador </b><?php echo $view->entity->getCalEnviador(); ?></li>
        <li><b>Cal. Transportista </b><?php echo $view->entity->getCalTrans(); ?></li>
        <li><b>Indicador Enviador </b><?php echo $view->entity->getIndEnviador(); ?></li>
        <li><b>Indicador Transportista </b><?php echo $view->entity->getIndTrans(); ?></li>
        <li><b>Comentario </b><?php echo $view->entity->getComments(); ?></li>
    </ul>
    <?php
    break;

    case 'DefaultDb_Entity_Notification':
    ?>
    <ul>
        <li><b>N&uacute;mero de notificaci&oacute;n </b><?php echo $view->entity->getId(); ?></li>
        <li><b>Tipo de notificaci&oacute;n </b><?php echo (($view->entity->getActionType() == 1) ? "Carga" : "Ruta") ?></li>
        <li><b>Veh&iacute;culo </b><?php echo $view->entity->getVehicle()->getName().' de '.$view->entity->getVehicleType()->getName(); ?></li>
        <!--<li><b>Tipo de veh&iacute;culo </b><?php echo $view->entity->getVehicleType()->getName(); ?></li>-->
        <li><b>Origen </b><?php echo utf8_decode($view->entity->getMunicipalityOrigin()->getName().', '.$view->entity->getStateOrigin()->getName()); ?></li>
        <li><b>Destino </b><?php echo utf8_decode($view->entity->getMunicipalityDestiny()->getName().', '.$view->entity->getStateDestiny()->getName()); ?></li>
    </ul>
    <?php
    break;
}