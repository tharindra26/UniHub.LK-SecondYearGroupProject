<?php
class Stat
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLoginCountsLast30Days()
    {
        // Get the date 30 days ago from today
        $thirtyDaysAgo = date('Y-m-d', strtotime('-30 days'));

        // Query to get the login counts for each day in the last 30 days
        $query = "SELECT DATE(login_time) AS login_date, COUNT(*) AS login_count
              FROM login_details
              WHERE login_time >= :thirtyDaysAgo
              GROUP BY DATE(login_time)
              ORDER BY login_date";

        // Prepare the query
        $this->db->query($query);

        // Bind the parameter
        $this->db->bind(':thirtyDaysAgo', $thirtyDaysAgo);

        // Execute the query
        $this->db->execute();

        // Fetch all rows
        $results = $this->db->resultSet();

        // Create an associative array to hold the login counts for each day
        $loginCounts = [];
        foreach ($results as $row) {
            $loginCounts[$row->login_date] = $row->login_count;
        }

        // Fill in missing days with 0 login counts
        $startDate = new DateTime('-30 days');
        $endDate = new DateTime();
        $interval = new DateInterval('P1D'); // 1 day interval
        $period = new DatePeriod($startDate, $interval, $endDate);
        $formattedResults = [];
        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $formattedResults[$formattedDate] = isset($loginCounts[$formattedDate]) ? $loginCounts[$formattedDate] : 0;
        }

        // Return the formatted results
        return $formattedResults;
    }

    public function getUsersByUniversity() {
        $query = "SELECT ut.name, COUNT(u.id) AS user_count
                  FROM users u
                  INNER JOIN universities ut ON u.university_id = ut.id
                  GROUP BY u.university_id";
    
        $this->db->query($query);
        $results = $this->db->resultSet();
    
        return $results;
    }


}
