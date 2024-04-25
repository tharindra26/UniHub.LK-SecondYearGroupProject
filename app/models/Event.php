<?php
class Event
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllEvents()
    {
        $this->db->query('SELECT events.*,
                        GROUP_CONCAT(categories.category_name) AS category_names
                        FROM events
                        INNER JOIN events_categories
                        ON events_categories.event_id = events.id
                        LEFT JOIN categories 
                        ON categories.id = events_categories.category_id
                        WHERE 1=1
                        GROUP BY events.id
                        ORDER BY events.created_at DESC
                        ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function addEventView($eventId) {
        $this->db->query('INSERT INTO event_views (event_id) VALUES (:eventId)');
        $this->db->bind(':eventId', $eventId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEventsCount() {
        $this->db->query('SELECT COUNT(*) AS event_count FROM events');
        $row = $this->db->single();
        return $row->event_count;
    }

    public function getEvents()
    {
        $this->db->query('SELECT *,
                        events.id AS eventId,
                        users.id AS userId
                        FROM events
                        INNER JOIN users
                        ON events.user_id = users.id
                        ORDER BY events.created_at DESC
                    ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function addEvent($data)
    {
        // var_dump($data['category_ids']);
        // die();
        $this->db->query("INSERT INTO events (
        user_id, 
        title,
        event_profile_image,
        event_cover_image, 
        start_datetime, 
        end_datetime, 
        university_id, 
        venue, 
        organized_by, 
        email, 
        contact_number, 
        web,
        linkedin,
        facebook,
        instagram,
        description, 
        map_navigation, 
        approval, 
        status, 
        main_button_action, 
        main_button_link, 
        countdown_text, 
        countdown_datetime) VALUES(:user_id, :title,:event_profile_image, :event_cover_image, :start_datetime, :end_datetime, :university_id, :venue, :organized_by, :email, :contact_number, :web, :linkedin, :facebook, :instagram, :description, :map_navigation, :approval, :status, :main_button_action, :main_button_link, :countdown_text, :countdown_datetime)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':event_profile_image', $data['event_profile_image']);
        $this->db->bind(':event_cover_image', $data['event_cover_image']);
        $this->db->bind(':start_datetime', $data['start_datetime']);
        $this->db->bind(':end_datetime', $data['end_datetime']);
        $this->db->bind(':university_id', $data['university_id']);
        $this->db->bind(':venue', $data['venue']);
        $this->db->bind(':organized_by', $data['organized_by']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':web', $data['web']);
        $this->db->bind(':linkedin', $data['linkedin']);
        $this->db->bind(':facebook', $data['facebook']);
        $this->db->bind(':instagram', $data['instagram']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':map_navigation', $data['map_navigation']);
        $this->db->bind(':approval', 1);
        $this->db->bind(':status', 1);
        $this->db->bind(':main_button_action', 'Hang with Us');
        $this->db->bind(':main_button_link', '#');
        $this->db->bind(':countdown_text', 'Get Ready! Event Begins:');
        $this->db->bind(':countdown_datetime', $data['start_datetime']);


        // Begin the transaction
        $this->db->beginTransaction();

        // Execute the first query
        if (!$this->db->execute()) {
            // Rollback the transaction if there's an error
            $this->db->rollBack();
            return false;
        }

        // Get the last inserted event ID
        $eventId = $this->db->lastInsertId();

        // Loop through each category ID and insert into the events_categories table
        foreach ($data['category_ids'] as $category_id) {
            // Insert into the event_categories table
            $this->db->query("INSERT INTO events_categories (event_id, category_id) VALUES (:event_id, :category_id)");

            // Bind values
            $this->db->bind(':event_id', $eventId);
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

    public function updateEvent($data)
    {
        $this->db->query("UPDATE events SET title = :title, type = :type, description = :description, date = :date, location = :location, event_card_image = :event_card_image, event_cover_image= :event_cover_image WHERE id= :id");
        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['event_title']);
        $this->db->bind(':type', $data['event_type']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':event_card_image', $data['event_card_image']);
        $this->db->bind(':event_cover_image', $data['event_cover_image']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvent($id)
    {
        $this->db->query("DELETE FROM events WHERE id = :id");
        //Bind values
        $this->db->bind(':id', $id);
        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function DeactivateEvent($data){
        $this->db->query("UPDATE events SET status = :status  WHERE id= :id");
        //Bind values
        $this->db->bind(':id', $data['event_id']);
        $this->db->bind('status', 0);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function activateEvent($data){
        $this->db->query("UPDATE events SET status = :status  WHERE id= :id");
        //Bind values
        $this->db->bind(':id', $data['event_id']);
        $this->db->bind('status', 1);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEventById($id) 
    {
        $this->db->query(
            'SELECT events.*
            FROM events 
            WHERE id = :id'
        );

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;

    }

    public function getAnnouncementsByEventId($event_id)
    {
        $this->db->query('SELECT * FROM event_announcements WHERE event_id = :event_id');
        $this->db->bind(':event_id', $event_id);

        $announcements = $this->db->resultSet();

        return $announcements;
    }

    public function getEventsByApprovalType($data){
        $this->db->query('SELECT e.*,
                        GROUP_CONCAT(c.category_name) AS category_names
                        FROM events e
                        LEFT JOIN events_categories ec ON e.id = ec.event_id
                        LEFT JOIN universities u_table ON e.university_id = u_table.id 
                        LEFT JOIN categories c ON ec.category_id = c.id 
                        WHERE e.approval = :approval
                        GROUP BY e.id');
        
        $this->db->bind(':approval', $data);

        $this->db->execute();

        $results = $this->db->resultSet();
        return $results;
    }


    public function getActiveEvents(){
        $this->db->query('SELECT e.*,
                        GROUP_CONCAT(c.category_name) AS category_names
                        FROM events e
                        LEFT JOIN events_categories ec ON e.id = ec.event_id
                        LEFT JOIN universities u_table ON e.university_id = u_table.id 
                        LEFT JOIN categories c ON ec.category_id = c.id 
                        WHERE e.status = :status
                        GROUP BY e.id');
        
        $this->db->bind(':status', 1);

        $this->db->execute();

        $results = $this->db->resultSet();
        return $results;
    }

    public function getDeactivedEvents(){
        $this->db->query('SELECT e.*,
                        GROUP_CONCAT(c.category_name) AS category_names
                        FROM events e
                        LEFT JOIN events_categories ec ON e.id = ec.event_id
                        LEFT JOIN universities u_table ON e.university_id = u_table.id 
                        LEFT JOIN categories c ON ec.category_id = c.id 
                        WHERE e.status = :status
                        GROUP BY e.id');
        
        $this->db->bind(':status', 0);

        $this->db->execute();

        $results = $this->db->resultSet();
        return $results;
    }

    public function totalEventCount(){
        $this->db->query('SELECT COUNT(*) AS total_events FROM events;');

        $row = $this->db->single();

        return $row;
    }

    public function ongoingCount(){
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->query('SELECT COUNT(*) AS ongoing_events 
                        FROM events
                        WHERE end_datetime >= :current_datetime;');

        $this->db->bind(':current_datetime', $currentDateTime );

        $row = $this->db->single();

        return $row;
    }

    public function dueCount(){
        $currentDateTime = date('Y-m-d H:i:s');
        $this->db->query('SELECT COUNT(*) AS due_events 
                        FROM events
                        WHERE end_datetime < :current_datetime
                        AND start_datetime < :current_datetime;');
        
        $this->db->bind(':current_datetime', $currentDateTime );

        $row = $this->db->single();

        return $row;
    }
    
    
    public function getOngoingEvents(){
        $currentDateTime = date('Y-m-d H:i:s');

        $this->db->query('SELECT e.*,
                        GROUP_CONCAT(c.category_name) AS category_names
                        FROM events e
                        LEFT JOIN events_categories ec ON e.id = ec.event_id
                        LEFT JOIN universities u_table ON e.university_id = u_table.id 
                        LEFT JOIN categories c ON ec.category_id = c.id 
                        WHERE e.end_datetime >= :current_datetime
                        GROUP BY e.id');
        
        $this->db->bind(':current_datetime', $currentDateTime );

        $this->db->execute();

        $results = $this->db->resultSet();
        return $results;
    }

    public function getDueEvents(){
        $currentDateTime = date('Y-m-d H:i:s');

        $this->db->query('SELECT e.*,
                        GROUP_CONCAT(c.category_name) AS category_names
                        FROM events e
                        LEFT JOIN events_categories ec ON e.id = ec.event_id
                        LEFT JOIN universities u_table ON e.university_id = u_table.id 
                        LEFT JOIN categories c ON ec.category_id = c.id 
                        WHERE e.end_datetime < :current_datetime
                        AND e.start_datetime < :current_datetime
                        GROUP BY e.id');
        
        $this->db->bind(':current_datetime', $currentDateTime );

        $this->db->execute();

        $results = $this->db->resultSet();
        return $results;
    }
    public function getEventsBySearch($data)
    {
        $keyword = $data['keyword'];
        $date = $data['date'];
        $university = trim($data['university']);
        $categories = isset($data['categories']) ? $data['categories'] : [];

        // Create a placeholder for each category
        $categoryPlaceholders = implode(',', array_fill(0, count($categories), '?'));

        $query = 'SELECT 
                    e.*,
                    GROUP_CONCAT(c.category_name) AS category_names
                    FROM events e
                    INNER JOIN users u ON e.user_id = u.id
                    LEFT JOIN events_categories ec ON e.id = ec.event_id
                    LEFT JOIN universities u_table ON e.university_id = u_table.id 
                    LEFT JOIN categories c ON ec.category_id = c.id
                    WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND e.title LIKE :keyword";
        }

        if (!empty($date)) {
            $formattedDate = date('Y-m-d', strtotime($date));
            $query .= " AND DATE(e.start_datetime) = :formattedDate";
        }

        if (!empty($university)) {
            $query .= " AND u_table.name = :university";
        }

        if (!empty($categories)) {
            // Add conditions for the selected categories
            $query .= " AND c.category_name IN ($categoryPlaceholders)";
        }

        $query .= " GROUP BY e.id";

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        if (!empty($date)) {
            $this->db->bind(':formattedDate', $formattedDate);
        }

        if (!empty($university)) {
            $this->db->bind(':university', $university);
        }

        foreach ($categories as $key => $category) {
            $this->db->bind(($key + 1), $category);
        }

        // Execute the query
        $this->db->execute();

        // Fetch the results
        $row = $this->db->resultSet();
        return $row;



    }

    public function getFilterEvents($data)
    {
        $keyword = $data['keyword'];
        $university = $data['university'];
        $approval = $data['approval'];
        $status = $data['status'];

        $query = 'SELECT 
                    e.*,
                    GROUP_CONCAT(c.category_name) AS category_names
                    FROM events e
                    INNER JOIN users u ON e.user_id = u.id
                    LEFT JOIN events_categories ec ON e.id = ec.event_id
                    LEFT JOIN universities u_table ON e.university_id = u_table.id 
                    LEFT JOIN categories c ON ec.category_id = c.id
                    WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND e.title LIKE :keyword";
        }

        if (!empty($university)) {
            $query .= " AND u_table.id = :uni_id";
        }

        if (!empty($approval)) {
            $query .= " AND e.approval = :approval";
        }

        if (!empty($status)) {
            $query .= " AND e.status = :status";
        }

        $query .= " GROUP BY e.id";

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        if (!empty($university)) {
            $this->db->bind(':uni_id', $university);
        }

        if (!empty($approval)) {
            $this->db->bind(':approval', $approval);
        }

        if (!empty($status)) {
            if($status == 'activated')
                $this->db->bind(':status', 1);
            elseif($status == 'deactivated'){
                $this->db->bind(':status', 0);
            }
        }
        
        // Execute the query
        $this->db->execute();

        // Fetch the results
        $row = $this->db->resultSet();
        return $row;



    }



    public function getEventsByShortcut($data) //$_POST
    {
        $shortcut = $data['value'];

        if ($shortcut == 'all') {
            $this->db->query('SELECT events.*,
            GROUP_CONCAT(categories.category_name) AS category_names 
            FROM events
            JOIN events_categories ON events.id = events_categories.event_id
            JOIN categories ON events_categories.category_id = categories.id
            GROUP BY events.id');
        } else {
            $this->db->query('SELECT events.*,
                        GROUP_CONCAT(categories.category_name) AS category_names
                         FROM events
                         JOIN events_categories ON events.id = events_categories.event_id
                         JOIN categories ON events_categories.category_id = categories.id
                         WHERE categories.category_name = :category
                         GROUP BY events.id');
            $this->db->bind(':category', $shortcut);
        }

        $this->db->execute();
        $rows = $this->db->resultSet();
        return $rows;
    }


    public function addUserInterest($data)
    {
        $this->db->query("INSERT INTO event_participation (user_id, event_id, participation_status) VALUES(:user_id, :event_id, :participation_status)");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':participation_status', 'interested');

        if ($this->db->execute()) {
            return true;
        }
    }

    public function deleteUserInterest($data)
    {
        $this->db->query("DELETE FROM event_participation WHERE user_id = :user_id AND event_id = :event_id");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':event_id', $data['event_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Viruli
    public function getEventByUser($user)
    {
        $this->db->query('SELECT * FROM events WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user);

        $row = $this->db->resultSet();

        return $row;
    }

    public function getInterestEventsByUser($user)
    {
        $this->db->query('SELECT events.* 
                        FROM event_participation
                        JOIN events
                        ON events.id = event_participation.event_id
                        WHERE event_participation.participation_status = :participation_status
                        AND event_participation.user_id = :user_id
                        ORDER BY event_participation.participation_id 
                        LIMIT 3');
        $this->db->bind(':user_id', $user);
        $this->db->bind(':participation_status', "interested");

        $row = $this->db->resultSet();

        return $row;
    }

    public function getGoingEventsByUser($user)
    {
        $this->db->query('SELECT events.* 
                        FROM event_participation
                        JOIN events
                        ON events.id = event_participation.event_id
                        WHERE event_participation.participation_status = "going" 
                        AND event_participation.user_id = :user_id
                        ORDER BY event_participation.participation_id 
                        LIMIT 3');
        $this->db->bind(':user_id', $user);

        $row = $this->db->resultSet();

        return $row;
    }


    public function checkUserInterest($data)
    {
        $this->db->query("SELECT * FROM event_participation WHERE user_id = :user_id AND event_id = :event_id");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':event_id', $data['event_id']);

        $this->db->single(); // Assuming you have a method like this to fetch a single row

        return $this->db->rowCount() > 0;
    }

    public function addAnnouncement($data)
    {

        $this->db->query('INSERT INTO event_announcements (user_id, event_id, announcement_text, announcement_date,sharingOption, status) 
                          VALUES (:user_id, :event_id, :announcement_text, current_timestamp(),:sharingOption, :status)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':announcement_text', $data['announcement']);
        $this->db->bind(':sharingOption', $data['sharingOption']);
        $this->db->bind(':status', 1);


        return $this->db->execute();

    }

    public function getEventCategories()
    {
        $this->db->query('SELECT * FROM categories');

        $rows = $this->db->resultSet();

        return $rows;
    }

    public function updateContactDetails($data)
    {
        $this->db->query("UPDATE events SET
                    organized_by = :organized_by,
                    contact_number = :contact_number,
                    web = :web,
                    linkedin = :linkedin,
                    facebook = :facebook,
                    instagram = :instagram
                    WHERE id = :id");

        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':organized_by', $data['organized_by']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':web', $data['web']);
        $this->db->bind(':linkedin', $data['linkedin']);
        $this->db->bind(':facebook', $data['facebook']);
        $this->db->bind(':instagram', $data['instagram']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function updatePlacementDetails($data)
    {
        $this->db->query("UPDATE events SET
                    venue = :venue,
                    map_navigation = :map_navigation,
                    start_datetime = :start_datetime,
                    end_datetime = :end_datetime
                    WHERE id = :id
                    ");

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':venue', $data['venue']);
        $this->db->bind(':map_navigation', $data['map_navigation']);
        $this->db->bind(':start_datetime', $data['start_datetime']);
        $this->db->bind(':end_datetime', $data['end_datetime']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDescription($data)
    {

        $this->db->query("UPDATE events SET
                    description = :description
                    WHERE id = :id
                    ");

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':description', $data['description']);


        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCountdown($data)
    {
        $this->db->query("UPDATE events SET
                    main_button_action = :main_button_action,
                    main_button_link = :main_button_link,
                    countdown_text = :countdown_text,
                    countdown_datetime = :countdown_datetime
                    WHERE id = :id");

        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':main_button_action', $data['main_button_action']);
        $this->db->bind(':main_button_link', $data['main_button_link']);
        $this->db->bind(':countdown_text', $data['countdown_text']);
        $this->db->bind(':countdown_datetime', $data['countdown_datetime']);
        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function addReview($data)
    {
        // Check if there is already a review for this user and event
        $this->db->query("SELECT * FROM events_reviews WHERE user_id = :user_id AND event_id = :event_id");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':event_id', $data['event_id']);
        $existingReview = $this->db->single();

        // If there is an existing review, delete it
        if ($existingReview) {
            $this->db->query("DELETE FROM events_reviews WHERE user_id = :user_id AND event_id = :event_id");
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':event_id', $data['event_id']);
            $this->db->execute();
        }

        // Add the new review
        $this->db->query("INSERT INTO events_reviews (user_id, event_id, rating, comment) VALUES (:user_id, :event_id, :rating, :comment)");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':comment', $data['comment']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getReviewsByEventId($event_id)
    {
        $this->db->query("SELECT er.*, u.* FROM events_reviews er 
        INNER JOIN users u ON er.user_id = u.id 
        WHERE er.event_id = :event_id");

        $this->db->bind(':event_id', $event_id);

        $reviews = $this->db->resultSet();

        return $reviews;
    }

    public function updateEventProfileImage($data)
    {

        // var_dump($data);
        // die();
        $this->db->query("UPDATE events SET
                event_profile_image = :event_profile_image,
                event_cover_image = :event_cover_image
                WHERE id = :id");

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':event_profile_image', $data['event_profile_image']);
        $this->db->bind(':event_cover_image', $data['event_cover_image']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEventCategoriesByEventId($event_id)
    {
        $this->db->query("SELECT *
        FROM events_categories ec
        JOIN categories c ON ec.category_id = c.id
        WHERE ec.event_id = :event_id;");

        $this->db->bind(':event_id', $event_id);

        $rows = $this->db->resultSet();

        return $rows;
    }

    public function deleteCategoryByEventIdCategoryId($data)
    {
        $this->db->query("DELETE FROM events_categories WHERE event_id = :event_id AND category_id = :category_id");
        $this->db->bind(':event_id', $data['event_id']);
        $this->db->bind(':category_id', $data['category_id']);
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addEventCategory($data)
    {
        $this->db->query("INSERT INTO events_categories (event_id, category_id) VALUES (:event_id, :category_id)");

        // Bind the values
        $this->db->bind(':event_id', $data['eventId']);
        $this->db->bind(':category_id', $data['categoryId']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAnnouncementById($announcement_id)
    {
        $this->db->query("DELETE FROM event_announcements WHERE announcement_id = :announcement_id");
        $this->db->bind(':announcement_id', $announcement_id);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAnnouncementById($data)
    {
        $this->db->query("UPDATE event_announcements SET announcement_text = :announcement_text WHERE announcement_id = :announcement_id");
        $this->db->bind(':announcement_id', $data['announcementId']);
        $this->db->bind(':announcement_text', $data['announcementText']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkStatusByEventId($eventId){
        $this->db->query("SELECT status FROM events WHERE id = :eventId");
        $this->db->bind(':eventId', $eventId);

        $row = $this->db->single();
        return $row->status;
    }

    public function activateEventById($eventId){
        $this->db->query("UPDATE events SET status = 1 WHERE id = :eventId");
        $this->db->bind(':eventId', $eventId);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deactivateEventById($eventId){
        $this->db->query("UPDATE events SET status = 0 WHERE id = :eventId");
        $this->db->bind(':eventId', $eventId);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changeApproval($data){
        $this->db->query("UPDATE events SET approval = :approval WHERE id = :eventId");
        $this->db->bind(':eventId', $data['eventId']);
        $this->db->bind(':approval', $data['selectedApproval']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}