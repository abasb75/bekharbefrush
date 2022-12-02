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
    
    <header id="main_header">
        <div class="container" id="main_header_container">
            
            
            <div id="searchBar">
                <div class="inputHolder" id="searchBarInputHolder">
                    <input type="search" value="" maxlength="50" id="searchInput" placeholder="جستجو در هزارن آگهی ...">
                    <button id="clear_search_input" style="display: none;"><i class="icon-clear"></i></button>
                    <button id="search"></button>
                    <ul id="most_search">
                        <li id="curren_most_search" ></li>
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
                    <label for="searchInput"><i class="icon-search"></i></label>
                    <button id="exitSearchTool" class="icon-arrow-thin-right"></button>
                </div>
                
                
            </div>
            <ul id="header_menu">
                <li id="header_set_location_button"><a><i class="icon-location"></i><span><?php echo $_USER['location_name']; ?></span></a></li>
            </ul>
        </div>
    </header>
    <div id="bottom_menu">
        <ul>
            <li id="go_home_bottom_menu"><i class="icon-home-with-zoom-tool-svgrepo-com"></i><span>خانه</span></li>
            <li id="show_category_on_mobile"><i class="icon-menu1"></i><span>دسته بندی</span></li>
            <a href="<?php echo $_MAIN_URL ?>new"><li id="header_add_post"><i class="icon-plus1"></i><span>ثبت آگهی</span></li></a>
            <a href="<?php echo $_MAIN_URL ?>chat"><li><i class="icon-comments"></i><span>گفت و گو</span></li></a>
            <a href="<?php echo $_MAIN_URL ?>user"><li id="header_myaccount_button"><i class="icon-user"></i><span>حساب من</span></li></a>
        </ul>
    </div>


    