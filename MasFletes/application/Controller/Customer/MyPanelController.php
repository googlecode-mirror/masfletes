<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyPanel
 *
 * @author Nayeli
 */
class Customer_MyPanelController extends Model3_Controller
{
    public function init()
    {
        $this->view->setTemplate('Customer');
    }
    
    public function indexAction()
    {
        $em = $this->getEntityManager('DefaultDb');
        $eventPanel = $em->getRepository('DefaultDb_Entity_EventPanel');
        $this->view->eventPanelView =  $eventPanel->getEvent();
    
         $typeEventRoutes='routes';
        $this->view->routesNoRead =  $eventPanel->getNoReadEvent($typeEventRoutes);
        
        while ($value = $this->view->routesNoRead->fetch(PDO::FETCH_ASSOC))
        {   $this->view->countRoutesNoRead=$value['Count_Event']; }
        
        $typeEventShipments='shipments';
        $this->view->shipmentsNoRead =  $eventPanel->getNoReadEvent($typeEventShipments);
        
        while ($value = $this->view->shipmentsNoRead->fetch(PDO::FETCH_ASSOC))
        {   $this->view->countShipmentsNoRead=$value['Count_Event'];    }
        
        $typeEventNotifications='notifications';
        $this->view->notificationsNoRead =  $eventPanel->getNoReadEvent($typeEventNotifications);
        
        while ($value = $this->view->notificationsNoRead->fetch(PDO::FETCH_ASSOC))
        {   $this->view->countNotificationsNoRead=$value['Count_Event'];   }
        
        
        while ($fila =  $this->view->eventPanelView->fetch(PDO::FETCH_ASSOC) )
        {
            $this->view->idPanel=$fila['id'];
            $this->view->numberEvent=$fila['coincidence_number'];
            $this->view->coincidenceEvent=$fila['coincidence_event'];
            $this->view->event=$fila['event'];  
            $this->view->idEvent=$fila['id_event'];
            $this->view->idUser=$fila['id_user'];
            $this->view->status=$fila['status'];
            $this->view->availabilityDate=$fila['Availability_Date'];
            $this->view->dataHidden=$fila['data_hidden'];
            $this->view->contactNameUser=$fila['FirstName_User'].' '. $fila['LastName_User'];
            $this->view->contactPhoneUser= ' Tel&eacute;fono: '.$fila['Phone_User'];
            $this->view->contactUser=$this->view->contactNameUser.$this->view->contactPhoneUser;
            
            foreach(explode(',',$this->view->numberEvent) as $key => $value)
            {
                $key;
                $value;
                $this->view->countNumbertEvent=substr($this->view->numberEvent, 0, -1);
            }
            
            if ($this->view->event=='routes' && $this->view->coincidenceEvent==3 && $this->view->dataHidden==0 )
            {
                $this->view->alias="RN-";
               
                if ($this->view->status == 0)
                {
                    $this->view->routeNotification= '<tr>
                    <td><span class="icon-envelope"></span><br /></td>
                    <td><b>'.$this->view->alias.$this->view->idPanel.'</b><br /></td>'
                    . '<td><b>'.$this->view->availabilityDate.'</b><br /></td>'       
                    . '<td><b> La Ruta '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' notificaci&oacute;n registrada que es: '. $this->view->countNumbertEvent.'</b></td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'')).'"><button class="btn btn-mini btn-primary" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><span class="icon-remove"></span><br /></td>'
                    . '</tr>';
                }
                
                if ($this->view->status == 1)
                {
                    $this->view->routeNotification = '<td><b><span class="icon-ok"></span></b><br /></td>'
                    . '<td>'.$this->view->alias.$this->view->idPanel.'<br /></td>'
                    . '<td>'.$this->view->availabilityDate.'<br /></td>'
                    . '<td>La Ruta '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' Cargas que son: '.$this->view->countNumbertEvent.'</td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'')).'"><button class="btn btn-mini btn-info" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'idHidden' => ''.$this->view->idPanel.'', 'hi' => ''.$this->view->dataHidden.'')).'"><span class="icon-remove"></span></a><br /></td>'
                    . '</tr>';              
                }    
                
                $this->view->routeNotificationPanel.=$this->view->routeNotification;
            }
            
            if ($this->view->event=='routes' && $this->view->dataHidden==0 )
            { 
               $this->view->alias="RC-";
               
                if ($this->view->status == 0)
                {
                    $this->view->route= '<tr>
                    <td><span class="icon-envelope"></span><br /></td>
                    <td><b>'.$this->view->alias.$this->view->idPanel.'</b><br /></td>'
                    . '<td><b>'.$this->view->availabilityDate.'</b><br /></td>'       
                    . '<td><b> La Ruta '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' Cargas que son: '.$this->view->countNumbertEvent.'</b></td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'')).'"><button class="btn btn-mini btn-primary" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><span class="icon-remove"></span><br /></td>'
                    . '</tr>';
                }
                
                if ($this->view->status == 1)
                {
                    $this->view->route = '<td><b><span class="icon-ok"></span></b><br /></td>'
                    . '<td>'.$this->view->alias.$this->view->idPanel.'<br /></td>'
                    . '<td>'.$this->view->availabilityDate.'<br /></td>'
                    . '<td>La Ruta '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' Cargas que son: '.$this->view->countNumbertEvent.'</td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'')).'"><button class="btn btn-mini btn-info" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'idHidden' => ''.$this->view->idPanel.'', 'hi' => ''.$this->view->dataHidden.'')).'"><span class="icon-remove"></span></a><br /></td>'
                    . '</tr>';              
                }    
                $this->view->routePanel.=$this->view->route;
            }
            
            if ($this->view->event=='shipments' && $this->view->dataHidden==0)
            {
                $this->view->alias="CR-";
                
                if ($this->view->status == 0)
                {
                    $this->view->shipment= '<tr>
                    <td><span class="icon-envelope"></span><br /></td>
                    <td><b>'.$this->view->alias.$this->view->idPanel.'</b><br /></td>'
                    . '<td><b>'.$this->view->availabilityDate.'</b><br /></td>'
                    . '<td><b> La Carga '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' rutas que son: '.$this->view->countNumbertEvent.'</b></td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'')).'"><button class="btn btn-mini btn-primary" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><span class="icon-remove"></span><br /></td>'
                    . '</tr>';
                }
                
                if ($this->view->status == 1)
                {
                    $this->view->shipment = '<td><b><span class="icon-ok"></span></b><br /></td>'
                    . '<td>'.$this->view->alias.$this->view->idPanel.'<br /></td>'
                    . '<td>'.$this->view->availabilityDate.'<br /></td>'
                    . '<td>La Carga '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' rutas que son: '.$this->view->countNumbertEvent.'</td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'')).'"><button class="btn btn-mini btn-info" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'idHidden' => ''.$this->view->idPanel.'', 'hi' => ''.$this->view->dataHidden.'')).'"><span class="icon-remove"></span></a><br /></td>'
                    . '</tr>';
                }
                $this->view->shipmentPanel.=$this->view->shipment;
            }
            
            if ($this->view->event=='shipments' && $this->view->coincidenceEvent==3 && $this->view->dataHidden==0 )
            { 
               $this->view->alias="CN-";
               
                if ($this->view->status == 0)
                {
                    $this->view->shipmentNotification= '<tr>
                    <td><span class="icon-envelope"></span><br /></td>
                    <td><b>'.$this->view->alias.$this->view->idPanel.'</b><br /></td>'
                    . '<td><b>'.$this->view->availabilityDate.'</b><br /></td>'       
                    . '<td><b> La Ruta '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' notificaci&oacute;n registrada que es la No.: '. $this->view->countNumbertEvent.'</b></td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'')).'"><button class="btn btn-mini btn-primary" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><span class="icon-remove"></span><br /></td>'
                    . '</tr>';
                }
                
                if ($this->view->status == 1)
                {
                    $this->view->shipmentNotification = '<td><b><span class="icon-ok"></span></b><br /></td>'
                    . '<td>'.$this->view->alias.$this->view->idPanel.'<br /></td>'
                    . '<td>'.$this->view->availabilityDate.'<br /></td>'
                    . '<td>La Ruta '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' notificaci&oacute;n registradas que es la No.: '.$this->view->countNumbertEvent.'</td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'')).'"><button class="btn btn-mini btn-info" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'idHidden' => ''.$this->view->idPanel.'', 'hi' => ''.$this->view->dataHidden.'')).'"><span class="icon-remove"></span></a><br /></td>'
                    . '</tr>';              
                }    
                $this->view->shipmentNotificationPanel.=$this->view->shipmentNotification;
            }
            
            if ($this->view->event=='notifications' && $this->view->dataHidden==0)
            {
                if ($this->view->coincidenceEvent==1)
                {
                     $this->view->alias="NC-";
                     $this->view->TypeEvent="Cargas";
                }  
               
                if ($this->view->coincidenceEvent==2)
                {
                     $this->view->alias="NR-";
                     $this->view->TypeEvent="Rutas";
                } 
                
                if ($this->view->status == 0)
                {
                    $this->view->notification= '<tr>
                    <td><span class="icon-star"></span><br /></td>
                    <td><b>'.$this->view->alias.$this->view->idPanel.'</b><br /></td>'
                    . '<td><b>'.$this->view->availabilityDate.'</b><br /></td>'
                    . '<td><b>La Notificaci&oacute;n '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' '.$this->view->TypeEvent.'  que son: '.$this->view->countNumbertEvent.'</b></td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'', 'ce' => ''.$this->view->coincidenceEvent.'')).'"><button class="btn btn-mini btn-primary" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><span class="icon-remove"></span><br /></td>'
                    . '</tr>';
                }
                
                if ($this->view->status == 1)
                {
                    $this->view->notification = '<td><b><span class="icon-ok"></span></b><br /></td>'
                    . '<td>'.$this->view->alias.$this->view->idPanel.'<br /></td>'
                    . '<td>'.$this->view->availabilityDate.'<br /></td>'
                    . '<td>La Notificaci&oacute;n '.$this->view->idEvent. ' registrada el '.$this->view->availabilityDate.' coincide con '.$key.' '.$this->view->TypeEvent.' que son: '.$this->view->countNumbertEvent.'</td>'
                    . '<td><b><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'id' => ''.$this->view->idEvent.'', 'ev' => ''.$this->view->event.'', 'ne' => ''.$this->view->numberEvent.'', 'st' => ''.$this->view->status.'', 'pa' => ''.$this->view->idPanel.'', 'us' => ''.$this->view->contactUser.'', 'ce' => ''.$this->view->coincidenceEvent.'')).'"><button class="btn btn-mini btn-info" type="button"><span class="icon-info-sign"></span>  M&aacute;s Detalles</button></a></b></td>'
                    . '<td><a href="'. $this->view->url(array('controller' => 'MyPanel', 'action' => 'details', 'idHidden' => ''.$this->view->idPanel.'', 'hi' => ''.$this->view->dataHidden.'')).'"><span class="icon-remove"></span></a><br /></td>'
                    . '</tr>';
                }
                $this->view->notificationsPanel.=$this->view->notification;
            }
        }               
    }
    
    
    
