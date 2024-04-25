<?php
class Organization
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addOrganizationView($organizationId)
    {
        $this->db->query('INSERT INTO organization_views (organization_id) VALUES (:organizationId)');
        $this->db->bind(':organizationId', $organizationId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrganizationsCount()
    {
        $this->db->query('SELECT COUNT(*) AS organization_count FROM organizations');
        $row = $this->db->single();
        return $row->organization_count;
    }

    public function getOrganizations()
    {
        $this->db->query('SELECT * FROM organizations;');
        $results = $this->db->resultSet();
        // var_dump($results);
        // die();
        return $results;
    }

    public function getAllOrganizations()
    {
        $this->db->query('SELECT 
                        o.*,
                        -- u_table.name AS university_name,
                        GROUP_CONCAT(oc.category_name) AS category_names
                        FROM organizations o
                        LEFT JOIN organization_category_mapping ocm ON o.organization_id = ocm.organization_id
                        -- LEFT JOIN universities u_table ON o.university = u_table.id 
                        LEFT JOIN organization_categories oc ON ocm.organization_category_id = oc.category_id
                        GROUP BY o.organization_id');
        $results = $this->db->resultSet();
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
        LEFT JOIN universities u_table ON o.university_id = u_table.id 
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
        university_id, 
        contact_number, 
        website_url,
        contact_email,
        facebook,
        instagram, 
        linkedin,
        organization_profile_image,
        organization_cover_image,
        board_members_image,
        number_of_members ) VALUES(:user_id, :organization_name, :short_caption, :description, :university_id, :contact_number, :website_url, :contact_email, :facebook, :instagram, :linkedin, :organization_profile_image, :organization_cover_image, :board_members_image, :number_of_members)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':organization_name', $data['organization_name']);
        $this->db->bind(':short_caption', $data['short_caption']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':university_id', $data['university']);
        $this->db->bind(':contact_number', $data['contact_number']);
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
                    LEFT JOIN universities u_table ON o.university_id = u_table.id 
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

    public function totalOrganizationCount()
    {
        $this->db->query('SELECT COUNT(*) AS total_organizations FROM organizations;');

        $row = $this->db->single();

        return $row;
    }

    public function getFilterOrganizations($data)
    {
        $keyword = $data['keyword'];
        $university = $data['university'];
        $category = $data['category'];
        $status = $data['status'];
        $approval = $data['approval'];

        $query = 'SELECT 
                    o.*,
                    GROUP_CONCAT(c.category_name) AS category_names,
                    u_table.name AS university_name
                    FROM organizations o
                    INNER JOIN users u ON o.user_id = u.id
                    LEFT JOIN organization_category_mapping m ON o.organization_id = m.organization_id
                    LEFT JOIN universities u_table ON o.university_id = u_table.id 
                    LEFT JOIN organization_categories c ON m.organization_category_id = c.category_id
                    WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND o.organization_name LIKE :keyword";
        }

        if (!empty($university)) {
            //$query .= " AND u_table.id = :uni_id";
            $query .= " AND o.university_id = :university";
        }

        if (!empty($category)) {
            $query .= " AND c.category_id = :category";
        }

        if (!empty($status)) {
            $query .= " AND o.status = :status";
        }

        if (!empty($approval)) {
            $query .= " AND o.approval = :approval";
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

        if (!empty($category)) {
            $this->db->bind(':category', $category);
        }

        if (!empty($approval)) {
            $this->db->bind(':approval', $approval);
        }

        if (!empty($status)) {
            if ($status == 'active')
                $this->db->bind(':status', 1);
            elseif ($status == 'deactivated') {
                $this->db->bind(':status', 0);
            }
        }

        // Execute the query
        $this->db->execute();

        // Fetch the results
        $row = $this->db->resultSet();
        return $row;
    }
    public function getActivityByActivityId($activityId)
    {
        $this->db->query('SELECT * FROM organization_activities WHERE activity_id = :activity_id');

        $this->db->bind(':activity_id', $activityId);

        // Execute the query
        $row = $this->db->single();

        // Check if there is a post with the given ID
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return null; // Post not found
        }
    }

    public function getNewsByNewsId($newsId)
    {
        $this->db->query('SELECT * FROM organization_news WHERE news_id = :news_id');

        $this->db->bind(':news_id', $newsId);

        // Execute the query
        $row = $this->db->single();

        // Check if there is a post with the given ID
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return null; // Post not found
        }
    }

    public function getNewsByOrganizationId($organizationId)
    {
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

    public function updateActivity($data)
    {
        $this->db->query("UPDATE organization_activities SET activity_title = :activity_title, activity_description = :activity_description, activity_image = :activity_image WHERE activity_id = :activity_id");
        $this->db->bind(':activity_id', $data['activity_id']);
        $this->db->bind(':activity_title', $data['activity_title']);
        $this->db->bind(':activity_description', $data['activity_description']);
        $this->db->bind(':activity_image', $data['activity_image']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
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

    public function updateNews($data)
    {
        $this->db->query("UPDATE organization_news SET news_title = :news_title, news_text = :news_text, sharing_option = :sharing_option WHERE news_id = :news_id");
        $this->db->bind(':news_id', $data['news_id']);
        $this->db->bind(':news_title', $data['news_title']);
        $this->db->bind(':news_text', $data['news_text']);
        $this->db->bind(':sharing_option', $data['sharing_option']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
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

    public function updateGeneralDetails($data)
    {
        $this->db->query("UPDATE organizations SET organization_name = :organization_name, short_caption = :short_caption, description = :description, university = :university, contact_number= :contact_number, number_of_members = :number_of_members WHERE organization_id = :organization_id");
        $this->db->bind(':organization_id', $data['organization_id']);
        $this->db->bind(':organization_name', $data['organization_name']);
        $this->db->bind(':short_caption', $data['short_caption']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':university', $data['university']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':number_of_members', $data['number_of_members']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProfileImage($data)
    {
        $this->db->query("UPDATE organizations SET organization_profile_image = :organization_profile_image, organization_cover_image = :organization_cover_image, board_members_image = :board_members_image WHERE organization_id = :organization_id");
        $this->db->bind(':organization_id', $data['organization_id']);
        $this->db->bind(':organization_profile_image', $data['organization_profile_image']);
        $this->db->bind(':organization_cover_image', $data['organization_cover_image']);
        $this->db->bind(':board_members_image', $data['board_members_image']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSocialMedia($data)
    {
        $this->db->query("UPDATE organizations SET website_url = :website_url, facebook = :facebook, instagram = :instagram, linkedin= :linkedin WHERE organization_id = :organization_id");
        $this->db->bind(':organization_id', $data['organization_id']);
        $this->db->bind(':website_url', $data['website_url']);
        $this->db->bind(':facebook', $data['facebook']);
        $this->db->bind(':instagram', $data['instagram']);
        $this->db->bind(':linkedin', $data['linkedin']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrganizationCategoriesById($organizationId)
    {
        $this->db->query("SELECT ocm.*,
        oc.category_name AS category_name,
        ocm.id AS category_record_id
        FROM organization_category_mapping ocm
        LEFT JOIN organization_categories oc ON ocm.organization_category_id = oc.category_id
        WHERE ocm.organization_id = :organization_id"
        );

        $this->db->bind(':organization_id', $organizationId);

        // Execute the query
        $this->db->execute();

        // Fetch the result set
        $categories = $this->db->resultSet();

        return $categories;
    }

    public function addOrganizationCategory($data)
    {
        $query = 'INSERT INTO organization_category_mapping (organization_id, organization_category_id) VALUES (:organization_id, :organization_category_id)';

        // Bind the parameters
        $this->db->query($query);
        $this->db->bind(':organization_id', $data['organizationId']);
        $this->db->bind(':organization_category_id', $data['categoryId']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteOrganizationCategory($data)
    {
        $query = 'DELETE FROM organization_category_mapping WHERE id = :id';

        // Bind the parameter
        $this->db->query($query);
        $this->db->bind(':id', $data['categoryId']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrganizationStatusById($organizationId)
    {
        $this->db->query("SELECT status FROM organizations WHERE organization_id = :organization_id");
        $this->db->bind(':organization_id', $organizationId);

        $result = $this->db->single(); // Assuming you have a method like this to fetch a single row

        if ($result) {
            return $result->status;
        } else {
            return null; // Return null if the organization with the given ID is not found
        }
    }

    public function deactivateOrganizationById($organizationId)
    {

        $this->db->query("UPDATE organizations SET status = 0 WHERE organization_id = :organization_id");
        $this->db->bind(':organization_id', $organizationId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function activateOrganizationById($organizationId)
    {

        $this->db->query("UPDATE organizations SET status = 1 WHERE organization_id = :organization_id");
        $this->db->bind(':organization_id', $organizationId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function deleteActivityByActivityId($data)
    {
        $this->db->query("UPDATE organization_activities SET status = 0 WHERE activity_id = :activity_id");
        $this->db->bind(':activity_id', $data['activityId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteNewsByNewsId($data)
    {
        $this->db->query("UPDATE organization_news SET status = 0 WHERE news_id = :news_id");
        $this->db->bind(':news_id', $data['newsId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changeApproval($data)
    {
        $this->db->query("UPDATE organizations SET approval = :approval WHERE organization_id = :organization_id");
        $this->db->bind(':organization_id', $data['organizationId']);
        $this->db->bind(':approval', $data['selectedOrganizationApproval']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkOrganizationExist($email){
        $this->db->query("SELECT * FROM organizations WHERE contact_email = :contact_email");
        $this->db->bind(':contact_email', $email);

        $row = $this->db->single();

        //check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

}