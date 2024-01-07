<?php
/*
*PDO Database class
*Connect to databse
*Create prepared statement
*Bind Values
*Return rows and results
*/

class Database{
    private $host =DB_HOST;
    private $user =DB_USER;
    private $pass =DB_PASSWORD;
    private $dbname =DB_NAME;

    private $dbh; //Database handle
    private $stmt; //statement
    private $error;

    public function __construct(){
        //Set DSN-->data soure name
        $dsn = 'mysql:host=' .$this->host .';dbname=' .$this->dbname;
        $options= array(
            PDO:: ATTR_PERSISTENT=>true, //attribute presistent connection
            PDO:: ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
        );

        //create pdo instance --> PHP data object
        try{
            $this->dbh= new PDO($dsn, $this-> user, $this->pass, $options);
        }catch(PDOException $e){
            $this->error= $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }
  
      // Bind values
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    
  
    // Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    // Get result set as array of objects-->Fetch all objects
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object--> Fetch one object
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    // Begin a transaction
    public function beginTransaction() {
        return $this->dbh->beginTransaction();
    }

    // Commit the transaction
    public function commit() {
        return $this->dbh->commit();
    }

    // Rollback the transaction
    public function rollBack() {
        return $this->dbh->rollBack();
    }

    
}