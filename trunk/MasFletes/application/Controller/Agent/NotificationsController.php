<?php
class Agent_NotificationsController extends Model3_Controller
{
    private $_credentials;
    
    public function init()
    {
        if(!Model3_Auth::isAuth())
            $this->redirect();
        else
        {
            $role = Model3_Auth::getCredentials('type');
            if( $role !== DefaultDb_Entity_User::TYPE_COORDINATOR )
            {
               Model3_Auth::deleteCredentials();
               $this->redirect();
            }
        }
        $this->_credentials = Model3_Auth::getCredentials();
        $this->view->setTemplate('Agent');
    }
    
    public function indexAction()
    {
        $this->view->getJsManager()->addJs('helper/details.js');
        $this->view->getJsManager()->addJs('helper/search.js');
        $this->view->getJsManager()->addJs('helper/state.js');
        
        $this->view->getJsManager()->addJsVar('urlGetDetails', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Details', 'action' => 'information')).'"');
        $this->view->getJsManager()->addJsVar('urlSearch', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Search', 'action' => 'search')).'"');
        $this->view->getJsManager()->addJsVar('urlGetCities', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')).'"');
        
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->notifications = $em->getRepository('DefaultDb_Entity_Notification')->findBy(array('user' => $user));
    }
    
    public function formAction()
    {
        $this->view->getJsManager()->addJs('helper/state.js');
        $this->view->getJsManager()->addJsVar('urlGetCities', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')).'"');
        
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $em = $this->getEntityManager('DefaultDb');
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Notification')->find($idReq);
        }
        
        if($this->getRequest()->isPost())
        {
            $em = $this->getEntityManager('DefaultDb');
            $post = $this->getRequest()->getPost();
            
            if( is_null($this->view->dataRequest) )
                $notification = new DefaultDb_Entity_Notification();
            else
                $notification = $this->view->dataRequest;
                        
            $notification->setNotificationDate(new DateTime());
            $notification->setActionType($post['actionType']);            
            
            $sourceState = $em->getRepository('DefaultDb_Entity_State')->find($post['sourceState']);
            $notification->setStateOrigin($sourceState);
            
            $sourceCity = $em->getRepository('DefaultDb_Entity_City')->find($post['sourceStateCity']);
            $notification->setMunicipalityOrigin($sourceCity);
            
            $destinyState = $em->getRepository('DefaultDb_Entity_State')->find($post['destinyState']);
            $notification->setStateDestiny($destinyState);
            
            $destinyCity = $em->getRepository('DefaultDb_Entity_City')->find($post['destinyStateCity']);
            $notification->setMunicipalityDestiny($destinyCity);
            
            $vehicle = $em->getRepository('DefaultDb_Entity_Vehicle')->find($post['vehicle']);
            $notification->setVehicle($vehicle);
            
            $vehicleType = $em->getRepository('DefaultDb_Entity_VehicleType')->find($post['vehicleType']);
            $notification->setVehicleType($vehicleType);
            
            $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
            $notification->setUser($user);
            
            $em->persist($notification);
            $em->flush();
            
            
              ///////////////////////////////////////////////////////////////////
            // Bsqueda que coincida con la notificacion para enviar correo    //
            // ActionType:  1(Shipment), 2(Routes)                            //
            ////////////////////////////////////////////////////////////////////
            
            $action=$notification->getActionType();
            $date=$notification->getNotificationDate()->format('y-m-d');
            
            $emailUser = $em->getRepository('DefaultDb_Entity_User');
            $this->view->email =  $emailUser->getEmailUser($this->_credentials['id']);
            foreach ($this->view->email as $value)
            { 
                $emailAgent = $value['username'];
            }
            
           //////////////////////////////////////// 
          //                                     //
          //       ::: CONFIGURATIONS :::        //
          //                                     //   
          /////////////////////////////////////////  
            
            $resultConfiguration = $em->getRepository('DefaultDb_Entity_ConfigurationEmail');
            $this->view->resultConfiguration =  $resultConfiguration->getDetailsConfigurations($this->_credentials['id']);
                 
            while ($rowConfigurations = $this->view->resultConfiguration ->fetch(PDO::FETCH_ASSOC))
            {
                $notificationsConfig=$rowConfigurations['send_notifications'];  
                $emailAdd=$rowConfigurations['email'];  
            }  
           
            
           $emnot = $this->getEntityManager('DefaultDb');
           $event_panel = new DefaultDb_Entity_EventPanel();
           
            if ($action==1)
            {
                $shipments = $em->getRepository('DefaultDb_Entity_Shipment');
                $shipment = new DefaultDb_Entity_Shipment();
                    
                list ($typeText,$eventText)=$shipment->getTypeText();
                    
                $this->view->shipments =  $shipments->getNotificationForShipments($vehicle->getId(),$destinyState->getId(),$destinyCity->getId(),$date);
                $countShipments= count($this->view->shipments);
                    
                if ($countShipments !=0)
                {
                    foreach ($this->view->shipments as $key)
                    {
                        $this->view->idShipments.= $key['Shipments_Id'].'<br />';
                        $this->view->idShipment.= $key['Shipments_Id'].',';
                        $this->view->destinyShipments.=$key['City_Destiny_Name'].' , '.$key['State_D_Abbrev'].'<br />';
                        $this->view->originShipments.=$key['City_Origin_Name'].' , '.$key['State_O_Abbrev'].'<br />';
                        $this->view->vehicleShipments.=$key['Vehicle_Name'].' De '.$key['Vehicle_Type_Name'].'<br />';
                        $this->view->Date.=$key['New_Availability_Date'].'<br />';
                        $this->view->Comments.= $key['Comment'].'<br />';
                    }
                                    
                    $event_panel->setEvent('notifications');
                    $event_panel->setIdEvent($notification->getId());
                    $event_panel->setCreationDate($notification->getNotificationDate());
                    $event_panel->setIdUser($this->_credentials['id']);
                    $event_panel->setStatus('0');
                    $event_panel->setDataHidden('0');
                    $event_panel->setCoincidenceEvent('1');
                    $event_panel->setCoincidenceNumber($this->view->idShipment);
                    $emnot->persist($event_panel);
                    $emnot->flush();
                   
                        if ($notificationsConfig==0)
                        {
                        $correo='<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head><body bgcolor="#F5F5F5" leftmargin="18px" topmargin="10px" rightmargin="10px" bottommargin="10px">
                                <h3 style="color:#AF080F;text-align:left;">:::::: Notificaci&oacute;n de '.$typeText.' de MasFletes.com ::::::</h3>
                                <p style="font-family:Arial;font-size:12px;line-height:16px;">
                                <strong>Tenemos '.$countShipments.' '.$typeText.' de tu inter&eacute;s que est&aacute;n disponibles.</strong><br /><br />
                                <table border="1" cellpadding="3" cellspacing="3" style="font-size:12px;">
                                    <tr>
                                        <td align="center"><strong>'.$typeText.' No.</strong></td>
                                        <td align="center"><strong>Origen</strong></td>
                                        <td align="center"><strong>Destino</strong></td>
                                        <td align="center"><strong>Veh&iacute;culo</strong></td>
                                        <td align="center"><strong>Disponible Hasta</strong></td>
                                        <td align="center"><strong>Comentarios</strong></td>
                                    </tr>
                                    <tr>
                                        <td align="center"> '.$this->view->idShipments.'</td>
                                        <td> '.$this->view->originShipments.'</td>
                                        <td> '.$this->view->destinyShipments.'</td>
                                        <td> '.$this->view->vehicleShipments.'</td>
                                        <td> '.$this->view->Date.'</td>
                                        <td> '.$this->view->Comments.'</td>
                                    </tr>
                                </table><br />
                                <strong>Otros clientes interesados en estas '.$typeText.' tambi&eacute;n han sido notificados.</strong><br /><br />
                                <strong>Si deseas ser notificado de otras rutas por favor, cont&aacute;ctanos.</strong><br /><br />
                                <strong>De interesarte alguna de ellas contacta a tu coordinador o comun&iacute;cate a los siguientes tel&eacute;fonos:</strong><br />
                                <strong>Nextel: 62 * 179099 *5 &oacute; *2 &oacute; al 01 - 444 - 2571546 con Arturo Mac&iacute;as</strong><br />
                                <strong>Oficina: 01 - 444 - 8240764 Con Cesar Castillo</strong><br />
                                <strong>Oficina: 01 - 444 - 8240647 </strong><br />
                                <strong>Correo : masfletes@masfletes.com</strong><br /><br />
                                </p></body></html>';

                                $mail = new PHPMailer();
                                $mail->IsSMTP();
                                $mail->Host = 'mail.masdistribucion.com.mx';
                                $mail->Port = 587;
                                $mail->SMTPAuth = true;
                                $mail->Username = 'admin@masdistribucion.com.mx';
                                $mail->Password = 'distribucion2900';
                                $mail->From = 'administrador@masfletes.com';
                                $mail->FromName = 'Notificaciones de Mas Fletes';
                                $mail->AddAddress($emailAgent,'Coordinador');
                                if ($emailAdd != "")
                                { 
                                     $mail->AddBCC(''.$emailAdd.'',"Usuario Mas Fletes");
                                } 
                              /*  foreach (explode(',', $notification->getEmail()) as $var)
                                {   $mail->AddAddress($var);    }*/
                                $mail->Subject = 'Notificaciones de '.$typeText.' de Mas Fletes';
                                $mail->MsgHTML($correo);
                                $mail->Send();
                         }   
                    }   
            }   
            
            if ($action==2)
            {
                 $routes = $em->getRepository('DefaultDb_Entity_Route');
                 $route = new DefaultDb_Entity_Route();
                 
                 $this->view->routes =  $routes->getNotificationForRoutes($vehicle->getId(),$destinyState->getId(),$destinyCity->getId(),$date);
                 $countRoutes= count($this->view->routes);
                     
                 list ($typeText,$eventText)=$route->getTypeText();
                 
                 if ($countRoutes != 0)
                 {
                    foreach ($this->view->routes as $key)
                    {
                        $this->view->idRoutes.= $key['Route_Id'].'<br />';
                        $this->view->idRoute.= $key['Route_Id'].',';
                        $this->view->destinyRoutes.=$key['City_Destiny_Name'].' , '.$key['State_D_Abbrev'].'<br />';
                        $this->view->originRoutes.=$key['City_Origin_Name'].' , '.$key['State_O_Abbrev'].'<br />';
                        $this->view->vehicleRoutes.=$key['Vehicle_Name'].' De '.$key['Vehicle_Type_Name'].'<br />';
                        $this->view->Date.=$key['New_Availability_Date'].'<br />';
                        $this->view->Comments.= $key['Comment'].'<br />';
                    }
                                
                    $event_panel->setEvent('notifications');
                    $event_panel->setIdUser($this->_credentials['id']);
                    $event_panel->setIdEvent($notification->getId());
                    $event_panel->setCreationDate($notification->getNotificationDate());
                    $event_panel->setStatus('0');
                    $event_panel->setDataHidden('0');
                    $event_panel->setCoincidenceEvent('2');
                    $event_panel->setCoincidenceNumber($this->view->idRoute);
                    $emnot->persist($event_panel);
                    $emnot->flush();

                    if ($notificationsConfig==0)
                    {               
                             
                    $correo='<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head><body bgcolor="#F5F5F5" leftmargin="18px" topmargin="10px" rightmargin="10px" bottommargin="10px">
                            <h3 style="color:#AF080F;text-align:left;">:::::: Notificaci&oacute;n de unidades disponibles en MasFletes.com ::::::</h3>
                            <p style="font-family:Arial;font-size:12px;line-height:16px;">
                            <strong>Tenemos '.$countRoutes.' unidades de tu inter&eacute;s que est&aacute;n disponibles.</strong><br /><br />
                            <table border="1" cellpadding="3" cellspacing="3" style="font-size:12px;">
                                <tr>
                                    <td align="center"><strong>'.$typeText.' No.</strong></td>
                                    <td align="center"><strong>Origen</strong></td>
                                    <td align="center"><strong>Destino</strong></td>
                                    <td align="center"><strong>Veh&iacute;culo</strong></td>
                                    <td align="center"><strong>Disponible</strong></td>
                                    <td align="center"><strong>Comentarios</strong></td>    
                                </tr>
                                <tr>
                                    <td align="center"> '.$this->view->idRoutes.'</td>
                                    <td> '.$this->view->originRoutes.'</td>
                                    <td> '.$this->view->destinyRoutes.'</td>
                                    <td> '.$this->view->vehicleRoutes.'</td>
                                    <td> '.$this->view->Date.'</td>
                                    <td> '.$this->view->Comments.'</td>   
                                </tr>
                            </table><br />
                            <strong>Otros clientes interesados en estas rutas tambi&eacute;n han sido notificados.</strong><br /><br />
                            <strong>Si deseas ser notificado de otras rutas por favor, cont&aacute;ctanos.</strong><br /><br />
                            <strong>De interesarte alguna de ellas contacta a tu coordinador o comun&iacute;cate a los siguientes tel&eacute;fonos:</strong><br />
                            <strong>Nextel: 62 * 179099 *5 &oacute; *2 &oacute; al 01 - 444 - 2571546 con Arturo Mac&iacute;as</strong><br />
                            <strong>Oficina: 01 - 444 - 8240764 Con Cesar Castillo</strong><br />
                            <strong>Oficina: 01 - 444 - 8240647 </strong><br />
                            <strong>Correo : masfletes@masfletes.com</strong><br /><br />
                            </p></body></html>';
                            
                    
                            $mail = new PHPMailer();
                            $mail->IsSMTP();
                            $mail->Host = 'mail.masdistribucion.com.mx';
                            $mail->Port = 587;
                            $mail->SMTPAuth = true;
                            $mail->Username = 'admin@masdistribucion.com.mx';
                            $mail->Password = 'distribucion2900';
                            $mail->From = 'administrador@masfletes.com';
                            $mail->FromName = 'Notificaciones de MasFletes.Com';
                            $mail->AddAddress($emailAgent,'Coordinador');
                            if ($emailAdd != "")
                                { 
                                     $mail->AddBCC(''.$emailAdd.'',"Usuario Mas Fletes");
                                } 
                           /* foreach (explode(',', $notification->getEmail()) as $var)
                            {   $mail->AddAddress($var);    }*/
                            $mail->Subject = 'Notificaciones de '.$typeText.' de Mas Fletes';
                            $mail->MsgHTML($correo);
                            $mail->Send();
                    }
                }
            }
            
            
            
            if( is_null($this->view->dataRequest) )
                Model3_Site::setTempMsg("msg", "La notificaci&oacute;n ha sido registrada correctamente");
            else
                Model3_Site::setTempMsg("msg", "Cambios guardados correctamente");
            $this->redirect ("Agent/".$this->getRequest()->getController()."/form");
        }
    }
}