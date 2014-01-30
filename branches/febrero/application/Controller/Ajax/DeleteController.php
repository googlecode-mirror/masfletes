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
            $entity = $em->getRepository('DefaultDb_Entity_'.$post['ent'])->find($post['idItem']);
            $em->remove($entity);
            $em->flush();
            $this->view->result = "1";
        }
    }
    
    public function formAction()
    {
        $post = $this->getRequest()->getPost();
        $this->view->texto = $post['txt'];
    }
}