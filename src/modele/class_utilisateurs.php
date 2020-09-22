<?php
	class Utilisateur{
		private $db;
        private $insert;
        private $connect;

		public function __construct($db){
			$this->db = $db;
            $this->insert = $db->prepare("insert into utilisateur(nom,prenom,email,idRole,mdp) values(:nom,:prenom,:email,:role,:mdp)");

            
            $this->connect = $this->db->prepare("select email, idRole, mdp from utilisateur where email=:email");
		}
        public function insert($nom,$prenom,$email,$role,$mdp){
            $r=true;
            $this->insert->execute(array(':nom'=>$nom,':prenom'=>$prenom,':email'=>$email,':role'=>$role,':mdp'=>$mdp));
            if($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }

        public function connect($email){
            $unUtilisateur = $this->connect->execute(array(':email'=>$email));
            if ($this->connect->errorCode()!=0){
            print_r($this->connect->errorInfo());
            }
            return $this->connect->fetch();
            } 
	}
		
?>