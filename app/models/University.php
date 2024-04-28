<?php
class University
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //get all feilds from university table
    public function getUniversities()
    {
        $this->db->query('SELECT * FROM Universities');
        $results = $this->db->resultSet();
        return $results;
    }

    //get university id by using the university name from the database
    public function getUniIdByName($name)
    {
        $this->db->query('SELECT id FROM universities WHERE name = :name');

        $this->db->bind(':name', $name);

        $row = $this->db->single();

        if ($row) {
            return $row->id;
        } else {
            return null; // or another default value depending on your logic
        }
    }


    public function getUniversity()
    {
        $this->db->query('SELECT u.*, uni.* 
                              FROM users u 
                              JOIN universities uni 
                              ON u.university_id = uni.id 
                              WHERE u.id = 1
                            ');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getUniversityById($id)
    {
        $this->db->query('SELECT * FROM universities WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;

    }

    public function getTotalUniversities()
    {
        $this->db->query('SELECT COUNT(*) AS total_universities FROM universities');
        $this->db->execute();
        return $this->db->single()->total_universities;
    }

    public function getTotalDomains()
    {
        $this->db->query('SELECT COUNT(*) AS total_domains FROM university_domains');
        $this->db->execute();
        return $this->db->single()->total_domains;
    }

    public function getFilterUniversities($data)
    {
        $keyword = $data['keyword'];
        $query = 'SELECT 
                u.*
                FROM universities u
                WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND (u.name LIKE :keyword OR u.unicode LIKE :keyword)";
        }

        $this->db->query($query);

        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        $this->db->execute();

        $row = $this->db->resultSet();
        return $row;
    }

    public function getFilterDomains($data)
    {
        $keyword = $data['keyword'];
        $university = $data['university'];
        $query = 'SELECT 
                ud.*,
                u.name AS university_name
                FROM university_domains ud
                LEFT JOIN universities u ON u.id = ud.university_id
                WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND (u.name LIKE :keyword OR ud.domain LIKE :keyword)";
        }
        if (!empty($university)) {
            $query .= " AND ud.university_id = :university_id";
        }

        $this->db->query($query);

        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        if (!empty($university)) {
            $this->db->bind(':university_id', $university);
        }

        $this->db->execute();

        $row = $this->db->resultSet();
        return $row;
    }

    public function deleteUniversity($data){
        $this->db->query('DELETE FROM universities WHERE id = :id');
        $this->db->bind(':id', $data['universityId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteDomain($data){
        $this->db->query('DELETE FROM university_domains WHERE domain_id = :domain_id');
        $this->db->bind(':domain_id', $data['domainId']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addUniversity($data)
    {
        $logo = $data['unicode'] . '.jpg';

        $this->db->query('INSERT INTO universities (name, unicode, logo) VALUES (:name, :unicode, :logo)');

        // Bind the values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':unicode', $data['unicode']);
        $this->db->bind(':logo',$logo);

        
        if ($this->db->execute()) {
            return true; // Return true if the insertion is successful
        } else {
            return false; // Return false if there is an error
        }
    }

    public function addDomain($data)
    {
        $logo = $data['unicode'] . '.jpg';

        $this->db->query('INSERT INTO university_domains (university_id, domain) VALUES (:university_id, :domain)');

        // Bind the values
        $this->db->bind(':university_id', $data['universityId']);
        $this->db->bind(':domain', $data['domain']);

        
        if ($this->db->execute()) {
            return true; // Return true if the insertion is successful
        } else {
            return false; // Return false if there is an error
        }
    }

    public function getDomainsByUniId($universityId){
        $this->db->query('SELECT * FROM university_domains WHERE university_id = :university_id');
        $this->db->bind(':university_id', $universityId);
        $results = $this->db->resultSet();
        return $results;
    }

}

    
