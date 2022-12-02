<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بخربفروش، <?php echo $category_array['name'] ?> ، <?php echo $r['title']; ?></title>
    <link href="<?php echo $_MAIN_URL ?>assets/fonts/style.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>assets/icon_fonts/style.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/reset.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/header.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/aside.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/main.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/single.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/footer.css" rel="stylesheet">
    <link href="<?php echo $_MAIN_URL ?>style/account.css" rel="stylesheet">

    <!--[if lt IE 9]>
	<script src="script/ie_support.js"></script>
    <link href="style/ie8fix.css" rel="stylesheet">
    <![endif]-->
    <!--[if lt IE 8]>
	<link href="style/iefix.css" rel="stylesheet">
    <![endif]-->
   
	<script src="<?php echo $_MAIN_URL ?>assets/data/categorys.js"></script>
	<script src="<?php echo $_MAIN_URL ?>assets/data/states.js"></script>
	<script src="<?php echo $_MAIN_URL ?>assets/data/cities.js"></script>
	<script src="<?php echo $_MAIN_URL ?>script/product.js"></script>
</head>
<body>
    <?php include 'views/header.php'; ?>
    <main id="main_content">
        <header id="singleHeader">
            <ul id="nav_titles">
                <li><a href="<?php echo $_MAIN_URL.'s/'.$state_array['slug']; ?>">استان <?php echo $state_array['name']; ?></a></li>
                <li><i class="icon-angle-left"></i></li>
                <li><a href="<?php echo $_MAIN_URL.'c/'.$city_array['slug']; ?>">شهر <?php echo $city_array['name']; ?></a></li>
                <li><i class="icon-angle-left"></i></li>
                <li><a href="<?php echo $_MAIN_URL.'c/'.$city_array['slug'].'/r/'.$category_array['title']; ?>"><?php echo $category_array['name']?> دیجیتال</a></li>
                <li><i class="icon-angle-left"></i></li>
                <li><span><?php echo $r['title']; ?></span></li>
            </ul>
        </header>
        <script>
            var ads = {
                id : <?php echo $r['id'] ?>,
                category : <?php echo $r['category'] ?>,
                city : <?php echo $r['city'] ?>,
                state : <?php echo $category_array['id'] ?>,
                link : '<?php echo $r['link'] ?>',
                short_link : 'bb.ir/<?php echo $r['uniccode'] ?>',
            }
        </script>
        <section id="singleSection">
            <div id="single_images_shower">
                <div id="main_image_shower">
                    
                </div>
                <div id="image_list_for_slider">
                    
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
                
                <script>
                    var main_image_shower = document.getElementById('main_image_shower');
                    var image_list_for_slider = document.getElementById('image_list_for_slider');
                    var slidermageCount = 0;
                    var img_sources = [<?php
                        if($r['idr'] != '0'){
                            $main_idr = $r['idr'];
                            $sql = "SELECT * FROM `posts_image` WHERE id=$main_idr;";
                            $ret = mysqli_query($connect , $sql);
                            if($idr = mysqli_fetch_assoc($ret)){
                                echo "'".$idr['data']."'";
                                $post_id = $r['id'];
                                $sql ="SELECT * FROM `posts_image` WHERE postId=$post_id AND id!=$main_idr";
                                $ret = mysqli_query($connect , $sql);
                                while($r2 = mysqli_fetch_assoc($ret)){
                                    echo ",\n'".$r2['data']."'";
                                }
                                
                            }
                        }
                        
                        
                        
                        ?>];
                    var slidermageCount = img_sources.length;
                </script>
            </div>

            <div id="single_info_shower">
                <div id="single_functions">
                    <button onclick="history.back()"><i class="icon-angle-right"></i><span>بازگشت</span></button>
                    <ul id="function_buttons">
                        <li class="icon-bookmark-o" onclick="<?php
                            if($_USER['id']==0){
                                echo 'showLogin()';
                            }else{
                                echo 'toggle_to_bookmark(this);';
                            }
                            
                            ?>"><span class="tooltip">نشانه گذاری شد</span></li>
                        <li class="icon-share" onclick="copy_share_link(this)"><span class="tooltip">لینک آگهی کپی شد</span></li>
                    </ul>
                </div>
                <h1 id="item_title"><?php echo $r['title']; ?></h1>
                
                <p id="time_single"><strong><?php
                    $date1 = $r['release_date'];
                    //$date2 = date('Y-m-d H:m:s');
                    $diff = abs(time() - strtotime($date1));
                    if($diff > 31536000){
                        echo floor($diff/(31536000)).' سال پیش';
                    }elseif($diff > 2592000){
                        echo floor($diff/(2592000)).' ماه پیش';
                    }elseif($diff > 604800){
                        echo floor($diff/(604800)).' هفته پیش';
                    }elseif($diff > 86400){
                        echo floor($diff/(86400)).' روز پیش';
                    }elseif($diff > 3600){
                        echo floor($diff/(3600)).' ساعت پیش';
                    }elseif($diff > 60){
                        echo floor($diff/(60)).' دقیقه پیش';
                    }else{
                        echo 'لحضاتی قبل';
                    }
                    
                    ?> | <?php echo $category_array['name']; ?></strong></p>
                
                <div id="single_price_holder">
                    <?php 
                    if($r['category']=='1' and ($r['type']=='4')){
                        ?><span class="single_price">ودیعه : <?php echo create_price($r['price_1']); ?></span>
                    <span class="single_price">اجاره ماهانه : <?php echo create_price($r['price_2']); ?></span><?php
                    }else{
                        ?><span class="single_price">قیمت : <?php echo create_price($r['price_1']); ?></span><?php
                    }
                    function create_price($pr){
                        if($pr=='0' or $pr == ''){
                            return 'توافقی';
                        }
                        $new_pr = '';
                        $counter = 1;
                        for($i=strlen($pr)-1;$i>=0;$i--){
                            if($counter==3 and $i!=0){
                                $new_pr = ','.$pr[$i].$new_pr;
                                $counter = 1;
                                continue;
                            }else{
                                $new_pr = $pr[$i].$new_pr;
                                $counter++;
                            }
                        }
                        $new_pr = $new_pr .' تومان';
                        return $new_pr;
                    }
                    ?>
                    
                </div>




                <span id="single_description_title">توضیحات : </span>
                <p id="single_description"><?php echo $r['body']; ?></p>
                    <div class="profile_detail">
                        <h2>آگهی دهنده : <?php if($sender_array['name']==''){ echo 'نامشخص'; }else{ echo $sender_array['name']; } ?></h2>
                    </div>
                    <div class="profile_detail more">
                        <h2>نوع آگهی : <?php 
                            if($r['type']=='1'){
                                echo 'فروشی';
                            }elseif($r['type']=='2'){
                                echo 'فروش یا معاوضه';
                            }elseif($r['type']=='3'){
                                echo 'معاوضه';
                            }elseif($r['type']=='4'){
                                echo 'اجاره';
                            }elseif($r['type']=='5'){
                                echo 'درخواستی';
                            }elseif($r['type']=='6'){
                                echo 'خدمات';
                            }else{
                                echo 'نامشخص';
                            }
                            ?></h2>
                    </div>
                    <div class="profile_detail more">
                        <h2>وضعیت کالا : <?php 
                            if($r['status']=='1'){
                                echo 'نو';
                            }elseif($r['status']=='2'){
                                echo 'در حد نو';
                            }elseif($r['status']=='3'){
                                echo 'دست دوم';
                            }elseif($r['status']=='4'){
                                echo 'نیازمند تعمییر';
                            }else{
                                echo 'نامشخص';
                            }
                            ?></h2>
                    </div>
                    <div class="profile_detail more">
                        <h2>تاریخ انتشار آگهی : <?php 
                         echo jdate('l، d F Y ساعت H:i',strtotime($r['release_date']));
                            
                            ?></h2>
                    </div>
                    
                <div id="single_button_List">
                    <a href="<?php echo $_MAIN_URL.'r/'.$category_array['title']; ?>"><button class="categorybutton">دسته <?php echo $category_array['name']; ?></button></a>
                    <button id="show_contact_seller">اطلاعات تماس</button>
                    <script>
                    var seller = {
                        id : 1,
                        name : '<?php echo $sender_array['name']; ?>',
                        phone : '<?php echo openPassword($sender_array['phone']); ?>',
                        mail:'<?php echo $sender_array['mail']; ?>',
                        link:'<?php echo $r['link']; ?>',
                        address:'<?php echo $r['address']; ?>'
                    };
                </script>
                    <a href="#"><button>چت خصوصی</button></a>
                </div>
            </div>
        </section>
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
    </main>
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
<!--[if lt IE 10]>
	<script src="<?php echo $_MAIN_URL ?>script/input_fixer.js"></script>
<![endif]-->
<script src="<?php echo $_MAIN_URL ?>script/header.js" ></script>
<script src="<?php echo $_MAIN_URL ?>script/side.js" ></script>
<script src="<?php echo $_MAIN_URL ?>script/image_slider.js" ></script>
<script src="<?php echo $_MAIN_URL ?>script/single.js" ></script>
<script src="<?php echo $_MAIN_URL ?>script/account.js" ></script>

</html>