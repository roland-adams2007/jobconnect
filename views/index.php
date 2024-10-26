<?php
 require_once "classes/Job.php";
 $job = new Job;

 $jobs = $job->fetch_jobs_limit_6();
//  print "<pre>";
//  print_r($jobs);
//  print "</pre>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect - Home</title>
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

<body class="bg-gray-100 relative">

    <?php include_once('partials/header.php') ?>
    <!-- Hero Section -->
    <section class="bg-indigo-600 text-white py-20" style="background-image: url('assets/images/telework.jpg'); background-size: cover;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl font-bold mb-6">Find Your Dream Job Today!</h2>
            <p class="text-lg mb-8">Explore thousands of job opportunities in top companies and industries.</p>
            <form class="flex justify-center flex-col md:flex-row items-center w-full gap-2  ">
                <input type="text" placeholder="Job title or keyword" class="w-full px-4 py-3 rounded-lg shadow-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-white">
                <select class="w-full px-4 py-3 rounded-lg shadow-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-white">
                    <option selected disabled>Location</option>
                    <option>Remote</option>
                    <option>New York</option>
                    <option>San Francisco</option>
                </select>
                <button class="bg-indigo-600 text-white font-bold px-6 py-3 rounded-lg  focus:ring-2 focus:ring-white w-full">Search Jobs</button>
            </form>
        </div>
    </section>

    <!-- Job Categories Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Explore Job Categories</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center hover:shadow-xl transition flex flex-col gap-y-2">
                   <div><i class="fa-solid fa-code text-3xl text-indigo-600"></i></div>
                   <div>
                    <h3 class="text-xl font-semibold text-indigo-600">Development</h3>
                    <p class="mt-3 text-gray-500">150+ Jobs</p>
                   </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center hover:shadow-xl transition flex flex-col gap-y-2">
                    <div><i class="fa-solid fa-pen-fancy text-3xl text-indigo-600"></i></div>
                    <div>
                     <h3 class="text-xl font-semibold text-indigo-600">Design</h3>
                     <p class="mt-3 text-gray-500">100+ Jobs</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center hover:shadow-xl transition flex flex-col gap-y-2">
                    <div><i class="fa-solid fa-bullhorn text-3xl text-indigo-600"></i></div>
                    <div>
                     <h3 class="text-xl font-semibold text-indigo-600">Marketing</h3>
                     <p class="mt-3 text-gray-500">90+ Jobs</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recenr Jobs Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Recent Jobs</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php 
                if(count($jobs) > 0) {
                    foreach($jobs as $job) {
                ?>
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                        <div class="flex items-center mb-4">
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold"><?php print $job['title'] ?></h3>
                                <p class="text-gray-500"><?php print $job['company_name'] ?></p>
                            </div>
                        </div>
                        <p class="text-gray-700">Location: <?php print $job['location'] ?></p>
                        <p class="text-gray-700">Category: <?php print $job['category'] ?></p>
                        <div class="mt-3 space-x-2">
                            <span class="text-xs font-semibold text-white bg-indigo-500 px-2 py-1 rounded"><?php print ucwords($job['job_type']) ?></span>
                            <span class="text-xs font-semibold text-white bg-green-500 px-2 py-1 rounded"><?php print $job['location'] ?></span>
                        </div>
                        <a href="<?php print url('job_application', ['id' => $job['job_id']])?>" class="mt-4 text-center block w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Apply Now</a>
                    </div>
                <?php
                    }
                } else {
                ?>
                    <div class="col-span-full text-center py-12">
                        <p class="text-lg text-gray-500">No jobs found. Check back later for more opportunities!</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!-- Trusted by Companies Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Trusted by Top Companies</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Company Logo -->
                <img src="assets/images/google.png" alt="Google" class="w-32 mx-auto grayscale hover:grayscale-0 transition border border-red-500">
                <img src="assets/images/apple.png" alt="Apple" class="w-32 mx-auto grayscale hover:grayscale-0 transition border border-red-500">
                <img src="https://via.placeholder.com/100" alt="Company 3" class="w-32 mx-auto grayscale hover:grayscale-0 transition">
                <img src="https://via.placeholder.com/100" alt="Company 4" class="w-32 mx-auto grayscale hover:grayscale-0 transition">
                <img src="https://via.placeholder.com/100" alt="Company 5" class="w-32 mx-auto grayscale hover:grayscale-0 transition">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include_once('partials/footer.php')?>

    <script src="<?php print asset('javascript/script.js') ?>"></script>


</body>

</html>
