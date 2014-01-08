<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//Creado para la busqueda de cargas coincidentes o no con una ruta
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

   class DefaultDb_Repositories_ShipmentRepository extends EntityRepository
{
    public function getSearchShipment($vehicleroute,$statedestiny,$municipalitydestiny)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $searchshipments = $cnx->executeQuery('SELECT shipments.id AS Shipments_Id, 
                                                    shipments.user_id, 
                                                    shipments.contact_name, 
                                                    shipments.source_date,
                                                    shipments.creation_date,
                                                    shipments.effective_days,
                                                    shipments.contact_phone, 
                                                    shipments.vehicle_id AS Vehicle_Id,
                                                    shipments.vehicle_type_id AS Vehicle_Id,
                                                    shipments.municipality_destiny_id, 
                                                    shipments.state_destiny_id AS StateId, 
                                                    vehicles.id, 
                                                    vehicles.name, 
                                                    vehicle_types.id, 
                                                    vehicle_types.name,
                                                    states.name AS State_Destiny_Name, 
                                                    states.id, 
                                                    cities.name AS City_Destiny_Name, 
                                                    cities.id,
                                                    statesOrigin.name AS State_Origin_Name, 
                                                    statesOrigin.id, 
                                                    citiesOrigin.name AS City_Origin_Name,  
                                                    citiesOrigin.id
                                            FROM shipments
                                            LEFT JOIN vehicles ON ( shipments.vehicle_id = vehicles.id )
                                            LEFT JOIN vehicle_types ON ( shipments.vehicle_type_id = vehicle_types.id ) 
                                            LEFT JOIN states ON ( state_destiny_id = states.id )
                                            LEFT JOIN cities ON ( municipality_destiny_id = cities.id )
                                            LEFT JOIN states AS statesOrigin ON ( state_Origin_id = statesOrigin.id ) 
                                            LEFT JOIN cities AS citiesOrigin ON ( municipality_Origin_id = citiesOrigin.id)
                                            WHERE Vehicle_Id ='.$vehicleroute.'
                                            AND state_destiny_id='.$statedestiny.' 
                                            AND municipality_destiny_id ='.$municipalitydestiny.'
                                            ORDER BY Shipments_Id DESC');

    return $searchshipments->fetchAll();
    } 
    
    public function getNotificationForShipments($vehicleroute,$state,$municipality,$notificationDate)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $NotifationforShipments  = $cnx->executeQuery("SELECT 
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
                                                    users.username as EmailUser,
                                                    users.id
                                            FROM shipments
                                            LEFT JOIN vehicles ON ( shipments.vehicle_id = vehicles.id )
                                            LEFT JOIN vehicle_types ON ( shipments.vehicle_type_id = vehicle_types.id ) 
                                            LEFT JOIN states ON ( state_destiny_id = states.id )
                                            LEFT JOIN cities ON ( municipality_destiny_id = cities.id )
                                            LEFT JOIN states AS statesOrigin ON ( state_Origin_id = statesOrigin.id ) 
                                            LEFT JOIN cities AS citiesOrigin ON ( municipality_Origin_id = citiesOrigin.id)
                                            LEFT JOIN users ON ( users.id = shipments.user_id )
                                            WHERE Vehicle_Id =".$vehicleroute."
                                            AND state_destiny_id=".$state." 
                                            AND municipality_destiny_id =".$municipality."
                                            AND (DATE_ADD( source_date, INTERVAL effective_days DAY )) >= '".$notificationDate."'
                                            ORDER BY Shipments_Id DESC");

       return $NotifationforShipments->fetchAll();
    } 
    
    public function getSearchShipmentsForZone ($vehicle,$numberzone,$date)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $SearchShipmentsForZone  = $cnx->executeQuery("SELECT 
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
                                                    zone.name AS Zone_Name, 
                                                    zone.number AS Zone_Number, 
                                                    zone.id_city, 
                                                    zone.id_state
                                                    FROM shipments
                                                    LEFT JOIN vehicles ON ( shipments.vehicle_id = vehicles.id )
                                                    LEFT JOIN vehicle_types ON ( shipments.vehicle_type_id = vehicle_types.id ) 
                                                    LEFT JOIN states ON ( state_destiny_id = states.id )
                                                    LEFT JOIN cities ON ( municipality_destiny_id = cities.id )
                                                    LEFT JOIN states AS statesOrigin ON ( state_Origin_id = statesOrigin.id ) 
                                                    LEFT JOIN cities AS citiesOrigin ON ( municipality_Origin_id = citiesOrigin.id)
                                                    LEFT JOIN zone ON (zone.id_city = municipality_destiny_id) AND (state_destiny_id=zone.id_state)
                                            WHERE Vehicle_Id =".$vehicle."
                                            AND zone.number =".$numberzone."
                                            AND (DATE_ADD( source_date, INTERVAL effective_days DAY )) >= '".$date."'
                                            ORDER BY Shipments_Id DESC");

       return $SearchShipmentsForZone;
    }
}
   
?>
