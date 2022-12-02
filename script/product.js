
var currentQuery = '';
var seb = 0;


function setLocation(e){
    var ids = '';
    var state_name = '';
    var slug = '';
    if(typeof this.getAttribute === "function"){
        ids = this.getAttribute('ids');
        state_name = this.getAttribute('state_name');
        slug = this.getAttribute('slug');
    }else if(typeof e.getAttribute === "function"){
        ids = e.getAttribute('ids');
        state_name = e.getAttribute('state_name');
        slug = e.getAttribute('slug');
    }
    if(ids != '' && ids != currentLocation){
        currentLocation = ids;
        currentlocationName = state_name;
        var header_set_location_button = document.getElementById('header_set_location_button');
        if(ids == 'i_0'){
            header_set_location_button.innerHTML = '<a><i class="icon-location"></i><span>ایران</span></a>';
            currentLocation = ids;
            currentlocationName = 'ایران';
            currentlocationSlug = 's/ایران/';
            resetPosts();
            close_product_view();
            initial_load_product();
        }else if(ids[0] == 's'){
            header_set_location_button.innerHTML = '<a><i class="icon-location"></i><span>استان '+ state_name +'</span></a>';
            currentLocation = ids;
            currentlocationName = 'استان ' + state_name;
            currentlocationSlug = 's/'+slug+'/';
            resetPosts();
            close_product_view();
            initial_load_product();
        }else if(ids[0] == 'c'){
            header_set_location_button.innerHTML = '<a><i class="icon-location"></i><span>شهر '+ state_name +'</span></a>';
            currentLocation = ids;
            currentlocationName = 'شهر ' + state_name;
            currentlocationSlug = 'c/'+slug+'/';
            resetPosts();
            close_product_view();
            initial_load_product();
        }else{
            console.log('invalid argumant');
        }
        window.history.replaceState(null,'',createHref());
        
    }
    exitFromSelectCity();
    
    setSearchWidth();
    setInfoHeader();
    
}

function setCategory(el){
    var aside_cateory_list = document.getElementById('aside_cateory_list');
    
    var idc = '';
    var slug = '';
    var categoryName = '';
    
    if(typeof this.getAttribute === 'function'){
        idc = this.getAttribute('idc');
        slug = this.getAttribute('slug');
        categoryName = this.getAttribute('category_name');
    }else if(typeof el.getAttribute === 'function'){
        idc = el.getAttribute('idc');
        slug = el.getAttribute('slug');
        categoryName = el.getAttribute('category_name');
    }
    
    currentCategoryName = categoryName;
    currentCategorySlug = 'r/'+slug+'/';
    if(idc != currentCategory && idc != ''){
        currentCategory = idc;
        for(var i=0;i<aside_cateory_list.children.length;i++){
            if(currentCategory == 'c_'+i){
                aside_cateory_list.children[i].setAttribute('class','selected')
            }else{
                aside_cateory_list.children[i].setAttribute('class','')
            }
            
        }
    }
    if( typeof exitMobileCategory === 'function'){
        exitMobileCategory();
    }
    setInfoHeader();
    resetPosts();
    close_product_view();
    window.history.replaceState(null,'',createHref());
    initial_load_product();
}


function setInfoHeader(){
    if(currentQuery == ''){
        var locationTitle = 'سرزمین ';
        if(currentLocation[0] == 's'){
            locationTitle = ' ';
        }else if(currentLocation[0] == 'c'){
            locationTitle = ' ';
        }
        locationTitle += currentlocationName;

        var categoryTitle = 'همه دسته ها';
        
        if(currentCategory == 'c_0'){
            categoryTitle = 'همه دسته ها';
        }
        else{
            categoryTitle = 'دسته ' + currentCategoryName;
        }

        var discription = 'مرجع خرید کالای نو و دست دوم';
        if(currentCategory == 'c_11'){
            discription = 'مرجع کاریابی و استخدام';
        }else if(currentCategory == 'c_1'){
            discription = 'مرجع قیمت ، خرید و اجاره املاک';
        }else if(currentCategory == 'c_5'){
            discription = 'مرجع معرفی و به کارگیری انواع خدمات';
        }else if(currentCategory == 'c_6'){
            discription = 'مرجع خرید و فروش حیوانات';
        }
        document.getElementById('heading_title').innerHTML = 'بخر بفروش ، '+discription+' در '+locationTitle+' ، '+categoryTitle+'';

    }else{
        document.getElementById('heading_title').innerHTML = 'بخر بفروش ، جستجو برای '+currentQuery;
    }
    if(document.getElementById('category_name_title') != null){
        document.getElementById('category_name_title').innerHTML = 'دسته بندی : '+currentCategoryName;
    }

}


