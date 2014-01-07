<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

   
class DefaultDb_Repositories_ConfigurationEmailRepository extends EntityRepository
{  
    public function getDetailsConfigurations($userId)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $resultConfigurations = $cnx->executeQuery("SELECT email, send_routes, send_shipments, send_notifications 
                    FROM configurations_email 
                    WHERE user_id='".$userId."'");
       return $resultConfigurations;
    }
    
    
    
    public function updateOptionsConfigurations($email,$routes,$shipments,$notifications,$userId)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $resultUpdate = $cnx->executeQuery("UPDATE configurations_email
                    SET email='".$email."',send_routes='".$routes."',send_shipments='".$shipments."',send_notifications='".$notifications."' 
                    WHERE user_id='".$userId."'");
        return $resultUpdate;
    }  
}





?>
