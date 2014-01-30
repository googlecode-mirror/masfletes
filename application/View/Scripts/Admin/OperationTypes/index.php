<div class="well" >
    <h1>Tipos de operación</h1>
    <br/>
    <a href="<?php echo $view->url(array('action' => 'form')); ?>">Crear tipo de operación</a>
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
            foreach ($view->entities as $e)
            {
                ?>
                <tr>
                    <td><?php echo $e->getId(); ?></td>
                    <td><?php echo $e->getName(); ?></td>
                    <td><?php echo $e->getDescription(); ?></td>
                    <td>
                        <a href="'<?php echo $view->url(array('controller' => 'OperationTypes', 'action' => 'form', 'id' => $e->getId())) ?>'">Editar</a>&nbsp;
                        <a href="#" id="<?php echo $e->getId(); ?>" class="deleteItem" title="Eliminar">Eliminar</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>