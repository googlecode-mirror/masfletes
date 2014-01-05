<div class="well">
    <h1>Listado de unidades</h1>
    <br />
    <?php if(is_array($view->units) == true && count($view->units) > 0):?>
    <table class="table">
        <thead>
            <tr>
                <th>Vehículo</th>
                <th>Tipo de vehículo</th>
                <th>Placas</th>
                <th>Número Económico</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Comentario</th>
                <th>Modificar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                /* @var $u DefaultDb_Entity_Unit */
                foreach($view->units as $u)
                {
                    echo '<td>'.$u->getVehicle()->getName().'</td>';
                    echo '<td>'.$u->getVehicleType()->getName().'</td>';
                    echo '<td>'.$u->getPlates().'</td>';
                    echo '<td>'.$u->getEconomicNumber().'</td>';
                    echo '<td>'.$u->getBrand().'</td>';
                    echo '<td>'.$u->getModel().'</td>';
                    echo '<td>'.$u->getColor().'</td>';
                    echo '<td>'.$u->getComments().'</td>';
                    echo '<td><a href="' . $view->url(array('controller' => 'Units', 'action' => 'form', 'id' => $u->getId())) . '">Editar</a>&nbsp;';
                    ?><a href="#" id="<?php echo $u->getId(); ?>" class="deleteItem" title="Eliminar">Eliminar</a></td></tr><?php
                }
            ?>
        </tbody>
    </table>
    <?php else:?>
    Aún no has dado de alta ninguna unidad
    <?php endif; ?>
</div>