<div class="well" >
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
                echo '<tr>
                    <td>' . $u->getId() . '</td>
                    <td>' . $u->getUsername() . '</td>
                    <td>' . $view->Users()->roleToText($u->getType()) . '</td>
                    <td><a href="' . $view->url(array('controller' => 'Users', 'action' => 'edit', 'id' => $u->getId())) . '">Editar</a></td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>