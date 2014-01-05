<?php

class Ajax_StatesController extends Model3_Controller
{

    public function init()
    {
        $this->view->setUseTemplate(FALSE);
    }

    public function getCitiesAction()
    {
        if ($this->getRequest()->isPost())
        {
            $post = $this->getRequest()->getPost();
            $idState = $post['state'];
            $state = $this->getEntityManager('DefaultDb')->getRepository('DefaultDb_Entity_State')->find($idState);
            $cities = $state->getCities();
            
            $result = array();
            foreach($cities as $city)
            {
                $result[] = array('id' => $city->getId(), 'name' => utf8_decode($city->getName()));
            }
            $this->view->result = json_encode($result);
        }
    }

}