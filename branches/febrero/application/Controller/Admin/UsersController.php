<?php
/**
 * Description of UsuariosController
 *
 * @author ricardo.guerra
 */
class Admin_UsersController extends Model3_Controller
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
        $this->view->getJsManager()->addJsVar('entity','"User"');
        $this->view->getJsManager()->addJsVar('texto','"eliminar este usuario"');
        $this->view->getJsManager()->addJsVar('urlDelForm', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'form')).'"');
        $this->view->getJsManager()->addJsVar('urlDelete', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'Delete', 'action' => 'delete')).'"');
        $this->view->getJsManager()->addJs('helper/delete.js');
        
        $auth = new Model3_Auth();
        $this->view->idUser = $auth->getCredentials('id');
        
        $usersRepo = $this->getEntityManager('DefaultDb')->getRepository('DefaultDb_Entity_User');
        $this->view->users = $usersRepo->findAll();
    }
    
    public function addAction()
    {
        $this->view->getJsManager()->addJs('helper/state.js');
        
        $this->view->getJsManager()->addJsVar('urlGetCities', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')).'"');
        
        $this->view->getJsManager()->addJsVar('urlUsers','"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'User', 'action' => 'validUser')).'"');
        
        $this->view->getJsManager()->addJsVar('id_user', 0);
        
        if( $this->getRequest()->isPost() )
        {
            $em = $this->getEntityManager('DefaultDb');
            $data = $this->getRequest()->getPost();
            $user = new DefaultDb_Entity_User;
            $user->setType($data['role']);
            $user->setFirstName($data['firstNameTF']);
            $user->setLastName($data['lastNameTF']);
            $user->setUsername($data['userNameTF']);
            $user->setPassword(md5($data['passTF']));
            $user->setAddress($data['address']);
            $state = $em->getRepository('DefaultDb_Entity_State')->find($data['state']);
            $city = $em->getRepository('DefaultDb_Entity_City')->find($data['stateCity']);
            $user->setState($state);
            $user->setCity($city);            
            $user->setZipCode($data['zipcode']);
            $user->setPhone($data['phone']);
            
            $em->persist($user);
            $em->flush();
            
            Model3_Site::setTempMsg("msg", "El usuario se ha creado correctamente");
            $this->redirect ('Admin/Users/add');
        }
    }
    
    public function editAction()
    {
        //Edicion del usuario
        if( !is_null($this->getRequest()->getParam('id')) && is_numeric($this->getRequest()->getParam('id')) )
        {
            $this->view->getJsManager()->addJs('helper/state.js');
            $this->view->getJsManager()->addJsVar('urlGetCities', '"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'States', 'action' => 'getCities')).'"');        
            $this->view->getJsManager()->addJsVar('urlUsers','"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'User', 'action' => 'validUser')).'"');
            
            $idUser = $this->getRequest()->getParam('id');
            $this->view->getJsManager()->addJsVar('id_user', $idUser);
                    
            $em = $this->getEntityManager('DefaultDb');
            $this->view->user = $em->getRepository('DefaultDb_Entity_User')->find($idUser);
            if( $this->getRequest()->isPost() )
            {
                $data = $this->getRequest()->getPost();
                $user = $this->view->user;
                $user->setType($data['role']);
                $user->setFirstName($data['firstNameTF']);
                $user->setLastName($data['lastNameTF']);
                $user->setUsername($data['userNameTF']);
                $user->setAddress($data['address']);
                $state = $em->getRepository('DefaultDb_Entity_State')->find($data['state']);
                $city = $em->getRepository('DefaultDb_Entity_City')->find($data['stateCity']);
                $user->setState($state);
                $user->setCity($city);            
                $user->setZipCode($data['zipcode']);
                $user->setPhone($data['phone']);
                
                if( isset($data['changePass']))
                    $user->setPassword(md5($data['passTF']));
                
                $em->persist($user);
                $em->flush();
                Model3_Site::setTempMsg("msg", "El usuario ha sido editado correctamente");
                $this->redirect ('Admin/Users/edit/id/'.$user->getId());
            }
        }else{
            $this->redirect ('Admin/Users/index');
        }
    }
}
?>
