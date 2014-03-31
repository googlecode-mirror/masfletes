<?php

class Ajax_SearchController extends Model3_Controller
{
    private $_credentials;
    
    public function init()
    {
        $this->_credentials = Model3_Auth::getCredentials();
        $this->view->setUseTemplate(FALSE);
    }

    public function searchAction()
    {
        if ($this->getRequest()->isPost())
        {
            $em = $this->getEntityManager('DefaultDb');
            $user = $em->getRepository('DefaultDb_Entity_User')->find($this->_credentials['id']);
            $userType = ($user->getType() == 2) ? "Agent" : "Customer";
            $post = $this->getRequest()->getPost();
            //Todas las variables de las busquedas
            $entity = $post['identity'];
            $originCity = isset($post['edosOrigenCity']) ? $post['edosOrigenCity'] : "";
            $destinyCity = isset($post['edosDestinoCity']) ? $post['edosDestinoCity'] : "";
            $vehicle = isset($post['vehicle']) ? $post['vehicle'] : "";
            $shipment = isset($post['shipment']) ? $post['shipment'] : "";
            $route = isset($post['route']) ? $post['route'] : "";
            $status = isset($post['status']) ? $post['status'] : "";
            //Fechas
            $fechaIni = isset($post['fechaIniTF']) ? $post['fechaIniTF'] : "";
            $fechaFin = isset($post['fechaFinTF']) ? $post['fechaFinTF'] : "";
            //Informacion de la db
            $query = $em->getRepository('DefaultDb_Entity_'.$entity)
                    ->createQueryBuilder('s')->select('s');
            //Consultas
            if( $entity == 'Operation' )
            {
                $query = $query->where('s.shipment = :shipment')
                    ->andWhere('s.route = :route')
                    ->andWhere('s.status = :status')
                    ->setParameter('shipment',$shipment)
                    ->setParameter('route',$route)
                    ->setParameter('status',$status);
            }else{
                $query = $query->where('s.municipalityOrigin = :origen')
                    ->andWhere('s.municipalityDestiny = :destino')
                    ->setParameter('origen',$originCity)
                    ->setParameter('destino',$destinyCity);
            }
            
            if($vehicle !== "")
                $query = $query->andWhere ('s.vehicle = :vehicle')->setParameter('vehicle',$vehicle);
            
            if($fechaIni !== "")
            {
                $fIni = new DateTime($fechaIni);
                if($entity == 'Shipment')
                    $query = $query->andWhere('s.sourceDate >= :f_ini');
                if($entity == 'Route')
                    $query = $query->andWhere('s.loadAvailabilityDate >= :f_ini');
                if($entity == 'Operation')
                    $query = $query->andWhere('s.operationDate >= :f_ini');
                
                $query = $query->setParameter('f_ini',$fIni->format('Y-m-d'));
            }
            
            if($fechaFin !== "")
            {
                $fFin = new DateTime($fechaFin);
                
                if( $entity == 'Shipment' )
                    $query = $query->andWhere('s.destinyDate <= :f_fin');
                if( $entity == 'Route' )
                    $query = $query->andWhere('s.loadAvailabilityDate <= :f_fin');
                if( $entity == 'Operation' )
                    $query = $query->andWhere('s.operationDate <= :f_fin');
                
                $query = $query->setParameter('f_fin',$fFin);
            }
            //Usuario
//            if( $entity !== 'Operation' )
//                $query = $query->andWhere('s.user = :user')->setParameter('user',$user);
//              var_dump($query->getQuery());      
            $list = $query->getQuery()->getResult();
            $this->view->userType = $userType;
            $this->view->entityName = $entity;
            $this->view->data = $list;
        }
    }
}