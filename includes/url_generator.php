<?php
// URL Generator functions

/**
 * Generate a new URL with metadata
 * 
 * @param string $title Title for metadata
 * @param string $description Description for metadata
 * @param string $imageUrl Image URL for metadata
 * @param string $finalUrl Final URL to redirect to
 * @return array Generated URL data
 */
function generateUrl($title, $description, $imageUrl, $finalUrl) {
    // Generate random components if empty
    if (empty($title)) {
        $title = getRandomTitle();
    }
    
    if (empty($description)) {
        $description = getRandomDescription();
    }
    
    // Add random strings to title for uniqueness
    $title = addRandomToTitle($title);
    
    // Generate URL components
    $slug = generateRandomString(URL_LENGTH);
    $tracking = generateRandomString(TRACKING_LENGTH);
    $debug = generateRandomString(DEB_LENGTH);
    
    // Generate complete URL
    $urlResult = generateUrlWithParams($slug, $tracking, $debug);
    $url = $urlResult['url'];
    $subdomain = $urlResult['subdomain'];
    
    // Create URL data
    $urlData = [
        'slug' => $slug,
        'title' => $title,
        'description' => $description,
        'image_url' => $imageUrl,
        'final_url' => $finalUrl,
        'tracking' => $tracking,
        'debug' => $debug,
        'subdomain' => $subdomain,
        'created_at' => date('Y-m-d H:i:s'),
        'created_by' => $_SESSION['user'] ?? 'system'
    ];
    
    // Save URL data
    createUrl($urlData);
    
    return [
        'url' => $url,
        'data' => $urlData
    ];
}

/**
 * Generate a complete URL with slug, tracking, and debug parameters
 * 
 * @param string $slug URL slug
 * @param string $tracking Tracking parameter
 * @param string $debug Debug parameter
 * @return string Complete URL
 */
function generateUrlWithParams($slug, $tracking, $debug) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    
    // Generate subdomain if enabled
    $host = DOMAIN;
    $subdomain = '';
    if (USE_RANDOM_SUBDOMAIN) {
        $subdomain = generateRandomSubdomain(SUBDOMAIN_LENGTH);
        $host = $subdomain . '.' . DOMAIN;
    }
    
    // Build URL
    $url = sprintf(
        "%s://%s/s/%s?tr=%s&deb=%s",
        $protocol,
        $host,
        $slug,
        $tracking,
        $debug
    );
    
    // Store the subdomain for history tracking
    return [
        'url' => $url,
        'subdomain' => $subdomain
    ];
}

/**
 * Add random string to title for uniqueness
 * 
 * @param string $title Original title
 * @return string Title with random string
 */
function addRandomToTitle($title) {
    $random = generateRandomString(5);
    return $title . ' ' . $random;
}

// getRandomTitle function is now used from functions.php

// getRandomDescription function is now used from functions.php

// createUrl and getUrlBySlug functions are now used from database.php
