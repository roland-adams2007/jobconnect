<?php
 require_once "Db.php";

 class Contact extends Db{

    private $connection;

    public function __construct()
    {
        $this->connection=$this->connect();
    }

    public function add_contact($user_id,$fname,$lname,$email,$message){
        $contact_id = rand(1,4000)+1;
       $sql = "INSERT into contact(contact_id,user_id,fname,lname,email,message) VALUES(?,?,?,?,?,?)";
       $stmt=$this->connection->prepare($sql);
       $result = $stmt->execute([$contact_id,$user_id,$fname,$lname,$email,$message]);
       return $result;
    }

 }

?>