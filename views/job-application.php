<?php
require_once "user_guard.php";
require_once "classes/Job.php";
$job = new Job;
if (!isset($_SESSION['user_details']['user_type']) || $_SESSION['user_details']['user_type'] !== 'job seeker') {
    header("Location: " . url('home'));
    exit;
}

$job_id = $id;

$job_details = $job->get_job_by_id($job_id); // Implement this method in the Job class

if (!$job_details) {
    header("HTTP/1.0 404 Not Found");
    include("404.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png')?>">
    <style>
        /* Custom Styles */
        .input-field:focus {
            border-color: #6366f1; /* Tailwind's indigo-600 */
            box-shadow: 0 0 0 1px #6366f1; /* Tailwind's indigo-600 */
        }

        .button-submit {
            background-color: #4f46e5; /* Tailwind's indigo-600 */
            transition: background-color 0.3s;
        }

        .button-submit:hover {
            background-color: #4338ca; /* Tailwind's indigo-700 */
        }
    </style>
</head>

<body class="bg-gray-100">

<?php include_once('partials/header.php') ?>

    <div class="container mx-auto py-9">
        <div class="bg-white p-8 rounded-lg shadow-md max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Job Application</h2>

            <?php
                if (isset($_SESSION['error'])) {
                    print "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                            <strong class='font-bold'>Error: </strong>
                            <span class='block sm:inline'>" . $_SESSION['error'] . "</span>
                        </div>";
                    unset($_SESSION['error']); // Unset after displaying
                }

                if (isset($_SESSION['feedback'])) {
                    print "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>
                            <strong class='font-bold'>Success: </strong>
                            <span class='block sm:inline'>" . $_SESSION['feedback'] . "</span>
                        </div>";
                    unset($_SESSION['feedback']); // Unset after displaying
                }
                ?>

            <form action="<?php  print url('application_action')?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="job_id" value="<?php print $id?>">
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-600">First Name</label>
                            <input type="text" name="fname" placeholder="Enter your firstname" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field" required>
                        </div>
                        <div>
                            <label class="block text-gray-600">Last Name</label>
                            <input type="text" name="lname" placeholder="Enter your lastname" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field" required>
                        </div>
                    </div>
                    <div class="mt-4">
                            <label class="block text-gray-600">Email</label>
                            <input type="email" name="email" placeholder="Enter your email" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field" required>
                        </div>
                    <div class="mt-4">
                        <label class="block text-gray-600">Phone Number</label>
                        <input type="tel" name="phone" placeholder="Enter your phone number" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field" required>
                    </div>
                </div>

                <!-- Resume Upload Section -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Resume Upload</h3>
                    <label class="block text-gray-600">Upload Resume (PDF, DOC, DOCX)</label>
                    <input type="file" name="resume" accept=".pdf, .doc, .docx" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field" required>
                </div>

                <!-- Cover Letter Section -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Cover Letter</h3>
                    <textarea rows="5" name="cover_letter" placeholder="Write your cover letter" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field" required></textarea>
                </div>

                <!-- Years in service Section -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Years in experience</h3>
                    <select name="years" id="years" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field" required>
                        <option value="">Select years in experience</option>
                        <option value="1-2">1 - 2 years</option>
                        <option value="3-5">3 - 5 years</option>
                        <option value="6-10">6 - 10 years</option>
                        <option value="11-15">11 - 15 years</option>
                        <option value="16-20">16 - 20 years</option>
                        <option value="20+">20+ years</option>
                    </select>
                </div>


                <!-- LinkedIn Profile Section -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">LinkedIn Profile (optional)</h3>
                    <input type="url" name="url" placeholder="https://linkedin.com/in/yourprofile" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field">
                </div>

                <!-- Additional Comments Section -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Additional Comments (optional)</h3>
                    <textarea rows="3" name="comment" placeholder="Any additional information" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500 input-field"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="application_btn" class="w-full text-white py-2 rounded-md button-submit">Submit Application</button>
            </form>

            <p class="mt-4 text-gray-600 text-sm text-center">By submitting this application, you agree to our <a href="#" class="text-indigo-600 hover:underline">terms and conditions</a>.</p>
        </div>
    </div>

    <script src="<?php print asset('javascript/script.js') ?>"></script>

</body>

</html>
