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
        <p>وب سایت نیازمندیها و کاریابی رایگان : <a href="<?php echo $_MAIN_URL ?>">انتخاب شهر و استان</a></p>
    </div>
    <div id="category_list">
        <h2>انتخاب دسته بندی در استان <?php echo $r2['name'] ?> : </h2>
        <ul>
        <?php 
            $sql = "SELECT `id`, `name`, `title`, `icon` FROM `category`";
            $result = mysqli_query($connect,$sql);
            while($r = mysqli_fetch_assoc($result)){
                ?><li><?php echo $r['name'] ?> : 
                    <a href="<?php echo $_MAIN_URL.'s/'.$r2['slug'].'/r/'.$r['title'].''; ?>">آگهی های دسته <?php echo $r['name'] ?></a> -
                    <a href="<?php echo $_MAIN_URL.'s/'.$r2['slug'].'/r/'.$r['title'].'/sitemap.html'; ?>">لیست آگهی ها نسخه ساده </a>

            </li><?php
            }?>
        </ul>
    </div>
    <div id="state_list">
        <h2>انتخاب شهرهای استان <?php echo $r2['name'] ?> : </h2>
        <ul>
            <li>سراسر استان : <a href="<?php echo $_MAIN_URL.'s/'. $r2['slug'].''; ?>">مشاهده آگهی ها</a> - 
            <a href="<?php echo $_MAIN_URL.'s/'. $r2['slug'].'/r/همه/sitemap.html'; ?>">آگهی های استان (نسخه ساده)</a> 
        
        </li>
        <?php 
            $sql = "SELECT `id`, `name`, `slug`, `province_id` FROM `cities` WHERE province_id=".$r2['id'];
            $result = mysqli_query($connect,$sql);
            while($r = mysqli_fetch_assoc($result)){
                ?><li>شهر <?php echo $r['name'] ?> : 
                    
                    <a href="<?php echo $_MAIN_URL.'c/'.$r['slug'].'/sitemap.html'; ?>">انتخاب دسته بندی</a> - 
                    <a href="<?php echo $_MAIN_URL.'c/'.$r['slug'].''; ?>"> آگهی های شهر <?php echo $r['name'] ?></a> - 
                    <a href="<?php echo $_MAIN_URL.'c/'.$r['slug'].'/r/همه/sitemap.html'; ?>">(نسخه ساده) آگهی های شهر <?php echo $r['name'] ?></a>
            </li><?php
            }?>
        </ul>
    </div>
</body>
</html>