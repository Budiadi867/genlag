<?php
// Delete URL endpoint
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/url_generator.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
checkAccess();

// Process delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['slug'])) {
    $slug = sanitizeInput($_POST['slug']);
    
    if (deleteUrlBySlug($slug)) {
        $_SESSION['success_message'] = "URL berhasil dihapus.";
    } else {
        $_SESSION['error_message'] = "Gagal menghapus URL.";
    }
}

// Redirect back to history page
redirect('history.php');

/**
 * Delete URL by slug
 * 
 * @param string $slug URL slug
 * @return bool Success status
 */
function deleteUrlBySlug($slug) {
    $urls = readJsonFile(URLS_FILE);
    $newUrls = [];
    $found = false;
    
    foreach ($urls as $url) {
        if ($url['slug'] !== $slug) {
            $newUrls[] = $url;
        } else {
            $found = true;
        }
    }
    
    if ($found) {
        return writeJsonFile(URLS_FILE, $newUrls);
    }
    
    return false;
}
