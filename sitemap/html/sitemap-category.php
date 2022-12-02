<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>assets/fonts/style.css">
    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>style/html_version.css">
</head>
<body>
    <div id="header">
        <h1>بخر بفروش</h1>
        <p>وب سایت نیازمندیها و کاریابی رایگان : <a href="<?php echo $_MAIN_URL ?>sitemap.html">انتخاب شهر و استان</a></p>
    </div>
    <div id="category_list">
        <h2>انتخاب دسته بندی در شهر <?php echo $r2['name'] ?> : </h2>
        <ul>
        <?php 
            $sql = "SELECT `id`, `name`, `title`, `icon` FROM `category`";
            $result = mysqli_query($connect,$sql);
            while($r = mysqli_fetch_assoc($result)){
                ?><li><?php echo $r['name'] ?> : 
                    <a href="<?php echo $_MAIN_URL.'c/'.$r2['slug'].'/r/'.$r['title'].''; ?>">آگهی های دسته <?php echo $r['name'] ?></a> - 
                    <a href="<?php echo $_MAIN_URL.'c/'.$r2['slug'].'/r/'.$r['title'].'/sitemap.html'; ?>">(نسخه ساده) آگهی های این دسته</a>
            </li><?php
            }?>
        </ul>
    </div>
</body>
</html>