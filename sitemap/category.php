<?php header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    $sql = "SELECT `id`, `name`, `title`, `icon` FROM `category`";
    $result = mysqli_query($connect,$sql);
    while($r = mysqli_fetch_assoc($result)){
        ?><url>
        <loc><?php echo $_MAIN_URL."s/ایران/r/".$r['title']; ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php
    }
    ?>
    
</urlset>
