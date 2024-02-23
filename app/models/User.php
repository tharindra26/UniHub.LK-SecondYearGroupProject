<?php
class User{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //Register the user
    public function register($data){

        $this->db->query("INSERT INTO users (email,type,password,status,verification_code,fname,lname,dob,university_id,contact_number,description,profile_image,cover_image) VALUES(:email,:type,:password,:status,:verification_code,:fname,:lname,:dob,:university_id,:contact_number,:description,:profile_image,:cover_image)");
        //Bind values
        $this->db->bind(':email' , $data['email']);
        $this->db->bind(':type' , "Undergraduate");
        $this->db->bind(':password' ,  $data['password']);
        $this->db->bind(':status' ,  false);
        $this->db->bind(':verification_code' ,  $data['verification_code']);
        $this->db->bind(':fname' ,  $data['fname']);
        $this->db->bind(':lname' ,  $data['lname']);
        $this->db->bind(':dob' ,  $data['dob']);
        $this->db->bind(':university_id' ,  $data['university_id']);
        $this->db->bind(':contact_number' ,  "0000000000");
        $this->db->bind(':description' ,  "default_description");
        $this->db->bind(':profile_image' ,  "default_profile_image.jpg");
        $this->db->bind(':cover_image' ,  "default_cover_image.jpg");
  

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Login User
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
  
        $row = $this->db->single();
  
        $hashed_password = $row->password;
        if(password_verify($password, $hashed_password)){ //password ekai hashpassword ekai same da balanawa
          return $row; 
        } else {
          return false;
        }
    }

