<?php
   
    class forum {
        private  $id ;
        private  $nom;
        private  $prenom;
        private  $message;
       

        public function __construct($id, $nom, $prenom, $message){
            //$this->idForum = $id;++
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->message = $message;
           
        }

        public function getId () {
            return $this->id;
        }

        
        public function getNom (){
            return $this->nom ;
        }
      
        public function getPrenom (){
            return $this->prenom ;
        }
        public function getMessage (){
            return $this->message ;
        }
        
        

        public function setId($id){
			$this->id=$id;
		}

        public function setNom ($nom){
            $this->nom = $nom;
        }
       
        public function setPrenom ($prenom){
            $this->prenom = $prenom;
        }
        public function setMessage ($message){
            $this->message = $message;
        }
       

    }
