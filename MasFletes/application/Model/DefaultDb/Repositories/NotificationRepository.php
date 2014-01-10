<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

   
class DefaultDb_Repositories_NotificationRepository extends EntityRepository
{  
    
    public function getEmailForSend($actiontype,$vehiclenotification,$statedestiny,$municipalitydestiny)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $result = $cnx->executeQuery('SELECT 
                                     action_type, 
                                     id, 
                                     notification_date,
                                     DATE (notification_date) AS Notification_Date_Format
                                     FROM notifications 
                                     WHERE action_type='.$actiontype.' 
                                     AND vehicle_id='.$vehiclenotification.' 
                                     AND state_destiny_id='.$statedestiny.' 
                                     AND municipality_destiny_id='.$municipalitydestiny.'');
        return $result->fetchAll();
    
    } 
    
     public function getNotificationForGroup()
    {
       $cnx = $this->getEntityManager()->getConnection();
       $result = $cnx->executeQuery('SELECT `id`,
                                    `vehicle_id`,
                                    `action_type`,
                                    `notification_date`,
                                    `state_destiny_id`,
                                    `municipality_destiny_id`,
                                    `email`,
                                    DATE (notification_date) AS Notification_Date_Format 
                                    FROM `notifications` 
                                    ORDER BY `id`
                                    ');
        return $result->fetchAll();
    
    } 
    
    
     public function getCoincidenceEvent($actiontype,$vehicle,$statedestiny,$municipalitydestiny)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $resultCoincidenceEvent = $cnx->executeQuery('SELECT 
                        id AS Id_Notification,
                        DATE (notification_date) AS Notification_Date_Format,
                        user_id,
                        action_type,
                        municipality_destiny_id,
                        state_destiny_id,
                        municipality_origin_id,
                        state_origin_id,
                        vehicle_type_id,
                        vehicle_id,
                        notification_date
                        FROM notifications
                        WHERE action_type='.$actiontype.' 
                        AND vehicle_id='.$vehicle.' 
                        AND state_destiny_id='.$statedestiny.' 
                        AND municipality_destiny_id='.$municipalitydestiny.'');
        return $resultCoincidenceEvent->fetchAll();
    } 
    
}





?>
