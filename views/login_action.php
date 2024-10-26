<?php
 require_once "classes/User.php";
 require "classes/utilities.php";
 $user = new User;


 if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = sanitizer($_POST['email']);
    $password = sanitizer($_POST['password']);


    if(empty($email) || empty($password)){
      $_SESSION['error']="All field are required";
      header('location:/jobconnect/login');
      exit;
    }

  
      

    $result = $user->login_user($email,$password);


    if($result){
         if($_SESSION['user_details']['user_type'] === 'job seeker'){
            header('location:'.url('home'));
            exit;
         }

         if($_SESSION['user_details']['user_type'] === 'employer'){
            header('location:'.url('employer-dashboard'));
            exit;
         }
    }else{
    header('location:'.url('login'));
    exit;
    }

 }else{
    header('location:'.url('login'));
    exit;
 }