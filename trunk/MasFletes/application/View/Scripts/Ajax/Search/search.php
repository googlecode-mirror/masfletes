<?php
if( count($view->data) > 0 )
{
switch ($view->entityName)
{
    case 'Shipment':
        $view->shipments = $view->data;
        $view->Shipments()->renderTable($view,$view->userType);
    break;
    case 'Route':
        $view->Routes()->renderTable($view->data,$view->userType);
    break;
    case 'Operation':
        $view->Operations()->renderTable($view->data,$view->userType);
    break;
    case 'Notification':
        $view->Notifications()->renderTable($view->data,$view->userType);
    break;
}
}
else
    echo '<div class="alert alert-block">  
  <a class="close" data-dismiss="alert">×</a>  
  <h4 class="alert-heading">La búsqueda no ha arrojado resultados coincidentes.</h4>  
</div>';