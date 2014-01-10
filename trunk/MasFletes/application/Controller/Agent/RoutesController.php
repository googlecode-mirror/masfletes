<?php
class Agent_RoutesController extends Model3_Controller
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
        $this->view->getJsManager()->addJs('helper/state.js');
        $this->view->getJsManager()->addJs('helper/details.js');
        $this->view->getJsManager()->addJs('helper/search.js');
        //Variables
        $this->view->getJsManager()->addJsVar('urlGetCities', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')) . '"');
        $this->view->getJsManager()->addJsVar('urlSearch', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'Search', 'action' => 'search')).'"');
        $this->view->getJsManager()->addJsVar('urlGetDetails', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'Details', 'action' => 'information')) . '"');
        
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->routes = $em->getRepository('DefaultDb_Entity_Route')->findBy(array('user' => $user));
    }
    
    public function formAction()
    {
        $this->view->getJsManager()->addJs('helper/state.js');
        $this->view->getJsManager()->addJsVar('urlGetCities', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')).'"');
        
        $em = $this->getEntityManager('DefaultDb');
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Route')->findOneBy(array('id' => $idReq, 'user' => $user));
        }        
        
        if($this->getRequest()->isPost())
        {
            $post = $this->getRequest()->getPost();            
            if( is_null($this->view->dataRequest) )
                $route = new DefaultDb_Entity_Route();
            else
                $route = $this->view->dataRequest;
            
            $route->setRouteAccepted(1);
            $route->setEmail($post['email']);
            $route->setFrequency($post['frequency']);
            $route->setEffectiveDays($post['effectiveDays']);
            $route->setLoadAvailabilityDate(new DateTime($post['startDate']));
            $route->setTiresCondition($post['tireCondition']);
            $route->setLetterMechanicalConditions($post['mechanicalCondition']);
            $route->setPlates($post['activePlates']);
            $route->setDriverLicence($post['activeLicense']);
            $route->setOwnTarpaulin($post['tarpaulin']);
            $route->setSatelitalTracking($post['satelitalTracking']);
            $route->setCellularPhone($post['driverPhone']);
            $route->setLetters_carry($post['letterCarry']);
            $route->setComments($post['comments']);
            
            $sourceState = $em->getRepository('DefaultDb_Entity_State')->find($post['sourceState']);
            $route->setStateOrigin($sourceState);
            
            $sourceCity = $em->getRepository('DefaultDb_Entity_City')->find($post['sourceStateCity']);
            $route->setMunicipalityOrigin($sourceCity);
            
            $destinyState = $em->getRepository('DefaultDb_Entity_State')->find($post['destinyState']);
            $route->setStateDestiny($destinyState);
            
            $destinyCity = $em->getRepository('DefaultDb_Entity_City')->find($post['destinyStateCity']);
            $route->setMunicipalityDestiny($destinyCity);
            
            $vehicle = $em->getRepository('DefaultDb_Entity_Vehicle')->find($post['vehicleCB']);
            $route->setVehicle($vehicle);
            
            $vehicleType = $em->getRepository('DefaultDb_Entity_VehicleType')->find($post['vehicleTypeCB']);
            $route->setVehicleType($vehicleType);
            
            $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
            $route->setUser($user);
            
            $em->persist($route);
            $em->flush();
            
            $date=$route->getLoadAvailabilityDate()->format('Y-m-d');
           
            $emailUser = $em->getRepository('DefaultDb_Entity_User');
            $this->view->email =  $emailUser->getEmailUser($this->_credentials['id']);
            foreach ($this->view->email as $value)
            { 
                $emailAgent = $value['username'];
            }
                
             ////////////////////////////////////////////////////////////////////
            // Mi Panel                                                       //
            // Rutas que coinciden con cargas                                 //
            ////////////////////////////////////////////////////////////////////
            
            $Shipments = $em->getRepository('DefaultDb_Entity_Shipment');
            $this->view->getShipment =  $Shipments->getNotificationForShipments($vehicle->getId(),$destinyState->getId(),$destinyCity->getId(),$date);
            $countShipmentsPanel = count($this->view->getShipment);
           
            if ($countShipmentsPanel >= 1)
            {
                foreach ($this->view->getShipment as $key)
                {
                    $this->view->idShipmen.= $key['Shipments_Id'].',';
                }
                    
                $event_panel = new DefaultDb_Entity_EventPanel();
                $event_panel->setEvent('routes');
                $event_panel->setIdEvent($route->getId());
                $event_panel->setCoincidenceNumber($this->view->idShipmen);
                $event_panel->setCreationDate($route->getLoadAvailabilityDate());
                $event_panel->setStatus('0');
                $event_panel->setDataHidden('0');
                    
                $em->persist($event_panel);
                $em->flush();
            }
            
            ///////////////////////////////////////////////////////////////////
            // Mi Panel           
            // Rutas que coinciden con una notificacion                                          //
            ////////////////////////////////////////////////////////////////////    
                 
                 $routesNotification = $em->getRepository('DefaultDb_Entity_Notification');
                 $actionType='2';
                 $this->view->routesNotifications =  $routesNotification->getCoincidenceEvent($actionType,$vehicle->getId(),$destinyState->getId(),$destinyCity->getId());
                 $countRoutesNotification= count($this->view->routesNotifications);
                
                 if ($countRoutesNotification != 0 )
                 {
                     foreach ($this->view->routesNotifications as $key)
                     {
                     $this->view->idNotification= $key['Id_Notification'];
                     }
                      
                     $em = $this->getEntityManager('DefaultDb');
                     $notificationEventPanel = new DefaultDb_Entity_EventPanel();
                     $notificationEventPanel->setEvent('routes');
                     $notificationEventPanel->setIdEvent($route->getId());
                     $notificationEventPanel->setCreationDate($route->getLoadAvailabilityDate());
                     $notificationEventPanel->setStatus('0');
                     $notificationEventPanel->setDataHidden('0');
                     $notificationEventPanel->setCoincidenceEvent('3');
                     $notificationEventPanel->setCoincidenceNumber($this->view->idNotification);
                     $em->persist($notificationEventPanel);
                     $em->flush();
                 }
                 
            
            $getZone = $em->getRepository('DefaultDb_Entity_Zone');
            $this->view->getZone =  $getZone->getZone($destinyState->getId(),$destinyCity->getId());
            $countZone = count($this->view->getZone);
             
            if ($countZone <= 0 )
            {
                $this->view->messageZone = "* NOTA: Por el momento nuestro sistema no encuentra resultados que coincidan con una zona.<br />";
            }
            
            if ($countZone != 0 )
            {
                foreach ($this->view->getZone as $key)
                {
                    $this->view->numberZone = $key['Number_Zone'];
                    $this->view->nameZone = $key['Name_Zone'];
                }    
            
               $this->view->shipmentZone=$Shipments-> getSearchShipmentsForZone($vehicle->getId(),$this->view->numberZone,$date);
               $countShipmentZone = count($this->view->shipmentZone);
                
               if ($countShipmentZone >= 0 )
               {
                    while ($value = $this->view->shipmentZone->fetch(PDO::FETCH_ASSOC))
                    { 
                    $this->view->id.= $value['Shipments_Id'].'<br />';
                    $this->view->destiny.=$value['City_Destiny_Name'].' , '.$value['State_D_Abbrev'].'<br />';
                    $this->view->origin.=$value['City_Origin_Name'].' , '.$value['State_O_Abbrev'].'<br />';
                    $this->view->vehicle.=$value['Vehicle_Name'].' De '.$value['Vehicle_Type_Name'].'<br />';
                    $this->view->Date.=$value['New_Availability_Date'].'<br />';
                    $this->view->Comments.= $value['Comment'].'<br />';
                    $this->view->Zone.= $value['Zone_Name'].'<br />';
                    }
                    
                $this->view->detailsZone='<table border="1" cellpadding="3" cellspacing="3"style=" font-size: 11px;">
                        <tr>
                            <td align="center"><strong>Carga</strong></td>
                            <td align="center"><strong>Destino</strong></td>
                            <td align="center"><strong>Veh&iacute;culo</strong></td>
                            <td align="center"><strong>Disponible Hasta</strong></td>
                            <td align="center"><strong>Comentarios</strong></td>
                            <td align="center"><strong>Zona</strong></td>
                        </tr>
                        <tr>
                            <td align="center"> '.$this->view->id.'</td>
                            <td> '.$this->view->destiny.'</td>
                            <td> '.$this->view->vehicle.'</td>
                            <td> '.$this->view->Date.'</td>
                            <td> '.$this->view->Comments.'</td>
                            <td> '.$this->view->Zone.'</td>
                        </tr>
                    </table><br />';
                
                $this->view->messageZone = '* NOTA: Esta ruta se encuentra dentro de la Zona No. '.$this->view->numberZone.' ( '.$this->view->nameZone.' )'
                . ' y coincide con Cargas.<br />';
                
               }
            }
            
           /////////////////////////////////////////////////////////////////////
           //           
           //           E::N::V::I::O::  C::O::R::R::E::O
           //
           /////////////////////////////////////////////////////////////////////
           // Buscar rutas que coinicdan con un notificacion registrada y    //
           // que se envie al correo, aun no funciona si el usuario quiere    //
           // o no que se le envíen.                                          //
           //                                                                 //
           // ActionType:  1(Shipment), 2(Routes)                             //
           /////////////////////////////////////////////////////////////////////
         
             $notification = $em->getRepository('DefaultDb_Entity_Notification');
            $actiontype='2';
            $this->view->email =  $notification->getEmailForSend($actiontype,$vehicle->getId(),$destinyState->getId(),$destinyCity->getId());
            $countEmail= count($this->view->email);
           
                if ($countEmail !=0)
                { 
                    foreach ($this->view->email as $var)
                    {
                        $this->view->idofnotification.=$var['id'];
                        $this->view->emailforuser.=$var['email'];
                        $this->view->notificationdate=$var['Notification_Date_Format'];
                    }
                    
                    $routes = $em->getRepository('DefaultDb_Entity_Route');
                    $this->view->routes =  $routes->getNotificationForRoutes($vehicle->getId(),$destinyState->getId(),$destinyCity->getId(),$this->view->notificationdate);
                    $countRoutes= count($this->view->routes);
                    
                    if ($countRoutes !=0)
                    {
                    list ($typeText,$eventText)=$route->getTypeText();
                             
                        foreach ($this->view->routes as $key)
                        {
                            $this->view->idRoutes.= $key['Route_Id'].'<br />';
                            $this->view->destinyRoutes.=$key['City_Destiny_Name'].' , '.$key['State_D_Abbrev'].'<br />';
                            $this->view->originRoutes.=$key['City_Origin_Name'].' , '.$key['State_O_Abbrev'].'<br />';
                            $this->view->vehicleRoutes.=$key['Vehicle_Name'].' De '.$key['Vehicle_Type_Name'].'<br />';
                            $this->view->Date.=$key['New_Availability_Date'].'<br />';
                            $this->view->Comments.= $key['Comment'].'<br />';
                        }
                                
                        $correo='<html><head></head><body bgcolor="#F5F5F5" leftmargin="18px" topmargin="10px" rightmargin="10px" bottommargin="10px">
                        <h3 style="color:#AF080F;text-align:left;">:::::: Notificaci&oacute;n de unidades disponibles en MasFletes.com ::::::</h3>
                        <p style="font-family:Arial;font-size:12px;line-height:16px;">
                        <strong>Tenemos '.$countRoutes.' unidades de tu inter&eacute;s que est&aacute;n disponibles.</strong><br /><br />
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
                        <strong>Oficina: 01 - 444 - 8240647</strong><br />
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
                        $mail->FromName = 'MasFletes.Com';
                        $mail->AddAddress($emailAgent,'Coordinador');
                       /* foreach (explode(',', $this->view->emailforuser) as $varx)
                        {
                        $mail->AddAddress($varx);
                        }*/
                        $mail->Subject = 'Notificaciones de '.$typeText.' de Mas Fletes';
                        $mail->MsgHTML($correo);
                        $mail->Send();
                    }
                }
            
            ////////////////////////////////////////////////////////////////////
            //                                                                //
            // BUSQUEDA DE CARGAS QUE COINCIDEN O NO CON   RUTA               //                                                         
            //                                                                //                                                
            ////////////////////////////////////////////////////////////////////
            
            $coincide = $em->getRepository('DefaultDb_Entity_Shipment');
            $this->view->coincide =  $coincide->getNotificationForShipments($vehicle->getId(),$destinyState->getId(),$destinyCity->getId(),$date);
            $countShipments= count($this->view->coincide);
            
            
            //////////////////////////////////////////////////////////////////// 
            //                                                                //
            //  Esta sección envía correos a: Coordinadores cuando no         //
            //  encuentra coincidnecia con alguna carga                       //
            //                                                                //
            //////////////////////////////////////////////////////////////////// 
            
            if ( $countShipments<=0)
            {
                list ($typeText,$eventText)=$route->getTypeText();
                    
                $correo='<html><head></head><body bgcolor="#F5F5F5" leftmargin="18px" topmargin="10px" rightmargin="10px" bottommargin="10px">
                <h3 style="color:#AF080F;text-align:left;">:::::: Notificaci&oacute;n de '.$typeText.' de MasFletes.com ::::::</h3>
                <p style="font-family:Arial;font-size:13px;line-height:16px;">
                <strong>Un usuario acaba de registrar una '.$typeText.' con estos datos:</strong><br /><br />
                <strong>* '.$typeText.' n&uacute;mero:  </strong>'.$route->getId().'<br />
                <strong>* De:  </strong>'.utf8_decode($sourceCity->getName().' , '.$sourceState->getName()).'<br />
                <strong>* A:  </strong>'.utf8_decode($destinyCity->getName().' , '.$destinyState->getName()).'<br />
                <strong>* Con Veh&iacute;culo:  </strong> '.$vehicle->getName().' , '.$vehicleType->getName().'<br />
                <strong>* Fecha Disponible:  </strong>'.$date.'<br />
                <strong>* Comentarios:  </strong>'.$route->getComments().'<br /><br />
                <strong>* NOTA: Por el momento ninguna de nuestras opciones arrojan resultados con los datos de esta '.$typeText.'.  **</strong> <br /> <br />										
                <strong>'.$this->view->messageZone.'</strong><br />
                <strong>Gracias por utilizar MasFletes.</strong><br />
                <strong>www.masfletes.com</strong><br /><br />
                </p></body></html>';
                    
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = 'mail.masdistribucion.com.mx';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'admin@masdistribucion.com.mx';
                $mail->Password = 'distribucion2900';
                $mail->From = 'admin@masdistribucion.com.mx';
                $mail->FromName = 'Notificaciones de Mas Fletes';
                $mail->AddAddress($emailAgent,'Coordinador');
                $mail->Subject = 'Notificaciones de '.$typeText.' de Mas Fletes';
                $mail->MsgHTML($correo);
                $mail->Send();
            }
            
            
            //////////////////////////////////////////////////////////////////// 
            //                                                                //
            //  Esta sección envía correos a: Coordinador cuando si           //
            //  encuentra una ruta que coincide con la carga ingresada        //                                                    
            //                                                                //
            //////////////////////////////////////////////////////////////////// 
           
            if ($countShipments !=0)
            {
                foreach ($this->view->coincide as $key)
                {
                    $this->view->idShipments.= $key['Shipments_Id'].'<br />'; 
                    $this->view->emailShipments.= $key['contact_name'].'<br />';
                    $this->view->comShipments.= $key['Comment'].'<br />';
                    $this->view->dateShipments.= $key['New_Availability_Date'].'<br />';
                }
                    
                list ($typeText,$eventText)=$route->getTypeText();
		
                $correo='<html><head></head><body bgcolor="#F5F5F5" leftmargin="18px" topmargin="10px" rightmargin="10px" bottommargin="10px">
                <h3 style="color:#AF080F;text-align:left;">:::::: Notificaci&oacute;n de '.$typeText.' de MasFletes.com ::::::</h3>
                <p style="font-family:Arial;font-size:13px;line-height:16px;">
                <strong>Se encontraron las siguientes '.$eventText.' que coinciden con la publicaci&oacute;n de un usuario, los detalles son: </strong><br />
                <strong>* Correo: </strong><br /><br />
                <strong>Por favor contactar con los correos electronicos que aparecen acontinuaci&oacute;n:</strong><br /><br />
		<strong>INFORMACI&Oacute;N GENERAL</strong><br />
                <strong>**************************************************************************************</strong><br />
                <strong>* Ruta No.:'.$route->getId().'<br />
                <strong>* De:  </strong>'.utf8_decode($sourceCity->getName().' , '.$sourceState->getName()).'<br />
                <strong>* A:  </strong>'.utf8_decode($destinyCity->getName().' , '.$destinyState->getName()).'<br />
                <strong>* Con Veh&iacute;culo:  </strong> '.$vehicle->getName().' , '.$vehicleType->getName().'<br />
                <strong>**************************************************************************************</strong><br />							
                <table border="1" cellpadding="5" cellspacing="5">
                    <tr>
                        <td align="center"><strong>Carga</strong></td>
                        <td align="center"><strong>Correo</strong></td>
                        <td align="center"><strong>Comentario</strong></td>
                        <td align="center"><strong>Fecha Carga</strong></td>
                    </tr>
                    <tr>
                        <td> '.$this->view->idShipments.'</td>
                        <td> '.$this->view->emailShipments.'</td>
                        <td> '.$this->view->comShipments.'</td>
                        <td> '.$this->view->dateShipments.'</td>
                    </tr>
                </table><br /><br />
                <strong>'.$this->view->messageZone.'</strong><br />
                <strong>'.$this->view->detailsZone.'</strong><br />
                <strong>Gracias por utilizar MasFletes.</strong><br />
                <strong>www.masfletes.com</strong><br /><br />
                </p></body></html>';
                        
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = 'mail.masdistribucion.com.mx';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'admin@masdistribucion.com.mx';
                $mail->Password = 'distribucion2900';
                $mail->From = 'admin@masdistribucion.com.mx';
                $mail->FromName = 'Notificaciones de Mas Fletes';
                $mail->AddAddress($emailAgent,'Coordinador');
                $mail->Subject = 'Notificaciones de '.$typeText.' de Mas Fletes';
                $mail->MsgHTML($correo);
                $mail->Send();
                }
            
            if( is_null($this->view->dataRequest) )
                Model3_Site::setTempMsg("msg", "La ruta ha sido registrada correctamente");
            else
                Model3_Site::setTempMsg("msg", "Cambios guardados correctamente");
            $this->redirect ("Agent/".$this->getRequest()->getController()."/form");
                
        }
    }
}