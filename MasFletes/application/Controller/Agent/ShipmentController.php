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
            
            if( is_null($this->view->dataRequest) )
                Model3_Site::setTempMsg("msg", "La carga ha sido registrada correctamente");
            else
                Model3_Site::setTempMsg("msg", "Cambios guardados correctamente");
            $this->redirect ("Agent/".$this->getRequest()->getController()."/form");
        }
    }

}