<?php

class View_Helper_Forms extends Model3_View_Helper
{    
    /**
     * Retorna un Select Html normal *
     */
    public function selectHtml($options = array(), $data = array(), $selected = '')
    {
        $strOptions = '';
        foreach ($options as $key => $option)
            $strOptions .= $key . '="' . $option . '" ';
        
        $html = '<select ' . $strOptions . '>';
        $html .= '<option value="">Seleccione</option>';
        
        $param = "";
        foreach ($data as $ind => $row)
        {
            if( $selected == $ind )
                $param = 'selected="selected"';
            
            $html .= '<option value="'.$ind.'" '.$param.'>'.$row.'</option>';
            $param = '';
        }
        
        $html .= '</select>';
        return $html;
    }
    
    /**
     * Retorna los municipios de algun estado*
     */
    public function selectCitys($idState, $options = array(), $selected = '')
    {
        $dbs = Model3_Registry::getInstance()->get('databases');
        $em = $dbs['DefaultDb'];
        $state = $em->getRepository('DefaultDb_Entity_State')->find($idState);
        $cities = $state->getCities();
        
        $strOptions = '';
        foreach ($options as $key => $option)
            $strOptions .= $key . '="' . $option . '" ';
        
        $html = '<select ' . $strOptions . '>';
        $html .= '<option value="">Seleccione</option>';
        
        $param = "";
        foreach ($cities as $city)
        {
            if( $selected == $city->getId() )
                $param = 'selected="selected"';
            
            $html .= '<option value="'.$city->getId().'" '.$param.'>'.utf8_decode($city->getName()).'</option>';
            $param = '';
        }
        
        $html .= '</select>';
        return $html;
    }

    /**
     * Retorna los estados
     */
    public function selectStates($options = array(), $selected = '')
    {
        $dbs = Model3_Registry::getInstance()->get('databases');
        $em = $dbs['DefaultDb'];
        $estados = $em->getRepository('DefaultDb_Entity_State')->findAll();
        
        $strOptions = '';
        foreach ($options as $key => $option)
            $strOptions .= $key . '="' . $option . '" ';
        
        $html = '<select ' . $strOptions . '>';
        $html .= '<option value="">Seleccione</option>';
        
        $param = "";
        foreach ($estados as $edo)
        {
            if( $selected == $edo->getId() )
                $param = 'selected="selected"';
            
            $html .= '<option value="'.$edo->getId().'" '.$param.'>'.utf8_decode($edo->getName()).'</option>';
            $param = '';
        }
        
        $html .= '</select>';
        return $html;
    }
        
    public function selectCatalogTypes($entity, $options = array(), $selected = '')
    {
        $dbs = Model3_Registry::getInstance()->get('databases');
        $em = $dbs['DefaultDb'];
        $list = $em->getRepository('DefaultDb_Entity_'.$entity)->findAll();

        $strOptions = '';
        foreach ($options as $key => $option)
            $strOptions .= $key . '="' . $option . '" ';

        $html = '<select ' . $strOptions . '>';
        $html .= '<option value="">Seleccione</option>';
        $param = '';
        
        foreach ($list as $row)
        {
            if($selected == $row->getId())
                $param = 'selected="selected"';
            
            $html .= '<option value="' . $row->getId() . '" '.$param.'>' . $row->getName() . '</option>';
            $param = '';
        }
        
        $html .= '</select>';

        return $html;
    }
    
    public function catalogForm($title = "Alta", $name = "nombre", $desc = "descripcion", $btn = "Guardar", $obj = null)
    {
    ?>
    <form method="post" name="catFrm" id="catFrm" class="form-horizontal">
        <fieldset>
            <legend><?php echo $title; ?></legend>
        </fieldset>
        
        <div class="control-group">
            <label class="control-label" for="nameTF"><?php echo $name; ?></label>
            <div class="controls">
              <input type="text" id="nameTF" name="nameTF" placeholder="<?php echo $name; ?>" value="<?php echo (is_null($obj) ? "" : $obj->getName() ); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="descriptionTF"><?php echo $desc; ?></label>
            <div class="controls">
              <input type="text" id="descriptionTF" name="descriptionTF" placeholder="<?php echo $desc; ?>" value="<?php echo (is_null($obj) ? "" : $obj->getDescription() ); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-primary" type="submit"><?php echo $btn; ?></button>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        $(function(){
            $("#catFrm").validate({
                rules:{
                    nameTF:"required",
                    descriptionTF:"required"
                },
                messages:{
                    nameTF:"Campo requerido",
                    descriptionTF:"Campo requerido"
                }
            });
        });
    </script>
    <?php
    }
}
