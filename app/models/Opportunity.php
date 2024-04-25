<?php
class Opportunity
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addOpportunityView($opportunityId) {
        $this->db->query('INSERT INTO opportunity_views (opportunity_id) VALUES (:opportunityId)');
        $this->db->bind(':opportunityId', $opportunityId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOpportunitiesCount() {
        $this->db->query('SELECT COUNT(*) AS opportunity_count FROM opportunities');
        $row = $this->db->single();
        return $row->opportunity_count;
    }

    public function getOpportunityById($id)
    {
        $query = 'SELECT 
                o.*,
                GROUP_CONCAT(DISTINCT ot.tag) AS tags,
                GROUP_CONCAT(DISTINCT otp.title_position) AS title_positions
                FROM opportunities o
                LEFT JOIN opportunity_tags ot ON o.id = ot.opportunity_id
                LEFT JOIN opportunity_title_positions otp ON o.id = otp.opportunity_id
                WHERE o.id = :id';

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        $this->db->bind(':id', $id);

        // Execute the query
        $this->db->execute();

        // Fetch the result
        $opportunity = $this->db->single();
        return $opportunity;
    }



    public function addOpportunity($data)
    {
        // Insert opportunity into opportunities table
        $query = "INSERT INTO opportunities (
        opportunity_title,
        organization_name,
        contact_person,
        contact_email,
        contact_phone,
        opportunity_type,
        working_type,
        description,
        qualifications,
        additional_information,
        application_deadline,
        website_url,
        linkedin,
        opportunity_card_image,
        opportunity_cover_image,
        description_image
    ) VALUES (
        :opportunity_title,
        :organization_name,
        :contact_person,
        :contact_email,
        :contact_phone,
        :opportunity_type,
        :working_type,
        :description,
        :qualifications,
        :additional_information,
        :application_deadline,
        :website_url,
        :linkedin,
        :opportunity_card_image,
        :opportunity_cover_image,
        :description_image
    )";

        $this->db->query($query);

        // Bind parameters for the opportunities table
        $this->db->bind(':opportunity_title', $data['opportunity_title']);
        $this->db->bind(':organization_name', $data['organization_name']);
        $this->db->bind(':contact_person', $data['contact_person']);
        $this->db->bind(':contact_email', $data['contact_email']);
        $this->db->bind(':contact_phone', $data['contact_phone']);
        $this->db->bind(':opportunity_type', $data['opportunity_type']);
        $this->db->bind(':working_type', $data['working_type']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':qualifications', $data['qualifications']);
        $this->db->bind(':additional_information', $data['additional_information']);
        $this->db->bind(':application_deadline', $data['application_deadline']);
        $this->db->bind(':website_url', $data['website_url']);
        $this->db->bind(':linkedin', $data['linkedin']);
        $this->db->bind(':opportunity_card_image', $data['opportunity_card_image']);
        $this->db->bind(':opportunity_cover_image', $data['opportunity_cover_image']);
        $this->db->bind(':description_image', $data['description_image']);


        // Execute the query
        if (!$this->db->execute()) {
            return false; // Opportunity insertion failed
        }

        // Get the ID of the inserted opportunity
        $opportunity_id = $this->db->lastInsertId();

        // Process tags only if opportunity insertion was successful
        if (isset($opportunity_id)) {
            // Process tags
            $tags = explode(',', $data['tags']);
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags); // Remove empty elements

            foreach ($tags as $tag) {
                // Check if tag exists in tags table
                // $query = "SELECT id FROM tags WHERE name = :name";
                // $this->db->query($query);
                // $this->db->bind(':name', $tag);
                // $existing_tag = $this->db->single();

                // if (!$existing_tag) {
                //     // Tag does not exist, insert it
                //     $query = "INSERT INTO tags (name) VALUES (:name)";
                //     $this->db->query($query);
                //     $this->db->bind(':name', $tag);
                //     if (!$this->db->execute()) {
                //         // Failed to insert tag
                //         return false;
                //     }

                //     // Get the ID of the inserted tag
                //     $tag_id = $this->db->lastInsertId();
                // } else {
                //     // Tag exists, use its ID
                //     $tag_id = $existing_tag['id'];
                // }

                // Insert into opportunity_tags pivot table
                $query = "INSERT INTO opportunity_tags (opportunity_id, tag) VALUES (:opportunity_id, :tag)";
                $this->db->query($query);
                $this->db->bind(':opportunity_id', $opportunity_id);
                $this->db->bind(':tag', $tag);
                if (!$this->db->execute()) {
                    // Failed to insert into opportunity_tags pivot table
                    return false;
                }
            }

            // Process title positions
            $title_positions = explode(',', $data['title_positions']);
            $title_positions = array_map('trim', $title_positions);
            $title_positions = array_filter($title_positions); // Remove empty elements

            foreach ($title_positions as $title_position) {
                // Insert title position into title_positions table
                // $query = "INSERT INTO title_positions (position_name) VALUES (:position_name)";
                // $this->db->query($query);
                // $this->db->bind(':position_name', $title_position);
                // if (!$this->db->execute()) {
                //     // Failed to insert title position
                //     return false;
                // }

                // // Get the ID of the inserted title position
                // $title_position_id = $this->db->lastInsertId();

                // Insert into opportunity_title_positions pivot table
                $query = "INSERT INTO opportunity_title_positions (opportunity_id, title_position) VALUES (:opportunity_id, :title_position)";
                $this->db->query($query);
                $this->db->bind(':opportunity_id', $opportunity_id);
                $this->db->bind(':title_position', $title_position);
                if (!$this->db->execute()) {
                    // Failed to insert into opportunity_title_positions pivot table
                    return false;
                }
            }
        }

        return true; // Opportunity, tags, and title positions inserted successfully
    }


    public function searchOpportunitiesByKeyword($data)
    {
        $keyword = $data['keyword'];

        $query = 'SELECT 
                o.*,
                GROUP_CONCAT(DISTINCT ot.tag) AS tags,
                GROUP_CONCAT(DISTINCT otp.title_position) AS title_positions
                FROM opportunities o
                LEFT JOIN opportunity_tags ot ON o.id = ot.opportunity_id
                LEFT JOIN opportunity_title_positions otp ON o.id = otp.opportunity_id
                WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND o.opportunity_title LIKE :keyword";
        }

        // Group by opportunity id to aggregate tags and title positions
        $query .= " GROUP BY o.id";

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        // Execute the query
        $this->db->execute();

        // Fetch the results
        $opportunities = $this->db->resultSet();
        return $opportunities;
    }

    public function getOpportuntiesByShortcut($data) //$_POST
    {
        $category = $data['value'];

        $query = 'SELECT 
                o.*,
                GROUP_CONCAT(DISTINCT ot.tag) AS tags,
                GROUP_CONCAT(DISTINCT otp.title_position) AS title_positions
                FROM opportunities o
                LEFT JOIN opportunity_tags ot ON o.id = ot.opportunity_id
                LEFT JOIN opportunity_title_positions otp ON o.id = otp.opportunity_id
                WHERE 1=1';

        if ($category !== "All") {
            $query .= " AND o.opportunity_type = :category";
        }

        // Group by opportunity id to aggregate tags and title positions
        $query .= " GROUP BY o.id";

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if ($category !== "All") {
            $this->db->bind(':category', $category);
        }

        // Execute the query
        $this->db->execute();

        // Fetch the results
        $opportunities = $this->db->resultSet();
        return $opportunities;
    }

    public function checkUserOpportunityBookmark($data)
    {
        $this->db->query("SELECT * FROM opportunity_user_bookmark WHERE user_id = :user_id AND opportunity_id = :opportunity_id");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':opportunity_id', $data['opportunity_id']);

        $this->db->single(); // Assuming you have a method like this to fetch a single row

        return $this->db->rowCount() > 0;
    }

    public function addUserOpportunityBookmark($data)
    {
        $this->db->query("INSERT INTO opportunity_user_bookmark (user_id, opportunity_id) VALUES(:user_id, :opportunity_id)");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':opportunity_id', $data['opportunity_id']);

        if ($this->db->execute()) {
            return true;
        }
    }

    public function deleteUserOpportunityBookmark($data)
    {
        $this->db->query("DELETE FROM opportunity_user_bookmark WHERE user_id = :user_id AND opportunity_id = :opportunity_id");
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':opportunity_id', $data['opportunity_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateOpportunity($data)
    {
        // Update opportunity in opportunities table
        $query = "UPDATE opportunities SET
        opportunity_title = :opportunity_title,
        organization_name = :organization_name,
        contact_person = :contact_person,
        contact_email = :contact_email,
        contact_phone = :contact_phone,
        opportunity_type = :opportunity_type,
        working_type = :working_type,
        description = :description,
        qualifications = :qualifications,
        additional_information = :additional_information,
        application_deadline = :application_deadline,
        website_url = :website_url,
        linkedin = :linkedin,
        opportunity_card_image = :opportunity_card_image,
        opportunity_cover_image = :opportunity_cover_image,
        description_image = :description_image
    WHERE id = :id";

        $this->db->query($query);

        // Bind parameters for the opportunities table
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':opportunity_title', $data['opportunity_title']);
        $this->db->bind(':organization_name', $data['organization_name']);
        $this->db->bind(':contact_person', $data['contact_person']);
        $this->db->bind(':contact_email', $data['contact_email']);
        $this->db->bind(':contact_phone', $data['contact_phone']);
        $this->db->bind(':opportunity_type', $data['opportunity_type']);
        $this->db->bind(':working_type', $data['working_type']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':qualifications', $data['qualifications']);
        $this->db->bind(':additional_information', $data['additional_information']);
        $this->db->bind(':application_deadline', $data['application_deadline']);
        $this->db->bind(':website_url', $data['website_url']);
        $this->db->bind(':linkedin', $data['linkedin']);
        $this->db->bind(':opportunity_card_image', $data['opportunity_card_image']);
        $this->db->bind(':opportunity_cover_image', $data['opportunity_cover_image']);
        $this->db->bind(':description_image', $data['description_image']);

        // Execute the query
        if (!$this->db->execute()) {
            return false; // Opportunity update failed
        }

        // Delete existing tags and title positions associated with this opportunity
        $deleteTagsQuery = "DELETE FROM opportunity_tags WHERE opportunity_id = :id";
        $this->db->query($deleteTagsQuery);
        $this->db->bind(':id', $data['id']);
        $this->db->execute();

        $deleteTitlePositionsQuery = "DELETE FROM opportunity_title_positions WHERE opportunity_id = :id";
        $this->db->query($deleteTitlePositionsQuery);
        $this->db->bind(':id', $data['id']);
        $this->db->execute();

        // Process tags
        $tags = explode(',', $data['tags']);
        $tags = array_map('trim', $tags);
        $tags = array_filter($tags); // Remove empty elements

        foreach ($tags as $tag) {
            // Insert into opportunity_tags pivot table
            $insertTagQuery = "INSERT INTO opportunity_tags (opportunity_id, tag) VALUES (:opportunity_id, :tag)";
            $this->db->query($insertTagQuery);
            $this->db->bind(':opportunity_id', $data['id']);
            $this->db->bind(':tag', $tag);
            if (!$this->db->execute()) {
                // Failed to insert into opportunity_tags pivot table
                return false;
            }
        }

        // Process title positions
        $title_positions = explode(',', $data['title_positions']);
        $title_positions = array_map('trim', $title_positions);
        $title_positions = array_filter($title_positions); // Remove empty elements

        foreach ($title_positions as $title_position) {
            // Insert into opportunity_title_positions pivot table
            $insertTitlePositionQuery = "INSERT INTO opportunity_title_positions (opportunity_id, title_position) VALUES (:opportunity_id, :title_position)";
            $this->db->query($insertTitlePositionQuery);
            $this->db->bind(':opportunity_id', $data['id']);
            $this->db->bind(':title_position', $title_position);
            if (!$this->db->execute()) {
                // Failed to insert into opportunity_title_positions pivot table
                return false;
            }
        }

        return true; // Opportunity, tags, and title positions updated successfully
    }

    public function deleteOpportunityById($id)
    {
        $query = "DELETE FROM opportunities WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true; // Opportunity delete failed
        }else{
            return false; // Opportunity delete failed
        }
    }

    public function getFilterOpportunities($data)
    {
        $keyword = $data['keyword'];
        $opportunityType = $data['opportunityType'];
        $approval = $data['approval'];
        $status = $data['status'];

        $query = 'SELECT 
                    o.*,
                    GROUP_CONCAT(ot.tag) AS opportunity_tags,
                    GROUP_CONCAT(otp.title_position) AS title_positions
                    FROM opportunities o
                    LEFT JOIN opportunity_tags ot ON o.id = ot.opportunity_id
                    LEFT JOIN opportunity_title_positions otp ON o.id = otp.opportunity_id 
                    WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND o.opportunity_title LIKE :keyword";
        }

        if (!empty($opportunityType)) {
            $query .= " AND o.opportunity_type = :opportunity_type";
        }

        if (!empty($approval)) {
            $query .= " AND o.approval = :approval";
        }

        if (!empty($status)) {
            $query .= " AND o.status = :status";
        }

        $query .= " GROUP BY o.id";

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        if (!empty($opportunityType)) {
            $this->db->bind(':opportunity_type', $opportunityType);
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

    public function changeApproval($data){
        $this->db->query("UPDATE opportunities SET approval = :approval WHERE id = :id");
        $this->db->bind(':id', $data['opportunityId']);
        $this->db->bind(':approval', $data['selectedOpportunityApproval']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }





}