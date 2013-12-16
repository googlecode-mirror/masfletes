<div class="well" >
    <h1>Veh&iacute;culos</h1>
    <br />
    <a href="<?php echo $view->url(array('action' => 'form')); ?>">Crar nuevo vehículo</a>
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
                echo '<tr>
                    <td>' . $e->getId() . '</td>
                    <td>' . $e->getName() . '</td>
                    <td>' . $e->getDescription() . '</td>
                    <td><a href="' . $view->url(array('controller' => 'Vehicles', 'action' => 'form', 'id' => $e->getId())) . '">Editar</a></td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>