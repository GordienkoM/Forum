<?php
namespace App\Model\Manager;

use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;

class SujetManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }


    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Sujet",
            "SELECT * FROM sujet"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Sujet",
            "SELECT * FROM sujet WHERE id = :num", 
            [
                "num" => $id
            ]
        );
    }

    
    public function getAllTopicsWithDetails(){
        return $this->getResults(
            "App\Model\Entity\SujetDetails",
            "SELECT sujet.id AS sujet_id, max(message.id) AS Message_id, COUNT(message.id) AS nombreDeMessages
            FROM  sujet, message
            WHERE sujet.id=message.sujet_id
            GROUP BY sujet.id"
        );
    }


    
    public function getMessagesByTopic($id){
        return $this->getResults(
            "App\Model\Entity\Message",
            "SELECT * FROM message WHERE sujet_id = :id 
             ORDER BY message.createdAt DESC",
            [
                "id" => $id 
            ]
        );
    }

    public function getAnswersByTopic($id){
        return $this->getResults(
            "App\Model\Entity\Message",
            "SELECT * FROM message WHERE sujet_id = :id
            HAVING  message.id != 
	            (SELECT min(message.id) FROM message WHERE sujet_id = :id) 
            ORDER BY message.createdAt DESC",
            [
                "id" => $id 
            ]
        );
    }

    public function getFirstMessageByTopic($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Message",
            "SELECT * FROM message WHERE sujet_id = :id
             ORDER BY message.createdAt
             LIMIT 1", 
            [
                "id" => $id
            ]
        );
    }

    
    public function changeStatus($id){
        $statut= 1-$this->getOneById($id)->getStatut();
        $this->executeQuery( 
            "UPDATE sujet
            SET sujet.statut = :statut
            WHERE id = :id",
            [
                "statut" => $statut,
                "id" => $id
            ]
        );
        return $this->getLastInsertId();
    }

    public function insertMessage($name, $descr, $price, $catid){
        $this->executeQuery( 
            "INSERT INTO Message (name, description, price, category_id) VALUES (:name, :descr, :price, :catid)",
            [
                "name"  => $name,
                "descr" => $descr,
                "price" => $price,
                "catid" => $catid
            ]
        );
        return $this->getLastInsertId();
    }

    public function insertTopic($titre, $utilisateur_id){
        $this->executeQuery( 
            "INSERT INTO sujet (titre, statut, utilisateur_id) VALUES (:titre, 1, :utilisateur_id)",
            [
                "titre"  => $titre,
                "utilisateur_id" => $utilisateur_id

            ]
        );
        return $this->getLastInsertId();
    }


    public function deleteTopic($id){
        return $this->executeQuery( 
            "DELETE FROM sujet WHERE id = :id",
            [
                "id" => $id 
            ]
        );
    }
}