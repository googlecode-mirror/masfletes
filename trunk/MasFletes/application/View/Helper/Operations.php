<?php

class View_Helper_Operations extends Model3_View_Helper
{
    public function renderTable($operations, $module='')
    {
        $params = array('controller' => 'Operations', 'action' => 'form', 'id' => 0);
        if($module !== '')
            $params['module'] = $module;
        ?>
        <table class="table" style="font-size: 11px;" >
            <thead>
                <tr>
                    <th>Operaci&oacute;n</th>
                    <th>Carga</th>
                    <th>Ruta</th>
                    <th>Status</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stat = array(1=>'Si',2=>'En proceso',3=>'No');
                foreach($operations as $operation)
                {
                    $params['id'] = $operation->getId();
                ?>
                <tr>
                    <td><?php echo $operation->getId(); ?></td>
                    <td>
                        #<?php echo $operation->getShipment()->getId(); ?>,
                        <?php echo utf8_decode($operation->getShipment()->getMunicipalityOrigin()->getName()); ?>
                        (<?php echo utf8_decode($operation->getShipment()->getStateOrigin()->getName()); ?>) >>
                        <?php echo utf8_decode($operation->getShipment()->getMunicipalityDestiny()->getName()); ?>
                        (<?php echo utf8_decode($operation->getShipment()->getStateDestiny()->getName()); ?>)
                    </td>
                    <td>
                        #<?php echo $operation->getRoute()->getId(); ?>,
                        <?php echo utf8_decode($operation->getRoute()->getMunicipalityOrigin()->getName()); ?>
                        (<?php echo utf8_decode($operation->getRoute()->getStateOrigin()->getName()); ?>) >>
                        <?php echo utf8_decode($operation->getRoute()->getMunicipalityDestiny()->getName()); ?>
                        (<?php echo utf8_decode($operation->getRoute()->getStateDestiny()->getName()); ?>)
                    </td>
                    <td><?php echo $stat[$operation->getStatus()]; ?></td>
                    <td><?php echo $operation->getOperationDate()->format('d-m-Y'); ?></td>
                    <td class="Operation" id="<?php echo $operation->getId(); ?>" style="cursor:pointer;">
                        <span class="icon-search" title="Detalles"></span>&nbsp;<a title="Editar" href="<?php echo $this->_view->url($params); ?>">
                        <span class="icon-pencil"></span></a>&nbsp;<span class="icon-remove" Title="Eliminar"></span>
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
