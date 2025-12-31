<?php
// Database functions for JSON file handling

/**
 * Ensure data directory exists and is writable
 */
function ensureDataDirectoryExists() {
    if (!is_dir(DATA_PATH)) {
        if (!mkdir(DATA_PATH, 0777, true)) {
            error_log("Failed to create data directory: " . DATA_PATH);
            return false;
        }
        chmod(DATA_PATH, 0777); // Make sure it's writable
    } else if (!is_writable(DATA_PATH)) {
        if (!chmod(DATA_PATH, 0777)) {
            error_log("Failed to make data directory writable: " . DATA_PATH);
            return false;
        }
    }
    
    // Initialize empty JSON files if they don't exist
    $files = [USERS_FILE, URLS_FILE, RANDOM_TITLES_FILE, RANDOM_DESCRIPTIONS_FILE];
    foreach ($files as $file) {
        if (!file_exists($file)) {
            $default_content = '[]';
            if ($file === USERS_FILE) {
                // Create default admin user if users file doesn't exist
                $default_content = '[{"username":"admin","password":"8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918","role":"admin"}]';
            } else if ($file === RANDOM_TITLES_FILE) {
                $default_content = '["Artikel Menarik", "Berita Terbaru", "Info Penting", "Wajib Tahu", "Artikel Terpopuler"]';
            } else if ($file === RANDOM_DESCRIPTIONS_FILE) {
                $default_content = '["Temukan informasi menarik di artikel ini", "Artikel terbaru yang wajib Anda baca", "Informasi penting yang mungkin Anda lewatkan"]';
            }
            file_put_contents($file, $default_content);
            chmod($file, 0666); // Make file readable and writable
        }
    }
    
    return true;
}

// Ensure data directory exists when this file is loaded
ensureDataDirectoryExists();

/**
 * Read data from a JSON file
 * 
 * @param string $file Path to JSON file
 * @return array Data from JSON file
 */
function readJsonFile($file) {
    // Debug info
    error_log("Attempting to read file: " . $file);
    
    // Check if file exists with full diagnostics
    if (!file_exists($file)) {
        error_log("File does not exist: " . $file);
        error_log("Current working directory: " . getcwd());
        error_log("open_basedir: " . ini_get('open_basedir'));
        
        // Try to find the file in a different location if path starts with /www/wwwroot
        if (strpos($file, '/www/wwwroot/lovelive.sbs') === 0) {
            $alternate_path = str_replace('/www/wwwroot/lovelive.sbs', '/home/xpost/lovelive.sbs/genlag', $file);
            error_log("Trying alternate path: " . $alternate_path);
            
            if (file_exists($alternate_path)) {
                error_log("Found file at alternate path");
                $file = $alternate_path;
            }
        }
        
        if (!file_exists($file)) {
            return [];
        }
    }
    
    $content = file_get_contents($file);
    if (empty($content)) {
        error_log("File is empty: " . $file);
        return [];
    }
    
    $json_data = json_decode($content, true);
    if ($json_data === null && json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON decode error: " . json_last_error_msg() . " in file: " . $file);
        return [];
    }
    
    return $json_data ?: [];
}

/**
 * Write data to a JSON file
 * 
 * @param string $file Path to JSON file
 * @param array $data Data to write
 * @return bool Success status
 */
function writeJsonFile($file, $data) {
    $dir = dirname($file);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    
    $json = json_encode($data, JSON_PRETTY_PRINT);
    return file_put_contents($file, $json) !== false;
}

/**
 * Get a random item from a JSON file
 * 
 * @param string $file Path to JSON file
 * @return string Random item
 */
function getRandomFromJson($file, $default = '') {
    $items = readJsonFile($file);
    if (empty($items)) {
        return $default;
    }
    
    return $items[array_rand($items)];
}

/**
 * Create a new URL entry
 * 
 * @param array $data URL data
 * @return bool Success status
 */
function createUrl($data) {
    $urls = readJsonFile(URLS_FILE);
    $urls[] = $data;
    return writeJsonFile(URLS_FILE, $urls);
}

/**
 * Get URL data by slug
 * 
 * @param string $slug URL slug
 * @return array|null URL data or null if not found
 */
function getUrlBySlug($slug) {
    $urls = readJsonFile(URLS_FILE);
    foreach ($urls as $url) {
        if (isset($url['slug']) && $url['slug'] === $slug) {
            return $url;
        }
    }
    return null;
}

/**
 * Increment the click counter for a URL
 * 
 * @param string $slug URL slug
 * @return bool Success status
 */
function incrementUrlClicks($slug) {
    $urls = readJsonFile(URLS_FILE);
    $updated = false;
    
    foreach ($urls as &$url) {
        if (isset($url['slug']) && $url['slug'] === $slug) {
            // Initialize clicks if it doesn't exist
            if (!isset($url['clicks'])) {
                $url['clicks'] = 0;
            }
            
            // Increment clicks
            $url['clicks']++;
            $updated = true;
            break;
        }
    }
    
    if ($updated) {
        return writeJsonFile(URLS_FILE, $urls);
    }
    
    return false;
}
