<?php
    class Category{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //get all feilds from university table
        // public function getUniversities(){
        //     $this->db->query('SELECT * FROM Universities');
        //     $results = $this->db->resultSet();
        //     return $results;
        // }

        //get university id by using the university name from the database
        public function getCategoryIdByName($categoryName){
            $this->db->query('SELECT id FROM categories WHERE category_name = :name');

            $this->db->bind(':name' , $categoryName);

            $row = $this->db->single();

            if ($row) {
                return $row->id;
            } else {
                return null; // or another default value depending on your logic
            }
        }
    }
?>