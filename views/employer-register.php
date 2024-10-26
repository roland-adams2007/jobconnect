
<?php 
 require_once "classes/User.php";
 $user= new User;

 $countries = $user->fetch_countries();
 $country_codes =$user->fetch_country_codes();
 $industries = $user->fetch_industries();

 if(isset($_SESSION['user_details']['user_id']) && $_SESSION['user_details']['user_type'] !== 'employer'){
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
    <title>Employer Register</title>
    <link rel="stylesheet" href="<?php print asset('css/loader.css') ?>">
    <script src="<?php print asset('javascript/tailwind.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php print asset('images/hand-shake.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php print asset('images/hand-shake.png') ?>">
</head>
<body class="bg-gray-100">

  <!-- Loader -->
<?php include_once('partials/loader.php') ?>

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl w-full">
            <h2 class="text-3xl font-bold text-center mb-6 text-indigo-600">Register as Employer</h2>

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
            <form action="<?php print url('register_action') ?>" method="post" id="form">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="company-name" class="block text-gray-700">Company Name</label>
                        <input type="text" name="company-name" id="company-name" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter company name" required>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Full Name</label>
                        <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your full name" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Create a password" required>
                    </div>

                    <div class="mb-4">
                        <label for="country-code" class="block text-gray-700">Country Code</label>
                        <select id="country-code" name="country_code" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
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
                        <label for="phone" class="block text-gray-700">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your phone number" required>
                    </div>

                    <div class="mb-4">
                        <label for="industry" class="block text-gray-700">Industry</label>
                        <select  id="industry" name="industry" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                        <option value="" disabled selected>Select your industry</option>
                            <?php 
                             foreach($industries as $industry){
                                ?>
                                <option value="<?php print $industry['industry_name'] ?>"><?php print $industry['industry_name'] ?></option>
                                <?php
                             }
                            
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="employees" class="block text-gray-700">Number of Employees</label>
                        <select id="employees" name="employees" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="1-10">1-10</option>
                            <option value="11-50">11-50</option>
                            <option value="51-200">51-200</option>
                            <option value="201+">201+</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="referral" class="block text-gray-700">Where did you hear about us?</label>
                        <select id="referral" name="referral" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                            <option value="friend">A Friend</option>
                            <option value="website">Website</option>
                            <option value="social-media">Social Media</option>
                            <option value="advertisement">Advertisement</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="country" class="block text-gray-700">Country</label>
                        <select id="country" name="country" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" required>
                        <option value="" disabled selected>Select your Country</option>
                            <?php 
                             foreach($countries as $country){
                                ?>
                                <option value="<?php print $country['name'] ?>"><?php print $country['name'] ?></option>
                                <?php
                             }
                            
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700">Address</label>
                        <input type="text" name="address" id="address" class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500" placeholder="Enter your address" required>
                    </div>
                </div>

                <button type="submit" name="employer_register_btn" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Create Account</button>
            </form>

            <div class="my-6 flex items-center justify-center">
                <span class="text-gray-400">OR</span>
            </div>

            <!-- Google Sign-In Button -->
            <button class="w-full bg-white text-gray-700 border border-gray-300 py-2 rounded-md shadow-md flex items-center justify-center hover:bg-gray-100 transition">
            <img src="../assets/images/g.png" alt="Google Logo" class="w-5 h-5 mr-3">
                Sign up with Google
            </button>

            <p class="mt-6 text-center text-gray-600">Already have an account? <a href="<?php print url('login') ?>" class="text-indigo-600 hover:underline">Login</a></p>
        </div>
    </div>

   <script src="<?php print asset('javascript/loader.js') ?>"></script>

</body>
</html>
