<?php

class View_Helper_Shipments extends Model3_View_Helper
{

    public function renderTable($view, $module = '')
    {
        $shipments = $view->shipments;
        $params = array('controller' => 'Shipment', 'action' => 'form', 'id' => 0);
        if($module !== '')
            $params['module'] = $module;
        ?>
        <table class="table" id="shipmentsTable" style="font-size: 11px;" >
            <thead>
                <tr>
                    <th>Carga</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha Carga</th>
                    <th>Dias</th>
                    <th>Vehículo</th>
                    <th>Tipo de Carga</th>
                    <!--<th>Aceptada</th>-->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($shipments as $shipment)
                {
                    /* @var $shipment DefaultDb_Entity_Shipment */
                    $params['id'] = $shipment->getId();
                ?>
                <tr>
                    <td><?php echo $shipment->getId(); ?></td>
                    <td><?php echo utf8_decode($shipment->getMunicipalityOrigin()->getName().", ".$shipment->getStateOrigin()->getName()); ?></td>
                    <td><?php echo utf8_decode($shipment->getMunicipalityDestiny()->getName().", ".$shipment->getStateDestiny()->getName()); ?></td>
                    <td><?php echo $shipment->getSourceDate()->format('d-m-Y'); ?></td>
                    <td><?php echo $shipment->getEffectiveDays(); ?></td>
                    <td><?php echo $shipment->getVehicle()->getName(); ?></td>
                    <td><?php echo $shipment->getShipmentType()->getName(); ?></td>
                    <!--<td><?php if($shipment->getShipmentAccepted()==1){ ?><span class="icon-ok"></span><?php } ?></td>-->
                    <td class="Shipment" id="<?php echo $shipment->getId(); ?>" style="cursor:pointer;">
                        <span class="icon-search" title="Detalles"></span>&nbsp;<a alt="Editar" title="Editar" href="<?php echo $this->_view->url($params); ?>">
                        <span class="icon-pencil"></span></a>&nbsp;<span class="icon-remove" title="Eliminar"></span>
                    </td>
                </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

}