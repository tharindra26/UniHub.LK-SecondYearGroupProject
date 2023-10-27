<?php
class User{

    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    //Register the user
    public function register($data){
        $this->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");
        //Bind values
        $this->db->bind(':name' , $data['name']);
        $this->db->bind(':email' ,  $data['email']);
        $this->db->bind(':password' ,  $data['password']);

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


}