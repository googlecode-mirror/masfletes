<?php
/** 
 * @Entity(repositoryClass="DefaultDb_Repositories_ConfigurationEmailRepository")
 * @Table(name="configurations_email")
 */
class DefaultDb_Entity_ConfigurationEmail
{
     /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var integer  
     */
   private $id;
   /**
     * @Column
     * @var integer
     */ 
    
   private $user_id;
    
    /**
     * @Column
     * @var string
     */
    private $email;
    /**
     * @Column
     * @var string
     */
    private $send_routes;
    /**
     * @Column
     * @var string
     */
    private $send_shipments;
    /**
     * @Column
     * @var string
     */
    private $send_notifications;
    
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    
    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getSendRoutes()
    {
        return $this->send_routes;
    }

    public function setSendRoutes($send_routes)
    {
        $this->send_routes = $send_routes;
    }
    
    
    public function getSendShipments()
    {
        return $this->send_shipments;
    }

    public function setSendShipments($send_shipments)
    {
        $this->send_shipments = $send_shipments;
    }
    
  
    public function setSendNotifications($send_notifications)
    {
        $this->send_notifications = $send_notifications;
    }
    
     public function getSendNotifications()
    {
        return $this->send_notifications;
    }

}
