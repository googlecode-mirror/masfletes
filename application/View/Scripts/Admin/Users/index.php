<div class="well">
    <h1>Administración de usuarios</h1>
    <br />
    <a href="<?php echo $view->url(array('controller' => 'Users', 'action' => 'add')); ?>">Crear Usuario</a>
    <br />
    <table class="table">
        <thead>
            <tr>
                <th>Clave</th>
                <th>Username</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /* @var $u DefaultDb_Entity_User */
            foreach ($view->users as $u)
            {
                ?>
                <tr>
                    <td><?php echo $u->getId(); ?></td>
                    <td><?php echo $u->getUsername(); ?></td>
                    <td><?php echo $view->Users()->roleToText($u->getType()) ?></td>
                    <td><a href="<?php echo $view->url(array('controller' => 'Users', 'action' => 'edit', 'id' => $u->getId())); ?>">Editar</a>&nbsp;
                        <?php if( $view->idUser !== $u->getId() ){ ?><a href="#" id="<?php echo $u->getId(); ?>" class="deleteItem" title="Eliminar">Eliminar</a><?php } ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>