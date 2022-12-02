<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بخر بفروش - نیازمندیها و کاریابی رایگان</title>

    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>assets/fonts/style.css">
    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>style/html_version.css">
</head>
<body>
    <div id="header">
        <h1>بخر بفروش</h1>
        <p>وب سایت نیازمندیها و کاریابی رایگان</p>
    </div>
    <div id="category_list">
        <h2>انتخاب دسته بندی : </h2>
        <ul>
        <?php 
            
            $sql = "SELECT `id`, `name`, `title`, `icon` FROM `category`";
            $result = mysqli_query($connect,$sql);
            while($r = mysqli_fetch_assoc($result)){
                ?><li><?php echo $r['name'] ?> : 
                    <a href="<?php echo $_MAIN_URL.'s/ایران/r/'.$r['title'].''; ?>">آگهی های دسته <?php echo $r['name'] ?></a> -
                    <a href="<?php echo $_MAIN_URL.'s/ایران/r/'.$r['title'].'/sitemap.html'; ?>">(نسخه ساده) آگهی های دسته <?php echo $r['name'] ?></a>
            </li><?php
            }?>
        </ul>
    </div>
    <div id="state_list">
        <h2>انتخاب استان : </h2>
        <ul>
            <li>سراسر ایران : <a href="<?php echo $_MAIN_URL.'s/ایران'; ?>">مشاهده آگهی ها</a>
        - <a href="<?php echo $_MAIN_URL.'s/ایران/r/همه/sitemap.html'; ?>">لیست آگهی ها نسخه ساده</a>
        </li>
            
        <?php 
            $sql = "SELECT `id`, `name`, `slug` FROM `provinces`";
            $result = mysqli_query($connect,$sql);
            while($r = mysqli_fetch_assoc($result)){
                ?><li>استان <?php echo $r['name'] ?> : 
                    <a href="<?php echo $_MAIN_URL.'s/'.$r['slug'].'/sitemap.html'; ?>">انتخاب شهر</a> -
                    <a href="<?php echo $_MAIN_URL.'s/'.$r['slug'].''; ?>"> آگهی های استان <?php echo $r['name']; ?></a> -
                    <a href="<?php echo $_MAIN_URL.'s/'.$r['slug'].'/r/همه/sitemap.html'; ?>">آگهی های استان (نسخه ساده)</a>
                    
            </li><?php
            }?>
        </ul>
    </div>
</body>
</html>