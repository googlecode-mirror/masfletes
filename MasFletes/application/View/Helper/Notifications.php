<?php

class View_Helper_Notifications extends Model3_View_Helper
{

    public function renderTable($notifications, $module = '')
    {
        $params = array('controller' => 'Notifications', 'action' => 'form', 'id' => 0);
        if($module !== '')
            $params['module'] = $module;
        ?>

        <table class="table" style="font-size: 11px;" >
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tipo</th>                    
                    <th>Origen</th>
                    <th>Destino</th>                    
                    <th>Vehículo</th>
                    <th>Tipo de Vehículo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($notifications as $notification)
                {
                    $params['id'] = $notification->getId();
                    /* @var $notification DefaultDb_Entity_Notification */
                ?>
                <tr>
                    <td><?php echo $notification->getId(); ?></td>
                    <td><?php echo (($notification->getActionType() == 1) ? "Carga" : "Ruta"); ?></td>
                    <td><?php echo utf8_decode($notification->getMunicipalityOrigin()->getName() . ', ' . $notification->getStateOrigin()->getName()); ?></td>
                    <td><?php echo utf8_decode($notification->getMunicipalityDestiny()->getName() . ', ' . $notification->getStateDestiny()->getName()); ?></td>
                    <td><?php echo $notification->getVehicle()->getName(); ?></td>
                    <td><?php echo $notification->getVehicleType()->getName(); ?></td>
                    <td class="Notification" id="<?php echo $notification->getId(); ?>" style="cursor:pointer;">
                            <span class="icon-search"></span>&nbsp;<a href="<?php echo $this->_view->url($params); ?>">
                            <span class="icon-pencil"></span></a>&nbsp;<span class="icon-remove"></span>
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
