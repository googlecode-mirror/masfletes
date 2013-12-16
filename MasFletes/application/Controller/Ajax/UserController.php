<?php

class Ajax_UserController extends Model3_Controller
{
    public function init()
    {
        $this->view->setUseTemplate(FALSE);
    }

    public function validUserAction()
    {
        if ($this->getRequest()->isPost())
        {
            $post = $this->getRequest()->getPost();
            $user = $post['user'];
            $ob = $this->getEntityManager('DefaultDb')->getRepository('DefaultDb_Entity_User')->findBy(array('username' => $user));
            $this->view->valid = $ob;
        }
    }
}