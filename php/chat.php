
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <title>سرویس گفت و گو</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>assets/fonts/style.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>assets/icon_fonts/style.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>style/reset.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>style/account.css">
        <link rel="stylesheet" href="<?php echo $_MAIN_URL ?>style/chat.css?v=2">
        <?php
        if($is_mobile){ 
        ?><link rel="stylesheet" href="<?php echo $_MAIN_URL ?>style/chat-mobile.css"><?php
        }
        ?>
        <script>var main_url = '<?php echo $_MAIN_URL; ?>';</script>
        <script src="<?php echo $_MAIN_URL ?>script/jquery-3.6.0.js"></script>
    </head>
    <body>
        <div id="main">
            <?php 
            if($is_mobile){
                ?><div id="bottom_menu">
                <ul>
                    <a href="<?php echo $_MAIN_URL ?>"><li id="go_home_bottom_menu"><i class="icon-home-with-zoom-tool-svgrepo-com"></i><span>خانه</span></li></a>
                    <a href="<?php echo $_MAIN_URL ?>"><li id="show_category_on_mobile"><i class="icon-menu1"></i><span>دسته بندی</span></li></a>
                    <a href="<?php echo $_MAIN_URL ?>new"><li id="header_add_post"><i class="icon-plus1"></i><span>ثبت آگهی</span></li></a>
                    <li><i class="icon-comments"></i><span>گفت و گو</span></li>
                    <a href="<?php echo $_MAIN_URL ?>user"><li id="header_myaccount_button"><i class="icon-user"></i><span>حساب من</span></li></a>
                </ul>
            </div><?php
            }else{
                ?><header id="user_header">
                <div id="header_container">
                    <h2>بخربفروش</h2>
                    <ul id="nav_menu_user">
                        <a href="<?php echo $_MAIN_URL; ?>">
                            <li>خانه</li>
                        </a>
                        <a href="<?php echo $_MAIN_URL; ?>support">
                            <li>پشتیبانی</li>
                        </a>
                        <a href="<?php echo $_MAIN_URL; ?>contact">
                            <li>ارتباط با ما</li>
                        </a>
                        <a href="<?php echo $_MAIN_URL; ?>blog">
                            <li>بلاگ</li>
                        </a>
                        <a href="<?php echo $_MAIN_URL; ?>user">
                            <li>حساب من</li>
                        </a>
                    </ul>
                    <a href="<?php echo $_MAIN_URL; ?>new">
                        <button id="add_post">ثبت آگهی رایگان</button>
                    </a>
                </div>
            </header><?php
            }
            ?>
                <script>
                    var user = '<?php echo $_USER['id']; ?>';
                    var postDefault = '<?php echo $postUnicCode; ?>';
                    var userDefault = '<?php echo $user; ?>';
                    var defaultTitle = '<?php echo $defaultTitle; ?>';
                    var defaultUserName = '<?php echo $defaultUserName; ?>';
                    var defaultImage = '<?php echo $defaultImage; ?>';
                    var mobility = '<?php echo $is_mobile ?>';
                </script>
            <?php 
            if($_USER['status'] != 'LOGIN'){
                include 'views/login-form.php';
            }else{
                ?><?php
                ?>
            <div id="chat">
                <div id="chat_holder">
                    <div id="contact_list">
                        <div class="header">
                            <h2 id="main_header_title">لیست گفتگوها</h2>
                        </div>
                        <div id="contact_item_list">
                            
                            
                        </div>
                    </div>
                    <div id="message_box">
                        <div class="header">
                            <button id="return_back" class="icon-arrow-thin-right"></button>
                            <h2 id="main_contact_name">مرتضی غلامی</h2>
                            <p id="last_time_seen"></p>
                        </div>
                        <div id="message_holder">
                            <a href="#" id="chat_post_link"><div id="chat_post_detail">
                                <div class="image_holder" id = "chat_post_image_holder">
                                    <img src="<?php echo $_MAIN_URL."assets/image/posts/th-13842.jpeg" ?>">
                                </div>
                                <h3 id="chat_post_title">عنوان آگهی</h3>
                            </div></a>
                            <div id="message_content">
                                <div id="alert_message">
                                    <p>لطفا نکات زیر را رعایت کنید :</p>
                                    <ul>
                                        <li>پیش از مشاهده و اطمینان از کالا هیچ مبلغی نپردازید</li>
                                        <li>در جاهای عمومی قرار بگذارید و به مکانهای خلوت و پرت نروید</li>
                                        <li>در صورت مشاهده هر گونه تخلف ، آنرا از طریق ثبت مشکل در آگهی گزارش کنید</li>
                                        <li>از دادن اطلاعات خصوصی جدا پرهیز کنید</li>
                                    </ul>
                                </div>
                                <div class="timing_max">
                                    <span>شنبه 27 فروردین 1401</span>
                                </div>
                                <div class="mymessage">
                                    <div class="message_blub">
                                        <div class="message_content">
                                            <p>سلام خوبی داش!</p>
                                        </div>
                                        <div class="message_detail">
                                            <i class="icon-check1"></i>
                                            <span>08:46</span>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="contact_message">
                                    <div class="message_blub">
                                        <div class="message_content">
                                            <p>سلام خوبی داش!</p>
                                        </div>
                                        <div class="message_detail">
                                            <i class="icon-check1"></i>
                                            <span>08:46</span>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div id="message_input_box">
                            <input type="text" id="message_input_box_text" placeholder="پیام خود را بنویسید">
                            <label class="icon-attach_file"></label>
                            <button id="input_msgbox_button" class="icon-paperplane"></button>
                        </div>
                        <div id="chat_cover">
                            <span>با سرویس چت میتوانید با فروشنده و خریداران ارتباط برقرار کنید!</span>
                        </div>
                    </div>
                </div>
            </div><?php
            }
            ?>
        </div>
        <div id="loading_viewer" >
            <div class="loading_holder">
                <img src="<?php echo $_MAIN_URL.'assets/image/loading/loadingw.gif' ?>">
                <span>در حال بارگیری اطلاعات</span>
            </div>
        </div>
    </body>
    <?php 
    
    if($_USER['status'] == 'LOGIN'){
        ?><script src="<?php echo $_MAIN_URL; ?>script/chat.js"></script><?php
    }else{
        ?><script src="<?php echo $_MAIN_URL; ?>script/chati.js"></script><?php
    }
    ?>
    
</html>