var is = '99999999999';
var psc = 0;
var s = true;
var g = true;
var currentPage = 1;
var loadDataXHR = null;
function initial_load_product(){
    if(s==false || g==false){
        console.log('canseled');
        return false;
        
    }
    if(document.getElementById('empty_loading')!=null){
        document.getElementById('product_Container').removeChild(document.getElementById('empty_loading'));
    }
    s=false;
    var loading_Product = document.createElement('div');
    loading_Product.setAttribute('id','loading_Product');
    loading_Product.innerHTML = '<img src="'+window.localStorage.getItem('loading')+'">';
    document.getElementById('product_Container').appendChild(loading_Product);
    loadDataXHR = new XMLHttpRequest();
    loadDataXHR.onreadystatechange = function(){
        if(this.readyState == 4){
            if(this.status == 200 && this.responseText != ''){
                document.getElementById('product_Container').removeChild(document.getElementById('loading_Product'));
                addPost(this.responseText);
                document.getElementById('loading_viewer').setAttribute('class','display_none');
                document.getElementById('main_content').setAttribute('class','');
                s=true;
            }else{
                document.getElementById('product_Container').removeChild(document.getElementById('loading_Product'));
                s=true;
                initial_load_product();
            }
        }
    }
    loadDataXHR.open('GET',main_url+'api/load_files.php?page='+currentPage+'&i='+is+'&c='+currentCategory+'&l='+currentLocation+'&q='+currentQuery,true);
    loadDataXHR.send();
    
}


function addPost(j){
    var productHolder = document.getElementById('productHolder');
    var ps = JSON.parse(j);
    if(ps['status']==200){
        for (var i=0;i<ps['post'].length;i++){
            
            var p = ps['post'][i];
            is = p['i'];
            var productItem = document.createElement('article');
            productItem.setAttribute('class', 'productItem');
            
            var a = document.createElement('a');
            a.setAttribute('href', p['url']);
            a.setAttribute('title', p['title']);
            
            
            productItem.appendChild(a);
            
            
            var productItemHolder = document.createElement('div');
            productItemHolder.setAttribute('class', 'productItemHolder');
            //productItemHolder.setAttribute('onclick', 'display_post(this)');
            
            
            
            
            
            a.setAttribute('id', p['code']);
            a.addEventListener('click',display_post);
            
            
            a.appendChild(productItemHolder);
            
            
            
            var imageHolder = document.createElement('div');
            imageHolder.setAttribute('class', 'imageHolder');
            
            
            
            if(p['sumbnail']=='' || p['sumbnail']=='0'){
                imageHolder.innerHTML = '<div class="no_image"><i class="icon-camera-off"></i></div>';
            }else{
                imageHolder.innerHTML = '<img src="'+p['sumbnail']+'" alt="بخربفروش '+p['title']+'">';
            }
            
            
            productItemHolder.appendChild(imageHolder);
            
            var infoHolder = document.createElement('div');
            infoHolder.setAttribute('class', 'infoHolder');
            infoHolder.innerHTML = '<h3>'+p['title']+'</h3><span>'+p['p1']+'</span><span>'+p['p2']+'</span><span>'+p['time']+' در '+p['location']+'</span>';
            productItemHolder.appendChild(infoHolder);
            
            productHolder.appendChild(productItem);
            
        }
        
    }else{
        g = false;
        if(productHolder.children.length == 0){
            var empty_loading = document.createElement('div');
            empty_loading.setAttribute('id','empty_loading');
            empty_loading.innerHTML = '<div><i class="icon-empty-21"></i></div> <p>متاسفانه موردی مطابق جستجوی شما یافت نشد.</p>';
            document.getElementById('product_Container').appendChild(empty_loading);
        }
    }
    
    
}
                                        
function resetPosts(){
    if(typeof exitMobileCategory === 'function'){
        exitMobileCategory();
    }
    var productHolder = document.getElementById('productHolder');
    productHolder.innerHTML = '';
    window.scrollTo(0,0);
    is = '99999999999';
    currentPage = 1;
    g = true;
    if(loadDataXHR != null){
        loadDataXHR.abort();
    }
}







function display_post(e){
    e.preventDefault();
    window.history.pushState({post:this.getAttribute('id')},'',this.getAttribute('href'));
    seb=1;
    
    loadpermission = false;
    if(loadDataXHR != null){
        loadDataXHR.abort();
    }
    
    document.getElementById('loading_viewer').setAttribute('class','');
    document.getElementById('main_content').setAttribute('class','display_none');
    load_post_data(this.getAttribute('id'));
}

