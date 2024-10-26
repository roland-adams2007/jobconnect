
<?php
require_once "user_guard.php";
require_once "classes/Job.php";
$job = new Job;
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
    <title>Job Details</title>
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png')?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png')?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png')?>">
</head>
<body class="bg-gray-100  h-screen flex flex-col">
    <?php include_once('partials/header.php') ?>

    <!-- Job Details Section -->
    <section class="container mx-auto py-8 h-full overflow-y-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800"><?php print $job_details['title'] ?></h2>
            <p class="text-gray-600"><?php print $job_details['company_name'] ?> - <?php print $job_details['location'] ?></p>
            <p class="mt-2 text-indigo-600 font-semibold"><?php $job_details['salary']?></p>

            <hr class="my-4">

            <h3 class="text-xl font-semibold text-gray-800">Job Description</h3>
            <p class="mt-2 text-gray-600">
                <?php print $job_details['description'] ?>
            </p>

            <div class="mt-6 flex justify-between items-center">
                <a href="<?php print url('job_application', ['id' => $job_details['job_id']])?>" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">Apply Now</a>
                <span class="text-gray-500">Posted On <?php print date('d-m-Y',strtotime($job_details['date_added'])) ?></span>
            </div>
        </div>
    </section>
         <!-- Footer -->
         <?php include_once('partials/footer.php')?>

        <script src="<?php print asset('javascript/script.js') ?>"></script>

</body>
</html>
