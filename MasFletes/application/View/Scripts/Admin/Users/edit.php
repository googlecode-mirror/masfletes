<div class="well" >
    <h3>Edici&oacute;n de usuarios</h3>
    <a href="<?php echo $view->url(array('controller' => 'Users', 'action' => 'index')); ?>">Volver</a>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php } ?>
    <form method="post" name="editUserFrm" id="editUserFrm" class="form-horizontal">
        <fieldset>
            <legend>Datos del usuario</legend>
        </fieldset>

        <div class="control-group">
          <label class="control-label" for="role">Rol</label>
          <div class="controls">
            <select name="role" id="role">
                <option value="1" <?php echo ($view->user->getType() == 1) ? 'selected="selected"' : ""; ?>>Administrador</option>
                <option value="2" <?php echo ($view->user->getType() == 2) ? 'selected="selected"' : ""; ?>>Coordinador</option>
                <option value="3" <?php echo ($view->user->getType() == 3) ? 'selected="selected"' : ""; ?>>Usuario</option>
            </select>
          </div>          
        </div>
        
        <div class="control-group">
            <label class="control-label" for="firstNameTF">Nombre(s)</label>
            <div class="controls">
              <input type="text" id="firstNameTF" name="firstNameTF" placeholder="Nombre(s)" value="<?php echo $view->user->getFirstName(); ?>">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="lastNameTF">Apellidos</label>
            <div class="controls">
              <input type="text" id="lastNameTF" name="lastNameTF" placeholder="Apellidos" value="<?php echo $view->user->getLastName(); ?>">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="userNameTF">Correo Electr&oacute;nico</label>
            <div class="controls">
              <input type="text" id="userNameTF" name="userNameTF" placeholder="Correo Electr&oacute;nico" value="<?php echo $view->user->getUsername(); ?>">
              <span id="correoSp" class="" style="display:none;">Comprobando...</span>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="changePass">Cambiar contrase&ntilde;a</label>
            <div class="controls">
                <input type="checkbox" name="changePass" id="changePass" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="passTF">Contrase&ntilde;a</label>
            <div class="controls">
              <input type="password" id="passTF" name="passTF" placeholder="Contrase&ntilde;a" value="" disabled="disabled">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="passCpyTF">Reescribir Contrase&ntilde;a</label>
            <div class="controls">
              <input type="password" id="passCpyTF" name="passCpyTF" placeholder="Reescribir Contrase&ntilde;a" disabled="disabled">
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" type="submit">Editar Usuario</button>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo $view->getBaseUrl(); ?>/js/application/admin/users/users.js"></script>