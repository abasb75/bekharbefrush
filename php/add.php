<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>افزودن محصول</title>

    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>assets/fonts/style.css">
    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>assets/icon_fonts/style.css">
    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>style/reset.css">
    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>style/footer.css">
    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>style/select_city.css">    
    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>style/account.css">

    <link rel="stylesheet" href="<?php echo $_MAIN_URL; ?>style/add.css">

    
    <script>var main_url = '<?php echo $_MAIN_URL ?>';</script>
    <script src="<?php echo $_MAIN_URL; ?>assets/data/categorys.js"></script>
    <script src="<?php echo $_MAIN_URL; ?>assets/data/cities.js"></script>
    <script src="<?php echo $_MAIN_URL; ?>assets/data/states.js"></script>


</head>
<body>
    <header id="add_header">
        <h2>بخربفروش</h2>
        <button id="buttonMenu" class="icon-menu"></button>
        <div id="mobile_menu">
            <div id="mobile_phone_contaner">
                <div class="button_Holder"><button id="exit_menu_mobile_show" class="icon-arrow-thin-right"></button></div>
                <ul>
                    <li><a href="<?php echo $_MAIN_URL ?>">آگهی ها</a></li>
                    <li><a href="<?php echo $_MAIN_URL ?>support">پشتیبانی</a></li>
                    <li><a href="<?php echo $_MAIN_URL ?>chat">گفت و گو</a></li>
                    <li><a href="<?php echo $_MAIN_URL ?>user">حساب من</a></li>
                    <li><a href="<?php echo $_MAIN_URL ?>contact">ارتباط با ما</a></li>
                    <li><a href="<?php echo $_MAIN_URL ?>blog">مقالات</a></li>
                </ul>
            </div>
            
        </div>
    </header>
    <nav id="add_nav">
        <div id="add_nav_layout">
            <h1>ثبت رایگان آگهی</h1>
            <ul>
                <a href="<?php echo $_MAIN_URL ?>"><li>آگهی ها</li></a>
                <a href="<?php echo $_MAIN_URL ?>support"><li>پشتیبانی</li></a>
                <a href="<?php echo $_MAIN_URL ?>chat"><li>گفت و گو</li></a>
                <a href="<?php echo $_MAIN_URL ?>user"><li>حساب من</li></a>
            </ul>
        </div>
    </nav>
    <main id="add_main">
        <?php
        if($_USER['status'] != 'LOGIN'){
            include 'views/login-form.php';
        }else{
            if(!isset($_SESSION['img_key'])){
                $_SESSION['img_key'] = $_USER['phone'].'_'.time();
                $_SESSION['tab_number'] = '1';
            }else{
                $_SESSION['tab_number'] = ((int)$_SESSION['tab_number']) + 1;
            }
            ?><div id="add_main_layout">
            <div id="select_category">
                <h2>لطفا دسته بندی مورد نظر خود را انتخاب کنید.</h2>
                <ul id="aside_cateory_list">

                </ul>
            </div>
            <div id="product_detail" class="hidden">
                <div id="set_category_layout" class="layout_item">
                    <h2 id="category_name">ثبت آگهی در دسته </h2>
                    <button id="return_back"><i class="icon-arrow-thin-right"></i><span>تغییر دسته بندی</span></button>
                </div>
                <div id="set_city_layout" class="layout_item">
                    <h2 id="city_name">موقعیت : استان تهران ، شهر تهران</h2>
                    <button id="set_city_load"><span>انتخاب<span class="large"> شهر و استان</span></span><i class="icon-angle-left"></i></button>
                </div>
                <div id="set_status_layout" class="layout_item">
                    <h2 id="product_status">وضعیت کالا : نو</h2>
                    <button id="set_status"><span>انتخاب</span><i class="icon-angle-left"></i></button>
                </div>
                <div id="set_type_layout" class="layout_item">
                    <h2 id="product_type">نوع آگهی : فروشی</h2>
                    <button id="set_type"><span>انتخاب</span><i class="icon-angle-left"></i></button>
                </div>
                <div id="upload_image" class="formInput">
                    <h3>تصاویر آگهی شما</h3>
                    <span style="display: block;">تصاویر به دیده شدن بهتر آگهی شما کمک میکنند. برای انتخاب تصویر اصلی روی آن کلیک کنید تا کادر آن سرخ شود. تصویر اصلی انتخاب شده را نمیتوان ویرایش یا حذف کرد.</span>
                    <div class="items" id="image_items">
                        <div class="item" id="finput">
                            <div class="itemHolder">
                                <div id="image_upload">
                                    <input type="file" accept="image/png,image/jpg,image/jpeg,image/gif,image/webp" id="image_file_input" multiple>
                                    <label for="image_file_input"><i class="icon-add_a_photo"></i></label>
                                    <span>آپلود تصویر</span>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <script>var tokenId = '<?php echo md5($_SESSION['tab_number']); ?>';</script>
                </div>
                
                
                
                
                
                <div id="set_ads_title" class="formInput">
                    <h3>عنوان آگهی</h3>
                    <span>موارد مهم و چشمگیر را در عنوان آگهی مطرح کنید.</span>
                    <input type="text" placeholder="مثلا موبایل نوکیا ..." id="title_ads_input" maxlength="256" oninput="checkTitleInput(this,25);">
                    <span id="title_information" class="offer_span">حداقل 25 کاراکتر باید وارد کنید ...</span>
                </div>
                <div id="set_ads_body" class="formInput">
                    <h3>متن آگهی</h3>
                    <span>در این قسمت توضیحات کاملی از آگهی خود بنویسید.</span>
                    <span>درج شماره تماس ، درخواست وجه بیعانه ، لینک وب سایت مجاز نیست. مواردی همجون ویژگیهای محصول و ... را ذکر کنید.</span>
                    <textarea id="body_ads_input" oninput="checkTitleInput(this,40);"></textarea>
                    <span class="offer_span">حداقل 40 کاراکتر باید وارد کنید</span>
                </div>
                <div id="set_ads_price" class="formInput">
                    <h3>قیمت</h3>
                    <span>قیمت را به تومان وارد کنید. خالی گذاشتن قیمت به معنای قیمت توافقی می باشد.</span>
                    <div class="inputHolder">
                        <input class="price_input" maxlength="12" type="tel" placeholder="قیمت به تومان" id="title_ads_price_1" inputmode="numeric" onkeypress="volvorin(event)" oninput="isdigit(this);">
                        <label>تومان</label>
                    </div>

                    
                </div>
                <div id="contact_way" class="formInput">
                    <h3>راه های ارتباطی</h3>
                    <span>راه های ارتباطی با خودتان را مشخص کنید.</span>
                    <span>شماره تلفن شما : 09015827703</span>
                    <div class="inputHolder">
                        <label>نام آگهی دهنده</label>
                        <input class="price_input" value="<?php echo $_USER['name'] ?>"  maxlength="32" type="text" placeholder="" id="adser_name_input">
                    </div>
                    <div class="inputHolder">
                        <label>ایمیل</label>
                        <input class="price_input" value="<?php echo $_USER['mail'] ?>" oninput="checkemail(this);" maxlength="" type="email" placeholder="" id="mail_input">
                    </div>
                    <div class="inputHolder">
                        <label>وب سایت</label>
                        <input class="price_input" maxlength="" type="link" placeholder="" id="link_input">
                    </div>
                    <div class="inputHolder">
                        <label>آدرس</label>
                        <input class="price_input" maxlength="" type="text" placeholder="" id="address_input">
                    </div>
                </div>
                <div id="upload_video" class="formInput">
                    <h3>فیلم آگهی شما</h3>
                    <span style="display: block;">برای آگهی خود میتوانید یک ویدیو در سایت آپارات آپلود کرده و لینک آن را در ورودی  زیر کپی کنید.</span>
                    <input type="text" placeholder="لینک ویدیو آگهی شما" id="video_ads_input" >
                    <div id="video_upload_controller">
                        <!--<input id="video_upload_input" accept="video/*" type="file">
                        <label for="video_upload_input" id="upload_button"><i class="icon-cloud-upload"></i>  بارگذاری فیلم</label>
                        <div id="progressview">
                            <img id="loading_upload" src="">
                            <div id="progress_bar">
                                <div id="progress_bar_status"></div>
                            </div>
                            <span id="text_progress_upload">در حال بارگزاری فایل ...</span>
                            <button id="button_cancel_upload"><i class="icon-clear"></i></button>
                            <button id="reload_upload"><i class="icon-repeat"></i></button>
                            <button id="end_of_upload_video"><i class="icon-check"></i></button>
                        </div>-->
                        <button></button>
                    </div>
                </div>
                <div id="button_send_categry" class="layout_item">
                    <a href="<?php echo $_MAIN_URL; ?>"><button class="right"><i class="icon-angle-right"></i><span>انصراف</span></button></a>
                </div>
            </div>
        </div>
        
        <?php
        }
        
        
        ?>
    </main>
    <footer id="main_footer">
        <div id="footer_content">
            <div id="footer_right_section">
                <h3>بخربفروش</h3>
                <ul>
                    <a href="<?php echo $_MAIN_URL ?>support"><li>پشتیبانی</li></a>
                    <a href="<?php echo $_MAIN_URL ?>about"><li>درباره ما</li></a>
                    <a href="<?php echo $_MAIN_URL ?>contact"><li>ارتباط با ما</li></a>
                    <a href="<?php echo $_MAIN_URL ?>blog"><li>مقالات</li></a>
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
    <div id="loading_box">
        <img src=""/>
        <span>در حال بارگیری اطلاعات</span>
    </div>
    <script>
        document.getElementById('loading_box').children[0].src = window.localStorage.getItem('loading');
        document.body.setAttribute('style','overflow:hidden;');
    </script>
</body>
<script src="<?php echo $_MAIN_URL; ?>script/add.js"></script>
    <script src="<?php echo $_MAIN_URL; ?>script/upload_image.js"></script>

    <?php
    if($_USER['status'] == 'LOGIN'){
        ?><script>allawysCheck('<?php echo $_MAIN_URL ?>');</script><?php
    }
        
    
    ?>
<script>
    
</script>
</html>