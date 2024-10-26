<header class="bg-white shadow sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex justify-between items-center gap-x-10">
            <div class="flex items-center gap-x-1">
                <img src="<?php print asset('images/hand-shake.png') ?>" alt="" class="w-10">
                <h1 class="text-2xl font-bold text-indigo-600">JobConnect</h1>
            </div>

            <nav class="space-x-6 hidden lg:flex">
                <a href="<?php print url('home') ?>" class="text-gray-600 hover:text-indigo-500">Home</a>
                <a href="<?php print url('job-listings') ?>" class="text-gray-600 hover:text-indigo-500">Jobs</a>
                <a href="<?php print url('contact') ?>" class="text-gray-600 hover:text-indigo-500">Contact</a>
            </nav>
        </div>

        <div class="relative">
            <div class="flex gap-x-3">
                <i class="fa-solid fa-user fa-xl cursor-pointer text-gray-600" id="menu-button" aria-label="User Menu"></i>
                <i class="fa-solid fa-bars fa-xl cursor-pointer text-gray-600 block md:hidden" id="mobile-menu-toggle" aria-label="Navigation Menu"></i>
            </div>

            <div id="user-menu" class="w-48 bg-white absolute shadow-md rounded-md right-0 hidden top-6 transition-all duration-150 ease-in-out">
                <ul>
                    <?php if (isset($_SESSION['user_details']['user_id'])) { ?>
                        <?php
                        // Show Dashboard link based on user type and if on dashboard page
                        print $_SESSION['user_details']['user_type'] === 'job seeker' 
                            ? '<li><a href="' . url('jobseeker-dashboard') . '" class="block px-4 py-2 hover:bg-indigo-50">Dashboard</a></li>
                            <li><a href="'.url('employer-register').'" class="block px-4 py-2 hover:bg-indigo-50">Post a Job</a></li>
                            ' 
                            : '<li><a href="' . url('employer-dashboard') . '" class="block px-4 py-2 hover:bg-indigo-50">Dashboard</a></li>';
                        ?>
        
                        <li><a href="<?php print url("logout_action"); ?>" class="block px-4 py-2 hover:bg-indigo-50">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="<?php print url("login"); ?>" class="block px-4 py-2 hover:bg-indigo-50">Login/Register</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobile-nav" class="hidden bg-white md:hidden">
        <nav class="space-y-2 px-4 py-3 flex flex-col">
        <a href="<?php print url('home') ?>" class="text-gray-600 hover:text-indigo-500">Home</a>
                <a href="<?php print url('job-listings') ?>" class="text-gray-600 hover:text-indigo-500">Jobs</a>
                <a href="<?php print url('contact') ?>" class="text-gray-600 hover:text-indigo-500">Contact</a>
        </nav>
    </div>
</header>
