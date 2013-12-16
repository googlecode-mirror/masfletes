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
            
            if( is_null($this->view->dataRequest) )
                Model3_Site::setTempMsg("msg", "La ruta ha sido registrada correctamente");
            else
                Model3_Site::setTempMsg("msg", "Cambios guardados correctamente");
            $this->redirect ("Agent/".$this->getRequest()->getController()."/form");
        }
    }
}