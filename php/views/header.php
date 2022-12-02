<script type="text/javascript">
var currentLocation = '<?php echo $_USER['location'] ?>';
var currentlocationName = '<?php echo $_USER['location_name']; ?>';
var currentlocationSlug = '<?php echo $_USER['location_slug']; ?>';
var currentCategory = '<?php echo $_USER['category']; ?>';
var currentCategoryName = '<?php echo $_USER['category_name']; ?>';
var currentCategorySlug = '<?php echo $_USER['category_slug']; ?>';
var defalt_layout = '<?php echo $page_default ?>';
var currentQuery = '<?php echo $q; ?>';
</script>
<nav id="header_navbar">
        <div class="container">
            <ul id="header_nav_list">
                <li><a href="<?php echo $_MAIN_URL ?>" title="همه آگهی های وب سایت بخر بفروش">همه آگهی ها</a></li>
                <li><a href="<?php echo $_MAIN_URL ?>laws" title="شرایط استفاده">شرایط استفاده</a></li>
                <li><a href="<?php echo $_MAIN_URL ?>sitemap.html" title="نقشه وب سایت sitemap">نقشه وب سایت</a></li>
            </ul>
            <ul id="header_nav_connect_list">
                <!--<li><a>چهارشنبه، 3 مرداد 1400</a></li>-->
                <li><a><?php echo jdate('l، d F Y'); ?></a></li>
            </ul>
        </div>
    </nav>
    <header id="main_header">
        <div class="container" id="main_header_container">
            <a href="<?php echo $_MAIN_URL?>" class="h1" id="header_h1" title="وب سایت بخر بفروش" ><h1>بخر بفروش</h1></a>
            <ul id="header_menu">
                <li id="header_set_location_button"><a><i class="icon-location"></i><span><?php echo $_USER['location_name']; ?></span></a></li>
                <li><a href="<?php echo $_MAIN_URL?>chat" title="گفت و گو با کاربران بخربفروش"><i class="icon-bubble"></i><span>گفتگو</span></a></li>
                <li class="topmenu" id="header_myaccount_button">
                    <a ><i class="icon-user"></i><span>حساب من</span></a>
                    <?php
                    if($_USER['status'] != 'LOGIN'){
                        ?><ul class="submenu" id="none_valid_user" style="height: 70px !important;">
                        <a><li onclick="showLogin()"><i class="icon-sign-in"></i><span>ورود به سایت</span></li></a>
                    </ul><?php
                    }else{
                        ?><ul class="submenu" id="none_valid_user" style="height: 352px !important;">
                        <li class="username"><?php echo $_USER['name']; ?></li>
                        <li class="intro"><i class="icon-phone"></i><span><?php echo $_USER['phone']; ?></span></li>
                        <li class="intro botomline"><i class="icon-at"></i><span><?php echo $_USER['mail']; ?></span></li>
                        <a href="<?php echo $_MAIN_URL ?>user/mypost"><li><i class="icon-shop1"></i><span>آگهی های من</span></li></a>
                        <a href="<?php echo $_MAIN_URL?>new" title="ثبت رایگان آگهی در بخربفروش"><li><i class="icon-plus"></i><span>ثبت آگهی</span></li></a>
                        <a href="<?php echo $_MAIN_URL ?>user/bookmark"><li><i class="icon-bookmark-o"></i><span>نشان شده ها</span></li></a>
                        <a href="<?php echo $_MAIN_URL ?>user/history"><li><i class="icon-history"></i><span>بازدیدهای اخیر</span></li></a>
                        <a href="<?php echo $_MAIN_URL?>logout"><li><i class="icon-sign-out"></i><span>خروج از حساب کاربری</span></li></a>
                    </ul><?php
                    }
                    ?>
                    
                </li>
            </ul>
            <?php if($_USER['status'] != 'LOGIN'){
                    ?><a href="<?php echo $_MAIN_URL; ?>new" onclick="" id="header_add_post_new">ثبت آگهی</a><?php
                }else{
                    ?><a href="<?php echo $_MAIN_URL; ?>new" onclick="window.open('<?php echo $_MAIN_URL?>new','_blank');" id="header_add_post">ثبت آگهی</a><?php
                }
            ?>
            <div id="searchBar">
                <div class="inputHolder" id="searchBarInputHolder">
                    <input type="search" value="" maxlength="50" id="searchInput" placeholder="جستجو در هزارن آگهی ...">
                    <button id="clear_search_input" style="display: none;"><i class="icon-clear"></i></button>
                    <ul id="most_search">
                        <li>ماشین و خودرو</li>
                        <li>موبایل و گوشی</li>
                        <li>لپ تاپ</li>
                        <li>تبلت</li>
                        <li>خانه</li>
                        <li>اجاره</li>
                        <li>استخدام</li>
                        <li>کار</li>
                        <li>پیراهن</li>
                        <li>کفش</li>
                    </ul>
                </div>
                <label for="searchInput"><i class="icon-search"></i></label>
                
            </div>
            
        </div>
    </header>