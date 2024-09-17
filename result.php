<?php

if (isset($_POST['submit'])) {
    $url = $_POST['link'];

    // Load the HTML content from the provided URL
    $htmlContent = file_get_contents($url); // Make sure the URL is valid and accessible

    // Create a new DOMDocument instance
    $dom = new DOMDocument();

    // Suppress errors due to malformed HTML
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
    foreach ($links as $linkElement) {
        // Make sure $linkElement is an instance of DOMElement
        if ($linkElement instanceof DOMElement) {
            $href = $linkElement->getAttribute('href');

            // Check if the link is absolute
            if (!preg_match('/^http/', $href)) {
                // If the link is relative, convert it to an absolute URL
                $baseUrl = $url; // Use the original URL as the base
                $href = rtrim($baseUrl, '/') . '/' . ltrim($href, '/');
            }

            $hrefs[] = $href;
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sitemap Result Links</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .link-div {
            max-height: 450px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <div class="container mt-4 box">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Sitemap Result Links</h2>
                    <div>
                    <a href="sitemap_url.php" class="btn btn-warning btn-sm px-4">Go Back</a>
                    </div>
                </div>

                <?php if (!empty($hrefs)): ?>
                    <div id="sitemapLinks" class="form-control link-div">
                    
                        <?php
                        
                        foreach ($hrefs as $href) {
                            echo '&lt;url&gt;<br>';
                            echo '&lt;loc&gt;' . htmlspecialchars($href) . '&lt;/loc&gt;<br>';
                            echo '&lt;lastmod&gt;2024-09-16T17:48:56+00:00&lt;/lastmod&gt;<br>';
                            echo '&lt;priority&gt;0.80&lt;/priority&gt;<br>';
                            echo '&lt;/url&gt;<br><br>';
                        }


                        ?>
                    </div>
                    <button id="copyButton" class="btn btn-primary mt-2">Copy All Links</button>
                <?php else: ?>
                    <p>No links found. Please try with a different URL.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            var sitemapLinks = document.getElementById('sitemapLinks');
            var range = document.createRange();
            range.selectNode(sitemapLinks);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);

            try {
                // Copy the text to the clipboard
                var successful = document.execCommand('copy');
                var msg = successful ? 'Sitemap links copied to clipboard!' : 'Failed to copy text.';
                alert(msg);
            } catch (err) {
                alert('Oops, unable to copy');
            }

            // Remove selection
            window.getSelection().removeAllRanges();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>