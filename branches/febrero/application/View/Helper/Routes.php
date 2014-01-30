<?php

class View_Helper_Routes extends Model3_View_Helper
{

    public function renderTable($routes, $module = '')
    {
        $params = array('controller' => 'Routes', 'action' => 'form', 'id' => 0);
        if($module !== '')
            $params['module'] = $module;
        ?>

        <table class="table" style="font-size: 11px;" >
            <thead>
                <tr>
                    <th>Ruta</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Dias</th>
                    <th>Vehículo</th>
                    <th>Aceptada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($routes as $route)
                {
                    $params['id'] = $route->getId();
                    /* @var $route DefaultDb_Entity_Route */
                    ?>
                    <tr>
                        <td><?php echo $route->getId(); ?></td>
                        <td><?php echo utf8_decode($route->getMunicipalityOrigin()->getName() . ', ' . $route->getStateOrigin()->getName()); ?></td>
                        <td><?php echo utf8_decode($route->getMunicipalityDestiny()->getName() . ', ' . $route->getStateDestiny()->getName()); ?></td>
                        <td><?php echo $route->getLoadAvailabilityDate()->format('d-m-Y'); ?></td>
                        <td><?php echo $route->getEffectiveDays(); ?></td>
                        <td><?php echo $route->getVehicle()->getName(); ?></td>
                        <td><?php if($route->getRouteAccepted()==1){ ?><span class="icon-ok"></span><?php } ?></td>
                        <td class="Route" id="<?php echo $route->getId(); ?>" style="cursor:pointer;">
                            <span class="icon-search" title="Detalles"></span>&nbsp;<a title="Editar"href="<?php echo $this->_view->url($params); ?>">
                            <span class="icon-pencil"></span></a>&nbsp;
                            <a href="#" id="<?php echo $route->getId(); ?>" class="deleteItem" title="Eliminar"><span class="icon-remove"></span></a>
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
