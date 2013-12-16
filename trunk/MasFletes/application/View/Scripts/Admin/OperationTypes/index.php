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
                echo '<tr>
                    <td>' . $e->getId() . '</td>
                    <td>' . $e->getName() . '</td>
                    <td>' . $e->getDescription() . '</td>
                    <td><a href="' . $view->url(array('controller' => 'OperationTypes', 'action' => 'form', 'id' => $e->getId())) . '">Editar</a></td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>