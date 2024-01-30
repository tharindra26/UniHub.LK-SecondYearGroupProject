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
        $this->db->query('SELECT * FROM events
                        INNER JOIN events_categories
                        ON events_categories.event_id = events.id
                        INNER JOIN categories 
                        ON categories.id = events_categories.category_id
                        ORDER BY events.created_at DESC
                        ');
        $results = $this->db->resultSet();
        return $results;
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
        description, 
        map_navigation, 
        approval, 
        status, 
        main_button_action, 
        main_button_link, 
        countdown_text, 
        countdown_datetime) VALUES(:user_id, :title,:event_profile_image, :event_cover_image, :start_datetime, :end_datetime, :university_id, :venue, :organized_by, :email, :contact_number, :description, :map_navigation, :approval, :status, :main_button_action, :main_button_link, :countdown_text, :countdown_datetime)");
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

        // Insert into the event_categories table
        $this->db->query("INSERT INTO events_categories (event_id, category_id) VALUES (:event_id, :category_id)");

        // Bind values
        $this->db->bind(':event_id', $eventId);
        $this->db->bind(':category_id', $data['category_id']);

        // Execute the second query
        if (!$this->db->execute()) {
            // Rollback the transaction if there's an error
            $this->db->rollBack();
            return false;
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

    public function getEventById($id) //14
    {
        $this->db->query('SELECT * FROM events WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;

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
                        WHERE event_participation.participation_status = "interested" 
                        AND event_participation.user_id = :user_id;
        ');
        $this->db->bind(':user_id', $user);

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
                        AND event_participation.user_id = :user_id;
        ');
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


}