<?php 

$locationQuery = '';
if($city_slug == 'ایران'){
    $locationQuery = '';
}elseif($stat == 'state'){
    $state_id = $r2['id'];
    $locationQuery = "AND city IN (SELECT `id` FROM `cities` WHERE `province_id`=$state_id)";
}elseif($stat == 'city'){
    $state_id = $r2['id'];
    $locationQuery = "AND city = $state_id";
}
$categoryQuery = '';
if($category_slug == ''){
    $categoryQuery = '';
}else{
    $categoryQuery = "AND category=".$r3['id'];
}



?>
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
        <h2>لیست آگهی ها</h2>
        <ul>
        <?php 
            
            $sql = "SELECT title,uniccode FROM `post` WHERE id < 999999999 $categoryQuery $locationQuery ORDER BY id DESC";
            $result = mysqli_query($connect,$sql);
            while($r = mysqli_fetch_assoc($result)){
                ?><li>آگهی : 
                    <a href="<?php echo $_MAIN_URL.'p/'.$r['uniccode'].'/'.str_replace(' ','-',$r['title']).''; ?>"><?php echo $r['title']; ?></a>
            </li><?php
            }?>
        </ul>
    </div>
</body>
</html>