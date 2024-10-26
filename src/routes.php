<?php
// Start a session to manage user sessions (e.g., for login).
session_start();

// Arrays to hold registered routes and named routes
$routes = [];
$namedRoutes = [];

// Function to register a route
/**
 * Register a route.
 * 
 * @param string $uri The URI pattern (e.g., '/jobconnect/login').
 * @param string $view The view file to load when this route is matched (e.g., 'views/login.php').
 * @param string|null $name Optional name for the route, used to generate URLs later.
 */
function route($uri, $view, $name = null) {
    global $routes, $namedRoutes;

    // Normalize URI and replace dynamic segments like {id} with regex
    $uriPattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', rtrim($uri, '/'));
    $uriPattern = str_replace('/', '\/', $uriPattern);  // Escape slashes for regex.

    // Register the route
    $routes[$uriPattern] = $view;

    // If a name is provided, add it to the namedRoutes array for URL generation.
    if ($name) {
        if (!isset($namedRoutes[$name])) {
            $namedRoutes[$name] = $uri;
        } else {
            logError("Route name conflict: '$name' already exists.");
        }
    }
}

// Function to log errors
function logError($message) {
    $logMessage = "[" . date('Y-m-d H:i:s') . "] " . $_SERVER['REMOTE_ADDR'] . " " . $message . PHP_EOL;
    file_put_contents('error_log.txt', $logMessage, FILE_APPEND);
}

// Function to handle routing based on the requested URI
/**
 * Handle routing based on the requested URI.
 * 
 * @param string $uri The current request URI (e.g., '/jobconnect/profile').
 */
function handleRouting($uri) {
    global $routes;

    // Normalize URI to remove trailing slash
    $uri = rtrim($uri, '/');

    // Loop through the registered routes to find a match
    foreach ($routes as $routePattern => $view) {
        // Check if the request URI matches the route pattern
        if (preg_match("/^$routePattern$/", $uri, $matches)) {
            // Extract dynamic parameters (if any) so they can be used in the view
            extract($matches);

            // Include the corresponding view file
            require $view;
            return;
        }
    }

    // If no match is found, return a 404 error and load a custom 404 page
    header("HTTP/1.0 404 Not Found");
    require 'views/404.php';
}

// Function to generate a URL for a named route
/**
 * Generate a URL for a named route.
 * 
 * @param string $name The name of the route (e.g., 'login').
 * @param array $params Associative array of parameters to replace in the URI.
 * @return string|null The URL for the named route, or null if not found.
 */
function url($name, $params = []) {
    global $namedRoutes;

    if (isset($namedRoutes[$name])) {
        $uri = $namedRoutes[$name];
        foreach ($params as $key => $value) {
            $uri = str_replace("{" . $key . "}", $value, $uri);
        }
        return $uri;
    }
    return null;
}

// Function to generate asset URLs
/**
 * Asset helper function to generate URLs for static assets.
 *
 * @param string $path The asset path.
 * @return string Full URL to the asset.
 */
function asset($path) {
    $base_url = "http://" . $_SERVER['HTTP_HOST'];
    $base_path = '/jobconnect/assets/'; // Set as root path for assets
    return $base_url . $base_path . $path;
}

// Register routes with optional names
route('/jobconnect', 'views/index.php', 'home');
route('/jobconnect/login', 'views/login.php', 'login');
route('/jobconnect/register', 'views/job-seeker-register.php', 'job-seeker-register');
route('/jobconnect/employer/register', 'views/employer-register.php', 'employer-register');
route('/jobconnect/user-select', 'views/user_select.php', 'user_select');
route('/jobconnect/register-action', 'views/register_action.php', 'register_action');
route('/jobconnect/dashboard', 'views/job-seeker-dashboard.php', 'jobseeker-dashboard');
route('/jobconnect/profile', 'views/jobseeker-profile.php', 'jobseeker-profile');
route('/jobconnect/login-action', 'views/login_action.php', 'login_action');
route('/jobconnect/logout-action', 'views/logout_action.php', 'logout_action');
route('/jobconnect/profile-action', 'views/profile_action.php', 'profile_action');
route('/jobconnect/resume-action', 'views/resume_action.php', 'resume_action');
route('/jobconnect/employer', 'views/employer-dashboard.php', 'employer-dashboard');
route('/jobconnect/employer/applications', 'views/employer_applications.php', 'employer-application');
route('/jobconnect/employer/profile', 'views/employer-profile.php', 'employer-profile');
route('/jobconnect/employer/myjobs', 'views/employer-jobs.php', 'employer-jobs');
route('/jobconnect/employer/job-action', 'views/employer_job_action.php', 'employer-job-action');
route('/jobconnect/job/{id}', 'views/job-application.php', 'job_application');
route('/jobconnect/job/application/action', 'views/application_action.php', 'application_action');
route('/jobconnect/job', 'views/job-listings.php', 'job-listings');
route('/jobconnect/job/detail/{id}', 'views/job-detail.php', 'job-detail');
route('/jobconnect/contact', 'views/contact.php', 'contact');
route('/jobconnect/contact/action', 'views/contact_action.php', 'contact_action');
route('/jobconnect/myapplications', 'views/jobseeker_applications.php', 'jobseeker-applications');
route('/jobconnect/myapplications/withdraw', 'views/withdraw_action.php', 'withdraw_action');


// Get the current request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Log the request URI for debugging purposes (optional)
file_put_contents('request_log.txt', $requestUri . PHP_EOL, FILE_APPEND);

// Handle the current request by calling the routing system
handleRouting($requestUri);
