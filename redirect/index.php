<?php
// Redirect endpoint
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/metadata.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Debug log
error_log("Redirect handler started");
error_log("Request URI: " . $_SERVER['REQUEST_URI']);
error_log("User Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'None'));

// Function to check if the request is from a social media crawler
function isSocialMediaCrawler() {
    if (!isset($_SERVER['HTTP_USER_AGENT'])) {
        return false;
    }
    
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $crawlers = [
        'facebookexternalhit',
        'facebook',
        'twitterbot',
        'whatsapp',
        'telegram',
        'linkedinbot',
        'line',
        'instagram',
        'pinterest',
        'slackbot'
    ];
    
    foreach ($crawlers as $crawler) {
        if (strpos($userAgent, $crawler) !== false) {
            error_log("Detected social media crawler: " . $crawler);
            return true;
        }
    }
    
    return false;
}

// Set crawler status
$isCrawler = isSocialMediaCrawler();

// Set cache control headers for social media crawlers
if ($isCrawler) {
    // Don't cache responses for crawlers
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
} else {
    // Cache regular user responses for a short time
    header("Cache-Control: public, max-age=60"); // 1 minute cache
}

// Get slug from URL - either from the URL path or from the query parameter
$slug = '';

// Check if slug is passed as a GET parameter (from the Nginx rewrite)
if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    // Strip query parameters if they exist in the slug
    if (strpos($slug, '?') !== false) {
        $slug = substr($slug, 0, strpos($slug, '?'));
    }
    error_log("Slug from GET parameter: " . $slug);
} else {
    // Get slug from URL path
    $requestUri = $_SERVER['REQUEST_URI'];
    $parts = explode('/', trim($requestUri, '/'));

    // Check if this is a valid redirect URL
    if (count($parts) >= 2 && $parts[0] === 's') {
        $slug = $parts[1];
        // Strip query parameters if they exist in the slug
        if (strpos($slug, '?') !== false) {
            $slug = substr($slug, 0, strpos($slug, '?'));
        }
        error_log("Slug from URI path: " . $slug);
    }
}

if (!empty($slug)) {
    // Get URL data from slug
    $urlData = getUrlBySlug($slug);
    
    if ($urlData) {
        error_log("URL data found for slug: " . $slug);
        
        // Increment click counter if not a crawler
        if (!$isCrawler) {
            incrementUrlClicks($slug);
        }
        
        // Generate HTML with metadata and redirect
        echo generateRedirectHtml($urlData, $isCrawler);
        exit;
    } else {
        error_log("No URL data found for slug: " . $slug);
    }
} else {
    error_log("No slug found in request");
}

// If no valid URL found, redirect to homepage
error_log("Redirecting to homepage");
header('Location: /');
exit;
