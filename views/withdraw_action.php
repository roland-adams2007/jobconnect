<?php
require_once "classes/Job.php";
require "classes/utilities.php";

$job = new Job;

// Check if the user is a job seeker
if (!isset($_SESSION['user_details']['user_type']) || $_SESSION['user_details']['user_type'] !== 'job seeker') {
    header("Location: " . url('home'));
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['withdraw_btn'])) {

    $application_id = $_POST['application_id'];

    $response = $job->withdraw($application_id);

    if($response){
       $_SESSION['feedback'] = "This job have been withdrawn";
    }else{
        $_SESSION['error'] = "An error occurred while trying to withdraw job";
    }



    // Redirect to the job application page
    header("Location: " . url('jobseeker-applications'));
    exit;
} else {
    // Redirect to home if the request is not POST or application button is not set
    header("Location: " . url('jobseeker-applications'));
    exit;
}
?>
