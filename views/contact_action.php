<?php 
  require_once('classes/Contact.php');
  require_once "classes/utilities.php"; 
   $contact = new Contact;

   if(!isset($_SESSION['user_details']['user_id'])){
     $_SESSION['error'] = "You must be logged in to send a message";
     header('location:'.url('contact'));
      exit;
   }

  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_btn'])){

    $user_id = $_SESSION['user_details']['user_id'];
    $fname = trim(ucfirst(sanitizer($_POST['fname']))); 
    $lname = trim(ucfirst(sanitizer($_POST['lname']))); 
    $email = trim(($_POST['email'])); 
    $message = trim(ucfirst(sanitizer($_POST['message']))); 

    if(empty($fname) || empty($fname) || empty($lname) || empty($email) || empty($message)){
        $_SESSION['error'] = "All fields are required";
        header('location:'.url('contact'));
         exit;
    }

    $response = $contact->add_contact($user_id,$fname,$lname,$email,$message);

    if($response){
        $_SESSION['feedback'] = "Submitted successfully";
    }else{
        $_SESSION['error'] = "An error occurred while trying to submit this form";
    }

    header('location:'.url('contact'));
    exit;

  }else{
    header('location:'.url('contact'));
    exit;
  }

?>