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
        $this->view->getJsManager()->addJsVar('entity','"Operation"');
        $this->view->getJsManager()->addJsVar('texto','"eliminar esta operación"');
        $this->view->getJsManager()->addJsVar('urlDelForm', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'form')).'"');
        $this->view->getJsManager()->addJsVar('urlDelete', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'delete')).'"');
        $this->view->getJsManager()->addJs('helper/delete.js');
        
        $this->view->getJsManager()->addJs('helper/details.js');
        $this->view->getJsManager()->addJs('helper/search.js');
        $this->view->getJsManager()->addJsVar('urlGetDetails', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'Details', 'action' => 'information')).'"');
        $this->view->getJsManager()->addJsVar('urlSearch', '"'.$this->view->url(array('module' => 'Ajax', 'controller' => 'Search', 'action' => 'search')).'"');
        
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->operations = $em->getRepository('DefaultDb_Entity_Operation')->findBy(array('user' => $user));
        $this->view->shipments = $em->getRepository('DefaultDb_Entity_Shipment')->findBy(array('user' => $user));
        $this->view->routes = $em->getRepository('DefaultDb_Entity_Route')->findBy(array('user' => $user));
    }
    
    public function formAction()
    {
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->shipments = $em->getRepository('DefaultDb_Entity_Shipment')->findBy(array('user' => $user),array('id' => 'DESC'));
        $this->view->routes = $em->getRepository('DefaultDb_Entity_Route')->findBy(array('user' => $user),array('id' => 'DESC'));
        
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
                        
            $operation->setOperationDate(new DateTime($post['operationDate']));
            $operation->setStatus($post['status']);            
            $route = $em->getRepository('DefaultDb_Entity_Route')->find($post['route']);
            $operation->setRoute($route);            
            $shipment = $em->getRepository('DefaultDb_Entity_Shipment')->find($post['shipment']);
            $operation->setShipment($shipment);
            $operation->setUser($user);
            $operation->setDocuments($post['docs']);
            $operation->setCost($post['costo']);
            $operation->setCostoEnviador($post['comision']);
            $operation->setManiobras($post['maniobras']);
            $operation->setCostoTrans($post['opectr']);
            $operation->setSeguro($post['opeseg']);
            $operation->setCustodia($post['opecus']);
            $operation->setRefEnviador($post['operpe']);
            $operation->setRefTrans($post['operpt']);
            $operation->setCalEnviador($post['opecae']);
            $operation->setCalTrans($post['opecat']);
            $operation->setIndEnviador($post['opein1']);
            $operation->setIndTrans($post['opein2']);
            $operation->setComments($post['comments']);
            
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