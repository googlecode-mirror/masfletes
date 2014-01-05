<?php

class View_Helper_Routes extends Model3_View_Helper
{

    public function renderTable($routes)
    {
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
                    /* @var $route DefaultDb_Entity_Route */
                    echo '<tr>';
                    echo '<td>' . $route->getId() . '</td>';
                    echo '<td>' . $route->getMunicipalityOrigin()->getName() . ', ' . $route->getStateOrigin()->getName() . '</td>';
                    echo '<td>' . $route->getMunicipalityDestiny()->getName() . ', ' . $route->getStateDestiny()->getName() . '</td>';
                    echo '<td>' . $route->getLoadAvailabilityDate()->format('d-m-Y') . '</td>';
                    echo '<td>' . $route->getEffectiveDays() . '</td>';

                    echo '<td>';
                    if ($route->getVehicle() != null)
                        echo $route->getVehicle()->getName();
                    echo '</td>';

                    $checked = '';
                    if ($route->getRouteAccepted() == 1)
                        $checked = 'checked = "checked"';
                    echo '<td><input type="checkbox" ' . $checked . '/></td>';
                    echo '<td><a><i class="icon-search"></i> <i class="icon-pencil"></i> <i class="icon-remove"></i></a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>

        </table>

        <?php
    }

}
