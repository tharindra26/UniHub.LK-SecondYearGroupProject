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


}