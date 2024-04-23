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

    public function getAllOrganizations(){
        $this->db->query('SELECT 
                        o.*,
                        u_table.name AS university_name,
                        GROUP_CONCAT(oc.category_name) AS category_names
                        FROM organizations o
                        LEFT JOIN organization_category_mapping ocm ON o.organization_id = ocm.organization_id
                        LEFT JOIN universities u_table ON o.university = u_table.id 
                        LEFT JOIN organization_categories oc ON ocm.organization_category_id = oc.category_id
                        GROUP BY o.organization_id');
            $results = $this->db->resultSet();
            return $results;
      }

    public function getOrganizationById($organization_id)
    {
        $this->db->query('SELECT * 
        FROM organizations o
        LEFT JOIN organization_category_mapping ocm ON o.organization_id = ocm.organization_id
        LEFT JOIN universities u_table ON o.university = u_table.id 
        LEFT JOIN organization_categories oc ON ocm.organization_category_id = oc.category_id
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

    public function getActivitiesByOrganizationId($organizationId){
        $this->db->query('SELECT * FROM organization_activities WHERE organization_id = :organization_id');
        $this->db->bind(':organization_id', $organizationId);
        $row = $this->db->single();
        return $row;
    }

    public function totalOrganizationCount(){
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

        $query = 'SELECT 
                    o.*,
                    GROUP_CONCAT(c.category_name) AS category_names
                    FROM organizations o
                    INNER JOIN users u ON o.user_id = u.id
                    LEFT JOIN organization_category_mapping m ON o.organization_id = m.organization_id
                    -- LEFT JOIN universities u_table ON e.university_id = u_table.id 
                    LEFT JOIN organization_categories c ON m.organization_category_id = c.category_id
                    WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND o.organization_name LIKE :keyword";
        }

        if (!empty($university)) {
            //$query .= " AND u_table.id = :uni_id";
            $query .= " AND o.university = :university"; 
        }

        if (!empty($category)) {
            $query .= " AND c.category_id = :category";
        }

        if (!empty($status)) {
            $query .= " AND o.status = :status";
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

        if (!empty($status)) {
            if($status == 'active')
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

}