<?php
include_once("PHPMailer/class.phpmailer.php");
class Customer_ShipmentController extends Model3_Controller
{
    private $_credentials;
    
    public function init()
    {
        if(!Model3_Auth::isAuth())
            $this->redirect();
        else
        {
            $role = Model3_Auth::getCredentials('type');
            if( $role !== DefaultDb_Entity_User::TYPE_USER )
            {
               Model3_Auth::deleteCredentials();
               $this->redirect();
            }
        }
        $this->_credentials = Model3_Auth::getCredentials();
        $this->view->setTemplate('Customer'); 
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

        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $em = $this->getEntityManager('DefaultDb');
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Shipment')->find($idReq);
        }
        
        if ($this->getRequest()->isPost())
        {
            $em = $this->getEntityManager('DefaultDb');

            $post = $this->getRequest()->getPost();
            if( is_null($this->view->dataRequest) )
                $shipment = new DefaultDb_Entity_Shipment();
            else
                $shipment =  $this->view->dataRequest;
            
            $sourceD = new DateTime($post['sourceDate']);
            $destinyD = new DateTime($post['destinyDate']);
            
            $shipment->setContactName("");
            $shipment->setContactPhone("");
            $shipment->setCreation_date(new DateTime());
            $shipment->setShipmentAccepted(1);
            $shipment->setSourceAddress($post['sourceAddress']);
            $shipment->setSourceDate($sourceD);
            $shipment->setDestinyAddress($post['destinyAddress']);
            $shipment->setDestinyDate($destinyD);
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
            
            /*$connection = $em->getConnection();
            $statement = $connection->executeQuery('
                SELECT u.*
                FROM notifications n
                LEFT JOIN users u
                ON n.user_id = u.id
                WHERE action_type = '.DefaultDb_Entity_Notification::ACTION_TYPE_SHIPMENT.'
                AND state_origin_id = '.$sourceState->getId().'
                AND state_destiny_id = '.$destinyState->getId().'
                AND municipality_origin_id = '.$sourceCity->getId().'
                AND municipality_destiny_id = '.$destinyCity->getId().'
                AND vehicle_id = '.$vehicle->getId().'
                AND vehicle_type_id = '.$vehicleType->getId().'
                ');
            $users = $statement->fetchAll();
            
            if(is_array($users) && count($users) > 0)
            {
                //mandar correo a estos usuarios
                $mail = new PHPMailer();

                $mail->IsSMTP();
                $mail->Host = 'ssl://boxpeople.boxpeople.net';
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = 'webcontact@masfletes.koden-it.com';
                $mail->Password = '123456';
                $mail->From = 'webcontact@masfletes.koden-it.com';
                $mail->FromName = 'Administracion Mas Fletes';
                foreach($users as $u)
                {
                    $mail->AddAddress($u['username']);
                }
                $mail->Subject = 'Notificacion de nueva carga';
                $mail->Body = 'Se ha agregado una nueva carga desde con las siguientes caracter&iacute;sticas:<br /><br />';
                $mail->Body .= 'Estado de origen: '.$sourceState->getName().'<br />';
                $mail->Body .= 'Ciudad de origen: '.$sourceCity->getName().'<br />';
                $mail->Body .= 'Estado de destino: '.$destinyState->getName().'<br />';
                $mail->Body .= 'Ciudad de destino: '.$destinyCity->getName().'<br />';
                $mail->Body .= 'Veh&iacute;culo: '.$vehicle->getName().'<br />';
                $mail->Body .= 'Tipo de veh&iacute;culo: '.$vehicleType->getName().'<br />';
                $mail->IsHTML (true);
                $mail->Send();
            }*/
            
            if( is_null($this->view->dataRequest) )
                Model3_Site::setTempMsg("msg", "La carga ha sido registrada correctamente");
            else
                Model3_Site::setTempMsg("msg", "Cambios guardados correctamente");
            $this->redirect ("Customer/".$this->getRequest()->getController()."/form");
        }
    }

}