<?php
/**
 * @Entity(repositoryClass="DefaultDb_Repositories_EventPanelRepository")
 * @Table(name="event_panel")
 */
class DefaultDb_Entity_EventPanel
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
    private $id_user;
    
    /**
     * @Column
     * @var integer
     */
    private $id_event;
       /**
     * @Column
     * @var string
     */
    private $event;
    
    /**
     * @Column
     * @var string
     */
    private $coincidence_number;
    
     /**
     * @Column
     * @var string
     */
    private $status;
    
    /**
     * @Column(type="datetime", name="creation_date")
     * @var DateTime
     */
    private $creationDate;
    
     /**
     * @Column
     * @var string
     */
    private $data_hidden;
       /**
     * @Column
     * @var string
     */
    private $coincidence_event;
    
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    
    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
    

    public function getIdEvent()
    {
        return $this->id_event;
    }

    public function setIdEvent($id_event)
    {
        $this->id_event = $id_event;
    }
    
    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
    }
    
    
    public function getCoincidenceNumber()
    {
        return $this->coincidence_number;
    }

    public function setCoincidenceNumber($coincidence_number)
    {
        $this->coincidence_number = $coincidence_number;
    }
    
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    
     public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }
    
        public function getDataHidden()
    {
        return $this->data_hidden;
    }

    public function setDataHidden($data_hidden)
    {
        $this->data_hidden = $data_hidden;
    }
       public function getCoincidenceEvent()
    {
        return $this->coincidence_event;
    }

    public function setCoincidenceEvent($coincidence_event)
    {
        $this->coincidence_event = $coincidence_event;
    }
}
?>
