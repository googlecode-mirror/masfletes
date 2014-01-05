<?php

class Ajax_DetailsController extends Model3_Controller
{
    public function init()
    {
        $this->view->setUseTemplate(FALSE);
    }

    public function informationAction()
    {
        if ($this->getRequest()->isPost())
        {
            $post = $this->getRequest()->getPost();
            $item = $post['idItem'];
            $nombre = 'DefaultDb_Entity_'.$post['entity'];
            $entity = $this->getEntityManager('DefaultDb')->getRepository($nombre)->find($item);
            $this->view->nameEntity = $nombre;
            $this->view->entity = $entity;
        }
    }
}