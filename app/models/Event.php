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
    
 }