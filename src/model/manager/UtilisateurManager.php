<?php
namespace App\Model\Manager;

use App\Core\AbstractManager as AM;
use App\Core\ManagerInterface;

class UtilisateurManager extends AM implements ManagerInterface
{
    public function __construct(){
        parent::connect();
    }

    public function getAll(){
        return $this->getResults(
            "App\Model\Entity\Utilisateur",
            "SELECT * FROM utilisateur"
        );
    }

    public function getOneById($id){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Utilisateur",
            "SELECT * FROM utilisateur WHERE id = :num", 
            [
                "num" => $id
            ]
        );
    }

    public function insertUser($pseudo, $mail, $pass){
        return $this->executeQuery(
            "INSERT INTO utilisateur (pseudo, email, password, role) VALUES (:pseudo, :mail, :pass, 'ROLE_USER')",
            [
                "pseudo" => $pseudo,
                "mail" => $mail,
                "pass" => $pass
            ]
        );
    }

    function getUserByEmail($mail){
        return $this->getOneOrNullResult(
            "App\Model\Entity\Utilisateur",
            "SELECT * FROM utilisateur WHERE email = :mail",
            [
                "mail" => $mail
            ]
        );
    }

    function getPasswordByEmail($mail){
        return $this->getOneValue(
            "SELECT password FROM utilisateur WHERE email = :mail",
            [
                "mail" => $mail
            ]
        );
    }

}
