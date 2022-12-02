<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">


    <meta name="description" content="وب سایت بخر بفروش مرجع نیازمندی ها ، کاریابی و استخدام رایگان ایران است.">
    <meta name="keywords" content="مرجع، خرید و فروش ، رایگان، نیازمندی ها ، کالا، فروشگاه ">
    <meta name="robots" content="">
    <meta name="google-site-verification" content="zBpNeeUWJLCMCzN3DCzHyihzFmsG47dSegYex-2GASw">
    <meta name="copyright" content="وب سایت بخر بفروش">
    <meta name="language" content="fa_IR">
    <meta name="geo" content="IR" />
    <meta name="geo.region" content="IR-07" />
    <!--<meta name="geo.placename" content="Tehran" />-->
    <meta name="geo.position" content="35.689252;51.3896" />
    <meta name="ICBM" content="35.689252, 51.3896" />




<!-- Primary Meta Tags -->
<meta name="title" content="Meta Tags — Preview, Edit and Generate">
<meta name="description" content="With Meta Tags you can edit and experiment with your content then preview how your webpage will look on Google, Facebook, Twitter and more!">

<!-- Open Graph / Facebook -->
<meta property="og:image" content="https://abasbagheri.ir/asset/image/logo-ba4.svg">

<meta property="twitter:image" content="https://abasbagheri.ir/asset/image/logo-ba4.svg">



    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>بخر و بفروش</title>
    <?php 
    include 'views/fonts.php';
    ?>
    <link href="<?php echo $_MAIN_URL ?>assets/fonts/style.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>assets/icon_fonts/style.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/reset.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/header.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/aside.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/main.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/single.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/footer.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/account.css" rel="stylesheet">
    <?php if($is_mobile){
        ?><link href="<?php echo $_MAIN_URL ?>style/mobile.css" rel="stylesheet"><?php
    } ?>

    <!--[if lt IE 9]>
	<script src="script/ie_support.js"></script>
    <link href="style/ie8fix.css" rel="stylesheet">
    <![endif]-->
    <!--[if lt IE 8]>
	<link href="style/iefix.css" rel="stylesheet">
    <![endif]-->
   
    <script>
        var main_url = '<?php echo $_MAIN_URL ?>';
    </script>
	<script src="<?php echo $_MAIN_URL ?>assets/data/categorys.js"></script>
	<script src="<?php echo $_MAIN_URL ?>assets/data/states.js"></script>
	<script src="<?php echo $_MAIN_URL ?>assets/data/cities.js"></script>
	<script src="<?php echo $_MAIN_URL ?>script/product.js?v=4"></script>


