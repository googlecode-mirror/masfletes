<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//Creado para la busqueda de rutas coincidentes o no con una carga
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

   class DefaultDb_Repositories_RouteRepository extends EntityRepository
{   
    public function getSearchRoute($vehicleroute,$statedestiny,$municipalitydestiny)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $searchroutes = $cnx->executeQuery("SELECT 
                    DATE_ADD( load_availability_date, INTERVAL effective_days DAY ),
                    routes.id AS Route_Id, 
                    routes.email, 
                    routes.load_availability_date, 
                    DATE_FORMAT(routes.load_availability_date,GET_FORMAT(DATE, 'EUR')) AS Availability_Date,
                    DATE_FORMAT( DATE_ADD( load_availability_date, INTERVAL effective_days DAY) ,GET_FORMAT(DATE, 'EUR')) AS New_Availability_Date,
                    routes.comments AS Comment, 
                    routes.vehicle_id AS Vehicle_Id, 
                    routes.vehicleType_id AS Vehicle_Type_Id, 
                    routes.municipalityOrigin_id AS City_Origin, 
                    routes.stateOrigin_id AS State_Origin, 
                    routes.municipalityDestiny_id AS City_Id, 
                    routes.stateDestiny_id AS State_Id, 
                    routes.effective_days, 
                    vehicles.id, 
                    vehicles.name AS Vehicle_Name, 
                    vehicle_types.id, 
                    vehicle_types.name AS Vehicle_Type_Name,
                    states.name AS State_Destiny_Name,
                    states.abbreviation AS State_D_Abbrev,
                    states.id, 
                    cities.name AS City_Destiny_Name, 
                    cities.id,
                    statesOrigin.name AS State_Origin_Name,
                    statesOrigin.abbreviation AS State_O_Abbrev,
                    statesOrigin.id, 
                    citiesOrigin.name AS City_Origin_Name, 
                    citiesOrigin.id
                    FROM routes
                    LEFT JOIN vehicles ON ( routes.vehicle_id = vehicles.id ) 
                    LEFT JOIN vehicle_types ON ( routes.vehicleType_id = vehicle_types.id ) 
                    LEFT JOIN states ON ( stateDestiny_id = states.id ) 
                    LEFT JOIN cities ON ( municipalityDestiny_id = cities.id)
                    LEFT JOIN states AS statesOrigin ON ( stateOrigin_id = statesOrigin.id ) 
                    LEFT JOIN cities AS citiesOrigin ON ( municipalityOrigin_id = citiesOrigin.id)
                    WHERE  Vehicle_Id=".$vehicleroute."
                    AND stateDestiny_id=".$statedestiny."
                    AND municipalityDestiny_id=".$municipalitydestiny."
                    ORDER BY Route_Id DESC");
       
       return $searchroutes->fetchAll();
    }     
    
     public function getNotificationForRoutes($vehicleroute,$statedestiny,$municipalitydestiny,$notificationDate)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $NotifationforRoutes = $cnx->executeQuery("SELECT 
                    DATE_ADD( load_availability_date, INTERVAL effective_days DAY ),
                    routes.id AS Route_Id, 
                    routes.email, 
                    routes.user_id,
                    routes.load_availability_date, 
                    DATE_FORMAT(routes.load_availability_date,GET_FORMAT(DATE, 'EUR')) AS Availability_Date,
                    DATE_FORMAT( DATE_ADD( load_availability_date, INTERVAL effective_days DAY) ,GET_FORMAT(DATE, 'EUR')) AS New_Availability_Date,
                    routes.comments AS Comment, 
                    routes.vehicle_id AS Vehicle_Id, 
                    routes.vehicleType_id AS Vehicle_Type_Id, 
                    routes.municipalityOrigin_id AS City_Origin, 
                    routes.stateOrigin_id AS State_Origin, 
                    routes.municipalityDestiny_id AS City_Id, 
                    routes.stateDestiny_id AS State_Id, 
                    routes.effective_days, 
                    vehicles.id, 
                    vehicles.name AS Vehicle_Name, 
                    vehicle_types.id, 
                    vehicle_types.name AS Vehicle_Type_Name,
                    states.name AS State_Destiny_Name,
                    states.abbreviation AS State_D_Abbrev,
                    states.id, 
                    cities.name AS City_Destiny_Name, 
                    cities.id,
                    statesOrigin.name AS State_Origin_Name,
                    statesOrigin.abbreviation AS State_O_Abbrev,
                    statesOrigin.id, 
                    citiesOrigin.name AS City_Origin_Name, 
                    citiesOrigin.id,
                    users.id,
                    users.username AS EmailUser
                    FROM routes
                    LEFT JOIN vehicles ON ( routes.vehicle_id = vehicles.id ) 
                    LEFT JOIN vehicle_types ON ( routes.vehicleType_id = vehicle_types.id ) 
                    LEFT JOIN states ON ( stateDestiny_id = states.id ) 
                    LEFT JOIN cities ON ( municipalityDestiny_id = cities.id)
                    LEFT JOIN states AS statesOrigin ON ( stateOrigin_id = statesOrigin.id ) 
                    LEFT JOIN cities AS citiesOrigin ON ( municipalityOrigin_id = citiesOrigin.id)
                    LEFT JOIN users ON ( users.id = user_id )
                    WHERE  Vehicle_Id=".$vehicleroute."
                    AND stateDestiny_id=".$statedestiny."
                    AND municipalityDestiny_id=".$municipalitydestiny."
                    AND (DATE_ADD( load_availability_date, INTERVAL effective_days DAY ))>='".$notificationDate."'
                    ORDER BY Route_Id DESC");
       return $NotifationforRoutes->fetchAll();
    }     
    
