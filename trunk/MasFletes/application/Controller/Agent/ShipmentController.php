<?php

class Agent_ShipmentController extends Model3_Controller
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
        
        $this->view->getJsManager()->addJsVar('urlGetCities', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')).'"');
        $this->view->getJsManager()->addJsVar('urlGetDetails', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Details', 'action' => 'information')).'"');
        $this->view->getJsManager()->addJsVar('urlSearch', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Search', 'action' => 'search')).'"');
        $this->view->getJsManager()->addJsVar('urlDelete', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Modal', 'action' => 'delete')).'"');
        
        $em = $this->getEntityManager('DefaultDb');        
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->shipments = $em->getRepository('DefaultDb_Entity_Shipment')->findBy(array('user' => $user));
    }

    public function formAction()
    {
        $this->view->getJsManager()->addJs('helper/state.js');
        $this->view->getJsManager()->addJsVar('urlGetCities', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')) . '"');
        $em = $this->getEntityManager('DefaultDb');
        
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Shipment')->findOneBy(array('id' => $idReq, 'user' => $user));
        }
        
        if ($this->getRequest()->isPost())
        {
            $post = $this->getRequest()->getPost();
            if( is_null($this->view->dataRequest) )
                $shipment = new DefaultDb_Entity_Shipment();
            else
                $shipment =  $this->view->dataRequest;
            
            $shipment->setContactName("");
            $shipment->setContactPhone("");
            $shipment->setCreation_date(new DateTime());
            $shipment->setShipmentAccepted(1);
            $shipment->setSourceAddress($post['sourceAddress']);
            $shipment->setSourceDate(new DateTime($post['sourceDate']));
            $shipment->setDestinyAddress($post['destinyAddress']);
            $shipment->setDestinyDate(new DateTime($post['destinyDate']));
            $shipment->setFrequency($post['frequency']);
            $shipment->setEffectiveDays($post['effectiveDays']);
            $shipment->setComments($post['comments']);

            $sourceState = $em->getRepository('DefaultDb_Entity_State')->find($post['sourceState']);
            $shipment->setStateOrigin($sourceState);

            $sourceCity = $em->getRepository('DefaultDb_Entity_City')->find($post['sourceStateCity']);
            $shipment->setMunicipalityOrigin($sourceCity);

            $destinyState = $em->getRepository('DefaultDb_Entity_State')->find($post['destinyState']);
            $shipment->setStateDestiny($destinyState);

            $destinyCity = $em->getRepository('DefaultDb_Entity_City')->find($post['destinyStateCity']);
            $shipment->setMunicipalityDestiny($destinyCity);

            $vehicle = $em->getRepository('DefaultDb_Entity_Vehicle')->find($post['vehicleCB']);
            $shipment->setVehicle($vehicle);
            
            $vehicleType = $em->getRepository('DefaultDb_Entity_VehicleType')->find($post['vehicleTypeCB']);
            $shipment->setVehicleType($vehicleType);

            $shipmentType = $em->getRepository('DefaultDb_Entity_ShipmentType')->find($post['shipmentTypeCB']);
            $shipment->setShipmentType($shipmentType);
            
            $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
            $shipment->setUser($user);

            $em->persist($shipment);
            $em->flush();
            
            $date = $shipment->getSourceDate()->format('Y-m-d');
            
             $emailUser = $em->getRepository('DefaultDb_Entity_User');
            $this->view->email =  $emailUser->getEmailUser($this->_credentials['id']);
            foreach ($this->view->email as $value)
            { 
                $emailAgent = $value['username'];
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
            
               $this->view->routeZone=$Routes->getSearchRoutesForZone($vehicle->getId(),$this->view->numberZone,$date);
               $countRouteZone = count($this->view->routeZone);
              
                if ($countRouteZone >= 0 )
                {
                    while ($value = $this->view->routeZone->fetch(PDO::FETCH_ASSOC))
                    { 
                    $this->view->id.= $value['Route_Id'].'<br />';
                    $this->view->destiny.=$value['City_Destiny_Name'].' , '.$value['State_D_Abbrev'].'<br />';
                    $this->view->origin.=$value['City_Origin_Name'].' , '.$value['State_O_Abbrev'].'<br />';
                    $this->view->vehicle.=$value['Vehicle_Name'].' De '.$value['Vehicle_Type_Name'].'<br />';
                    $this->view->Date.=$value['New_Availability_Date'].'<br />';
                    $this->view->Comments.= $value['Comment'].'<br />';
                    $this->view->Zone.= $value['Zone_Name'].'<br />';
                    }
                    
                $this->view->detailsZone='<table border="1" cellpadding="3" cellspacing="3" style="font-size:12px;">
                        <tr>
                            <td align="center"><strong>Ruta</strong></td>
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
                
                $this->view->messageZone = '* NOTA: Esta carga se encuentra dentro de la Zona No. '.$this->view->numberZone.' ( '.$this->view->nameZone.' )'
                . ' y coincide con Rutas.<br />';
                
                }
            }
            
             /////////////////////////////////////////////////////////////////////
           //           
           //           E::N::V::I::O::  C::O::R::R::E::O
           //
           /////////////////////////////////////////////////////////////////////
           // Buscar cargas que coinicdan con un notificacion registrada y    //
           // que se envie al correo, aun no funciona si el usuario quiere    //
           // o no que se le envíen.                                          //
           //                                                                 //
           // ActionType:  1(Shipment), 2(Routes)                             //
           /////////////////////////////////////////////////////////////////////
         
            
            
            ////////////////////////////////////////////////////////////////////
            //                                                                //
            // BUSQUEDA DE RUTAS QUE COINCIDEN O NO                           //                                                         
            //                                                                //                                                
            ////////////////////////////////////////////////////////////////////
            
            $coincide = $em->getRepository('DefaultDb_Entity_Route');
            $this->view->coincide =  $coincide->getNotificationForRoutes($vehicle->getId(),$destinyState->getId(),$destinyCity->getId(),$date);
            $countRoute= count($this->view->coincide);
            
            //////////////////////////////////////////////////////////////////// 
            //                                                                //
            //  Esta sección envía correos a: Coordinadores cuando no         //
            //  encuentra coincidnecia con alguna rutas                       //
            //                                                                //
            //////////////////////////////////////////////////////////////////// 
            
            if ($countRoute<=0)
            {
                list ($typeText,$eventText)=$shipment->getTypeText();
              
                $correo='<html><head></head><body>
                <h4>:::::: Notificaci&oacute;n de '.$typeText.' de MasFletes.com ::::::</h4>
                <p style="font-family:Arial;font-size:13px;line-height:16px;">
                <strong>Un usuario acaba de registrar una '.$typeText.' con estos datos:</strong><br /><br />
                <strong>* '.$typeText.' n&uacute;mero:  </strong>'.$shipment->getId().'<br />
                <strong>* De:  </strong>'.$sourceCity->getName().' , '.$sourceState->getName().'<br />
                <strong>* A:  </strong>'.$destinyCity->getName().' , '.$destinyState->getName().'<br />
                <strong>* Con Veh&iacute;culo:  </strong>'.$vehicle->getName().' , '.$vehicleType->getName().'<br />
                <strong>* Fecha Carga:  </strong>'.$date.'<br />
                <strong>* Comentarios:   </strong>'.$shipment->getComments().'<br /><br />
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
                $mail->FromName = 'Notificaciones de MasFletes';
                $mail->AddAddress($emailAgent,'Coordinador');
                $mail->Subject = 'Notificaciones de '.$typeText.' de MasFletes';
                $mail->MsgHTML($correo);
                $mail->Send();   
            }
           
            //////////////////////////////////////////////////////////////////// 
            //                                                                //
            //  Esta sección envía correos a: Coordinador cuando si           //
            //  encuentra una ruta que coincide con la carga ingresada        //                                                    
            //                                                                //
            //////////////////////////////////////////////////////////////////// 
           
           if ($countRoute != 0)
           {
                foreach ($this->view->coincide as $key)
                {
                    $this->view->idRoutes.= $key['Route_Id'].'<br />'; 
                    $this->view->emailRoutes.= $key['email'].'<br />';
                    $this->view->comRoutes.= $key['Comment'].'<br />';
                    $this->view->dateRoutes.= $key['New_Availability_Date'].'<br />';
                }
                     
                list ($typeText,$eventText)=$shipment->getTypeText();
                
                $correo='<html><head></head><body>
                <h4>:::::: Notificaci&oacute;n de '.$typeText.' de MasFletes.com ::::::</h4>
                <p style="font-family:Arial;font-size:13px;line-height:16px;">
                <strong>Se encontraron las siguientes '.$eventText.' que coinciden con la publicaci&oacute;n del usuario, los detalles son: </strong><br />
                <strong>* Correo: </strong><br /><br />
                <strong>Por favor contactar con los correos electronicos que aparecen acontinuaci&oacute;n:</strong><br /><br />
		<strong>INFORMACI&Oacute;N GENERAL</strong><br />
                <strong>**************************************************************************************</strong><br />
                <strong>* Carga No.:'.$shipment->getId().'<br />
                <strong>* De:  </strong>'.$sourceCity->getName().' , '.$sourceState->getName().'<br />
                <strong>* A:  </strong>'.$destinyCity->getName().' , '.$destinyState->getName().'<br />
                <strong>* Con Veh&iacute;culo:  </strong> '.$vehicle->getName().' , '.$vehicleType->getName().'<br /><br />
                <strong>**************************************************************************************</strong><br />							
                <table border="1" cellpadding="5" cellspacing="5">
                    <tr>
                        <td align="center"><strong>Ruta</strong></td>
			<td align="center"><strong>Correo</strong></td>
			<td align="center"><strong>Comentario</strong></td>
                        <td align="center"><strong>Fecha</strong></td>
                    </tr>
                    <tr>
                        <td> '.$this->view->idRoutes.'</td>
                        <td> '.$this->view->emailRoutes.'</td>
                        <td> '.$this->view->comRoutes.'</td>
                        <td> '.$this->view->dateRoutes.'</td>
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
                    $mail->FromName = 'Notificaciones de MasFletes';
                    $mail->AddAddress($emailAgent,'Coordinador');
                    $mail->Subject = 'Notificaciones de '.$typeText.' de MasFletes';
                    $mail->MsgHTML($correo);
                    $mail->Send();
           }
            
            
            
            
            
            if( is_null($this->view->dataRequest) )
                Model3_Site::setTempMsg("msg", "La carga ha sido registrada correctamente");
            else
                Model3_Site::setTempMsg("msg", "Cambios guardados correctamente");
            $this->redirect ("Agent/".$this->getRequest()->getController()."/form");
        }
    }

}