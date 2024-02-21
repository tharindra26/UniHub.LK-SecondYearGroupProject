<?php
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addPost($data)
    {
        var_dump($data);
        die();
        $this->db->query("INSERT INTO posts ( 
        user_id,
        title,
        description, 
        material_link, ) VALUES(:user_id, :title, :description, :material_link)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':material_link', $data['material_link']);
        


        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }


    }

}