    public function detailsAction()
    {
    $idEvent = $this->getRequest()->getParam("id");
    $Event = $this->getRequest()->getParam("ev");
    $NumberEvent = $this->getRequest()->getParam("ne");
    $CoincidenceEvent = $this->getRequest()->getParam("ce");
    $Status = $this->getRequest()->getParam("st");
    $idPanel = $this->getRequest()->getParam("pa");
    $idHidden = $this->getRequest()->getParam("idHidden");
    $dataHidden = $this->getRequest()->getParam("hi");
    $ContactUser = $this->getRequest()->getParam("us");   
    $contactDetailsUser = str_replace("_"," ",$ContactUser);
    
    $em = $this->getEntityManager('DefaultDb');
    $updateStatusPanel = $em->getRepository('DefaultDb_Entity_EventPanel');
    
    $this->view->NumberEvent=substr($NumberEvent, 0, -1);
    $array=explode(',',$this->view->NumberEvent);
      
        if ($Status==0)
        {
            $this->view->updateStatusPanel =  $updateStatusPanel->updateEvent($idPanel);
        }
     
        
        if ($dataHidden==0)
        {
            $this->view->updateDataHidden =  $updateStatusPanel->updateDataHidden($idHidden);
            $this->view->Message = "<div class='alert alert-success'>"
                                   . "<br />"
                                   . "El evento <b>No.".$idHidden." </b>ha sido eliminada satisfactoriamente."
                                   . "<br />"
                                   . "Este ya no aparecer&aacute; mas en tu lista de eventos."
                                   . "<br /><br />"
                                   . "</div>"
                                   . "<script language='javascript'>"
                                   . "window.location='".$this->view->url(array('controller' => 'MyPanel', 'action' => 'index'))."'"
                                   . "</script>"; 
        }
        
        
        if ($Event=='routes')
        {
        $this->view->titleDetails="<h5>::: Rutas que coinciden con cargas disponibles :::</h5><br />";
        $this->view->Message =  "La <b>Ruta No. ".$idEvent."</b> que acaba de ser registrada por el <b>usuario ".$contactDetailsUser."</b>, coincide con las siguientes cargas:";
        $this->view->Head =  "Carga";
        
            for($i=0;$i<count($array);$i++)
            { 
            $this->view->shipments =  $updateStatusPanel->getShipmentsEvent($array[$i]);
            
                while ($value = $this->view->shipments->fetch(PDO::FETCH_ASSOC))
                {
                    $this->view->Body .= '<tr><td>'.$this->view->idShipments= $value['Shipments_Id'].'<br /></td>'
                    .'<td>'.$this->view->originShipments=$value['City_Origin_Name'].' , '.$value['State_O_Abbrev'].'<br /></td>'
                    .'<td>'.$this->view->destinyShipments=$value['City_Destiny_Name'].' , '.$value['State_D_Abbrev'].'<br /></td>'
                    .'<td>'.$this->view->vehicleShipments=$value['Vehicle_Name'].' De '.$value['Vehicle_Type_Name'].'<br /></td>'
                    .'<td>'.$this->this->view->DateShipments=$value['New_Availability_Date'].'<br /></td>'
                    .'<td>'.$this->view->CommentsShipments= $value['Comment'].'<br /></td>'
                    .'<td>'.$this->view->contactUserShipments= $value['FirstName_User'].'  '.$value['LastName_User'].'<br /></td></tr>';
                }
            }
        }
        
        if ($Event=='shipments')
        {
        $this->view->titleDetails="<h5>::: Cargas que coinciden con rutas disponibles :::</h5><br />";
        $this->view->Message =  "La <b>Carga No. ".$idEvent."</b> que acaba de ser registrada por el <b>usuario ".$contactDetailsUser."</b>, coincide con las siguientes rutas:";
        $this->view->Head =  "Ruta";
        
            for($i=0;$i<count($array);$i++)
            { 
            $this->view->routes =  $updateStatusPanel->getRoutesEvent($array[$i]);
            
                while ($value = $this->view->routes->fetch(PDO::FETCH_ASSOC))
                {
                    $this->view->Body .= '<tr><td>'.$this->view->idRoutes= $value['Route_Id'].'<br /></td>'
                    .'<td>'.$this->view->originRoutes=$value['City_Origin_Name'].' , '.$value['State_O_Abbrev'].'<br /></td>'
                    .'<td>'.$this->view->destinyRoutes=$value['City_Destiny_Name'].' , '.$value['State_D_Abbrev'].'<br /></td>'
                    .'<td>'.$this->view->vehicleRoutes=$value['Vehicle_Name'].' De '.$value['Vehicle_Type_Name'].'<br /></td>'
                    .'<td>'.$this->this->view->DateRoutes=$value['New_Availability_Date'].'<br /></td>'
                    .'<td><br /></td>'
                    .'<td>'.$this->view->CommentsRoutes= $value['Comment'].'<br /></td>'
                    .'<td>'.$this->view->contactUserRoutes= $value['FirstName_User'].'  '.$value['LastName_User'].'<br /></td></tr>';
                }
            }
        }
        
        if ($Event=='notifications' && $CoincidenceEvent == 1)
        {
        $this->view->titleDetails="<h5>::: Notificaciones que coinciden con una carga :::</h5><br />";
        $this->view->Message =  "La <b>Notificaci&oacute;n No. ".$idEvent."</b> que acaba de ser registrada por el <b>usuario ".$contactDetailsUser."</b>, coincide con las siguientes cargas:";
        $this->view->Head =  "Carga";
        
            for($i=0;$i<count($array);$i++)
            { 
            $this->view->shipmentsCoincidence =  $updateStatusPanel->getShipmentsEvent($array[$i]);
            
                while ($value = $this->view->shipmentsCoincidence->fetch(PDO::FETCH_ASSOC))
                {
                    $this->view->Body .= '<tr><td>'.$this->view->idShipmentsCoincidence= $value['Shipments_Id'].'<br /></td>'
                    .'<td>'.$this->view->originShipmentsCoincidence=$value['City_Origin_Name'].' , '.$value['State_O_Abbrev'].'<br /></td>'
                    .'<td>'.$this->view->destinyShipmentsCoincidence=$value['City_Destiny_Name'].' , '.$value['State_D_Abbrev'].'<br /></td>'
                    .'<td>'.$this->view->vehicleShipmentsCoincidence=$value['Vehicle_Name'].' De '.$value['Vehicle_Type_Name'].'<br /></td>'
                    .'<td>'.$this->this->view->DateShipments=$value['New_Availability_Date'].'<br /></td>'
                    .'<td>'.$this->view->CommentsShipmentsCoincidence= $value['Comment'].'<br /></td>'
                    .'<td>'.$this->view->contactUserShipmentsCoincidence= $value['FirstName_User'].'  '.$value['LastName_User'].'<br /></td></tr>';
                }
            }
        }
        
        if ($Event=='notifications' && $CoincidenceEvent == 2)
        {
        $this->view->titleDetails="<h5>::: Notificaciones que coinciden conuna unidad de transporte disponible :::</h5><br />";
        $this->view->Message =  "La <b>Notificaci&oacute;n No. ".$idEvent."</b> que acaba de ser registrada por el <b>usuario ".$contactDetailsUser."</b>, coincide con las siguientes rutas:";
        $this->view->Head =  "Ruta";
        
            for($i=0;$i<count($array);$i++)
            { 
            $this->view->routesCoincidence =  $updateStatusPanel->getRoutesEvent($array[$i]);
            
                while ($value = $this->view->routesCoincidence->fetch(PDO::FETCH_ASSOC))
                {
                    $this->view->Body .= '<tr><td>'.$this->view->idRoutesCoincidence= $value['Route_Id'].'<br /></td>'
                    .'<td>'.$this->view->originRoutesCoincidence=$value['City_Origin_Name'].' , '.$value['State_O_Abbrev'].'<br /></td>'
                    .'<td>'.$this->view->destinyRoutesCoincidence=$value['City_Destiny_Name'].' , '.$value['State_D_Abbrev'].'<br /></td>'
                    .'<td>'.$this->view->vehicleRoutesCoincidence=$value['Vehicle_Name'].' De '.$value['Vehicle_Type_Name'].'<br /></td>'
                    .'<td>'.$this->this->view->DateRoutes=$value['New_Availability_Date'].'<br /></td>'
                    .'<td><br /></td>'
                    .'<td>'.$this->view->CommentsRoutesCoincidence= $value['Comment'].'<br /></td>'
                    .'<td>'.$this->view->contactUserRoutesCoincidence= $value['FirstName_User'].'  '.$value['LastName_User'].'<br /></td></tr>';
                }
            }
        }
    }
}
                        
?>



