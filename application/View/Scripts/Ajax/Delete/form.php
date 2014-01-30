<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<div id="dialog-delete" title="Eliminar" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Esta seguro de <?php echo $view->texto; ?><div class="wait" style="display:none;" align="center"><b>Espere...</b></div><div id="responseDiv" align="center" class="" style="display:none;"></div></p>
    <input type="hidden" id="idItem" name="idItem" value="" /><input type="hidden" id="rowIndex" name="rowIndex" value="" />
</div>