<main id="main_content_post" class="display_none">
        <header id="singleHeader">
            <ul id="nav_titles">
                <li><a href="#" id="post_state_v1"> </a></li>
                <li><i class="icon-angle-left"></i></li>
                <li><a href="#" id="post_city_v1"> </a></li>
                <li><i class="icon-angle-left"></i></li>
                <li><a href="#" id="post_category_v1"> </a></li>
                <li><i class="icon-angle-left"></i></li>
                <li><span id="post_title_v1"></span></li>
            </ul>
        </header>
        <script>
            var ads = {
                id : 10000000,
                category : 1,
                city : 1,
                state : 1,
                link : '',
                short_link : '',
            }
        </script>

        <section id="singleSection">
            <div id="single_images_shower">
                <div id="video_list_for_slider">
                </div>
                
                
                
            </div>

            <div id="single_info_shower">
                <div id="single_functions">
                    <button onclick="close_pv();"><i class="icon-angle-right"></i><span>بازگشت</span></button>
                    <ul id="function_buttons">
                        <li class="icon-bookmark-o" id="bookmark_post_button" onclick="<?php if($_USER['status']=='LOGIN'){ echo 'toggle_to_bookmark(this);'; }else{ echo 'showMarkView(this)'; }?>"><span class="tooltip"><?php if($_USER['status']=='LOGIN'){ echo 'آگهی نشانه گذاری شد'; }else{ echo 'باید وارد شوید'; }?></span></li>
                        <li class="icon-share" onclick="copy_share_link(this)"><span class="tooltip">لینک آگهی کپی شد</span></li>
                    </ul>
                </div>
                <div id="main_image_shower">
                    
                </div>
                <div id="image_list_for_slider">
                    
                </div>
                <script>
                    var main_image_shower = document.getElementById('main_image_shower');
                    var image_list_for_slider = document.getElementById('image_list_for_slider');
                    var slidermageCount = 0;
                    var img_sources = [
                    ];

                </script>
                <h1 id="item_title"></h1>
                
                <p id="time_single"><strong></strong></p>
                
                <div id="single_price_holder">
                    <span class="single_price"></span>
                    <span class="single_price"> </span>
                </div>




                <span id="single_description_title">توضیحات : </span>
                <p id="single_description"></p>
                    <div class="profile_detail">
                        <h2  id="v1_sender_name">آگهی دهنده :  </h2>
                    </div>
                    <div class="profile_detail more" >
                        <h2 id="v1_type_name">نوع آگهی : </h2>
                    </div>
                    <div class="profile_detail more">
                        <h2  id="v1_status_name">وضعیت کالا : </h2>
                    </div>
                    <div class="profile_detail more" >
                        <h2 id="v1_time_name">تاریخ انتشار آگهی : </h2>
                    </div>
                    
                
                
                
                
                <div id="single_button_List">
                    <a href="#" id="category_button_v1"><button class="categorybutton">دسته مسکن</button></a>
                    <div id="contact_botton_hoder">
                        <button id="show_contact_seller">اطلاعات تماس</button>
                        <a href="" id="go_chat_button"><button>چت خصوصی</button></a>
                    </div>
                    <script>
                    var seller = null;
                </script>
                    
                </div>
                <div id="single_alert">
                    <div class="logoHolder"><i class="icon-exclamation-triangle"></i></div>
                    <div class="introHolder">
                        <p>وب سایت بخر بفروش هیچ گونه منفعتی از این آگهی ندارد و تمام مسیولیت بعهده خریدار و فروشنده می باشد. لطفا قبل از دریافت کالا هیچ وجهی پرداخت نکنید.</p>
                        <div id="report_single_division">
                            <button id = "report_single_division_button"><i class="icon-warning"></i><span>ثبت مشکل در آگهی</span></button>
                            
                            <a href="#"><button id = "report_single_division_button"><i class="icon-map"></i><span>راهنمای خرید امن</span></button></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <footer id="main_footer">
            <div id="footer_content">
                <div id="footer_right_section">
                    <h3>بخربفروش</h3>
                    <ul>
                        <a href="<?php echo $_MAIN_URL; ?>support"><li>پشتیبانی</li></a>
                        <a href="<?php echo $_MAIN_URL; ?>about"><li>درباره ما</li></a>
                        <a href="<?php echo $_MAIN_URL; ?>contact"><li>ارتباط با ما</li></a>
                        <a href="<?php echo $_MAIN_URL; ?>blog"><li>مقالات</li></a>
                    </ul>
                </div>
                <div id="footer_left_section">
                    <ul>
                        <a href=""><li><i class="icon-instagram"></i></li></a>
                        <a href="#"><li><i class="icon-twitter"></i></li></a>
                        <a href="#"><li><i class="icon-telegram"></i></li></a>
                        <a href="#"><li><i class="icon-linkedin"></i></li></a>
                    </ul>
                </div>
            </div>
        </footer>
    </main>
    