    public function addLoginRecord($id) {
        // Get the user's IP address
        $userIP = $_SERVER['REMOTE_ADDR'];
    
        // Prepare and execute the SQL query
        $this->db->query("INSERT INTO login_details (user_id, login_ip) VALUES (:user_id, :login_ip)");
        
        // Bind values
        $this->db->bind(':user_id', $id);
        $this->db->bind(':login_ip', $userIP);
      
        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function addUser($data){
        $this->db->query("INSERT INTO users (name, user_type, email, password) VALUES(:name, :user_type, :email, :password)");
        //Bind values
        $this->db->bind(':name' , $data['name']);
        $this->db->bind(':user_type' , $data['user_type']);
        $this->db->bind(':email' ,  $data['email']);
        $this->db->bind(':password' ,  $data['password']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateUser($data){
        $this->db->query("UPDATE users SET name = :name, user_type = :user_type, email = :email, password = :password WHERE id= :id");
        //Bind values
        $this->db->bind(':id' , $data['id']);
        $this->db->bind(':name' , $data['name']);
        $this->db->bind(':user_type' , $data['user_type']);
        $this->db->bind(':email' ,  $data['email']);
        $this->db->bind(':password' ,  $data['password']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function getUsers(){
        $this->db->query('SELECT * FROM users');
        $results= $this->db->resultSet();
        return $results;
    }

    //Find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email' , $email);

        $row = $this->db->single();

        //check row
        if($this->db->rowCount()>0){
            return true;
        }else {
            return false;
        }
    }

    //Find user by id
    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id = :id');

        $this->db->bind(':id' , $id);

        $row = $this->db->single();
        
        return $row;
    }

    // Check user status by email
    public function getUserStatusByEmail($email) {
        $this->db->query('SELECT status FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            return $row->status;
        } else {
            return null; // or another default value depending on your logic
        }
    }

    //get user by verification code
    public function getUserByVerificationCode($code){
        $this->db->query('SELECT * FROM users WHERE verification_code = :verification_code');

        $this->db->bind(':verification_code' , $code);

        $row = $this->db->execute();
        $rowCount =$this->db->rowCount();
        
        return $result=[
            'row' => $row,
            'rowCount' => $rowCount,
            
        ];
    }

    public function deleteUser($id){
        $this->db->query("DELETE FROM users WHERE id = :id");
        //Bind values
        $this->db->bind(':id' ,  $id);
        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function activateUser($verificationCode){
        $this->db->query("UPDATE users SET status = :status, verification_code = :new_verification_code WHERE verification_code= :verification_code");
        //Bind values
        $this->db->bind(':status' , true);
        $this->db->bind(':new_verification_code' , NULL);
        $this->db->bind(':verification_code' , $verificationCode);
    
        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getEducationByUserId($user_id){
        $this->db->query('SELECT * FROM user_education 
                        WHERE user_id = :user_id
                        AND status = :status');

        $this->db->bind(':user_id' , $user_id);
        $this->db->bind(':status' , 1);

        $row = $this->db->resultSet();
        
        return $row;
    }

    public function getEducationById($education_id){
        $this->db->query('SELECT * FROM user_education 
                        WHERE education_id = :education_id
                        AND status = :status');

        $this->db->bind(':education_id' , $education_id);
        $this->db->bind(':status' , 1);

        $row = $this->db->single();
        
        return $row;
    }

    public function getQualificationByUserId($user_id){
        $this->db->query('SELECT * FROM user_qualifications WHERE user_id = :user_id');

        $this->db->bind(':user_id' , $user_id);

        $row = $this->db->resultSet();
        
        return $row;
    }

    public function getSkillsByUserId($user_id){
        $this->db->query('SELECT * FROM user_skills WHERE user_id = :user_id');

        $this->db->bind(':user_id' , $user_id);

        $row = $this->db->resultSet();
        
        return $row;
    }
    
    public function getFriendsByUserId($user_id){
        $this->db->query('SELECT *
        FROM users u1
        JOIN followers
        ON u1.id = followers.follower_id
        -- JOIN users u2
        -- ON u2.id = followers.following_id
        WHERE 
        -- followers.follower_id = :user_id
        -- OR followers.following_id = :user_id
        followers.request_status = :status');
        
        // $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', "accepted");

        $row = $this->db->resultSet();

        return $row;
    }

    public function getUsersByType($data){
        $type = $data['value'];

        if ($type == 'all') {
            $this->db->query('SELECT *
                            FROM users');
        } else {
            $this->db->query('SELECT *
                            FROM users
                            WHERE type = :type');
            $this->db->bind(':type', $type);
        }

        $this->db->execute();
        $rows = $this->db->resultSet();
        return $rows;
    }

    
//     public function filterUsers($data)
//     {
//         $keyword = $data['keyword'];
//         //$date = $data['date'];
//         //$university = trim($data['university']);

//         $query = 'SELECT *
//                     FROM users 
//                     WHERE 1=1';

//         if (!empty($keyword)) {
//             $query .= " AND email LIKE :keyword
//                         OR type LIKE :keyword
//                         OR fname LIKE :keyword
//                         OR lname LIKE :keyword";

//         }

//         // if (!empty($date)) {
//         //     $formattedDate = date('Y-m-d', strtotime($date));
//         //     $query .= " AND DATE(e.start_datetime) = :formattedDate";
//         // }

//         // if (!empty($university)) {
//         //     $query .= " AND u_table.name = :university";
//         // }


//         // Prepare the query
//         $this->db->query($query);

//         // Bind values to the placeholders
//         if (!empty($keyword)) {
//             $this->db->bind(':keyword', '%' . $keyword . '%');
//         }

//         // if (!empty($date)) {
//         //     $this->db->bind(':formattedDate', $formattedDate);
//         // }

//         // if (!empty($university)) {
//         //     $this->db->bind(':university', $university);
//         // }


//         // Execute the query
//         $this->db->execute();

//         // Fetch the results
//         $row = $this->db->resultSet();
//         return $row;

// }

    public function getRecentlyLoggedInUsers(){
        $this->db->query('SELECT * FROM users
                        JOIN (
                        SELECT user_id, MAX(login_time) AS last_login_time
                        FROM login_details
                        GROUP BY user_id
                        ) AS latest_logins
                        ON users.id = latest_logins.user_id
                        ORDER BY latest_logins.last_login_time DESC
                        LIMIT 10');
        $this->db->execute();
        $rows = $this->db->resultSet();
        return $rows;
    }

    public function DeactivateAccount($data){
        $this->db->query("UPDATE users SET status = :status  WHERE id= :id");
            //Bind values
            $this->db->bind(':id', $data['user_id']);
            $this->db->bind('status', 0);
    
            //Execute the query
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
    }

    public function ActivateAccount($data){
        $this->db->query("UPDATE users SET status = :status  WHERE id= :id");
            //Bind values
            $this->db->bind(':id', $data['user_id']);
            $this->db->bind('status', 1);
    
            //Execute the query
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
    }

    public function checkStatusByID($data){
        $this->db->query('SELECT status FROM users WHERE id = :di');
        $this->db->bind(':id', $data['user_id']);
        $this->db->execute();
        $row = $this->db->single();
        return $row;
    }

    // public function filterUsers($data) {
    //     $keyword = '%' . $data['keyword'] . '%'; // Preparing the keyword for a partial match
    
    //     $query = 'SELECT *
    //               FROM users
    //               WHERE email LIKE :keyword
    //                  OR type LIKE :keyword
    //                  OR fname LIKE :keyword
    //                  OR lname LIKE :keyword';
    
    //     $this->db->query($query);
    //     $this->db->bind(':keyword', $keyword);
    //     $this->db->execute();
    //     $rows = $this->db->resultSet();
    
    //     return $rows;
    // }

    public function updateContactDetails($data){
        $this->db->query("UPDATE users SET
                    contact_number = :contact_number,
                    web = :web,
                    linkedin = :linkedin
                    WHERE id = :id");

        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':web', $data['web']);
        $this->db->bind(':linkedin', $data['linkedin']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function updateDescription($data){
        $this->db->query("UPDATE users SET
                        profile_title = :profile_title,
                        description = :description
                        WHERE id = :id");
        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':profile_title', $data['profile_title']);
        $this->db->bind(':description', $data['description']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateEducation($data){
        $this->db->query("UPDATE user_education SET
                        institution = :institution,
                        description = :description,
                        start_year = :start_year,
                        end_year = :end_year
                        WHERE education_id = :education_id");
        //Bind values
        $this->db->bind(':education_id', $data['education_id']);
        $this->db->bind(':institution', $data['institution']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':start_year', $data['start_year']);
        $this->db->bind(':end_year', $data['end_year']);

        //Execute the query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteEducation($data){
        $this->db->query("UPDATE user_education SET status = :status  WHERE education_id= :education_id");
            //Bind values
            $this->db->bind(':education_id', $data['education_id']);
            $this->db->bind('status', 0);
    
            //Execute the query
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
    }
    
}