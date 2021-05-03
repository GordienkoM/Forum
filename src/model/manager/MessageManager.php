<?php
namespace App\Model\Manager;
    
use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;

class MessageManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Message",
            "SELECT * FROM message"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Message",
            "SELECT * FROM message WHERE id = :num", 
            [
                "num" => $id
            ]
        );
    }

    public function insertMessage($contenue, $utilisateur_id, $sujet_id){
        $this->executeQuery( 
            "INSERT INTO message (contenue, utilisateur_id, sujet_id) VALUES (:contenue, :utilisateur_id, :sujet_id)",
            [
                "contenue"  => $contenue,
                "utilisateur_id" => $utilisateur_id,
                "sujet_id" => $sujet_id
            ]
        );
        return $this->getLastInsertId();
    }

    
    public function deleteMessage($id){
        return $this->executeQuery( 
            "DELETE FROM message WHERE id = :id",
            [
                "id" => $id 
            ]
        );
    }

    public function deleteMessages($id){
        return $this->executeQuery( 
            "DELETE FROM message WHERE sujet_id = :id",
            [
                "id" => $id 
            ]
        );
    }

}