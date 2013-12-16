<?php
class Agent_ReportsController extends Model3_Controller
{
    public function init()
    {
        $this->view->setTemplate('Agent');
    }
    
    public function indexAction()
    {
    }
    
    public function commentsToEventsAction()
    {
        $em = $this->getEntityManager('DefaultDb');
        $this->view->comments = $em->getRepository('DefaultDb_Entity_CommentToEvent')->findAll();
    }
}