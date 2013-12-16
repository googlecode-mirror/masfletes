<div class="well">
    <h1>Listado de operadores</h1>
    <br />
    <?php if(is_array($view->drivers) == true && count($view->drivers) > 0):?>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Licencia Federal</th>
                <th>Vigencia de la licencia</th>
                <th>Modificar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                /* @var $d DefaultDb_Entity_Driver */
                foreach($view->drivers as $d)
                {
                    echo '<tr>';
                    echo '<td>'.$d->getName().'</td>';
                    echo '<td>'.$d->getLicence().'</td>';
                    echo '<td>'.$d->getLicenceDuration()->format('Y-m-d').'</td>';
                    echo '<td><a href="' . $view->url(array('controller' => 'Drivers', 'action' => 'form', 'id' => $d->getId())) . '">Editar</a></td>';
                    echo '<tr>';
                }
            ?>
        </tbody>
    </table>
    <?php else:?>
    Aún no has dado de alta ningún operador
    <?php endif; ?>
</div>