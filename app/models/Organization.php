<?php
class Organization
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getOrganizations()
    {
        $this->db->query('SELECT * FROM organizations;');
        $results = $this->db->resultSet();
        // var_dump($results);
        // die();
        return $results;
    }

    public function getOrganizationById($organization_id)
    {
        $this->db->query('SELECT o.*,
        u_table.name AS university_name,
        GROUP_CONCAT(DISTINCT oc.category_name) AS category_names,
        GROUP_CONCAT(DISTINCT of.follower_id) AS organization_followers
        FROM organizations o
        LEFT JOIN organization_category_mapping ocm ON o.organization_id = ocm.organization_id
        LEFT JOIN universities u_table ON o.university = u_table.id 
        LEFT JOIN organization_categories oc ON ocm.organization_category_id = oc.category_id
        LEFT JOIN organization_followers of ON o.organization_id =of.organization_id
        WHERE o.organization_id= :organization_id');

        $this->db->bind(':organization_id', $organization_id);

        $row = $this->db->single();
        return $row;
    }

    public function addOrganization($data)
    {
        // var_dump($data);
        // die();

        $this->db->query("INSERT INTO organizations ( 
        user_id,
        organization_name,
        short_caption,
        description, 
        university, 
        website_url,
        contact_email,
        facebook,
        instagram, 
        linkedin,
        organization_profile_image,
        organization_cover_image,
        board_members_image,
        number_of_members ) VALUES(:user_id, :organization_name, :short_caption, :description, :university, :website_url, :contact_email, :facebook, :instagram, :linkedin, :organization_profile_image, :organization_cover_image, :board_members_image, :number_of_members)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':organization_name', $data['organization_name']);
        $this->db->bind(':short_caption', $data['short_caption']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':university', $data['university']);
        $this->db->bind(':website_url', $data['website_url']);
        $this->db->bind(':contact_email', $data['contact_email']);
        $this->db->bind(':facebook', $data['facebook']);
        $this->db->bind(':instagram', $data['instagram']);
        $this->db->bind(':linkedin', $data['linkedin']);
        $this->db->bind(':organization_profile_image', $data['organization_profile_image']);
        $this->db->bind(':organization_cover_image', $data['organization_cover_image']);
        $this->db->bind(':board_members_image', $data['board_members_image']);
        $this->db->bind(':number_of_members', $data['number_of_members']);



        // Begin the transaction
        $this->db->beginTransaction();

        // Execute the first query
        if (!$this->db->execute()) {
            // Rollback the transaction if there's an error
            $this->db->rollBack();
            return false;
        }

        // Get the last inserted event ID
        $organizationId = $this->db->lastInsertId();

        // Loop through each category ID and insert into the events_categories table
        foreach ($data['categories'] as $category_id) {
            // Insert into the event_categories table
            $this->db->query("INSERT INTO organization_category_mapping (organization_id, organization_category_id) VALUES (:organization_id, :organization_category_id)");

            // Bind values
            $this->db->bind(':organization_id', $organizationId);
            $this->db->bind(':organization_category_id', $category_id);

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

    public function getOrganizationCategories()
    {
        $this->db->query('SELECT * FROM organization_categories');

        $rows = $this->db->resultSet();

        return $rows;
    }

    public function getOrganizationsBySearch($data)
    {
        $keyword = $data['keyword'];
        $university = trim($data['university']);
        $categories = isset($data['categories']) ? $data['categories'] : [];


        // Create a placeholder for each category
        $categoryPlaceholders = implode(',', array_fill(0, count($categories), '?'));

        $query = 'SELECT 
                    o.*,
                    u_table.name AS university_name,
                    GROUP_CONCAT(oc.category_name) AS category_names
                    FROM organizations o
                    LEFT JOIN organization_category_mapping ocm ON o.organization_id = ocm.organization_id
                    LEFT JOIN universities u_table ON o.university = u_table.id 
                    LEFT JOIN organization_categories oc ON ocm.organization_category_id = oc.category_id
                    WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND o.organization_name LIKE :keyword";
        }

        if (!empty($university)) {
            $query .= " AND u_table.name = :university";
        }

        if (!empty($categories)) {
            // Add conditions for the selected categories
            $query .= " AND oc.category_name IN ($categoryPlaceholders)";
        }

        $query .= " GROUP BY o.organization_id";

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
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

    public function getActivitiesByOrganizationId($organizationId)
    {
        $this->db->query('SELECT * FROM organization_activities WHERE organization_id = :organization_id');
        $this->db->bind(':organization_id', $organizationId);
        // Execute the query
        $this->db->execute();

        // Fetch the results
        $row = $this->db->resultSet();
        return $row;
    }

    public function getNewsByOrganizationId($organizationId){
        $this->db->query('SELECT * FROM organization_news WHERE organization_id = :organization_id');
        $this->db->bind(':organization_id', $organizationId);
        // Execute the query
        $this->db->execute();

        // Fetch the results
        $row = $this->db->resultSet();
        return $row;
    }

    public function addActivity($data)
    {
        $this->db->query('INSERT INTO organization_activities (organization_id, activity_title, activity_description, activity_image) 
        VALUES (:organization_id, :activity_title, :activity_description, :activity_image)');
        $this->db->bind(':organization_id', $data['organization_id']);
        $this->db->bind(':activity_title', $data['activity_title']);
        $this->db->bind(':activity_description', $data['activity_description']);
        $this->db->bind(':activity_image', $data['activity_image']);
        return $this->db->execute();
    }

    public function addNews($data)
    {
        $this->db->query('INSERT INTO organization_news (organization_id, news_title, news_text, sharing_option) 
        VALUES (:organization_id, :news_title, :news_text, :sharing_option)');
        $this->db->bind(':organization_id', $data['organization_id']);
        $this->db->bind('news_title', $data['news_title']);
        $this->db->bind(':news_text', $data['news_text']);
        $this->db->bind(':sharing_option', $data['sharing_option']);
        return $this->db->execute();
    }

    public function checkUserOrganizationFollow($data)
    {
        $this->db->query("SELECT * FROM organization_followers WHERE follower_id = :follower_id AND organization_id = :organization_id");
        $this->db->bind(':follower_id', $data['followerId']);
        $this->db->bind(':organization_id', $data['organizationId']);

        $this->db->single(); // Assuming you have a method like this to fetch a single row

        return $this->db->rowCount() > 0;
    }

    public function addUserOrganizationFollow($data)
    {
        $this->db->query("INSERT INTO organization_followers (follower_id, organization_id) VALUES(:follower_id, :organization_id)");
        $this->db->bind(':follower_id', $data['followerId']);
        $this->db->bind(':organization_id', $data['organizationId']);

        if ($this->db->execute()) {
            return true;
        }
    }

    public function deleteUserOrganizationFollow($data)
    {
        $this->db->query("DELETE FROM organization_followers WHERE follower_id = :follower_id AND organization_id = :organization_id");
        $this->db->bind(':follower_id', $data['followerId']);
        $this->db->bind(':organization_id', $data['organizationId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }




}