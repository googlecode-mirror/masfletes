<?php

class Ajax_DeleteController extends Model3_Controller
{

    public function init()
    {
        $this->view->setUseTemplate(FALSE);
    }
    
    public function deleteAction()
    {
        if( $this->getRequest()->isPost() )
        {
            $post = $this->getRequest()->getPost();
            $em = $this->getEntityManager('DefaultDb');
            $entity = $em->getRepository('DefaultDb_Entity_'.$post['entityName'])->find($post['idEntity']);
            $em->remove($entity);
            $em->flush();
            $this->view->result = "Registro eliminado correctamente";
        }
    }

}