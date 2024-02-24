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
        // var_dump($data);
        // die();

        $this->db->query("INSERT INTO posts ( 
        user_id,
        title,
        description,
        post_profile_image, 
        material_link ) VALUES(:user_id, :title, :description, :post_profile_image, :material_link)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':post_profile_image', $data['post_profile_image']);
        $this->db->bind(':material_link', $data['material_link']);
        


              // Begin the transaction
              $this->db->beginTransaction();

              // Execute the first query
              if (!$this->db->execute()) {
                  // Rollback the transaction if there's an error
                  $this->db->rollBack();
                  return false;
              }
      
              // Get the last inserted event ID
              $postId = $this->db->lastInsertId();
      
              // Loop through each category ID and insert into the events_categories table
              foreach ($data['category_ids'] as $category_id) {
                  // Insert into the event_categories table
                  $this->db->query("INSERT INTO post_categories_mapping (post_id, category_id) VALUES (:post_id, :category_id)");
      
                  // Bind values
                  $this->db->bind(':post_id', $postId);
                  $this->db->bind(':category_id', $category_id);
      
                  // Execute the query
                  if (!$this->db->execute()) {
                      // Rollback the transaction if there's an error
                      $this->db->rollBack();
                      return false;
                  }
              }
      
      
              // Commit the transaction if everything is successful
              $this->db->commit();
              return true;

    }

    public function getCategoryIdByName($categoryName){
        $this->db->query('SELECT category_id FROM post_categories WHERE category_name = :name');

        $this->db->bind(':name' , $categoryName);

        $row = $this->db->single();

        if ($row) {
            return $row->category_id;
        } else {
            return null; // or another default value depending on your logic
        }
    }

}