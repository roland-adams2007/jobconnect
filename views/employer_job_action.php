<?php
require_once "classes/Job.php";
require "classes/utilities.php";
$job = new Job;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employer_job_btn'])) {
    $title = trim(ucwords(sanitizer($_POST['title'])));
    $location = sanitizer($_POST['location']);
    $salary = sanitizer($_POST['salary']);
    $category = sanitizer($_POST['category']);
    $job_type = sanitizer($_POST['job_type']);
    $allowed_tags = '<p><a><strong><em><ul><li><hr>';
    $description = strip_tags(trim($_POST['description']), $allowed_tags);
    $status = sanitizer($_POST['status']);

    // Validate inputs
    $errors = [];
    if (empty($title)) {
        $errors[] = "Job title is required.";
    }
    if (empty($location)) {
        $errors[] = "Location is required.";
    }
    if (empty($salary)) {
        $errors[] = "Salary is required.";
    }
    if (empty($category)) {
        $errors[] = "Category is required.";
    }
    if (empty($job_type)) {
        $errors[] = "Job type is required.";
    }
    if (empty($description)) {
        $errors[] = "Job description is required.";
    }

    // If there are errors, redirect with error messages
    if (!empty($errors)) {
        $_SESSION['error'] = implode(" ", $errors);
        $_SESSION['form_data'] = $_POST; // Store form data to repopulate fields
        header("location:" . url('employer-jobs'));
        exit;
    }

    // Insert job if no errors
    $response = $job->insert_jobs($title, $location, $salary, $category, $job_type, $description, $status);

    if ($response) {
        $_SESSION['feedback'] = "Job added successfully.";
    } else {
        $_SESSION['error'] = "Failed to add job.";
    }

    header("location:" . url('employer-jobs'));
    exit;

} else {
    header("location:" . url('employer-jobs'));
    exit;
}
?>
