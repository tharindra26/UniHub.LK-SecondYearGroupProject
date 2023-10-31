<?php
 class Organization{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getOrganizations(){
        $this->db->query('SELECT *,
                        organizations.id AS organizationId,
                        users.id AS userId
                        FROM organizations
                        INNER JOIN users
                        ON organizations.user_id = users.id
                        ORDER BY organizations.created_at DESC
                    ');
        $results= $this->db->resultSet();
        // var_dump($results);
        return $results;
    }

    public function addOrganization($data){
        $this->db->query("INSERT INTO organizations (user_id, name, university, description, link, organization_card_image, organization_cover_image) VALUES(:user_id, :name, :university, :description, :link, :organization_card_image, :organization_cover_image)");
        //Bind values
        $this->db->bind(':user_id' , $_SESSION['user_id']);
        $this->db->bind(':name' ,  $data['name']);
        $this->db->bind(':university' ,  $data['university']);
        $this->db->bind(':description' ,  $data['description']);
        $this->db->bind(':link' ,  $data['link']);
        $this->db->bind(':organization_card_image' ,  $data['organization_card_image']);
        $this->db->bind(':organization_cover_image' ,  $data['organization_cover_image']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateOrganization($data){
        $this->db->query("UPDATE organizations SET name = :name, university = :university, description = :description, link = :link, organization_card_image = :organization_card_image, organization_cover_image= :organization_cover_image WHERE id= :id");
        //Bind values
        $this->db->bind(':id' ,  $data['id']);
        $this->db->bind(':name' , $data['name']);
        $this->db->bind(':university' ,  $data['university']);
        $this->db->bind(':description' ,  $data['description']);
        $this->db->bind(':link' ,  $data['link']);
        $this->db->bind(':organization_card_image' ,  $data['organization_card_image']);
        $this->db->bind(':organization_cover_image' ,  $data['organization_cover_image']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteOrganization($id){
        $this->db->query("DELETE FROM organizations WHERE id = :id");
        //Bind values
        $this->db->bind(':id' ,  $id);
        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getOrganizationById($id){
        $this->db->query('SELECT * FROM organizations WHERE id = :id');
        $this->db->bind(':id' , $id);

        $row= $this->db->single();

        return $row;

    }
    
    public function getOrganizationByUserId($id){
        $this->db->query('SELECT * FROM organizations WHERE user_id = :id');
        $this->db->bind(':id' , $id);

        $row= $this->db->single();

        return $row;

    }
    
 }