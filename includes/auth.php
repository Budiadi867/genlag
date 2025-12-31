<?php
// Authentication functions

/**
 * Authenticate user
 * 
 * @param string $username Username
 * @param string $password Password
 * @return bool Whether authentication was successful
 */
function authenticateUser($username, $password) {
    $users = readJsonFile(USERS_FILE);
    
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            // Cek panjang hash untuk menentukan apakah MD5 atau SHA-256
            $hash_length = strlen($user['password']);
            
            // MD5 hash (32 karakter)
            if ($hash_length == 32 && $user['password'] === md5($password)) {
                // Set session variables
                $_SESSION['user'] = $username;
                $_SESSION['role'] = $user['role'] ?? 'user';
                $_SESSION['last_activity'] = time();
                return true;
            }
            // SHA-256 hash (64 karakter)
            else if ($hash_length == 64 && $user['password'] === hash('sha256', $password)) {
                // Set session variables
                $_SESSION['user'] = $username;
                $_SESSION['role'] = $user['role'] ?? 'user';
                $_SESSION['last_activity'] = time();
                return true;
            }
        }
    }
    
    return false;
}

/**
 * Logout user
 */
function logoutUser() {
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
}

/**
 * Check if user has access
 * 
 * @return bool Whether user has access
 */
function checkAccess() {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
    
    // Update last activity time
    $_SESSION['last_activity'] = time();
    return true;
}

/**
 * Check if user is admin
 * 
 * @return bool Whether user is admin
 */
function isAdmin() {
    if (!isLoggedIn()) {
        return false;
    }
    
    $users = readJsonFile(USERS_FILE);
    foreach ($users as $user) {
        if ($user['username'] === $_SESSION['user'] && isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
    }
    
    return false;
}

/**
 * Check if user is admin and redirect if not
 */
function checkAdminAccess() {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
    
    if (!isAdmin()) {
        // Not an admin
        $_SESSION['error_message'] = 'Anda tidak memiliki akses administrator.';
        redirect('generator.php');
    }
    
    // Update last activity time
    $_SESSION['last_activity'] = time();
    return true;
}
