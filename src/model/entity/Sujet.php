<?php
    namespace App\Model\Entity;
 
    use App\Core\AbstractEntity as AE;
    use App\Core\EntityInterface;

    class Sujet extends AE implements EntityInterface
    {

        private $id;
        private $titre;
        private $statut;
        private $createdAt;
        private $utilisateur;
        
        public function __construct($data){
            parent::hydrate($data, $this);
        }

        
        public function __toString(){
                return $this->titre;
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
         * Get the value of statut
         */ 
        public function getStatut()
        {
                return $this->statut;
        }

        /**
         * Set the value of statut
         *
         * @return  self
         */ 
        public function setStatut($statut)
        {
                $this->statut = $statut;

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
         * Get the value of titre
         */ 
        public function getTitre()
        {
                return $this->titre;
        }

        /**
         * Set the value of titre
         *
         * @return  self
         */ 
        public function setTitre($titre)
        {
                $this->titre = $titre;

                return $this;
        }
    }