<?php
// Helper functions for the application

/**
 * Generate a random string
 * 
 * @param int $length Length of the random string
 * @return string Random string
 */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Generate a random subdomain
 * 
 * @param int $length Length of the random subdomain
 * @return string Random subdomain
 */
function generateRandomSubdomain($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Generate a URL slug
 * 
 * @param int $length Length of the slug
 * @return string URL slug
 */
function generateSlug($length = 10) {
    return 's/' . generateRandomString($length);
}

/**
 * Generate tracking parameter
 * 
 * @param int $length Length of the tracking parameter
 * @return string Tracking parameter
 */
function generateTrackingParam($length = 8) {
    return generateRandomString($length);
}

/**
 * Generate debug parameter
 * 
 * @param int $length Length of the debug parameter
 * @return string Debug parameter
 */
function generateDebugParam($length = 6) {
    return generateRandomString($length);
}

/**
 * Generate a complete URL
 * 
 * @param string $slug URL slug
 * @param string $tracking Tracking parameter
 * @param string $debug Debug parameter
 * @return string Complete URL
 */
function generateCompleteUrl($slug, $tracking, $debug) {
    $subdomain = USE_RANDOM_SUBDOMAIN ? generateRandomSubdomain(SUBDOMAIN_LENGTH) . '.' : '';
    return 'https://' . $subdomain . DOMAIN . '/' . $slug . '?tracking=' . $tracking . '&deb=' . $debug;
}

/**
 * Sanitize input
 * 
 * @param string $input Input to sanitize
 * @return string Sanitized input
 */
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Check if user is logged in
 * 
 * @return bool Whether user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']) && isset($_SESSION['last_activity']) && 
           (time() - $_SESSION['last_activity'] < SESSION_TIMEOUT);
}

/**
 * Redirect to a URL
 * 
 * @param string $url URL to redirect to
 * @param int $statusCode HTTP status code for redirect
 * @return void
 */
function redirect($url, $statusCode = 302) {
    // Check if URL is already absolute or has protocol
    if (strpos($url, 'http') !== 0 && strpos($url, '/') !== 0) {
        $url = '/'.$url; // Convert to absolute path
    }
    header('Location: ' . $url, true, $statusCode);
    exit();
}

/**
 * Display error message
 * 
 * @param string $message Error message
 * @return string HTML for error message
 */
function displayError($message) {
    return '<div class="alert alert-danger">' . $message . '</div>';
}

/**
 * Display success message
 * 
 * @param string $message Success message
 * @return string HTML for success message
 */
function displaySuccess($message) {
    return '<div class="alert alert-success">' . $message . '</div>';
}

/**
 * Get random title
 * 
 * @param string $default Default title if no random title is available
 * @return string Random title
 */
function getRandomTitle($default = 'Penawaran Spesial') {
    return getRandomFromJson(RANDOM_TITLES_FILE, $default);
}

/**
 * Get random description
 * 
 * @param string $default Default description if no random description is available
 * @return string Random description
 */
function getRandomDescription($default = 'Dapatkan penawaran terbaik hari ini.') {
    return getRandomFromJson(RANDOM_DESCRIPTIONS_FILE, $default);
}

// The addRandomToTitle function was moved to url_generator.php to avoid duplication
