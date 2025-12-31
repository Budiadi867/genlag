<?php
// Metadata handling functions

/**
 * Generate Open Graph metadata tags
 * 
 * @param array $data URL data
 * @return string HTML for Open Graph metadata
 */
function generateOpenGraphMetadata($data) {
    $html = '';
    
    // Basic Open Graph tags
    $html .= '<meta property="og:title" content="' . htmlspecialchars($data['title']) . '" />' . "\n";
    $html .= '<meta property="og:description" content="' . htmlspecialchars($data['description']) . '" />' . "\n";
    $html .= '<meta property="og:image" content="' . htmlspecialchars($data['image_url']) . '" />' . "\n";
    $html .= '<meta property="og:url" content="' . htmlspecialchars($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . '" />' . "\n";
    $html .= '<meta property="og:type" content="website" />' . "\n";
    
    // Image dimensions and type can help crawlers
    // Assuming most images are 1200x630 (standard OG image size)
    $html .= '<meta property="og:image:width" content="1200" />' . "\n";
    $html .= '<meta property="og:image:height" content="630" />' . "\n";
    $html .= '<meta property="og:image:type" content="image/jpeg" />' . "\n";
    
    // Site name
    $html .= '<meta property="og:site_name" content="' . htmlspecialchars(SITE_NAME) . '" />' . "\n";
    
    // Locale
    $html .= '<meta property="og:locale" content="id_ID" />' . "\n";
    
    // Facebook specific tags
    $html .= '<meta property="fb:app_id" content="' . htmlspecialchars(FB_APP_ID) . '" />' . "\n";
    
    // Twitter Card tags
    $html .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    $html .= '<meta name="twitter:title" content="' . htmlspecialchars($data['title']) . '" />' . "\n";
    $html .= '<meta name="twitter:description" content="' . htmlspecialchars($data['description']) . '" />' . "\n";
    $html .= '<meta name="twitter:image" content="' . htmlspecialchars($data['image_url']) . '" />' . "\n";
    
    return $html;
}

/**
 * Generate HTML for redirect page with metadata
 * 
 * @param array $data URL data
 * @param bool $isCrawler Whether the request is from a social media crawler
 * @return string HTML for redirect page
 */
function generateRedirectHtml($data, $isCrawler = false) {
    // Debug info
    error_log("Generating redirect HTML for URL: " . ($data['final_url'] ?? 'unknown'));
    error_log("Is crawler: " . ($isCrawler ? 'Yes' : 'No'));
    
    $html = '<!DOCTYPE html>' . "\n";
    $html .= '<html lang="id" prefix="og: https://ogp.me/ns#">' . "\n";
    $html .= '<head>' . "\n";
    $html .= '    <meta charset="UTF-8">' . "\n";
    $html .= '    <meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
    $html .= '    <title>' . htmlspecialchars($data['title']) . '</title>' . "\n";
    
    // Add canonical URL
    $html .= '    <link rel="canonical" href="' . htmlspecialchars($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . '" />' . "\n";
    
    // Add Open Graph metadata
    $html .= generateOpenGraphMetadata($data);
    
    // Add CSS for styling
    $html .= '    <style>' . "\n";
    $html .= '        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }' . "\n";
    $html .= '        .container { max-width: 600px; margin: 0 auto; padding: 20px; }' . "\n";
    $html .= '        h1, h2 { color: #333; }' . "\n";
    $html .= '        .image-container { margin: 20px 0; max-width: 100%; }' . "\n";
    $html .= '        .image-container img { max-width: 100%; height: auto; border-radius: 8px; }' . "\n";
    $html .= '        .loader { width: 50px; height: 50px; border: 5px solid #f3f3f3; border-top: 5px solid #3498db; border-radius: 50%; animation: spin 2s linear infinite; margin: 20px auto; }' . "\n";
    $html .= '        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }' . "\n";
    $html .= '    </style>' . "\n";
    
    // Only add redirect for non-crawlers
    if (!$isCrawler) {
        $html .= '    <meta http-equiv="refresh" content="10;url=' . htmlspecialchars($data['final_url']) . '">' . "\n";
        $html .= '    <script>setTimeout(function() { window.location.href = "' . htmlspecialchars($data['final_url']) . '"; }, 850);</script>' . "\n";
    }
    
    $html .= '</head>' . "\n";
    $html .= '<body>' . "\n";
    $html .= '</body>' . "\n";
    $html .= '</html>';
    
    return $html;
}
