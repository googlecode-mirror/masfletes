<?php

/**
 * Description of UsuariosController
 *
 * @author ricardo.guerra
 */
class Admin_OperationTypesController extends Model3_Controller
{
    private $_credentials;
    
    public function init()
    {
        if(!Model3_Auth::isAuth())
            $this->redirect();
        else
        {
            $role = Model3_Auth::getCredentials('type');
            if( $role !== DefaultDb_Entity_User::TYPE_ADMIN )
            {
               Model3_Auth::deleteCredentials();
               $this->redirect();
            }
        }
        $this->_credentials = Model3_Auth::getCredentials();
        $this->view->setTemplate('Admin');
    }
    
    public function indexAction()
    {
        $this->view->getJsManager()->addJsVar('entity','"OperationType"');
        $this->view->getJsManager()->addJsVar('texto','"eliminar este tipo de operación"');
        $this->view->getJsManager()->addJsVar('urlDelForm', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'form')).'"');
        $this->view->getJsManager()->addJsVar('urlDelete', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'delete')).'"');
        $this->view->getJsManager()->addJs('helper/delete.js');
        
        $repo = $this->getEntityManager('DefaultDb')->getRepository('DefaultDb_Entity_OperationType');
        $this->view->entities = $repo->findAll();
    }
    
    public function formAction()
    {
        $this->view->dataRequest = NULL;
        
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $em = $this->getEntityManager('DefaultDb');
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_OperationType')->find($idReq);
        }
        
        if( $this->getRequest()->isPost() )
        {
            $msg = "Registro creado correctamente";
            $link = "form";
            $data = $this->getRequest()->getPost();
            if( is_null($this->view->dataRequest) )
                $entity = new DefaultDb_Entity_OperationType();
            else
            {
                $entity = $this->view->dataRequest;
                $msg = "Sus cambios han sido guardados correctamente";
                $link .= "/id/".$entity->getId();
            }
            
            $entity->setName($data['nameTF']);
            $entity->setDescription($data['descriptionTF']);
            
            $em = $this->getEntityManager('DefaultDb');
            $em->persist($entity);
            $em->flush();

            Model3_Site::setTempMsg("msg", $msg);
            $this->redirect ("Admin/".$this->getRequest()->getController()."/".$link);
        }
    }
}
?>
