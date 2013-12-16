<?php
/**
 * Description of UsuariosController
 *
 * @author ricardo.guerra
 */
class Admin_UsersController extends Model3_Controller
{
    public function init()
    {
        $this->view->setTemplate('Admin');
    }
    
    public function indexAction()
    {
        $usersRepo = $this->getEntityManager('DefaultDb')->getRepository('DefaultDb_Entity_User');
        $this->view->users = $usersRepo->findAll();
    }
    
    public function addAction()
    {
        $this->view->getJsManager()->addJsVar('urlUsers','"'.$this->view->url(
                array('module' => 'Ajax', 'controller' => 'User', 'action' => 'validUser')).'"');
        
        if( $this->getRequest()->isPost() )
        {
            $data = $this->getRequest()->getPost();
            $user = new DefaultDb_Entity_User;
            $user->setType($data['role']);
            $user->setFirstName($data['firstNameTF']);
            $user->setLastName($data['lastNameTF']);
            $user->setUsername($data['userNameTF']);
            $user->setPassword(md5($data['passTF']));
            $user->setAddress('');
            $user->setCity('');
            $user->setState('');
            $user->setCountry('');
            $user->setZipCode('');
            $user->setPhone('');
            
            $em = $this->getEntityManager('DefaultDb');
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
            $idUser = $this->getRequest()->getParam('id');
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
