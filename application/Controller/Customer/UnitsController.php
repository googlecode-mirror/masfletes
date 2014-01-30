<?php
class Customer_UnitsController extends Model3_Controller
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
        $this->view->getJsManager()->addJsVar('entity','"Unit"');
        $this->view->getJsManager()->addJsVar('texto','"eliminar esta unidad"');
        $this->view->getJsManager()->addJsVar('urlDelForm', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'form')).'"');
        $this->view->getJsManager()->addJsVar('urlDelete', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'delete')).'"');
        $this->view->getJsManager()->addJs('helper/delete.js');
        
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->units = $em->getRepository('DefaultDb_Entity_Unit')->findBy(array('user' => $user));
    }
    
    public function formAction()
    {
        $this->view->dataRequest = NULL;
        
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $em = $this->getEntityManager('DefaultDb');
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Unit')->find($idReq);
        }
        
        if($this->getRequest()->isPost())
        {
            $msg = "Unidad creada correctamente";
            $link = "form";
            $post = $this->getRequest()->getPost();
            if( is_null($this->view->dataRequest) )
                $entity = new DefaultDb_Entity_Unit();
            else
            {
                $entity = $this->view->dataRequest;
                $msg = "Sus cambios han sido guardados correctamente";
                $link .= "/id/".$entity->getId();
            }
            
            $em = $this->getEntityManager('DefaultDb');
            
            $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);          
            $vehicle = $em->getRepository('DefaultDb_Entity_Vehicle')->find($post['vehicle']);
            $vehicleType = $em->getRepository('DefaultDb_Entity_VehicleType')->find($post['vehicleType']);                       
            
            $entity->setUser($user);
            $entity->setVehicle($vehicle);
            $entity->setVehicleType($vehicleType);
            $entity->setPlates($post['plates']);
            $entity->setBrand($post['brand']);
            $entity->setModel($post['model']);
            $entity->setColor($post['color']);
            $entity->setEconomicNumber($post['economicNumber']);
            $entity->setComments($post['comments']);
            
            $em->persist($entity);
            $em->flush();
            
            Model3_Site::setTempMsg("msg", $msg);
            $this->redirect ("Customer/".$this->getRequest()->getController()."/".$link);
        }
    }
}