</head>
<body>
    <?php 
    if($is_mobile){
        include 'views/mobile-header.php';
    }else{
        include 'views/header.php';
    }
     ?>
    <main id="main_content" class="display_none" >
        <div id="main_container">
            <aside id="main_content_sidebar">
                <header>
                    <h2>دسته بندیها</h2>
                </header>
                <section>
                    <ul id="aside_cateory_list">
                    </ul>
                </section>
                <footer>
                    <ul id="footer_link">
                        <a href="<?php echo $_MAIN_URL ?>support" title="پشتیبانی"><li>پشتیبانی</li></a>
                        <a href="<?php echo $_MAIN_URL ?>about"  title="شرایط استفاده"><li>شرایط استفاده</li></a>
                        <a href="<?php echo $_MAIN_URL ?>contact"  title="ارتباط با ما"><li>ارتباط با ما</li></a>
                        <a href="<?php echo $_MAIN_URL ?>blog"  title="مقالات و نوشته ها"><li>مقالات</li></a>
                    </ul>
                    <ul id="footer_sosial">
                        <a href="#" title="ما را در اینستاگرام دنبال کنید"><li><i class="icon-instagram"></i></li></a>
                        <a href="#"  title="ما را در توئیتر دنبال کنید"><li><i class="icon-twitter"></i></li></a>
                        <a href="#" title="ما را در تلگرام دنبال کنید"><li><i class="icon-telegram"></i></li></a>
                        <a href="#" title="ما را در لینکدین دنبال کنید"><li><i class="icon-linkedin"></i></li></a>
                    </ul>
                </footer>
            </aside>
            <section id="Product_list">
                <header id="section_header">
                    <h2 id="heading_title"></h2>
                    <?php 
                    if($is_mobile){
                        ?><h2 id="category_name_title">دسته بندی :  </h2><?php
                    }
                    ?>
                    <div id="refresh_button"><i class="icon-repeat"></i></div>
                </header>
                <section id="product_Container">
                    <div id="productHolder">
                        <?php //include 'views/product_list.php' ?>
                    </div>
                    <!--<div id="loading_Product">
                        <img src="assets/image/loading/Blocks-1s-200px.png">
                    </div>
                    <div id="empty_loading">
                        <div><i class="icon-empty-21"></i></div>
                        <p>متاسفانه موردی مطابق جستجوی شما یافت نشد.</p>
                    </div>
                    <div id="network_error">
                        <div><i class="icon-signal_cellular_connected_no_internet_4_bar"></i></div>
                        <p>ارتباط شما با سرور ما قطع است.</p>
                        <button>دوباره امتحان کنید</button>
                    </div>-->
                </section>
            </section>
        </div>
        <script>
            <?php 
            if($page_default == '0'){
                ?>history.pushState(null,'','<?php echo $_MAIN_URL.$_USER['location_slug'].$_USER['category_slug'];
                if($q != ''){
                    echo '?q='.$q;
                }
                ?>');<?php
            }
            
            ?>
            
        </script>
    </main>
    <main id="loading_viewer" >
        <div class="loading_holder">
            <img src="<?php echo $_MAIN_URL.'assets/image/loading/loadingw.gif' ?>">
            <span>در حال بارگیری اطلاعات</span>
        </div>
    </main>
    <?php
    if($is_mobile){
        include 'views/mobile-single.php';
    }else{
        include 'views/single.php';
    }
    
    ?>
    <?php if($_USER['status']!='LOGIN'){ include 'views/login-form.php'; } ?>
</body>
<div id="select_city">
    <div id="select_city_container">
        <div id="select_city_header">
            <button id="select_city_back_button"><i class="icon-arrow-thin-right"></i></button>
            <h2 id="select_city_title">انتخاب استان</h2>
        </div>
        <div id="select_state">
            <ul id="select_state_selector">
            </ul>
        </div>
    </div>
</div>
<div id="report_post">
    <div id="report_post_layout">
        <header>
            <button id="exit_report_post"><i class="icon-arrow-thin-right"></i></button>
            <h2>گزارش مشکل در آگهی</h2>
        </header>
        <main>
            <div class="container">
                <h3>به نظر شما آگهی چه مشکلی دارد؟</h3>
                <div id="report_text">
                    <textarea id="report_text_input" placeholder="به پاکسازی و امن سازی وب سایت کمک کنید ..."></textarea>
                </div>
                <span>20 کاراکتر باید وارد کنید ...</span>
                <div id="loading_holder_report">
                    <img src="">
                </div>
            </div>
            
        </main>
        <footer>
            <button class="right" id="exit_report_post_footer">انصراف</button>
            <button class="left disable" id="send_data_form">ارسال گزارش</button>
        </footer>
    </div>
</div>

<!--[if lt IE 10]>
	<script src="script/input_fixer.js"></script>
<![endif]-->
<script src="<?php echo $_MAIN_URL ?>script/header.js" ></script>
<script src="<?php echo $_MAIN_URL ?>script/side.js" ></script>
<script src="<?php echo $_MAIN_URL ?>script/image_slider.js" ></script>
<script src="<?php echo $_MAIN_URL ?>script/single.js" ></script>
<script src="<?php echo $_MAIN_URL ?>script/account.js" ></script>
<?php 
if($is_mobile){
    ?><script src="<?php echo $_MAIN_URL ?>script/mobile.js" ></script>
    <?php
}

?>
</html> 