<?php
 class Event{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getEvents(){
        $this->db->query('SELECT *,
                        events.id AS eventId,
                        users.id AS userId
                        FROM events
                        INNER JOIN users
                        ON events.user_id = users.id
                        ORDER BY events.created_at DESC
                    ');
        $results= $this->db->resultSet();
        return $results;
    }

    public function addEvent($data){
        $this->db->query("INSERT INTO events (user_id, title, type, description, date, location, event_card_image) VALUES(:user_id, :title, :type, :description, :date, :location, :event_card_image)");
        //Bind values
        $this->db->bind(':user_id' , $_SESSION['user_id']);
        $this->db->bind(':title' ,  $data['event_title']);
        $this->db->bind(':type' ,  $data['event_type']);
        $this->db->bind(':description' ,  $data['description']);
        $this->db->bind(':date' ,  $data['date']);
        $this->db->bind(':location' ,  $data['location']);
        $this->db->bind(':event_card_image' ,  $data['event_card_image']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    
 }