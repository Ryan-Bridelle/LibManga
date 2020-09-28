<?php
	class Ajout{
		private $db;
        private $insert;
        private $connect;
        private $select;

		public function __construct($db){
			$this->db = $db;
            $this->insert = $db->prepare("insert into manga(nomManga,genre,resume) values(:nomManga,:genre,:resume)");
            $this->connect = $this->db->prepare("select nomManga, genre, resume from manga where nomManga=:nomManga");
            $this->select = $db->prepare("select nomManga, genre, resume from manga m");
           
		}
        public function insert($nomManga,$genre,$resume){
            $r=true;
            $this->insert->execute(array(':nomManga'=>$nomManga,':genre'=>$genre,':resume'=>$resume));
            if($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            return $r;
        }
 
        public function select(){

            $this->select->execute();
            if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
            }
            return $this->select->fetchAll();
        }
	}
		
?>