function load_post_data(id){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState==4){
            if(this.status == 200 && this.responseText != '' ){
                show_post_page(this.responseText);
            }else{
                load_post_data(id);
            }
        }
    }
    xhttp.open('GET',main_url+'api/load_product.php?id='+id,true);
    xhttp.send();
}

function show_post_page(j){
    console.log(j);
    var post = JSON.parse(j);
    if(post['status'] != 200){
        document.getElementById('loading_viewer').setAttribute('class','display_none');
        document.getElementById('main_content').setAttribute('class','display_none');
        document.getElementById('main_content_post').setAttribute('class','');
        empty_alert_show();
        return;
    }
    post = post['data'];
    console.log(post);
    
    ads = { id : post['post']['id'], category : post['category']['id'], city : post['location']['id'], state : post['state']['id'], link : post['post']['link'], short_link : main_url+'p/'+post['post']['uniccode'] }
    
    
    
    img_sources = [];
    for(var i= 0;i<post['images'].length;i++){
        img_sources.push ({'type':'image','src':post['images'][i]});
    }
    if(post['post']['video'] != 0 && post['post']['video'] != ''){
        img_sources.push ({'type':'frame','src':post['post']['video']});
    }
    
    slidermageCount = img_sources.length ;
    
    seller = { id : 0, name : post['sender']['name'], phone : post['sender']['phone'], mail:post['sender']['mail'], link:post['post']['link'], address:post['post']['address'] }
    
    document.getElementById('main_image_shower').innerHTML = post['post']['title'];
    document.getElementById('image_list_for_slider').innerHTML = post['post']['title'];
    
    
    loadImagesSlider();

/*
    if(post['post']['video'] == 0){
        var video = document.createElement('div');
        video.setAttribute('class','listItem');
        var listItemContent = document.createElement('div');
        listItemContent.setAttribute('class','listItemContent');
        video.appendChild(listItemContent);
        document.getElementById('image_list_for_slider').appendChild(video);

        var itemImageHolder = document.createElement('div');
        itemImageHolder.setAttribute('class','itemImageHolder');
       
        

        
        var button_play = document.createElement('button');
        button_play.setAttribute('vframe', post['post']['video']);
        button_play.onclick = playVideo;
        button_play.setAttribute('class','icon-film2');
        listItemContent.appendChild(itemImageHolder);
        itemImageHolder.appendChild(button_play);
    }*/
    document.getElementById('loading_viewer').setAttribute('class','display_none');
    document.getElementById('main_content').setAttribute('class','display_none');
    document.getElementById('main_content_post').setAttribute('class','');
    
    
    
    
    document.getElementById('post_state_v1').innerHTML = 'استان ' + post['state']['name']; 
    document.getElementById('post_state_v1').setAttribute('href',main_url+'s/'+post['state']['slug']);
    document.getElementById('post_state_v1').setAttribute('ids','s_'+post['state']['id']);
    document.getElementById('post_state_v1').setAttribute('slug',''+post['state']['slug']);
    document.getElementById('post_state_v1').setAttribute('state_name',post['state']['name']);
    
    
    
    
    
    
    document.getElementById('report_single_division_button').setAttribute('pid',post['post']['uniccode']);
    
    document.getElementById('report_single_division_button').onclick = showReportDialog;
    
    
    
    document.getElementById('post_city_v1').innerHTML = 'شهر ' + post['location']['name'];
    document.getElementById('post_city_v1').setAttribute('href',main_url+'c/'+post['location']['slug']); 
    document.getElementById('post_city_v1').setAttribute('ids','c_'+post['location']['id']);
    document.getElementById('post_city_v1').setAttribute('state_name',post['location']['name']);
    document.getElementById('post_city_v1').setAttribute('slug',post['location']['slug']);
    
    
    
    document.getElementById('post_category_v1').innerHTML = 'دسته ' + post['category']['name'];
    document.getElementById('post_category_v1').setAttribute('href',main_url+'c/'+post['location']['slug']+'/r/'+post['category']['title']);
    document.getElementById('post_category_v1').setAttribute('idc','c_'+post['category']['id']);
    document.getElementById('post_category_v1').setAttribute('slug',post['category']['title']);
    document.getElementById('post_category_v1').setAttribute('category_name',post['category']['name']);
    
    
    
    
    
    document.getElementById('post_title_v1').innerHTML = post['post']['title'];
    document.getElementById('item_title').innerHTML = post['post']['title'];
    document.getElementById('single_description').innerHTML = post['post']['body'];
    
    
    
    document.getElementById('category_button_v1').children[0].innerHTML = 'دسته '+ post['category']['name'];
    document.getElementById('category_button_v1').setAttribute('href',main_url + 'r/' +post['category']['title']);
    
    
    document.getElementById('category_button_v1').setAttribute('idc','c_'+post['category']['id']);
    document.getElementById('category_button_v1').setAttribute('slug',post['category']['title']);
    document.getElementById('category_button_v1').setAttribute('category_name',post['category']['name']);
    
    
    
    
    document.getElementById('bookmark_post_button').setAttribute('pid',post['post']['uniccode']);
    if(post['mark']=='0'){
        document.getElementById('bookmark_post_button').setAttribute('class','icon-bookmark-o');
    }else{
        document.getElementById('bookmark_post_button').setAttribute('class','icon-bookmark');
    }
    
    
   
    
    
    
    
    
    document.getElementById('time_single').children[0].innerHTML = post['post']['release_date'] + ' | '+ post['category']['name'];
    document.getElementById('single_price_holder').innerHTML = '';
    if(post['post']['p1']!=''){
        document.getElementById('single_price_holder').innerHTML = '<span class="single_price">'+post['post']['p1']+'</span>';
    }
    if(post['post']['p2']!=''){
        document.getElementById('single_price_holder').innerHTML = '<span class="single_price">'+post['post']['p2']+'</span>';
    }
    
    if(post['post']['is_chat'] == '1'){
        document.getElementById('go_chat_button').children[0].setAttribute('style','');
        document.getElementById('go_chat_button').setAttribute('href',main_url+'chat/'+post['post']['uniccode']);
    }else{
        document.getElementById('go_chat_button').children[0].setAttribute('style','opacity:0.1;cursor: no-drop;background:#555;');
        document.getElementById('go_chat_button').removeAttribute('href','');
    }
    


    
    
    document.getElementById('v1_sender_name').innerHTML = 'آگهی دهنده : '+post['sender']['name'];
    document.getElementById('v1_type_name').innerHTML = 'نوع آگهی : '+post['post']['type'];
    document.getElementById('v1_status_name').innerHTML = 'وضعیت کالا : '+post['post']['status'];
    document.getElementById('v1_time_name').innerHTML = 'تاریخ انتشار آگهی : '+post['post']['timed'];

    var seen_post = window.localStorage.getItem('history');
    if(seen_post){
        var ps = seen_post.split('_');
        var y=true;
        if(ps.length >= 24){
            ps.pop();
            seen_post = '';
            for(var i=0;i<ps.length;i++){
                seen_post = seen_post + ps[i];
                if(ps[i] == post['post']['uniccode']){
                    y=false;
                }
            }
        }
        if(y==true){
            seen_post = post['post']['uniccode'] + '_' + seen_post;
        }
        window.localStorage.setItem('history',seen_post);
    }else{
        window.localStorage.setItem('history',post['post']['uniccode']);
    }
    
    if(document.getElementById('main_header')!=null){
        if(document.getElementById('bottom_menu') != null){
            document.getElementById('bottom_menu').setAttribute('class','display_none');
            document.getElementById('main_header').setAttribute('class','display_none');
        }
        
        
    }
    
   
}

