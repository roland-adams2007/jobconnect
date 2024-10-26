

<?php 
 require_once "classes/User.php";
 $user= new User;

 $countries = $user->fetch_countries();
 $country_codes =$user->fetch_country_codes(); 
 $job_functions =$user->fetch_job_functions(); 

 if(isset($_SESSION['user_details']['user_id']) && $_SESSION['user_details']['user_type'] !== 'job seeker'){
    unset($_SESSION['user_details']);
    header('location:'.url('home'));
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Register</title>
    <link rel="stylesheet" href="<?php print asset('css/loader.css') ?>">
    <link rel="stylesheet" href="<?php print asset('css/hamburger.css') ?>">
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">
    <script src="<?php print asset('javascript/hamburger.js') ?>"></script>
 
</head>
<body class="bg-gray-100">

  <!-- Loader -->
 <?php include('partials/loader.php') ?>

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl w-full">
            <h2 class="text-3xl font-bold text-center mb-6 text-indigo-600">Register as Job Seeker</h2>

            <?php
           if (isset($_SESSION['error'])) {
            print "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                    <strong class='font-bold'>Error: </strong>
                    <span class='block sm:inline'>" . $_SESSION['error'] . "</span>
                </div>";
            unset($_SESSION['error']); // Unset after displaying
        }
        
            ?>

            <!-- Register Form -->
            <form action="<?php print url('register_action') ?>" method="post" enctype="multipart/form-data" id="form">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your full name" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-4">
                        <label for="dob" class="block text-gray-700">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="gender" class="block text-gray-700">Gender</label>
                        <select id="gender" name="gender" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="" disabled selected>Select your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="country" class="block text-gray-700">Country</label>
                        <select id="country" name="country" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="" disabled selected>Select your Country</option>
                            <?php 
                             foreach ($countries as $country){
                                ?>
                                <option value="<?php print $country['name'] ?>"><?php print $country['name']?></option>
                                <?php
                             }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="country-code" class="block text-gray-700">Country Code</label>
                        <select id="country-code" name="country-code" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="" disabled selected>Select country code</option>
                            <?php 
                             foreach ($country_codes as $code){
                                ?>
                                <option value="<?php print $code['code'] ?>"><?php print $code['code']." "."(".$code['name'].")"; ?></option>
                                <?php
                             }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700">Mobile Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your mobile number" required>  
                    </div>

                    <div class="mb-4">
                        <label for="highest-qualification" class="block text-gray-700">Highest Qualification</label>
                        <select id="highest-qualification" name="qualification" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="" disabled selected>Select your qualification</option>
                            <option value="highschool">High School</option>
                            <option value="bachelor">Bachelor's Degree</option>
                            <option value="master">Master's Degree</option>
                            <option value="phd">PhD</option>
                            <!-- Add more qualifications as needed -->
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="experience" class="block text-gray-700">Years of Experience</label>
                        <select id="experience" name="experience" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="" disabled selected>Select years of experience</option>
                            <option value="0-1">0-1 year</option>
                            <option value="2-5">2-5 years</option>
                            <option value="6-10">6-10 years</option>
                            <option value="10+">10+ years</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="current-job" class="block text-gray-700">Current Job Function</label>
                        <select id="current-job" name="current-job"  class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="" disabled selected>Select your current job function</option>
                            <?php 
                             foreach ($job_functions as $function){
                                ?>
                                <option value="<?php print $function['function_name'] ?>"><?php print $function['function_name']?></option>
                                <?php
                             }
                            ?>
                        </select>
                    </div>
                    


                    <div class="mb-4">
                        <label for="availability" class="block text-gray-700">Availability</label>
                        <select id="availability" name="availability" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="" disabled selected>Select your availability</option>
                            <option value="immediate">Immediate</option>
                            <option value="within-1-month">Within 1 month</option>
                            <option value="within-3-months">Within 3 months</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="resume" class="block text-gray-700">Resume Upload</label>
                        <input type="file" name="resume" id="resume" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700">Address</label>
                        <input type="text" name="address" id="address" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your address" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your password" required>
                    </div>

                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2" required>
                            <span class="text-gray-700">I agree to the <a href="#" class="text-indigo-600 hover:underline">terms and conditions</a>.</span>
                        </label>
                    </div>
                </div>

                <button type="submit" name="job_seeker_register_btn" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Create Account</button>
            </form>

            <div class="my-6 flex items-center justify-center">
                <span class="text-gray-400">OR</span>
            </div>

            <!-- Google Sign-In Button -->
            <button class="w-full bg-white text-gray-700 border border-gray-300 py-2 rounded-md shadow-md flex items-center justify-center hover:bg-gray-100 transition">
                <img src="assets/images/g.png" alt="Google Logo" class="w-5 h-5 mr-3">
                Sign up with Google
            </button>

            <p class="mt-6 text-center text-gray-600">Already have an account? <a href="<?php print url('login') ?>" class="text-indigo-600 hover:underline">Login</a></p>
        </div>
    </div>
   <script src="<?php print asset('javascript/loader.js') ?>"></script>

</body>
</html>
