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
            if( $role !== DefaultDb_Entity_User::TYPE_SENDER && $role !== DefaultDb_Entity_User::TYPE_TRANSPORTER )
            {
               Model3_Auth::deleteCredentials();
               $this->redirect();
            }
        }
        
        switch ($role)
        {
            case DefaultDb_Entity_User::TYPE_SENDER:
                $this->view->setTemplate('Customer');
                break;
                
                case DefaultDb_Entity_User::TYPE_TRANSPORTER:
                $this->view->setTemplate('Transporter');
                break;
        }
    }
    
    public function indexAction()
    {
    }
}