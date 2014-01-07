<?php
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;


class DefaultDb_Repositories_UserRepository extends EntityRepository
{     
    public function getNoti()
    {
        $cnx = $this->getEntityManager()->getConnection();
        $res = $cnx->executeQuery('SELECT id, username, first_name FROM users WHERE type=1 ORDER BY username DESC');
       return $res->fetchAll();
    }     
    
      
    public function getEmailContact()
    {
         $cnx = $this->getEntityManager()->getConnection();
       $contact = $cnx->executeQuery('SELECT id, email, first_name, last_name, type 
                                            FROM users WHERE type=3
                                            ORDER BY first_name DESC');

       return $contact->fetchAll();
    }
    
    public function getEmailUser($id)
    {
       $cnx = $this->getEntityManager()->getConnection();
       $emailUser = $cnx->executeQuery('SELECT username
                                      FROM users WHERE id='.$id.'');

       return $emailUser->fetchAll();
    } 
}

?>
