<?php
// Random content management page
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and is admin
checkAdminAccess();

// Process add title form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_title'])) {
    $title = sanitizeInput($_POST['title']);
    
    if (empty($title)) {
        $error_title = 'Judul tidak boleh kosong.';
    } else {
        if (addRandomContent(RANDOM_TITLES_FILE, $title)) {
            $success_title = 'Judul berhasil ditambahkan.';
        } else {
            $error_title = 'Gagal menambahkan judul.';
        }
    }
}

// Process add description form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_description'])) {
    $description = sanitizeInput($_POST['description']);
    
    if (empty($description)) {
        $error_desc = 'Deskripsi tidak boleh kosong.';
    } else {
        if (addRandomContent(RANDOM_DESCRIPTIONS_FILE, $description)) {
            $success_desc = 'Deskripsi berhasil ditambahkan.';
        } else {
            $error_desc = 'Gagal menambahkan deskripsi.';
        }
    }
}

// Process delete title form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_title'])) {
    $index = (int) $_POST['index'];
    
    if (deleteRandomContent(RANDOM_TITLES_FILE, $index)) {
        $success_title = 'Judul berhasil dihapus.';
    } else {
        $error_title = 'Gagal menghapus judul.';
    }
}

// Process delete description form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_description'])) {
    $index = (int) $_POST['index'];
    
    if (deleteRandomContent(RANDOM_DESCRIPTIONS_FILE, $index)) {
        $success_desc = 'Deskripsi berhasil dihapus.';
    } else {
        $error_desc = 'Gagal menghapus deskripsi.';
    }
}

// Get random content
$titles = readJsonFile(RANDOM_TITLES_FILE);
$descriptions = readJsonFile(RANDOM_DESCRIPTIONS_FILE);

// Include header
include __DIR__ . '/templates/header.php';

// Include random content template
include __DIR__ . '/templates/random_content.php';

// Include footer
include __DIR__ . '/templates/footer.php';

/**
 * Add random content to JSON file
 * 
 * @param string $file JSON file path
 * @param string $content Content to add
 * @return bool Success status
 */
function addRandomContent($file, $content) {
    $data = readJsonFile($file);
    
    // Check if content already exists
    if (in_array($content, $data)) {
        return false;
    }
    
    $data[] = $content;
    return writeJsonFile($file, $data);
}

/**
 * Delete random content from JSON file
 * 
 * @param string $file JSON file path
 * @param int $index Index of content to delete
 * @return bool Success status
 */
function deleteRandomContent($file, $index) {
    $data = readJsonFile($file);
    
    if (isset($data[$index])) {
        array_splice($data, $index, 1);
        return writeJsonFile($file, $data);
    }
    
    return false;
}
