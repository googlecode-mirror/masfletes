<?php
include_once("PHPMailer/class.phpmailer.php");
class Customer_RoutesController extends Model3_Controller
{
    private $_credentials;
    
    public function init()
    {
        if(!Model3_Auth::isAuth())
            $this->redirect();
        else
        {
            $role = Model3_Auth::getCredentials('type');
            if( $role !== DefaultDb_Entity_User::TYPE_SENDER && $role !== DefaultDb_Entity_User::TYPE_TRANSPORTER )
            {
               Model3_Auth::deleteCredentials();
               $this->redirect();
            }
        }
        
        switch ($role)
        {
            case DefaultDb_Entity_User::TYPE_SENDER:
                $this->view->setTemplate('Customer');
                break;
                
                case DefaultDb_Entity_User::TYPE_TRANSPORTER:
                $this->view->setTemplate('Transporter');
                break;
        }
        $this->_credentials = Model3_Auth::getCredentials();
    }
    
    public function indexAction()
    {
        $this->view->getJsManager()->addJsVar('entity','"Route"');
        $this->view->getJsManager()->addJsVar('texto','"eliminar esta ruta"');
        $this->view->getJsManager()->addJsVar('urlDelForm', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'form')).'"');
        $this->view->getJsManager()->addJsVar('urlDelete', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'delete')).'"');
        $this->view->getJsManager()->addJs('helper/delete.js');
        
        $this->view->getJsManager()->addJs('helper/state.js');
        $this->view->getJsManager()->addJs('helper/details.js');
        $this->view->getJsManager()->addJs('helper/search.js');
        //Variables
        $this->view->getJsManager()->addJsVar('urlGetCities', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')) . '"');
        $this->view->getJsManager()->addJsVar('urlSearch', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Search', 'action' => 'search')).'"');
        $this->view->getJsManager()->addJsVar('urlGetDetails', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Details', 'action' => 'information')) . '"');
        
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->routes = $em->getRepository('DefaultDb_Entity_Route')->findBy(array('user' => $user));
    }
    
    public function formAction()
    {
        $this->view->getJsManager()->addJs('helper/state.js');
        $this->view->getJsManager()->addJsVar('urlGetCities', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')) . '"');
        
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $units = $em->getRepository('DefaultDb_Entity_Unit')->findBy(array('user'=> $user));
        $drivers = $em->getRepository('DefaultDb_Entity_Driver')->findBy(array('user'=> $user));
        //***
        $units_a = array();
        foreach($units as $ind => $unit)
            $units_a[++$ind] = $unit->getVehicle()->getName()." / ".$unit->getVehicleType()->getName()." / ".$unit->getBrand()." / ".$unit->getModel();
        $this->view->units = $units_a;
        
        $driver_a = array();
        foreach ($drivers as $ind => $driver)
            $driver_a[++$ind] = $driver->getName();
        $this->view->drivers = $driver_a;
        //***
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Route')->find($idReq);
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
            
            if( $post['unit'] !== "" )
            {
                $unit = $em->getRepository('DefaultDb_Entity_Unit')->find($post['unit']);
                $route->setUnit($unit);
            }
            if( $post['driver'] !== "" )
            {
                $driver = $em->getRepository('DefaultDb_Entity_Driver')->find($post['driver']);
                $route->setDriver($driver);
            }
            
            $em->persist($route);
            $em->flush();
            
            /*$connection = $em->getConnection();
            $statement = $connection->executeQuery('
                SELECT u.*
                FROM notifications n
                LEFT JOIN users u
                ON n.user_id = u.id
                WHERE action_type = '.DefaultDb_Entity_Notification::ACTION_TYPE_ROUTE.'
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
                $mail->Subject = 'Notificacion de nueva ruta';
                $mail->Body = 'Se ha agregado una nueva ruta desde con las siguientes caracter&iacute;sticas:<br /><br />';
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
                Model3_Site::setTempMsg("msg", "La ruta ha sido registrada correctamente");
            else
                Model3_Site::setTempMsg("msg", "Cambios guardados correctamente");
            $this->redirect ("Customer/".$this->getRequest()->getController()."/form");
        }
    }
}