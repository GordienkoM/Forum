<?php
    namespace App\Controller;

    use App\Core\Session;
    use App\Core\AbstractController as AC;
    use App\Model\Manager\SujetManager;
    use App\Model\Manager\MessageManager;



    class ForumController extends AC
    {
        public function __construct(){
            $this->managerS = new SujetManager();
            $this->managerM = new MessageManager();
        }

        public function index()
        {
            $sujets = $this->managerS->getAll();
            $topicsDetails = $this->managerS->getAllTopicsWithDetails();

            //Si utilisateur est connecté, il y a accés au forum, sinon on affiche une page de connextion
            if(Session::get("user")){
            return $this->render("forum/topics.php", [
                "sujets" => $sujets,
                "topicsDetails" => $topicsDetails,
                "title"    => "Liste des sujets"
            ]);
            }  
            else return $this->render("user/login.php", [
                "title"    => "Connextion"
            ]);
        }


        public function showTopic($id)
        {
            if($id){
                
                $messages = $this->managerS->getAnswersByTopic($id);
                $sujet = $this->managerS->getOneById($id);
                $premierMessage = $this->managerS->getFirstMessageByTopic($id);

                return $this->render("forum/topicAndMessages.php", [
                    "messages" => $messages,
                    "sujet" => $sujet,
                    "premierMessage" => $premierMessage,
                    "title"   => $sujet
                ]);
            }  
            else $this->redirectToRoute("forum");
        }

        
        public function lockUnlockTopict($id)
        {
            if($id){
                if(Session::get("user") && Session::get("user")->hasRole("ROLE_ADMIN")){ 
                    $this->managerS->changeStatus($id);  
                }  
            }

            return $this->redirectToRoute("forum");
        }


        public function newTopic()
        {
            return $this->render("forum/createTopic.php");
        }

        
        public function addTopic(){
            if(isset($_POST["submit"])){
                
                $utilisateur_id =  Session::get("user")->getId();
                $titre  = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
                $contenue = filter_input(INPUT_POST, "contenue", FILTER_SANITIZE_STRING);
                
                if($titre && $contenue){
                $sujet_id = $this->managerS->insertTopic($titre, $utilisateur_id);
                $message_id = $this->managerM->insertMessage($contenue, $utilisateur_id, $sujet_id); 
                    if($sujet_id && $message_id){
                        Session::addFlash('success', "Le sujet est ajouté");
                    }
                    else{
                        Session::addFlash('error', "Une erreur est survenue, contactez l'administrateur...");
                    }
                }
                else Session::addFlash('error', "Tous les champs doivent être remplis et respecter leur format...");
            }
            else Session::addFlash('error', "Petit malin, mais ça marche pas !! Nananèèèèreuh !");
            
            return $this->redirectToRoute("forum");
        }

        public function delTopic($id){
            if($id){

                if($this->managerM->deleteMessages($id) && $this->managerS->deleteTopic($id)){
                    Session::addFlash('success', "Le sujet est suprimé");
                }
                else{
                    Session::addFlash('error', "Une erreur est survenue, contactez l'administrateur...");
                }
            }
            else Session::addFlash('error', "Une erreur est survenue, contactez l'administrateur...");
            
            return $this->redirectToRoute("forum");
        }
    }