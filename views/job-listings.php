<?php 
 require_once('classes/Job.php');
 $job = new Job;
 $jobs = $job->fetch_all_jobs();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">
</head>
<body class="bg-gray-100 h-screen flex flex-col">

    <?php include_once('partials/header.php') ?>

    <!-- Search and Filters Section -->
    <section class="container mx-auto py-8 h-full">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-gray-600">Keyword</label>
                    <input type="text" placeholder="Job title, skills, etc." class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-gray-600">Location</label>
                    <input type="text" placeholder="City, state, or zip" class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-gray-600">Category</label>
                    <select class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500">
                        <option>Select Category</option>
                        <option>Technology</option>
                        <option>Marketing</option>
                        <option>Sales</option>
                        <option>Healthcare</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-600">Sort By</label>
                    <select class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-indigo-500">
                        <option>Most Recent</option>
                        <option>Highest Salary</option>
                        <option>Lowest Salary</option>
                    </select>
                </div>
            </form>
        </div>
    </section>

    <!-- Job Listings -->
    <section class="container mx-auto pb-8">
        <div class="grid grid-cols-1 gap-4">
            <!-- Single Job Listing -->
            <?php 
             if(count($jobs) > 0){
                foreach($jobs as $job){
                    ?>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800"><?php print $job['title'] ?></h2>
                                <p class="text-gray-600"><?php print $job['company_name'] ?> - <?php print $job['location'] ?></p>
                            </div>
                            <div>
                                <span class="text-indigo-600 font-semibold"><?php print $job['salary'] ?></span>
                            </div>
                        </div>
                        <p class="mt-4 text-gray-600">
                            <?php 
                                $description = $job['description'];
                                // Truncate if longer than 25 characters
                                echo strlen($description) > 25 ? substr($description, 0, 25) . '...' : $description;
                            ?>
                        </p>

                        <div class="mt-4 flex justify-between items-center">
                            <a href="<?php print url('job-detail',['id'=> $job['job_id'] ]) ?>" class="text-indigo-600 hover:underline">View Details</a>
                            <span class="text-gray-500">Posted On <?php print date('d-m-Y',strtotime($job['date_added'])) ?></span>
                        </div>
                    </div>
                    <?php
                }
             }else{
                ?>
                <div class="col-span-full text-center py-12">
                        <p class="text-lg text-gray-500">No jobs found. Check back later for more opportunities!</p>
                    </div>
                <?php
             }
            ?>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            <nav aria-label="Pagination">
                <ul class="inline-flex items-center space-x-2">
                    <li>
                        <a href="#" class="px-3 py-1 rounded-md bg-gray-200 text-gray-600 hover:bg-indigo-600 hover:text-white">Previous</a>
                    </li>
                    <li>
                        <a href="#" class="px-3 py-1 rounded-md bg-indigo-600 text-white">1</a>
                    </li>
                    <li>
                        <a href="#" class="px-3 py-1 rounded-md bg-gray-200 text-gray-600 hover:bg-indigo-600 hover:text-white">2</a>
                    </li>
                    <li>
                        <a href="#" class="px-3 py-1 rounded-md bg-gray-200 text-gray-600 hover:bg-indigo-600 hover:text-white">3</a>
                    </li>
                    <li>
                        <a href="#" class="px-3 py-1 rounded-md bg-gray-200 text-gray-600 hover:bg-indigo-600 hover:text-white">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

         <!-- Footer -->
    <?php include_once('partials/footer.php')?>

<script src="<?php print asset('javascript/script.js') ?>"></script>

</body>
</html>
