<?php
class Admin_IndexController extends Model3_Controller
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
    }
}