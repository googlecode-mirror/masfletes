<?php
class Customer_IndexController extends Model3_Controller
{
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
        $this->view->setTemplate('Customer');
    }
    
    public function indexAction()
    {
    }
}