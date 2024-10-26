<?php
 require_once "classes/User.php";
 require "classes/utilities.php";
 $user = new User;


 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['job_seeker_profile_btn'])){
      $name=trim(ucwords(sanitizer($_POST['name'])));
      $phone=trim(sanitizer($_POST['phone']));
      $address=trim(ucwords(sanitizer($_POST['address'])));

      if(empty($name) || empty($phone) || empty($address)){
        $_SESSION['error']="All fields are required";
        header("location:/jobconnect/profile");
        exit;
      }
      $id=$_SESSION['user_details']['user_id'];
      $response = $user->updateUserDetails($name,$phone,$address,$id);

      if($response){
        $_SESSION['feedback']="Profile updated successfully";
      }else{
        $_SESSION['error']="Fail to update profile";
      }

      header("location:/jobconnect/profile");
      exit;

     }


 }else{
  header("location:/jobconnect/profile");
  exit;
 }
?>