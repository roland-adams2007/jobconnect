<?php
require_once "classes/User.php";
require "classes/utilities.php";
$user = new User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resume = $_FILES['resume'];
    $id = $_SESSION['user_details']['user_id'];

    // Validate the uploaded file
    $allowed_extensions = ['pdf', 'doc', 'docx'];
    $max_file_size = 2 * 1024 * 1024; // 2 MB limit
    $file_extension = pathinfo($resume['name'], PATHINFO_EXTENSION);
    
    // Check if the file is uploaded without errors
    if ($resume['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "Error uploading file. Please try again.";
        header("location:/jobconnect/profile");
        exit;
    }

    // Validate file size
    if ($resume['size'] > $max_file_size) {
        $_SESSION['error'] = "File size exceeds the 2 MB limit.";
        header("location:/jobconnect/profile");
        exit;
    }

    // Validate file type
    if (!in_array($file_extension, $allowed_extensions)) {
        $_SESSION['error'] = "Invalid file type. Please upload a PDF or Word document.";
        header("location:/jobconnect/profile");
        exit;
    }

    // Proceed to update the resume
    $response = $user->updateResume($resume, $id);

    if ($response) {
        $_SESSION['feedback'] = "Resume updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update resume. Please try again.";
    }

    header("location:/jobconnect/profile");
    exit;

} else {
    header("location:/jobconnect/profile");
    exit;
}
?>
