<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

   
class DefaultDb_Repositories_ZoneRepository extends EntityRepository
{  
    public function getZone($state,$city)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $resultZone = $cnx->executeQuery("SELECT 
                id_zone AS Id_Zone,
                name AS Name_Zone,
                number AS Number_Zone,
                id_city,
                id_state
                FROM zone 
                WHERE id_state = '".$state."' 
                AND id_city = '".$city."'");
        return $resultZone->fetchAll();
    }  
}





?>
