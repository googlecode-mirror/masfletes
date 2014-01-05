<?php
class Customer_NotificationsController extends Model3_Controller
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
        $this->view->getJsManager()->addJsVar('entity','"Notification"');
        $this->view->getJsManager()->addJsVar('texto','"eliminar esta notificación"');
        $this->view->getJsManager()->addJsVar('urlDelForm', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'form')).'"');
        $this->view->getJsManager()->addJsVar('urlDelete', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'delete')).'"');
        $this->view->getJsManager()->addJs('helper/delete.js');
        
        $this->view->getJsManager()->addJs('helper/details.js');
        $this->view->getJsManager()->addJs('helper/search.js');
        $this->view->getJsManager()->addJs('helper/state.js');
        
        $this->view->getJsManager()->addJsVar('urlGetDetails', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Details', 'action' => 'information')) . '"');
        $this->view->getJsManager()->addJsVar('urlSearch', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'Search', 'action' => 'search')).'"');
        $this->view->getJsManager()->addJsVar('urlGetCities', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')).'"');
        
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->notifications = $em->getRepository('DefaultDb_Entity_Notification')->findBy(array('user' => $user));
    }
    
    public function formAction()
    {
        $this->view->dataRequest = NULL;
        
        $this->view->getJsManager()->addJs('helper/state.js');
        $this->view->getJsManager()->addJsVar('urlGetCities', '"' . $this->view->url(array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')) . '"');
        
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
            
            if( is_null($this->view->dataRequest) )
                Model3_Site::setTempMsg("msg", "La notificaci&oacute;n ha sido registrada correctamente");
            else
                Model3_Site::setTempMsg("msg", "Cambios guardados correctamente");
            $this->redirect ("Customer/".$this->getRequest()->getController()."/form");
        }
    }
}