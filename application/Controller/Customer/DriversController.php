<?php
class Customer_DriversController extends Model3_Controller
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
        $this->view->getJsManager()->addJsVar('entity','"Driver"');
        $this->view->getJsManager()->addJsVar('texto','"eliminar este conductor"');
        $this->view->getJsManager()->addJsVar('urlDelForm', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'form')).'"');
        $this->view->getJsManager()->addJsVar('urlDelete', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'delete')).'"');
        $this->view->getJsManager()->addJs('helper/delete.js');
        
        $em = $this->getEntityManager('DefaultDb');
        $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
        $this->view->drivers = $em->getRepository('DefaultDb_Entity_Driver')->findBy(array('user' => $user));
    }
    
    public function formAction()
    {
        $this->view->dataRequest = NULL;
        
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $em = $this->getEntityManager('DefaultDb');
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Driver')->find($idReq);
        }
        
        if($this->getRequest()->isPost())
        {
            $msg = "Operador creado correctamente";
            $link = "form";
            $post = $this->getRequest()->getPost();
            if( is_null($this->view->dataRequest) )
                $entity = new DefaultDb_Entity_Driver();
            else
            {
                $entity = $this->view->dataRequest;
                $msg = "Sus cambios han sido guardados correctamente";
                $link .= "/id/".$entity->getId();
            }
            
            $em = $this->getEntityManager('DefaultDb');
            $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);          
            $date = new DateTime($post['licenceDuration']);
            $entity->setUser($user);
            $entity->setName($post['nameTF']);
            $entity->setLicence($post['licence']);
            $entity->setLicenceDuration($date);
            
            $em->persist($entity);
            $em->flush();
            
            Model3_Site::setTempMsg("msg", $msg);
            $this->redirect ("Customer/".$this->getRequest()->getController()."/".$link);
        }
    }
}