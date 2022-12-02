<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <title>صفحه کاربری</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>assets/fonts/style.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>assets/icon_fonts/style.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>style/reset.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>style/account.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>style/footer.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>style/user.css">
        <script>
            var main_url = '<?php echo $_MAIN_URL; ?>';
            var current_post = '<?php echo $input; ?>';
            var ucode = '<?php echo $unic_code; ?>';
        </script>
        <script src="<?php echo $_MAIN_URL; ?>assets/image/loading/loadingw.gif"></script>

    </head>
    <body>
        <header id="user_header">
            <div id="header_container">
                <button id="btn_menu_mobile"><i class="icon-menu"></i></button>
                <button id="btn_more_mobile"><i class="icon-more_vert"></i></button>
                <h3 id="page_title">محیط کاربری</h3>
                <h2>بخربفروش</h2>
                <ul id="nav_menu_user">
                    <a href="<?php echo $_MAIN_URL; ?>" title="صفحه اصلی"></title>>
                        <li>خانه</li>
                    </a>
                    <a href="<?php echo $_MAIN_URL; ?>support" title="پشتیبانی وب سایت ">
                        <li>پشتیبانی</li>
                    </a>
                    <a href="<?php echo $_MAIN_URL; ?>contact" title="ارتباط با ما"></title>>
                        <li>ارتباط با ما</li>
                    </a>
                    <a href="<?php echo $_MAIN_URL; ?>blog" title="نوشته ها و مقالات">
                        <li>بلاگ</li>
                    </a>
                    <a href="<?php echo $_MAIN_URL; ?>chat" title="گفت و گو با کاربران">
                        <li>گفت و گو</li>
                    </a>
                </ul>
                <a href="<?php echo $_MAIN_URL; ?>new">
                    <button id="add_post">ثبت آگهی رایگان</button>
                </a>
            </div>
        </header>
        <?php
        if($_USER['status']=='LOGIN'){
            ?><main>
            <div class="container">
                <aside id="user_aside">
                    <div id="user_info">
                        <span><i class="icon-user"></i><span>نام : عباس باقری</span></span>
                        <span><i class="icon-phone"></i><span>شماره تلفن : 09015827703</span></span>
                        <span><i class="icon-at"></i><span>آدرس ایمیل : abasbagheria@gmail.com</span></span>
                    </div>
                    <ul id="userpanel_maenu">
                        <li id="menu_mypost_button" class="selected"><i class="icon-text"></i><span>آگهی های من</span><i class="icon-angle-left"></i></li>
                        <li id="menu_bookmark_button" ><i class="icon-bookmark"></i><span>آگهی های نشان شده</span><i class="icon-angle-left"></i></li>
                        <li id="menu_history_button"><i class="icon-history"></i><span>بازدیدهای اخیر</span><i class="icon-angle-left"></i></li>
                        <a href="<?php echo $_MAIN_URL ?>chat"><li><i class="icon-comments"></i><span>گفت و گو</span><i class="icon-angle-left"></i></li></a>
                        <a href="<?php echo $_MAIN_URL ?>logout"><li><i class="icon-sign-out"></i><span>خروج از حساب کاربری</span><i class="icon-angle-left"></i></li></a>
                    </ul>
                </aside>
                <div id="section_holder">
                    <section id="user_section">
                        <header>
                            <h1 id="page_title2">لیست آگهی های من</h1>
                        </header>
                        <div id="loading_view" class="display_none">
                            <img src="<?php echo $_MAIN_URL ?>assets/image/loading/loadingw.gif" alt="">
                            <span>در حال بارگیری اطلاعات</span>
                        </div>
                        
                        <div id="mylist" class="display_none">
                        
                        </div>
                        <div id="empty_error" class="display_none">
                            <i class="icon-empty-24"></i>
                            <span>متاسفانه موردی یافت نشد</span>
                        </div>
                        <!--<header>
                            <h1>لیست آگهی نشان شده</h1>
                        </header>
                        <div id="mylist" class="listView">
                        
                        </div>-->
                        <!--<header>
                            <h1>مدیریت آگهی</h1>
                        </header>-->
                        <div id="post_managment" class="display_none">
                            <div class="post_container">
                                <header>
                                    <h2>وضعیت آگهی : منتشر شده</h2>
                                    <button id="delete_post_button">حذف آگهی</button>
                                </header>
                                <div id="top_partition">
                                    <div id="image_view">
                                        <div class="image_slider" id="main_image_shower">
                                            <div id="slider_holder">
                                                <div class="slide"><img src="<?php echo $_MAIN_URL; ?>assets/image/post/th-3685-1.jpeg"></div>
                                                <div class="slide"><img src="<?php echo $_MAIN_URL; ?>assets/image/post/th-3685-2.jpeg"></div>
                                                <div class="slide"><img src="<?php echo $_MAIN_URL; ?>assets/image/post/th-3685-3.jpeg"></div>
                                                <div class="slide"><img src="<?php echo $_MAIN_URL; ?>assets/image/post/th-3685-4.jpeg"></div>
                                                
                                            </div>
                                            <div id="slide_controller">
                                                <button id="slide_go_left_button" class="icon-angle-left"></button>
                                                <button id="slide_go_right_button" class="icon-angle-right"></button>
                                                <button id="remove_image" class="icon-delete"></button>
                                                <input id="image_input" name="image_input" type="file" accept="image/gif ,image/webp , image/png , image/jpeg ,image/jpg">
                                                <label id="upload_new_image" for="image_input" class="icon-upload"></label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div id="introView">
                                        <h3 id="category_h3">دسته بندی : مسکن</h3>
                                        <h3 id="location_h3">موقعیت : تهران</h3>
                                        <h3 id="type_h3">نوع آگهی : فروشی</h3>
                                        <h3 id="status_h3">وضعیت کالا : نو</h3>
                                        <h3 id="time_h3">تاریخ آگهی : 25 اسفند 1386</h3>
                                        <h3 id="code_h3">کد آگهی : SCETA</h3>
                                    </div>
                                </div>
                                <div id="editable_option">
                                    <div id="editTitle" class="edit_item">
                                        <h3>عنوان آگهی : </h3>
                                        <input type="text" id="post_title_edit" placeholder="عنوان آگهی">
                                        <span>نباید کمتر از 25 کاراکتر باشد</span>
                                    </div>
                                    <div id="editBody" class="edit_item" id="postBody">
                                        <h3>توضیحات آگهی : </h3>
                                        <textarea name="" id="post_body_edit"></textarea>
                                        <span>نباید از 45 کاراکتر کمتر باشد</span>
                                    </div>
                                    <div id="editPrice" class="edit_item">
                                        
                                    </div>
                                    <div id="editVideo" class="edit_item">
                                        <h3>لینک فیلم آگهی : </h3>
                                        <input type="text" id="post_video_edit" placeholder="لینک آپارات">
                                        <span>لینک فیلم شما در آپارات</span>
                                    </div>
                                    <div id="buttonHolder">
                                        <button id="setPostUpdateButton">ذخیره تغییرات</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
        <?php
        } else {
            include 'views/login-form.php';
        }
        ?>
        <footer id="main_footer">
            <div id="footer_content">
                <div id="footer_right_section">
                    <h3>بخربفروش</h3>
                    <ul>
                        <a href="#"><li>پشتیبانی</li></a>
                        <a href="#"><li>درباره ما</li></a>
                        <a href="#"><li>ارتباط با ما</li></a>
                        <a href="#"><li>مقالات</li></a>
                    </ul>
                </div>
                <div id="footer_left_section">
                    <ul>
                        <a href="#"><li><i class="icon-instagram"></i></li></a>
                        <a href="#"><li><i class="icon-twitter"></i></li></a>
                        <a href="#"><li><i class="icon-telegram"></i></li></a>
                        <a href="#"><li><i class="icon-linkedin"></i></li></a>
                    </ul>
                </div>
            </div>
        </footer>
        <div id="user_start_view">
            <img src="<?php echo $_MAIN_URL ?>assets/image/loading/loadingw.gif" alt="">
            <span>در حال بارگیری اطلاعات</span>
        </div>
    </body>
    <script src="<?php echo $_MAIN_URL ?>script/user.js"></script>
</html>