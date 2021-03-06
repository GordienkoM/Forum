<?php
namespace App\Controller;

use App\Core\AbstractController as AC;
use App\Model\Manager\SujetManager;
use App\Model\Manager\MessageManager;
use App\Model\Manager\UtilisateurManager;

class AdminController extends AC
{
    public function __construct(){
        $this->managerS = new SujetManager();
        $this->managerM = new MessageManager();
        $this->managerU = new UtilisateurManager();
    }

    public function index(){
        $sujets = $this->managerS->getAll();
        $messages = $this->managerM->getAll();
        $utilisateurs = $this->managerU->getAll();

        return $this->render("admin/admin.php", [
            "sujets" => $sujets,
            "messages" => $messages,
            "utilisateurs" => $utilisateurs,
            "title"    => "Administration"
        ]);
    }

}