<div class="well" >
    <h3>Alta de usuarios</h3>
    <a href="<?php echo $view->url(array('controller' => 'Users', 'action' => 'index')); ?>">Volver</a>
    <?php if( ($resp = Model3_Site::getTempMsg("msg")) ) { ?>
        <div class="alert alert-success"><?php echo $resp; ?></div>
    <?php } ?>
    <form method="post" name="addUserFrm" id="addUserFrm" class="form-horizontal">
        <fieldset>
            <legend>Datos del usuario</legend>
        </fieldset>
        
        <div class="control-group">
          <label class="control-label" for="role">Rol</label>
          <div class="controls">
            <select name="role" id="role">
                <option value="1">Administrador</option>
                <option value="2">Coordinador</option>
                <option value="3">Usuario</option>
            </select>
          </div>          
        </div>
        
        <div class="control-group">
            <label class="control-label" for="firstNameTF">Nombre(s)</label>
            <div class="controls">
              <input type="text" id="firstNameTF" name="firstNameTF" placeholder="Nombre(s)">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="lastNameTF">Apellidos</label>
            <div class="controls">
              <input type="text" id="lastNameTF" name="lastNameTF" placeholder="Apellidos">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="userNameTF">Correo Electr&oacute;nico</label>
            <div class="controls">
              <input type="text" id="userNameTF" name="userNameTF" placeholder="Correo Electr&oacute;nico">
              <span id="correoSp" class="" style="display:none; font-weight:bold; ">Comprobando...</span>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="passTF">Contrase&ntilde;a</label>
            <div class="controls">
              <input type="password" id="passTF" name="passTF" placeholder="Contrase&ntilde;a">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="passCpyTF">Reescribir Contrase&ntilde;a</label>
            <div class="controls">
              <input type="password" id="passCpyTF" name="passCpyTF" placeholder="Reescribir Contrase&ntilde;a">
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" type="submit">Crear Usuario</button>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo $view->getBaseUrl(); ?>/js/application/admin/users/users.js"></script>