<?php

class IndexController extends Model3_Controller
{
    public function indexAction()
    {
        $this->view->setUseTemplate(FALSE);
        
        if( $this->getRequest()->getParam('logout') )
        {
            Model3_Auth::deleteCredentials();
            $this->redirect();
        }
        
        if($this->getRequest()->isPost())
        {
            $post = $this->getRequest()->getPost();
            $auth = new Model3_Auth();

            if($auth->authenticate($post['username'], md5($post['password'])))
            {
                $rol = $auth->getCredentials('type');
                switch($rol)
                {

                    case DefaultDb_Entity_User::TYPE_ADMIN:
                         $this->redirect ('Admin/Index');
                        break;
                    case DefaultDb_Entity_User::TYPE_COORDINATOR:
                         $this->redirect ('Agent/Index');
                        break;
                    case DefaultDb_Entity_User::TYPE_USER:
                         $this->redirect ('Customer/Index');
                        break;
                }
            }
            else
            {
                $this->redirect();
            }
        }
    }
    
    public function fixturesAction()
    {
        $em = $this->getEntityManager('DefaultDb');
        
        $vehicleType = new DefaultDb_Entity_VehicleType();
        $vehicleType->setName('Tipo de vehiculo 1');
        $vehicleType->setDescription('Descripcion de vehiculo 1');
        $em->persist($vehicleType);
        $em->flush();
    }
}
