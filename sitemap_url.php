<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap</title>
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <?php


// Load the HTML content from a URL or a local file
$htmlContent = file_get_contents('https://www.xebecmarine.com//'); // Replace with your URL or local file path

// Create a new DOMDocument instance
$dom = new DOMDocument();

// Suppress errors due to malformed HTML by using '@'
libxml_use_internal_errors(true);

// Load the HTML content into the DOMDocument
$dom->loadHTML($htmlContent);

// Clear any errors
libxml_clear_errors();

// Create a DOMXPath instance to query the DOM
$xpath = new DOMXPath($dom);

// Find all anchor tags <a> in the HTML
$links = $xpath->query('//a');

// Initialize an array to store the href values
$hrefs = [];

// Loop through each link and extract the href attribute
foreach ($links as $link) {
    // Make sure $link is an instance of DOMElement
    if ($link instanceof DOMElement) {
        $href = $link->getAttribute('href');
        
        // Check if the link is absolute
        if (!preg_match('/^http/', $href)) {
            // If the link is relative, convert it to an absolute URL
            $baseUrl = 'https://www.xebecmarine.com//'; // Base URL of the website
            $href = rtrim($baseUrl, '/') . '/' . ltrim($href, '/');
        }
        
        $hrefs[] = $href;
    }
}

// Output the list of links in XML-like format
foreach ($hrefs as $href) {
    echo '&lt;url&gt;<br>';
    echo '&lt;loc&gt;' . htmlspecialchars($href) . '&lt;/loc&gt;<br>';
    echo '&lt;lastmod&gt;2024-09-16T17:48:56+00:00&lt;/lastmod&gt;<br>';
    echo '&lt;priority&gt;0.80&lt;/priority&gt;<br>';
    echo '&lt;/url&gt;<br><br>';
}

?>

</body>

</html>