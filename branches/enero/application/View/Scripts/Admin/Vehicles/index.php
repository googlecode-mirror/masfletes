<div class="well" >
    <h1>Veh&iacute;culos</h1>
    <br />
    <a href="<?php echo $view->url(array('action' => 'form')); ?>">Crear nuevo vehículo</a>
    <br />
    <table class="table">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /* @var $u DefaultDb_Entity_User */
            foreach ($view->entities as $e)
            {
                ?>
                <tr>
                    <td><?php echo $e->getId(); ?></td>
                    <td><?php echo $e->getName(); ?></td>
                    <td><?php echo $e->getDescription(); ?></td>
                    <td><a href="<?php echo $view->url(array('controller' => 'Vehicles', 'action' => 'form', 'id' => $e->getId())); ?>">Editar</a>
                        <a href="#" id="<?php echo $e->getId(); ?>" class="deleteItem" title="Eliminar">Eliminar</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>