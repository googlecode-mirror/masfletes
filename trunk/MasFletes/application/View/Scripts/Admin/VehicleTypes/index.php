<div class="well" >
    <h1>Tipos de vehículos</h1>
    <br />
    <a href="<?php echo $view->url(array('action' => 'form')); ?>">Crear nuevo tipo de vehículo</a>
    <br />
    <table class="table">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /* @var $u DefaultDb_Entity_User */
            foreach ($view->entities as $e)
            {
                echo '<tr>
                    <td>' . $e->getId() . '</td>
                    <td>' . $e->getName() . '</td>
                    <td>' . $e->getDescription() . '</td>
                    <td><a href="' . $view->url(array('controller' => 'VehicleTypes', 'action' => 'form', 'id' => $e->getId())) . '">Editar</a></td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>