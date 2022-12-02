<?php header('Content-type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php
    $sql = "SELECT  `title`, `uniccode` FROM `post` ORDER BY id DESC LIMIT 50000";
    $result = mysqli_query($connect,$sql);
    while($r = mysqli_fetch_assoc($result)){
        ?><url>
        <loc><?php echo $_MAIN_URL."p/".$r['uniccode'].'/'.str_replace(' ','-',$r['title']); ?></loc>
        <changefreq>never</changefreq>
        <priority>0.9</priority>
    </url><?php 
    }
    ?>
</urlset>