function close_pv(){
    if(defalt_layout =='0' || defalt_layout==0){
        close_product_view();
        window.history.back();
    }else{
        defalt_layout = '0';
        close_product_view();
        resetPosts();
        
        window.history.replaceState('','',createHref());
        initial_load_product();


    }
    
}


function close_product_view(){
    document.getElementById('loading_viewer').setAttribute('class','display_none');
    document.getElementById('main_content').setAttribute('class','');
    document.getElementById('main_content_post').setAttribute('class','display_none');
    loadpermission = true;
    window.scrollTo(0,current_scroll_on_post);
    console.log(current_scroll_on_post);
    seb=0;
    if(document.getElementById('main_header')!=null){
        if(document.getElementById('bottom_menu') != null){
            document.getElementById('bottom_menu').setAttribute('class','');
        }
        document.getElementById('main_header').setAttribute('class','');
    }
    
}


function refresh_page(){
    close_product_view();
    resetPosts();
    initial_load_product();
}



function playVideo(){
    document.getElementById('video_frame').src = this.getAttribute('vframe');
}


function empty_alert_show(){
    document.body.innerHTML += '<div id="empty_post"><div id="empty_post_label"><i class="icon-empty-24 "></i><h3>آگهی مورد نظر یافت نشد</h3><button id="exit_empty_button">برگشت به صفحه اصلی</button></div></div>';
    document.getElementById('exit_empty_button').onclick = function(){
        document.body.removeChild(document.getElementById('empty_post'));
        close_pv();
    }
}