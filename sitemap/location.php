<?php header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo $_MAIN_URL."s/ایران"; ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php
    $sql = "SELECT `id`, `name`, `slug` FROM `provinces`";
    $result = mysqli_query($connect,$sql);
    while($r = mysqli_fetch_assoc($result)){
        ?><url>
        <loc><?php echo $_MAIN_URL."s/".$r['slug']; ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php
    }
    ?>
    <?php
    $sql = "SELECT `id`, `name`, `slug`, `province_id` FROM `cities`";
    $result = mysqli_query($connect,$sql);
    while($r = mysqli_fetch_assoc($result)){
        ?><url>
        <loc><?php echo $_MAIN_URL."c/".$r['slug']; ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php
    }
    ?>
</urlset>