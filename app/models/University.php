<?php
    class University{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //get all feilds from university table
        public function getUniversities(){
            $this->db->query('SELECT * FROM Universities');
            $results = $this->db->resultSet();
            return $results;
        }

        //get university id by using the university name from the database
        public function getUniIdByName($name){
            $this->db->query('SELECT id FROM universities WHERE name = :name');

            $this->db->bind(':name' , $name);

            $row = $this->db->single();

            if ($row) {
                return $row->id;
            } else {
                return null; // or another default value depending on your logic
            }
        }

        
        public function getUniversity(){
            $this->db->query('SELECT u.*, uni.* 
                              FROM users u 
                              JOIN universities uni 
                              ON u.university_id = uni.id 
                              WHERE u.id = 1
                            ');
            $results= $this->db->resultSet();
            return $results;
        }

        public function getUniversityById($id){
            $this->db->query('SELECT * FROM universities WHERE id = :id');
            $this->db->bind(':id' , $id);
    
            $row= $this->db->single();
    
            return $row;
    
        }
    }
?>