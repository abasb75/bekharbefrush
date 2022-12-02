<?php header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc><?php echo $_MAIN_URL; ?>sitemap/category.xml</loc>
    </sitemap>
    <sitemap>
        <loc><?php echo $_MAIN_URL; ?>sitemap/location.xml</loc>
    </sitemap>
    <sitemap>
        <loc><?php echo $_MAIN_URL; ?>sitemap/post.xml</loc>
    </sitemap>
</sitemapindex>