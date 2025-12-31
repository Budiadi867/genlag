<?php
// Configuration file
define('APP_NAME', 'POST IMG');
define('APP_VERSION', '2.0.0');

// Define the base path directly for datlnglove.my.id
$detected_path = '/www/wwwroot/all-domain/myonlyfans.biz.id/genlag';

define('BASE_PATH', $detected_path);
define('DATA_PATH', BASE_PATH . '/data');
define('DOMAIN', 'myonlyfans.biz.id');
define('SESSION_TIMEOUT', 3600); // 1 hour

// JSON file paths
define('USERS_FILE', DATA_PATH . '/users.json');
define('URLS_FILE', DATA_PATH . '/urls.json');
define('RANDOM_TITLES_FILE', DATA_PATH . '/random_titles.json');
define('RANDOM_DESCRIPTIONS_FILE', DATA_PATH . '/random_descriptions.json');

// URL generation settings
define('URL_LENGTH', 10); // Length of random string in URL
define('TRACKING_LENGTH', 8); // Length of tracking parameter
define('DEB_LENGTH', 6); // Length of debug parameter

// Subdomain settings
define('USE_RANDOM_SUBDOMAIN', true);
define('SUBDOMAIN_LENGTH', 8); // Length of random subdomain

// Security settings
define('HASH_SALT', 'nPoS7#8lQkRt@2xH4zYvM6!9dK3bF'); // Random salt untuk keamanan

// Site and social media settings
define('SITE_NAME', 'myonlyfans ');
define('FB_APP_ID', '123456789'); // Replace with your actual Facebook App ID if available
