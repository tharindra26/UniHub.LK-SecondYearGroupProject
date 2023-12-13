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
        $this->db->query("INSERT INTO events (user_id, title, type, description, date, location, event_card_image, event_cover_image) VALUES(:user_id, :title, :type, :description, :date, :location, :event_card_image, :event_cover_image)");
        //Bind values
        $this->db->bind(':user_id' , $_SESSION['user_id']);
        $this->db->bind(':title' ,  $data['event_title']);
        $this->db->bind(':type' ,  $data['event_type']);
        $this->db->bind(':description' ,  $data['description']);
        $this->db->bind(':date' ,  $data['date']);
        $this->db->bind(':location' ,  $data['location']);
        $this->db->bind(':event_card_image' ,  $data['event_card_image']);
        $this->db->bind(':event_cover_image' ,  $data['event_cover_image']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateEvent($data){
        $this->db->query("UPDATE events SET title = :title, type = :type, description = :description, date = :date, location = :location, event_card_image = :event_card_image, event_cover_image= :event_cover_image WHERE id= :id");
        //Bind values
        $this->db->bind(':id' ,  $data['id']);
        $this->db->bind(':title' , $data['event_title']);
        $this->db->bind(':type' ,  $data['event_type']);
        $this->db->bind(':description' ,  $data['description']);
        $this->db->bind(':date' ,  $data['date']);
        $this->db->bind(':location' ,  $data['location']);
        $this->db->bind(':event_card_image' ,  $data['event_card_image']);
        $this->db->bind(':event_cover_image' ,  $data['event_cover_image']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteEvent($id){
        $this->db->query("DELETE FROM events WHERE id = :id");
        //Bind values
        $this->db->bind(':id' ,  $id);
        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getEventById($id){
        $this->db->query('SELECT * FROM events WHERE id = :id');
        $this->db->bind(':id' , $id);

        $row= $this->db->single();

        return $row;

    }

    public function getEventsBySearch($data){
        $keyword = $data['keyword'];
        $date = $data['date'];
        $university = trim($data['university']);
        $categories = isset($data['categories']) ? $data['categories'] : [];

        // Create a placeholder for each category
        $categoryPlaceholders = implode(',', array_fill(0, count($categories), '?'));
    
        $query = 'SELECT DISTINCT e.*
                  FROM events e
                  INNER JOIN users u ON e.user_id = u.id
                  LEFT JOIN events_categories ec ON e.id = ec.event_id
                  LEFT JOIN categories c ON ec.category_id = c.id
                  WHERE 1=1';
    
        if (!empty($keyword)) {
            $query .= " AND e.title LIKE '%$keyword%'";
        }
    
        if (!empty($date)) {
            $formattedDate = date('Y-m-d', strtotime($date));
            $query .= " AND DATE(e.start_datetime) = '$formattedDate'";
        }
    
        if (!empty($categories)) {
            // Add conditions for the selected categories
            $query .= " AND c.category_name IN ($categoryPlaceholders)";
        }
    
        // Prepare and execute the query with bound values
        $this->db->query($query);
    
        // Bind values to the placeholders
        foreach ($categories as $key => $category) {
            $this->db->bind(($key + 1), $category);
        }
    
        // Execute the query
        $this->db->execute();
    
        // Fetch the results
        $row = $this->db->resultSet();
        return $row;

        // var_dump($categories);
        // die();

        
        // if (empty($keyword) && empty($date) && empty($university)) {
        //     $this->db->query('SELECT * FROM events;');
        //     $row = $this->db->resultSet();
        //     return $row;
        // } elseif (!empty($keyword) && empty($date) && empty($university)) {
        //     $this->db->query("SELECT * FROM events WHERE title LIKE '%$keyword%';");
        //     $row = $this->db->resultSet();
        //     return $row;
        // } elseif (empty($keyword) && !empty($date) && empty($university)) {
        //     $formattedDate = date('Y-m-d', strtotime($date));
        //     $this->db->query("SELECT * FROM events WHERE DATE(start_datetime) = '$formattedDate';");
        //     $row = $this->db->resultSet();
        //     return $row;
        // } elseif (empty($keyword) && empty($date) && !empty($university)) {
        //     $this->db->query("SELECT * FROM events WHERE university = '$university';");
        //     $row = $this->db->resultSet();
        //     return $row;
        // } elseif (!empty($keyword) && !empty($date) && empty($university)) {
        //     $formattedDate = date('Y-m-d', strtotime($date));
        //     $this->db->query("SELECT * FROM events WHERE title LIKE '%$keyword%' AND DATE(start_datetime) = '$formattedDate';");
        //     $row = $this->db->resultSet();
        //     return $row;
        // } elseif (!empty($keyword) && empty($date) && !empty($university)) {
        //     $this->db->query("SELECT * FROM events WHERE title LIKE '%$keyword%' AND university = '$university';");
        //     $row = $this->db->resultSet();
        //     return $row;
        // } elseif (empty($keyword) && !empty($date) && !empty($university)) {
        //     $formattedDate = date('Y-m-d', strtotime($date));
        //     $this->db->query("SELECT * FROM events WHERE DATE(start_datetime) = '$formattedDate' AND university = '$university';");
        //     $row = $this->db->resultSet();
        //     return $row;
        // } else {
        //     $formattedDate = date('Y-m-d', strtotime($date));
        //     $this->db->query("SELECT * FROM events WHERE title LIKE '%$keyword%' AND DATE(start_datetime) = '$formattedDate' AND university = '$university';");
        //     $row = $this->db->resultSet();
        //     return $row;
        // }
    }
    
 }