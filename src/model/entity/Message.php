<?php
    namespace App\Model\Entity;
    
    use App\Core\AbstractEntity as AE;
    use App\Core\EntityInterface;

    class Message extends AE implements EntityInterface
    {
        private $id;
        private $contenue;
        private $createdAt;
        private $utilisateur;
        private $sujet;

        public function __construct($data){
            parent::hydrate($data, $this);
        }

        public function __toString()
        {
            return $this->getCreatedAt('d/m/Y H:i:s');
        }
        
        
        /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        

        /**
         * Get the value of contenue
         */ 
        public function getContenue()
        {
                return $this->contenue;
        }

        /**
         * Set the value of contenue
         *
         * @return  self
         */ 
        public function setContenue($contenue)
        {
                $this->contenue = $contenue;

                return $this;
        }

        /**
         * Get the value of created_at
         */ 
        public function getCreatedAt($format)
        {
            return $this->createdAt->format($format);
        }

        /**
         * Set the value of created_at
         *
         * @return  self
         */ 
        public function setCreatedAt($createdAt)
        {
            $this->createdAt = new \DateTime($createdAt);

            return $this;
        }


        /**
         * Get the value of utilisateur
         */ 
        public function getUtilisateur()
        {
                return $this->utilisateur;
        }

        /**
         * Set the value of utilisateur
         *
         * @return  self
         */ 
        public function setUtilisateur($utilisateur)
        {
                $this->utilisateur = $utilisateur;

                return $this;
        }

        /**
         * Get the value of sujet
         */ 
        public function getSujet()
        {
                return $this->sujet;
        }

        /**
         * Set the value of sujet
         *
         * @return  self
         */ 
        public function setSujet($sujet)
        {
                $this->sujet = $sujet;

                return $this;
        }
    }