<div class="well">
    <table class="table" >
        <tr>
            <th>Usuario</th>
            <th>Tipo de Evento</th>
            <th>Número de Evento</th>
            <th>Comentario</th>
            <th>Borrar</th>
        </tr>
        <?php
        foreach($view->comments as $comment)
        {
            echo '<tr>';
            echo '<td>' . $comment->getUser()->getUsername() . '</td>';
            echo '<td>' . $comment->getEventType() . '</td>';
            echo '<td>' . $comment->getEventId() . '</td>';
            echo '<td>' . $comment->getComment() . '</td>';
            echo '<td>Borrar</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>