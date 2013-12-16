<?php
class Agent_OperationsController extends Model3_Controller
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
        $this->view->getJsManager()->addJsVar('urlGetDetails', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'Details', 'action' => 'information')).'"');
        $this->view->getJsManager()->addJsVar('urlSearch', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'Search', 'action' => 'search')).'"');
        
        $em = $this->getEntityManager('DefaultDb');
        $this->view->operations = $em->getRepository('DefaultDb_Entity_Operation')->findAll();
        $this->view->shipments = $em->getRepository('DefaultDb_Entity_Shipment')->findAll();
        $this->view->routes = $em->getRepository('DefaultDb_Entity_Route')->findAll();
    }
    
    public function formAction()
    {
        $em = $this->getEntityManager('DefaultDb');
        $this->view->shipments = $em->getRepository('DefaultDb_Entity_Shipment')->findAll();
        $this->view->routes = $em->getRepository('DefaultDb_Entity_Route')->findAll();
        
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $em = $this->getEntityManager('DefaultDb');
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Operation')->find($idReq);
        }
        
        if($this->getRequest()->isPost())
        {
            $post = $this->getRequest()->getPost();
            
            if( is_null($this->view->dataRequest) )
                $operation = new DefaultDb_Entity_Operation();
            else
                $operation = $this->view->dataRequest;
            
            $opeDate = new DateTime();
            $datOpe = explode("-",$post['operationDate']);
            $opeDate->setDate($datOpe[0], $datOpe[1], $datOpe[2]);
            
            $operation->setOperationDate($opeDate);
            $operation->setStatus($post['status']);            
            $route = $em->getRepository('DefaultDb_Entity_Route')->find($post['route']);
            $operation->setRoute($route);            
            $shipment = $em->getRepository('DefaultDb_Entity_Shipment')->find($post['shipment']);
            $operation->setShipment($shipment);
            
            $em->persist($operation);
            $em->flush();
            
            if( is_null($this->view->dataRequest) )
                Model3_Site::setTempMsg("msg", "La operaci&oacute;n ha sido registrada correctamente.");
            else
                Model3_Site::setTempMsg("msg", "Los cambios a la operación han sido guardados correctamente.");
            $this->redirect ("Agent/".$this->getRequest()->getController()."/index");
        }
    }
}