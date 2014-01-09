<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventPanelRepository
 *
 * @author Propietario
 */
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class DefaultDb_Repositories_EventPanelRepository extends EntityRepository
{  
    
     public function getEvent()
    {
        $cnx = $this->getEntityManager()->getConnection();
        $res = $cnx->executeQuery("SELECT event_panel.id, 
                                    id_user, 
                                    coincidence_number,
                                    coincidence_event, 
                                    id_event, 
                                    event, 
                                    status, 
                                    creation_date, 
                                    data_hidden, 
                                    DATE_FORMAT(creation_date,GET_FORMAT(DATE, 'EUR')) AS Availability_Date,
                                   users.username AS Email_User,
                                   users.first_name AS FirstName_User,
                                   users.last_name AS LastName_User,
                                   users.phone AS Phone_User,
                                   users.id AS Id_User
                                   FROM event_panel 
                                   LEFT JOIN users ON ( event_panel.id_user = users.id)
                                   ORDER BY event_panel.id DESC");
        return $res;
    }
    
    
    public function getNoReadEvent($typeEvent)
    {
        $cnx = $this->getEntityManager()->getConnection();
        $readEvent = $cnx->executeQuery("SELECT event, COUNT( * ) AS Count_Event
                                    FROM event_panel
                                    WHERE STATUS =  '0'
                                    AND event = '".$typeEvent."'
                                    GROUP BY event");
        return $readEvent;
    }
    
   
    
    public function getCoincideRoutes($vehicleroute,$statedestiny,$municipalitydestiny,$notificationDate)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $coincideRoutes = $cnx->executeQuery("SELECT 
                    DATE_ADD( load_availability_date, INTERVAL effective_days DAY ),
                    routes.id AS Route_Id, 
                    routes.email, 
                    routes.load_availability_date AS Availability_Date, 
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
                    AND (DATE_ADD( load_availability_date, INTERVAL effective_days DAY ))>= '".$notificationDate."'
                    ORDER BY Route_Id DESC");
       return $coincideRoutes->fetchAll();
    }     
    
    public function getCoincideShipments($vehicleroute,$statedestiny,$municipalitydestiny,$notificationDate)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $CoincideShipments  = $cnx->executeQuery("SELECT 
                                                    DATE_ADD( source_date, INTERVAL effective_days DAY ),
                                                    shipments.id AS Shipments_Id, 
                                                    shipments.user_id, 
                                                    shipments.contact_name, 
                                                    shipments.creation_date,
                                                    shipments.source_date,
                                                    DATE_FORMAT(source_date,GET_FORMAT(DATE, 'EUR')) AS Availability_Date,
                                                    DATE_FORMAT(DATE_ADD( source_date, INTERVAL effective_days DAY) ,GET_FORMAT(DATE, 'EUR')) AS New_Availability_Date,
                                                    shipments.effective_days,
                                                    shipments.contact_phone,
                                                    shipments.comments AS Comment, 
                                                    shipments.vehicle_id AS Vehicle_Id, 
                                                    shipments.vehicle_type_id AS Vehicle_Type_Id, 
                                                    shipments.municipality_destiny_id AS Municipality_Destiny, 
                                                    shipments.state_destiny_id AS StateId, 
                                                    shipments.municipality_origin_id AS Municipality_Origin, 
                                                    shipments.state_origin_id AS OriginId,
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
                                            FROM shipments
                                            LEFT JOIN vehicles ON ( shipments.vehicle_id = vehicles.id )
                                            LEFT JOIN vehicle_types ON ( shipments.vehicle_type_id = vehicle_types.id ) 
                                            LEFT JOIN states ON ( state_destiny_id = states.id )
                                            LEFT JOIN cities ON ( municipality_destiny_id = cities.id )
                                            LEFT JOIN states AS statesOrigin ON ( state_origin_id = statesOrigin.id ) 
                                            LEFT JOIN cities AS citiesOrigin ON ( municipality_origin_id = citiesOrigin.id)
                                            WHERE Vehicle_Id =".$vehicleroute."
                                            AND state_destiny_id=".$statedestiny." 
                                            AND municipality_destiny_id =".$municipalitydestiny."
                                            AND (DATE_ADD(source_date, INTERVAL effective_days DAY )) >= '".$notificationDate."'
                                            ORDER BY Shipments_Id DESC");
      
       return $CoincideShipments->fetchAll();
    } 
    
    public function getRoutesEvent($numberevent)
    {
        $cnx = $this->getEntityManager()->getConnection();
        $RoutesEvent = $cnx->executeQuery("SELECT
                    DATE_ADD( load_availability_date, INTERVAL effective_days DAY ),
                    routes.id AS Route_Id, 
                    routes.email, 
                    routes.user_id, 
                    routes.load_availability_date AS Availability_Date_Route, 
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
                    users.username AS Email_User,
                    users.first_name AS FirstName_User,
                    users.last_name AS LastName_User,
                    users.phone AS Phone_User,
                    users.id AS Id_User
                    FROM routes
                    LEFT JOIN vehicles ON ( routes.vehicle_id = vehicles.id ) 
                    LEFT JOIN vehicle_types ON ( routes.vehicleType_id = vehicle_types.id ) 
                    LEFT JOIN states ON ( stateDestiny_id = states.id ) 
                    LEFT JOIN cities ON ( municipalityDestiny_id = cities.id)
                    LEFT JOIN states AS statesOrigin ON ( stateOrigin_id = statesOrigin.id ) 
                    LEFT JOIN cities AS citiesOrigin ON ( municipalityOrigin_id = citiesOrigin.id)
                    LEFT JOIN users ON ( routes.user_id = users.id)
                    WHERE routes.id='".$numberevent."' 
                    ORDER BY Route_Id  DESC");
                    return $RoutesEvent;
    }  
    
    public function getShipmentsEvent($numberevent)
    {
        $cnx = $this->getEntityManager()->getConnection();
        $ShipmentsEvent = $cnx->executeQuery("SELECT 
                    DATE_ADD( source_date, INTERVAL effective_days DAY ),
                    shipments.id AS Shipments_Id, 
                    shipments.user_id, 
                    shipments.contact_name, 
                    shipments.source_date,
                    shipments.creation_date,
                    DATE_FORMAT(source_date,GET_FORMAT(DATE, 'EUR')) AS Availability_Date,
                    DATE_FORMAT(DATE_ADD( source_date, INTERVAL effective_days DAY) ,GET_FORMAT(DATE, 'EUR')) AS New_Availability_Date,
                    shipments.effective_days,
                    shipments.contact_phone,
                    shipments.comments AS Comment, 
                    shipments.vehicle_id AS Vehicle_Id, 
                    shipments.vehicle_type_id AS Vehicle_Type_Id, 
                    shipments.municipality_destiny_id, 
                    shipments.state_destiny_id AS StateId, 
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
                    users.username AS Email_User,
                    users.first_name AS FirstName_User,
                    users.last_name AS LastName_User,
                    users.phone AS Phone_User,
                    users.id AS Id_User
                    FROM shipments
                    LEFT JOIN vehicles ON ( shipments.vehicle_id = vehicles.id )
                    LEFT JOIN vehicle_types ON ( shipments.vehicle_type_id = vehicle_types.id ) 
                    LEFT JOIN states ON ( state_destiny_id = states.id )
                    LEFT JOIN cities ON ( municipality_destiny_id = cities.id )
                    LEFT JOIN states AS statesOrigin ON ( state_Origin_id = statesOrigin.id ) 
                    LEFT JOIN cities AS citiesOrigin ON ( municipality_Origin_id = citiesOrigin.id)
                    LEFT JOIN users ON ( shipments.user_id = users.id)
                    WHERE shipments.id='".$numberevent."'
                    ORDER BY Shipments_Id DESC");
                    return $ShipmentsEvent; 
    }  
    
    
       public function updateEvent($idPanel)
    {
        $cnx = $this->getEntityManager()->getConnection();
        $updateIdPanel = $cnx->executeQuery("UPDATE event_panel SET status='1' WHERE id='".$idPanel."'");
        return $updateIdPanel;
    }
    
        public function updateDataHidden($idPanel)
    {
        $cnx = $this->getEntityManager()->getConnection();
        $updateDataHiden = $cnx->executeQuery("UPDATE event_panel SET data_hidden='1' WHERE id='".$idPanel."'");
        return $updateDataHiden;
    }
}

?>
