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


}