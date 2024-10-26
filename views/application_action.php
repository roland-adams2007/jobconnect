<?php
require_once "classes/Job.php";
require "classes/utilities.php";

$job = new Job;

// Check if the user is a job seeker
if (!isset($_SESSION['user_details']['user_type']) || $_SESSION['user_details']['user_type'] !== 'job seeker') {
    header("Location: " . url('home'));
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['application_btn'])) {
    // Get job ID and applicant ID
    $job_id = $_POST['job_id'];
    $applicant_id = $_SESSION['user_details']['user_id'];

    $formCheck = $job->check_application_form($job_id,$applicant_id);

    if($formCheck > 0){
        $_SESSION['error'] = 'You have applied for this job before';
        header("Location: " . url('job_application', ['id' => $job_id]));
        exit;
    }



    // Sanitize and validate input data
    $fname = trim(ucwords(sanitizer($_POST['fname'])));
    $lname = trim(ucwords(sanitizer($_POST['lname'])));
    $email = trim(sanitizer($_POST['email']));
    $phone = trim(sanitizer($_POST['phone']));
    $cover_letter = trim(ucfirst(sanitizer($_POST['cover_letter'])));
    $years = sanitizer($_POST['years']);
    $url = trim(sanitizer($_POST['url']));
    $comment = trim(ucfirst(sanitizer($_POST['comment'])));
    $resume = $_FILES['resume'];

    // Initialize error array
    $errors = [];

    // Check required fields
    if (empty($fname)) {
        $errors[] = "Firstname is required.";
    }
    if (empty($lname)) {
        $errors[] = "Lastname is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }
    if (empty($cover_letter)) {
        $errors[] = "Cover letter is required.";
    }
    if (empty($years)) {
        $errors[] = "Years of experience is required.";
    }
    if (empty($resume['name'])) {
        $errors[] = "Resume upload is required.";
    }

    // If there are errors, set them in the session and redirect back
    if (!empty($errors)) {
        $_SESSION['error'] = implode(' ', $errors);
        header("Location: " . url('job_application', ['id' => $job_id]));
        exit;
    }

    // Validate resume file upload
    if (isset($resume['error']) && $resume['error'] === UPLOAD_ERR_OK) {
        // Call the method to handle job application submission
        $response = $job->job_application($job_id, $fname,$lname, $email, $phone, $cover_letter, $years, $url, $comment, $resume, $applicant_id);

        // Check the response
        if ($response) {
            $_SESSION['feedback'] = "Application submitted successfully.";
        } else {
            $_SESSION['error'] = "There was an error trying to submit your application.";
        }
    } else {
        $_SESSION['error'] = "Resume upload failed. Please check the file and try again.";
    }

    // Redirect to the job application page
    header("Location: " . url('job_application', ['id' => $job_id]));
    exit;
} else {
    // Redirect to home if the request is not POST or application button is not set
    header("Location: " . url('home'));
    exit;
}
?>
