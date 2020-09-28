<?php 
    class Role{
        private $select;

        public function __construct($db){
            $this->select = $db->prepare("select  idRole, r.libelle as libellerole from utilisateur u, role r where u.idRole = r.id");
        }

        public function select(){

            $this->select->execute();
            if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
            }
            return $this->select->fetchAll();
        }
    }