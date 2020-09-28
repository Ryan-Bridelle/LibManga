<?php
	class Utilisateur{
		private $db;
        private $insert;
        private $connect;
        private $select;
        private $selectByEmail;

		public function __construct($db){
			$this->db = $db;
            $this->insert = $db->prepare("insert into utilisateur(nom,prenom,email,idRole,mdp) values(:nom,:prenom,:email,:role,:mdp)");
            $this->connect = $this->db->prepare("select email, idRole, mdp from utilisateur where email=:email");
            $this->select = $db->prepare("select email, idRole, nom, prenom, r.libelle as libellerole from utilisateur u, role r where u.idRole = r.id order by nom");
            $this->selectByEmail  =  $db->prepare("select email,  nom,  prenom,  idRole  from  utilisateur  where email=:email");
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

        public function select(){

            $this->select->execute();
            if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
            }
            return $this->select->fetchAll();
        }

        public function selectByEmail($email){
            $this->selectByEmail->execute(array(':email'=>$email));        
            if ($this->selectByEmail->errorCode()!=0){             
                print_r($this->selectByEmail->errorInfo());          
             }        
             return $this->selectByEmail->fetch(); 
         }
	}
		
?>