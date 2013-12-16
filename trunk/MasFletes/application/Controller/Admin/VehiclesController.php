<?php

/**
 * Description of UsuariosController
 *
 * @author ricardo.guerra
 */
class Admin_VehiclesController extends Model3_Controller
{
    public function init()
    {
        $this->view->setTemplate('Admin');
    }
    
    public function indexAction()
    {
        $repo = $this->getEntityManager('DefaultDb')->getRepository('DefaultDb_Entity_Vehicle');
        $this->view->entities = $repo->findAll();
    }
    
    public function formAction()
    {
        $this->view->dataRequest = NULL;
        
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $idReq = $this->getRequest()->getParam('id');
            $em = $this->getEntityManager('DefaultDb');
            $this->view->dataRequest = $em->getRepository('DefaultDb_Entity_Vehicle')->find($idReq);
        }
        
        if( $this->getRequest()->isPost() )
        {
            $msg = "Registro creado correctamente";
            $link = "form";
            $data = $this->getRequest()->getPost();
            if( is_null($this->view->dataRequest) )
                $entity = new DefaultDb_Entity_Vehicle();
            else
            {
                $entity = $this->view->dataRequest;
                $msg = "Sus cambios han sido guardados correctamente";
                $link .= "/id/".$entity->getId();
            }
            
            $entity->setName($data['nameTF']);
            $entity->setDescription($data['descriptionTF']);
            $entity->setCapacity($data['capacidadTF']);
            
            $em = $this->getEntityManager('DefaultDb');
            $em->persist($entity);
            $em->flush();

            Model3_Site::setTempMsg("msg", $msg);
            $this->redirect ("Admin/".$this->getRequest()->getController()."/".$link);
        }
    }
}
?>
