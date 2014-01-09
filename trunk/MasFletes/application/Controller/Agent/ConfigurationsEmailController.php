<?php
class Agent_ConfigurationsEmailController extends Model3_Controller
{
    public function init()
    {
        $this->_credentials = Model3_Auth::getCredentials();
        $this->view->setTemplate('Agent');
    }
    
    public function indexAction()
    {
        $em = $this->getEntityManager('DefaultDb');
        $configuration = $em->getRepository('DefaultDb_Entity_ConfigurationEmail');
        
        $this->view->configurationsDetails =  $configuration->getDetailsConfigurations($this->_credentials['id']);
       
    }
    
    public function newAction()
    {
        if($this->getRequest()->isPost())
        {
            $em = $this->getEntityManager('DefaultDb');
            $updateConfiguration = $em->getRepository('DefaultDb_Entity_ConfigurationEmail');
        
            $post = $this->getRequest()->getPost();
            
            $routes=$post['routesLoad'];
            $shipments=$post['shipmentsLoad'];
            $notifications=$post['notificationsLoad'];
            $email=$post['emailAdd'];
            
            
            $var=$updateConfiguration->updateOptionsConfigurations($email,$routes,$shipments,$notifications,$this->_credentials['id']);
            
            if ($var==1)
               {
                $this->view->updateOptionsConfigurations ="<div class='alert alert-success'>
                                                          <br />La actualizaci&oacute;n se ha realizado con &eacute;xito<br /><br />
                                                          </div>
                                                          <script language='javascript'>
                                                          window.location='".$this->view->url(array('controller' => 'ConfigurationsEmail', 'action' => 'index'))."'
                                                          </script>";
            } 
             
        } 
        
    }
}