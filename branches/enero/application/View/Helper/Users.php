<?php

/**
 * Description of Users
 *
 * @author ricardo.guerra
 */

class View_Helper_Users extends Model3_View_Helper 
{
    /**
     * Imprime el formulario para dar de alta o editar un usuario
     * @return string
     */
    public function usersform()
    {
        $form = '<form method="post" />
        <fieldset>
        <legend>Datos del Usuario</legend>
        <table>
            <tr>
                <td><label for="role">Rol :</label></td>
                <td>
                    <select name="role" id="role">
                        <option value="1">Administrador</option>
                        <option value="2">Coordinador</option>
                        <option value="3">Usuario</option>
                    </select>
                </td>
            </tr>
            <tr>
                 <td><label for="name">Nombre :</label></td>
                <td><input type="text" name="firstName" id="firstName"/></td>
            </tr>
            <tr>
                 <td><label for="name">Apellidos :</label></td>
                <td><input type="text" name="lastName" id="lastName"/></td>
            </tr>
             <tr>
                 <td><label for="username">Username :</label></td>
                 <td><input type="text" name="username" id="username"/></td>
            </tr>
             <tr>
                 <td><label for="password">Password :</label></td>
                 <td><input type="password" name="password" id="password"/></td>
            </tr>
            <tr>
                 <td><label for="confirm_password">Confirma Password :</label></td>
                 <td><input type="password" name="confirm_password" id="confirm_password"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" class="btn" value="Crear Usuario"/></td>
            </tr>
        </table>
        </fieldset>
        </form>';
        return $form;
    }
    
    /**
     * Convierte el valor numerico del rol en texto
     * @param integer $role
     * @return string
     */
    public function roleToText($role)
    {
        $roleText = 'N/A';
        
        switch ($role) 
        {
            case 1: $roleText = 'Administrador';
                break;
            case 2: $roleText = 'Coordinador';
                break;
            case 3: $roleText = 'Cliente';
                break;
            default:
                break;
        }
        
        return $roleText;
    }
}

?>
