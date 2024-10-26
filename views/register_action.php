<?php
 require_once "classes/User.php";
 require "classes/utilities.php";
 $user = new User;


 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['job_seeker_register_btn'])){
      $name = trim(ucwords(sanitizer($_POST['name'])));
      $email = trim(sanitizer($_POST['email']));
      $dob = sanitizer($_POST['dob']);
      $gender = sanitizer($_POST['gender']);
      $country = sanitizer($_POST['country']);
      $country_code = sanitizer($_POST['country-code']);
      $phone = sanitizer($_POST['phone']);
      $qualification = sanitizer($_POST['qualification']);
      $experience = sanitizer($_POST['experience']);
      $current_job = sanitizer($_POST['current-job']);
      $availability = sanitizer($_POST['availability']);
      $address = sanitizer($_POST['address']);
      $password = sanitizer($_POST['password']);
      $resume = $_FILES['resume'];

      $full_phone = $country_code.$phone;

      if(empty($name) || empty($email) || empty($dob) || empty($gender) || empty($country) || empty($country_code) || empty($phone) || empty($qualification) || empty($experience) || empty($current_job) || empty($availability) || empty($address) || empty($password)){
        $_SESSION['error']="All fields are required";
        header('location:'.url('login'));
        exit;
      }

      if(strlen($password) < 8){
        $_SESSION['error']="Password must be 8 characters or more";
        header('location:'.url('login'));
        exit;
      }

      $job_seeker = $user->insert_job_seeker($name, $email, $password, $dob, $gender, $country, $full_phone, $qualification, $experience, $current_job, $availability, $resume, $address);

      if($job_seeker){
        header("location:".url('home'));
        exit;
      }else{
        header("location:".url('job-seeker-register'));
        exit;
      }
     }

 

     if(isset($_POST['employer_register_btn'])){

      $company_name= trim(ucwords(sanitizer($_POST['company-name'])));
      $name= trim(ucwords(sanitizer($_POST['name'])));
      $email = trim(sanitizer($_POST['email']));
      $password= sanitizer($_POST['password']);
      $country_code = sanitizer($_POST['country_code']);
      $phone = sanitizer($_POST['phone']);
      $full_phone = $country_code.$phone;
      $industry = sanitizer($_POST['industry']);
      $employees = sanitizer($_POST['employees']);
      $referral = sanitizer($_POST['referral']);
      $address = sanitizer($_POST['address']);
      $country = sanitizer($_POST['country']);
      
      if(strlen($password) < 8){
        $_SESSION['error']="Password must be 8 characters or more";
        header('location:'.url('employer-register'));
        exit;
      }

          if(empty($company_name) || empty($name) || empty($email) || empty($password) || empty($industry) || empty($employees) || empty($referral) || empty($country) || empty($address)){
            $_SESSION['error']="All fields are required";
            header('location:'.url('employer-register'));
            exit;
          }

        $employer = $user->insert_employer($company_name,$name,$email,$password,$full_phone,$industry,$employees,$referral,$country,$address);

        if($employer){
          header("location:".url('employer-dashboard'));
          exit;
        }else{
          header('location:'.url('employer-register'));
          exit;
        }

     }


 }else{
  header("location:".url('job-seeker-register'));
  exit;
 }
?>

<?php
// // Function to mimic Laravel's old() function
// function old($fieldName, $default = null) {
//     // Check if the field is set in the POST request
//     return isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName]) : $default;
// }
?>
