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
            $id = intval($post['idUser']);
            $ob = $this->getEntityManager('DefaultDb')->getRepository('DefaultDb_Entity_User')->findOneBy(array('username' => $user));
            if($id > 0)
                if($ob->getId() === $id )
                    $ob = array();
            
            $this->view->valid = $ob;
        }
    }
}