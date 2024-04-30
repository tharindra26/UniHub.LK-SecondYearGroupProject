<?php
class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addUserView($userId)
    {
        $this->db->query('INSERT INTO user_views (user_id) VALUES (:userId)');
        $this->db->bind(':userId', $userId);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUsersCount()
    {
        $this->db->query('SELECT COUNT(*) AS user_count FROM users');
        $row = $this->db->single();
        return $row->user_count;
    }

    public function getNumberOfAllUsers()
    {
        $this->db->query('SELECT COUNT(*) AS total_users FROM users;');
        $row = $this->db->single();
        return $row->total_users;
    }

    public function getUserCountByType($type)
    {
        $this->db->query('SELECT COUNT(*) AS user_count FROM users WHERE type = :type');
        $this->db->bind(':type', $type);
        $row = $this->db->single();
        return $row->user_count;
    }

    //Register the user
    public function register($data)
    {

        $this->db->query("INSERT INTO users (email, secondary_email, type,password,status,verification_code,fname,lname,dob,university_id,contact_number,description,profile_image,cover_image) VALUES(:email, :secondary_email, :type,:password,:status,:verification_code,:fname,:lname,:dob,:university_id,:contact_number,:description,:profile_image,:cover_image)");
        //Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':secondary_email', $data['email']);
        $this->db->bind(':type', "undergraduate");
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':status', false);
        $this->db->bind(':verification_code', $data['verification_code']);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':university_id', $data['university_id']);
        $this->db->bind(':contact_number', "0704936553");
        $this->db->bind(':description', "default_description");
        $this->db->bind(':profile_image', "default_user_profile_image.jpg");
        $this->db->bind(':cover_image', "default_user_cover_image.jpg");


        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserByEmail($email)
    {
        $this->db->query('SELECT u.*, ua.last_authentication_date, ua.google_auth_required, ua.successfully_authenticated 
        FROM users u 
        LEFT JOIN user_authentication ua ON u.id = ua.user_id WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    public function updateVerificationCode($data){
        $this->db->query('UPDATE users SET verification_code = :verification_code WHERE email = :email');

         //Bind values
         $this->db->bind(':email', $data['email']);
        $this->db->bind(':verification_code', $data['verification_code']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function createAdmin($data)
    {
        $primaryUser = $this->getUserByEmail($data['secondaryEmail']);

        $this->db->query("INSERT INTO users (email,secondary_email,type,password,status,verification_code,fname,lname,dob,university_id,contact_number,description,profile_image,cover_image) VALUES(:email, :secondary_email, :type,:password,:status,:verification_code,:fname,:lname,:dob,:university_id,:contact_number,:description,:profile_image,:cover_image)");
        //Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':secondary_email', $data['secondaryEmail']);
        $this->db->bind(':type', "admin");
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':status', true);
        $this->db->bind(':verification_code', '');
        $this->db->bind(':fname', $primaryUser->fname);
        $this->db->bind(':lname', $primaryUser->lname);
        $this->db->bind(':dob', $primaryUser->dob);
        $this->db->bind(':university_id', $primaryUser->university_id);
        $this->db->bind(':contact_number', $primaryUser->contact_number);
        $this->db->bind(':description', $primaryUser->description);
        $this->db->bind(':profile_image', $primaryUser->profile_image);
        $this->db->bind(':cover_image', $primaryUser->cover_image);


        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function createUniRep($data)
    {
        $primaryUser = $this->getUserByEmail($data['secondaryEmail']);

        $this->db->query("INSERT INTO users (email,secondary_email,type,password,status,verification_code,fname,lname,dob,university_id,contact_number,description,profile_image,cover_image) VALUES(:email, :secondary_email, :type,:password,:status,:verification_code,:fname,:lname,:dob,:university_id,:contact_number,:description,:profile_image,:cover_image)");
        //Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':secondary_email', $data['secondaryEmail']);
        $this->db->bind(':type', "unirep");
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':status', true);
        $this->db->bind(':verification_code', '');
        $this->db->bind(':fname', $primaryUser->fname);
        $this->db->bind(':lname', $primaryUser->lname);
        $this->db->bind(':dob', $primaryUser->dob);
        $this->db->bind(':university_id', $primaryUser->university_id);
        $this->db->bind(':contact_number', $primaryUser->contact_number);
        $this->db->bind(':description', $primaryUser->description);
        $this->db->bind(':profile_image', $primaryUser->profile_image);
        $this->db->bind(':cover_image', $primaryUser->cover_image);


        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getOrganizationByEmail($email)
    {
        $this->db->query('SELECT * FROM organizations WHERE contact_email = :contact_email');
        $this->db->bind(':contact_email', $email);
        $row = $this->db->single();
        return $row;
    }

    public function creatOrgRep($data)
    {
        $organization = $this->getOrganizationByEmail($data['email']);
        $this->db->query("INSERT INTO users (email,secondary_email,type,password,status,verification_code,fname,lname,dob,university_id,contact_number,description,profile_image,cover_image) VALUES(:email, :secondary_email, :type,:password,:status,:verification_code,:fname,:lname,:dob,:university_id,:contact_number,:description,:profile_image,:cover_image)");
        //Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':secondary_email', $data['email']);
        $this->db->bind(':type', "orgrep");
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':status', true);
        $this->db->bind(':verification_code', '');
        $this->db->bind(':fname', $organization->organization_name);
        $this->db->bind(':lname', $organization->organization_name);
        $this->db->bind(':dob', '');
        $this->db->bind(':university_id', $organization->university_id);
        $this->db->bind(':contact_number', $organization->contact_email);
        $this->db->bind(':description', $organization->description);
        $this->db->bind(':profile_image', $organization->organization_profile_image);
        $this->db->bind(':cover_image', $organization->organization_cover_image);


        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT u.*, ua.last_authentication_date, ua.google_auth_required, ua.successfully_authenticated 
        FROM users u 
        LEFT JOIN user_authentication ua ON u.id = ua.user_id 
        WHERE u.email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) { //password ekai hashpassword ekai same da balanawa
            return $row;
        } else {
            return false;
        }
    }

    public function addLoginRecord($id)
    {
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


    public function addUser($data)
    {
        $this->db->query("INSERT INTO users (name, user_type, email, password) VALUES(:name, :user_type, :email, :password)");
        //Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':user_type', $data['user_type']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addUserAuthenticationRecord($user_id, $last_authentication_date)
    {
        $this->db->query("INSERT INTO user_authentication (user_id, last_authentication_date) VALUES (:user_id, :last_authentication_date)");
        // Bind values
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':last_authentication_date', $last_authentication_date);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateLastAuthenticationDate($user_id, $last_authentication_date)
    {
        $this->db->query("UPDATE user_authentication SET last_authentication_date = :last_authentication_date WHERE user_id = :user_id");
        // Bind values
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':last_authentication_date', $last_authentication_date);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function setGoogleAuthRequired($user_id, $google_auth_required)
    {
        $this->db->query("UPDATE user_authentication SET google_auth_required = :google_auth_required WHERE user_id = :user_id");
        // Bind values
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':google_auth_required', $google_auth_required);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSuccessfullyAuthenticated($user_id, $successfully_authenticated)
    {
        $this->db->query("UPDATE user_authentication SET successfully_authenticated = :successfully_authenticated WHERE user_id = :user_id");
        // Bind values
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':successfully_authenticated', $successfully_authenticated);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($data)
    {
        $this->db->query("UPDATE users SET name = :name, user_type = :user_type, email = :email, password = :password WHERE id= :id");
        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':user_type', $data['user_type']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function getUsers()
    {
        $this->db->query('SELECT * FROM users');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getAllUniversities()
    {
        $this->db->query('SELECT * FROM universities');
        $results = $this->db->resultSet();
        return $results;
    }

    //Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }



    public function getUserByName($name)
    {
        $names = explode(' ', $name);
        $fname = $names[0];
        $lname = $names[1];
        $this->db->query('SELECT id FROM users WHERE fname = :fname AND lname = :lname');
        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);

        $row = $this->db->single();

        //check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function SearchUserByName($name){
        $names = explode(' ', $name);
        $fname = $names[0];
        $lname = $names[1];
        $this->db->query('SELECT id FROM users WHERE fname = :fname AND lname = :lname AND type = :type');
        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':type', "undergraduate");

        $row = $this->db->single();

        //check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by id
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    // Check user status by email
    public function getUserStatusByEmail($email)
    {
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
    public function getUserByVerificationCode($code)
    {
        $this->db->query('SELECT * FROM users WHERE verification_code = :verification_code');

        $this->db->bind(':verification_code', $code);

        $row = $this->db->execute();
        $rowCount = $this->db->rowCount();
        $result = [
            'row' => $row,
            'rowCount' => $rowCount,

        ];

        return $result;
    }

    public function getUserByVerifyEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');

        $this->db->bind(':email', $email);

        $row = $this->db->execute();
        $rowCount = $this->db->rowCount();
        $result = [
            'row' => $row,
            'rowCount' => $rowCount,

        ];

        return $result;
    }

    public function deleteUser($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        //Bind values
        $this->db->bind(':id', $id);
        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function activateUser($verificationCode)
    {
        $this->db->query("UPDATE users SET status = :status, verification_code = :new_verification_code WHERE verification_code= :verification_code");
        //Bind values
        $this->db->bind(':status', true);
        $this->db->bind(':new_verification_code', NULL);
        $this->db->bind(':verification_code', $verificationCode);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCode($verificationCode)
    {
        $this->db->query("UPDATE users SET verification_code = :new_verification_code WHERE verification_code= :verification_code");
        //Bind values
        $this->db->bind(':new_verification_code', NULL);
        $this->db->bind(':verification_code', $verificationCode);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getAllInterestedEventsByUserId($user_id)
    {
        $this->db->query('SELECT e.*, event_participation.* 
                        FROM event_participation
                        INNER JOIN events e
                        ON e.id = event_participation.event_id
                        WHERE event_participation.participation_status = :participation_status 
                        AND event_participation.user_id = :user_id
                        ');

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':participation_status', "interested");

        $row = $this->db->resultSet();

        return $row;
    }


    public function RemoveInterestedEvent($data)
    {
        $this->db->query("DELETE FROM event_participation   
                        WHERE participation_id= :participation_id
                        AND participation_status = :participation_status");
        //Bind values
        $this->db->bind(':participation_id', $data['participation_id']);
        $this->db->bind(':participation_status', "interested");

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllLikedPostsByUserId($user_id)
    {
        $this->db->query('SELECT posts.* , post_likes.*
                        FROM posts
                        JOIN post_likes
                        ON posts.post_id = post_likes.post_id
                        WHERE post_likes.user_id = :user_id
                        ORDER BY post_likes.post_timestamp_liked DESC');

        $this->db->bind(':user_id', $user_id);

        $row = $this->db->resultSet();

        return $row;
    }

    public function RemoveLikedPosts($data)
    {
        $this->db->query("DELETE FROM post_likes   
                        WHERE post_like_id= :post_like_id");
        //Bind values
        $this->db->bind(':post_like_id', $data['post_like_id']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllFollowingOrganizationsByUserId($user_id)
    {
        $this->db->query('SELECT organizations.* , organization_followers.* , universities.name AS uni_name
                        FROM organizations
                        JOIN organization_followers
                        ON organizations.organization_id = organization_followers.organization_id
                        JOIN universities
                        ON universities.id = organizations.university_id
                        WHERE organization_followers.follower_id = :user_id');

        $this->db->bind(':user_id', $user_id);

        $row = $this->db->resultSet();

        return $row;
    }

    public function removeFollowingOrganization($data)
    {
        $this->db->query("DELETE FROM organization_followers   
                        WHERE id= :id");
        //Bind values
        $this->db->bind('id', $data['id']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getFriendsByUserId($user_id)
    {
        // First query: Fetching users followed by the given user
        $this->db->query('SELECT u2.*, f.follower_relationship_id, universities.name AS university_name
                        FROM users u1
                        JOIN user_followers f
                        ON u1.id = f.follower_id
                        JOIN users u2
                        ON u2.id = f.following_id
                        JOIN universities 
                        ON universities.id = u2.university_id
                        WHERE f.follower_id = :user_id
                        AND f.status = :status');

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', "accepted");

        $friendsYouFollow = $this->db->resultSet();

        // Second query: Fetching users that follow the given user
        $this->db->query('SELECT u1.*, f.follower_relationship_id,universities.name AS university_name
                        FROM users u1
                        JOIN user_followers f
                        ON u1.id = f.follower_id
                        JOIN universities 
                        ON universities.id = u1.university_id
                        JOIN users u2
                        ON u2.id = f.following_id
                        WHERE f.following_id = :user_id
                        AND f.status = :status');

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', "accepted");

        $friendsFollowingYou = $this->db->resultSet();

        // Combine the results from both queries
        // Depending on your needs, you might want to merge them or handle them separately
        $allFriends = array_merge($friendsYouFollow, $friendsFollowingYou);

        return $allFriends;
    }

    public function UnfollowFriend($data)
    {
        $this->db->query("DELETE FROM user_followers WHERE 	follower_relationship_id = :follower_relationship_id");
        //Bind values
        $this->db->bind(':follower_relationship_id', $data['follower_relationship_id']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkFriendStatus($data)
    {
        $this->db->query("SELECT *
                        FROM user_followers
                        WHERE (follower_id = :loggedin_user AND following_id = :user_id)
                        OR (follower_id = :user_id AND following_id = :loggedin_user)");

        //Bind Values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':loggedin_user', $data['loggedin_id']);

        $result = $this->db->single();
        return $result;
    }

    public function getFriendRequestsById($id)
    {
        //Fetching users that follow the given user
        $this->db->query('SELECT u1.*, f.follower_relationship_id,universities.name AS university_name
                FROM users u1
                JOIN user_followers f
                ON u1.id = f.follower_id
                JOIN universities 
                ON universities.id = u1.university_id
                JOIN users u2
                ON u2.id = f.following_id
                WHERE f.following_id = :user_id
                AND f.status = :status');

        $this->db->bind(':user_id', $id);
        $this->db->bind(':status', "pending");

        $rows = $this->db->resultSet();
        return $rows;

    }

    public function addFriend($data)
    {
        $this->db->query("INSERT INTO user_followers (
            follower_id, 
            following_id,
            status) VALUES(:follower_id, :following_id, :status) ");

        $this->db->bind(':follower_id', $data['follower_id']);
        $this->db->bind(':following_id', $data['following_id']);
        $this->db->bind(':status', "pending");

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function cancelRequest($data)
    {
        $this->db->query("DELETE FROM user_followers WHERE 	follower_id = :follower_id AND following_id = :following_id");

        $this->db->bind(':follower_id', $data['follower_id']);
        $this->db->bind(':following_id', $data['following_id']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function acceptRequestById($data)
    {
        $this->db->query("UPDATE user_followers 
                        SET status = :status
                        WHERE follower_relationship_id = :follower_relationship_id");
        //Bind values
        $this->db->bind(':follower_relationship_id', $data['follower_relationship_id']);
        $this->db->bind(':status', "accepted");

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEducationByUserId($user_id)
    {
        $this->db->query('SELECT * FROM user_education 
                        WHERE user_id = :user_id
                        AND status = :status');

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', 1);

        $row = $this->db->resultSet();

        return $row;
    }

    public function getEducationById($education_id)
    {
        $this->db->query('SELECT * FROM user_education 
                        WHERE education_id = :education_id
                        AND status = :status');

        $this->db->bind(':education_id', $education_id);
        $this->db->bind(':status', 1);

        $row = $this->db->single();

        return $row;
    }

    public function getQualificationByUserId($user_id)
    {
        $this->db->query('SELECT * FROM user_qualifications 
                        WHERE user_id = :user_id
                        AND status = :status');

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', 1);

        $row = $this->db->resultSet();

        return $row;
    }


    public function getQualificationById($qualification_id)
    {
        $this->db->query('SELECT * FROM user_qualifications 
                        WHERE qualification_id = :qualification_id
                        AND status = :status');

        $this->db->bind(':qualification_id', $qualification_id);
        $this->db->bind(':status', 1);

        $row = $this->db->single();

        return $row;
    }

    public function getSkillsByUserId($user_id)
    {
        $this->db->query('SELECT * FROM user_skills WHERE user_id = :user_id
                        AND status = :status');

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', 1);


        $row = $this->db->resultSet();

        return $row;
    }

    public function addSkill($data)
    {
        // Insert skill into the database
        $this->db->query('INSERT INTO user_skills (user_id, skill_name, proficiency_level) VALUES (:user_id, :skill_name, :proficiency_level)');
        // Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':skill_name', $data['skill_name']);
        $this->db->bind(':proficiency_level', $data['proficiency_level']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSkill($data)
    {
        $this->db->query("UPDATE user_skills SET status = :status  WHERE user_skill_id= :user_skill_id");
        //Bind values
        $this->db->bind(':user_skill_id', $data['user_skill_id']);
        $this->db->bind('status', 0);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function getOrganizationByUserId($user_id)
    {
        $this->db->query('SELECT user_organizations.*, universities.id AS uni_id, universities.name AS uni_name 
                        FROM user_organizations 
                        INNER JOIN universities 
                        ON universities.id = user_organizations.organization_university
                        WHERE user_id = :user_id
                        AND status = :status');

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':status', 1);

        $row = $this->db->resultSet();

        return $row;
    }

    public function getOrganizationById($id)
    {
        $this->db->query('SELECT user_organizations.*, 
        universities.name AS uni_name, 
        organizations.organization_name AS organization
 FROM user_organizations
 LEFT JOIN universities ON user_organizations.organization_university = universities.id
 LEFT JOIN organizations ON user_organizations.organization_id = organizations.organization_id
 WHERE user_organizations.id = :id
    OR user_organizations.status = :status');

        $this->db->bind(':id', $id);
        $this->db->bind(':status', 1);

        $row = $this->db->single();

        return $row;
    }

    // public function getAllOrganizations()
    // {
    //     $this->db->query('SELECT *  FROM organizations
    //                     WHERE status = :status');

    //     $this->db->bind(':status', 1);

    //     $row = $this->db->resultSet();

    //     return $row;
    // }

    public function getFollowingOrganizations($user_id)
    {
        $this->db->query('SELECT * FROM user_organizations 
                        INNER JOIN universities 
                        ON user_organizations.organization_university = universities.id
                        WHERE user_id = :user_id');

        $this->db->bind(':user_id', $user_id);

        $row = $this->db->resultSet();

        return $row;
    }

    public function addOrganization($data)
    {
        // var_dump($data['category_ids']);
        // die();
        $this->db->query("INSERT INTO user_organizations (
                        user_id,
                        organization_name, 
                        organization_university,
                        organization_id,
                        role,
                        start_date, 
                        end_date) VALUES(:user_id, :organization_name, :organization_university, :organization_id, :role, :start_date, :end_date)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':organization_name', $data['organization_name']);
        $this->db->bind(':organization_university', $data['organization_university']);
        $this->db->bind(':organization_id', $data['organization_id']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);

        // Begin the transaction
        $this->db->beginTransaction();

        // Execute the first query
        if (!$this->db->execute()) {
            // Rollback the transaction if there's an error
            $this->db->rollBack();
            return false;
        }

        // Commit the transaction if everything is successful
        $this->db->commit();
        return true;
    }

    public function updateOrganization($data)
    {
        $this->db->query("UPDATE user_organizations SET
                    organization_name = :organization_name,
                    organization_university = :organization_university,
                    organization_id = :organization_id,
                    role = :role,
                    start_date = :start_date,
                    end_date = :end_date
                    WHERE id = :id");
        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':organization_name', $data['organization_name']);
        $this->db->bind(':organization_university', $data['organization_university']);
        $this->db->bind(':organization_id', $data['organization_id']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPassword($id)
    {
        $this->db->query('SELECT password FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function passwordReset($data)
    {

        $new_password = password_hash($data['new_password'], PASSWORD_DEFAULT);
            // Update the user's password in the database
            $this->db->query("UPDATE users SET password = :password WHERE id = :id");
            $this->db->bind(':id', $data['user_id']);
            $this->db->bind(':password', $new_password);

            // Execute the query
            if ($this->db->execute()) {
                return true; // Password successfully updated
            } else {
                return false; // Failed to update password
            }
    }


    public function getUsersByType($data)
    {
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

    public function searchUsers($data)
    {
        $keyword = $data['keyword'];
        //$date = $data['date'];
        //$university = trim($data['university']);

        $query = 'SELECT *
                    FROM users 
                    WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND fname LIKE :keyword
                        OR lname LIKE :keyword";

        }

        // Prepare the query
        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }

        // Execute the query
        $this->db->execute();

        // Fetch the results
        $row = $this->db->resultSet();
        return $row;

    }

    public function filterUsers($data)
    {
        $keyword = $data['keyword'];
        $type = isset($data['type']) ? $data['type'] : null;
        $status = isset($data['status']) ? $data['status'] : null;
        $universityId = isset($data['universityId']) ? $data['universityId'] : null;



        $query = 'SELECT *
                    FROM users 
                    WHERE 1=1';

        if (!empty($keyword)) {
            $query .= " AND (email LIKE :keyword
                    OR type LIKE :keyword
                    OR fname LIKE :keyword
                    OR lname LIKE :keyword)";
        }
        if (!empty($type)) {
            $query .= " AND type = :type";
        }
        if (!empty($status)) {
            $query .= " AND status = :status";
        }
        if (!empty($universityId)) {
            $query .= " AND university_id = :university_id";
        }


        $this->db->query($query);

        // Bind values to the placeholders
        if (!empty($keyword)) {
            $this->db->bind(':keyword', '%' . $keyword . '%');
        }
        if (!empty($type)) {
            $this->db->bind(':type', $type);
        }
        if (!empty($status)) {
            if ($status == 'activated')
                $this->db->bind(':status', 1);
            elseif ($status == 'deactivated') {
                $this->db->bind(':status', 0);
            }
        }
        if (!empty($approval)) {
            $this->db->bind(':approval', $approval);
        }
        if (!empty($universityId)) {
            $this->db->bind(':university_id', $universityId);
        }


        // Execute the query
        $this->db->execute();

        // Fetch the results
        $row = $this->db->resultSet();
        return $row;

    }

    public function getRecentlyLoggedInUsers()
    {
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

    public function getAllRequests()
    {
        $this->db->query('SELECT * FROM events, posts, organizations, opportunities
                        WHERE events.approval == :event_approval
                        OR posts.approval == :posts_approval
                        AND  ');
    }

    public function DeactivateAccount($data)
    {
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

    public function ActivateAccount($data)
    {
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

    public function checkStatusByID($data)
    {
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

    public function updateUserProfileImage($data)
    {

        // var_dump($data);
        // die();
        $this->db->query("UPDATE users SET
                profile_image = :profile_image,
                cover_image = :cover_image
                WHERE id = :id");

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':profile_image', $data['profile_image']);
        $this->db->bind(':cover_image', $data['cover_image']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateContactDetails($data)
    {
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

    public function updateDescription($data)
    {
        $this->db->query("UPDATE users SET
                        profile_title = :profile_title,
                        description = :description
                        WHERE id = :id");
        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':profile_title', $data['profile_title']);
        $this->db->bind(':description', $data['description']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //User Education 
    public function updateEducation($data)
    {
        $this->db->query("UPDATE user_education SET
                        institution = :institution,
                        description = :description,
                        grade = :grade,
                        start_year = :start_year,
                        end_year = :end_year
                        WHERE education_id = :education_id");
        //Bind values
        $this->db->bind(':education_id', $data['education_id']);
        $this->db->bind(':institution', $data['institution']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':grade', $data['grade']);
        $this->db->bind(':start_year', $data['start_year']);
        $this->db->bind(':end_year', $data['end_year']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEducation($data)
    {
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

    public function addEducation($data)
    {
        // var_dump($data['category_ids']);
        // die();
        $this->db->query("INSERT INTO user_education (
        user_id, 
        institution,
        description,
        grade,
        start_year, 
        end_year) VALUES(:user_id, :institution, :description, :grade, :start_year, :end_year)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':institution', $data['institution']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':grade', $data['grade']);
        $this->db->bind(':start_year', $data['start_year']);
        $this->db->bind(':end_year', $data['end_year']);

        // Begin the transaction
        $this->db->beginTransaction();

        // Execute the first query
        if (!$this->db->execute()) {
            // Rollback the transaction if there's an error
            $this->db->rollBack();
            return false;
        }

        // Commit the transaction if everything is successful
        $this->db->commit();
        return true;
    }

    //User Qualifications 
    public function updateQualification($data)
    {
        $this->db->query("UPDATE user_qualifications SET
                    qualification_name = :qualification_name,
                    institution = :institution,
                    description = :description,
                    completion_date = :completion_date 
                    WHERE qualification_id = :qualification_id");
        //Bind values
        $this->db->bind(':qualification_id', $data['qualification_id']);
        $this->db->bind(':qualification_name', $data['qualification_name']);
        $this->db->bind(':institution', $data['institution']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':completion_date', $data['completion_date']);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteQualification($data)
    {
        $this->db->query("UPDATE user_qualifications SET status = :status  WHERE qualification_id= :qualification_id");
        //Bind values
        $this->db->bind(':qualification_id', $data['qualification_id']);
        $this->db->bind('status', 0);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteOrganization($data)
    {
        $this->db->query("UPDATE user_organizations SET status = :status  WHERE id= :organization_id");
        //Bind values
        $this->db->bind(':organization_id', $data['organization_id']);
        $this->db->bind('status', 0);

        //Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function addQualification($data)
    {
        // var_dump($data['category_ids']);
        // die();
        $this->db->query("INSERT INTO user_qualifications (
    user_id,
    qualification_name, 
    institution,
    description, 
    completion_date) VALUES(:user_id, :qualification_name, :institution, :description, :completion_date)");
        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':qualification_name', $data['qualification_name']);
        $this->db->bind(':institution', $data['institution']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':completion_date', $data['completion_date']);

        // Begin the transaction
        $this->db->beginTransaction();

        // Execute the first query
        if (!$this->db->execute()) {
            // Rollback the transaction if there's an error
            $this->db->rollBack();
            return false;
        }

        // Commit the transaction if everything is successful
        $this->db->commit();
        return true;
    }

    public function getUserEventCategories($userId)
    {
        $query = 'SELECT ueic.*, c.category_name
        FROM user_event_interest_categories ueic
        LEFT JOIN categories c ON ueic.event_category_id = c.id
        WHERE ueic.user_id = :user_id';

        // Bind the user ID parameter
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);

        // Execute the query
        $this->db->execute();

        // Fetch the result set
        $categories = $this->db->resultSet();

        return $categories;
    }

    public function addEventInterestCategory($data)
    {
        $query = 'INSERT INTO user_event_interest_categories (user_id, event_category_id) VALUES (:user_id, :event_category_id)';

        // Bind the parameters
        $this->db->query($query);
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':event_category_id', $data['categoryId']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEventInterestCategory($data)
    {
        $query = 'DELETE FROM user_event_interest_categories WHERE id = :id';

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


    public function getUserPostCategories($userId)
    {
        $query = 'SELECT upic.*, pc.category_name
        FROM user_post_interest_categories upic
        LEFT JOIN post_categories pc ON upic.post_category_id = pc.category_id
        WHERE upic.user_id = :user_id';

        // Bind the user ID parameter
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);

        // Execute the query
        $this->db->execute();

        // Fetch the result set
        $categories = $this->db->resultSet();

        return $categories;
    }

    public function addPostInterestCategory($data)
    {
        $query = 'INSERT INTO user_post_interest_categories (user_id, post_category_id) VALUES (:user_id, :post_category_id)';

        // Bind the parameters
        $this->db->query($query);
        $this->db->bind(':user_id', $data['userId']);
        $this->db->bind(':post_category_id', $data['categoryId']);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePostInterestCategory($data)
    {
        $query = 'DELETE FROM user_post_interest_categories WHERE id = :id';

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

    public function checkStatusByUserId($userId)
    {
        $this->db->query("SELECT status FROM users WHERE id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();
        return $row->status;
    }

    public function activateUserById($userId)
    {
        $this->db->query("UPDATE users SET status = 1 WHERE id = :userId");
        $this->db->bind(':userId', $userId);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deactivateUserById($userId)
    {
        $this->db->query("UPDATE users SET status = 0 WHERE id = :userId");
        $this->db->bind(':userId', $userId);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUnirepsEmailsByUniId($uniId)
    {
        $this->db->query("SELECT secondary_email FROM users WHERE university_id = :university_id AND type = 'unirep'");
        $this->db->bind(':university_id', $uniId);
        $emails = $this->db->resultSet();
        return $emails;

    }

    public function getAdminsEmails()
    {
        $this->db->query("SELECT secondary_email FROM users WHERE type='admin'");
        $emails = $this->db->resultSet();
        return $emails;
    }



}