    public function getSearchRoutesForZone($vehicle,$numberzone,$date)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $SearchRoutesForZone = $cnx->executeQuery("
                    SELECT 
                    DATE_ADD( load_availability_date, INTERVAL effective_days DAY ),
                    routes.id AS Route_Id, 
                    routes.email, 
                    routes.load_availability_date, 
                    DATE_FORMAT(routes.load_availability_date,GET_FORMAT(DATE, 'EUR')) AS Availability_Date,
                    DATE_FORMAT( DATE_ADD( load_availability_date, INTERVAL effective_days DAY) ,GET_FORMAT(DATE, 'EUR')) AS New_Availability_Date,
                    routes.comments AS Comment, 
                    routes.vehicle_id AS Vehicle_Id, 
                    routes.vehicleType_id AS Vehicle_Type_Id, 
                    routes.municipalityOrigin_id AS City_Origin, 
                    routes.stateOrigin_id AS State_Origin, 
                    routes.municipalityDestiny_id AS City_Id, 
                    routes.stateDestiny_id AS State_Id, 
                    routes.effective_days, 
                    vehicles.id, 
                    vehicles.name AS Vehicle_Name, 
                    vehicle_types.id, 
                    vehicle_types.name AS Vehicle_Type_Name,
                    states.name AS State_Destiny_Name,
                    states.abbreviation AS State_D_Abbrev,
                    states.id, 
                    cities.name AS City_Destiny_Name, 
                    cities.id,
                    statesOrigin.name AS State_Origin_Name,
                    statesOrigin.abbreviation AS State_O_Abbrev,
                    statesOrigin.id, 
                    citiesOrigin.name AS City_Origin_Name, 
                    citiesOrigin.id,
                    zone.name AS Zone_Name, 
                    zone.number AS Zone_Number, 
                    zone.id_city, 
                    zone.id_state
                    FROM routes
                    LEFT JOIN vehicles ON ( routes.vehicle_id = vehicles.id ) 
                    LEFT JOIN vehicle_types ON ( routes.vehicleType_id = vehicle_types.id ) 
                    LEFT JOIN states ON ( stateDestiny_id = states.id ) 
                    LEFT JOIN cities ON ( municipalityDestiny_id = cities.id)
                    LEFT JOIN states AS statesOrigin ON ( stateOrigin_id = statesOrigin.id ) 
                    LEFT JOIN cities AS citiesOrigin ON ( municipalityOrigin_id = citiesOrigin.id) 
                    LEFT JOIN zone ON (zone.id_city = municipalityDestiny_id) AND (stateDestiny_id=zone.id_state)
                    WHERE  Vehicle_Id=".$vehicle."
                    AND zone.number = ".$numberzone."
                    AND (DATE_ADD( load_availability_date, INTERVAL effective_days DAY ))>='".$date."'
                    ORDER BY Route_Id DESC");
       return $SearchRoutesForZone;
    }
    
}
?>
