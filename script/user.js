var ed = 0;
var il = 0;
var ps = 0;
var showedPost = null;

var images_array = [];
var post_title = null;
var loading_view = null;


document.body.onload = function(){
    if(document.getElementById('mylist') == null){
        var loading = document.getElementById('user_start_view');
        document.body.removeChild(loading);
        return;
    }
    post_title =document.getElementById('page_title2');
    load_page();
    var loading = document.getElementById('user_start_view');
    
    document.getElementById('btn_menu_mobile').onclick = showMoreMenu;
    document.getElementById('btn_more_mobile').onclick = showUserDetail;
    document.body.removeChild(loading);
    document.getElementById('post_title_edit').oninput = checkEditable;
    document.getElementById('post_body_edit').oninput = checkEditable;
    document.getElementById('post_video_edit').oninput = function(){
        ps = 1;
    };
    document.getElementById('menu_mypost_button').onclick = load_my_post_list_menu;
    document.getElementById('menu_bookmark_button').onclick = load_my_bookmark_menu;
    document.getElementById('menu_history_button').onclick = load_my_history_menu;
    
}


var tuser = false;
function showMoreMenu(){
    
    document.getElementById('nav_menu_user').setAttribute('class','show');
    document.body.onclick = exitMoreMenu;
}

function showUserDetail(){
    document.getElementById('user_info').setAttribute('class','show');
    document.body.onclick = exitDetail;
}

function exitDetail(e){
    if(tuser == false){
        tuser = true;
        return false;
    }
    tuser = false;
    if(e.target == null){
        return null;
    }
    if(e.target.id == 'nav_menu_user' || e.target.parentElement.id == 'nav_menu_user' ){
        return null;
    }
    if(e.target.parentElement.parentElement != null && e.target.parentElement.parentElement.id == 'nav_menu_user'){
        return null;
    }
    document.getElementById('user_info').setAttribute('class','');
    document.body.onclick = null
}


function exitMoreMenu(e){
    if(tuser == false){
        tuser = true;
        return false;
    }
    tuser = false;
    if(e.target == null){
        return null;
    }
    if(e.target.id == 'nav_menu_user' || e.target.parentElement.id == 'nav_menu_user' ){
        return null;
    }
    if(e.target.parentElement.parentElement != null && e.target.parentElement.parentElement.id == 'nav_menu_user'){
        return null;
    }
    document.getElementById('nav_menu_user').setAttribute('class','');
    document.body.onclick = null

}

var user_section = document.getElementById('user_section');
var xhttp = null;
function load_page(){
    if(current_post == 'MY_POST'){
        console.log('e34')
        load_my_post_list();
        
    } if(current_post == 'MY_BOOKMARK'){
        var userpanel_maenu = document.getElementById('userpanel_maenu');
        for(var i=0;i<userpanel_maenu.children.length;i++){
            userpanel_maenu.children[i].setAttribute('class','');
        }
        document.getElementById('menu_bookmark_button').setAttribute('class','selected');
        load_marks();
        
    } if(current_post == 'MY_HISTORY'){
        var userpanel_maenu = document.getElementById('userpanel_maenu');
        for(var i=0;i<userpanel_maenu.children.length;i++){
            userpanel_maenu.children[i].setAttribute('class','');
        }
        document.getElementById('menu_history_button').setAttribute('class','selected');
        load_my_history();
        
    }else if(current_post == 'SINGLE_POST'){
        showedPost = {code:ucode}
        console.log( showedPost.id);
        reloadMyPost();
    }
}


function load_my_post_list_menu(){
    if(this.getAttribute('class') == 'selected'){
        return;
    }else{
        var userpanel_maenu = document.getElementById('userpanel_maenu');
        for(var i=0;i<userpanel_maenu.children.length;i++){
            userpanel_maenu.children[i].setAttribute('class','');
        }
        this.setAttribute('class','selected');
    }
    window.history.pushState({page:'mypost'},null,main_url+'user/mypost')
    load_my_post_list()
}



function load_my_history_menu(){
    document.getElementById('btn_menu_mobile').innerHTML = '<i class="icon-menu"></i>';
    document.getElementById('btn_menu_mobile').style.fontSize = '24px';
    document.getElementById('btn_menu_mobile').onclick = showMoreMenu;
    
    if(this.getAttribute('class') == 'selected'){
        return;
    }else{
        var userpanel_maenu = document.getElementById('userpanel_maenu');
        for(var i=0;i<userpanel_maenu.children.length;i++){
            userpanel_maenu.children[i].setAttribute('class','');
        }
        this.setAttribute('class','selected');
    }
    window.history.pushState({page:'myhistory'},null,main_url+'user/history')
    load_my_history()
}

function load_my_post_list(){
    document.getElementById('btn_menu_mobile').innerHTML = '<i class="icon-menu"></i>';
    document.getElementById('btn_menu_mobile').style.fontSize = '24px';
    document.getElementById('btn_menu_mobile').onclick = showMoreMenu;
    show_loading();
    document.getElementById('empty_error').setAttribute('class','display_none');
    document.getElementById('post_managment').setAttribute('class','display_none');
    document.getElementById('mylist').setAttribute('class','display_none');
    document.getElementById('page_title2').innerHTML = 'آگهی های من';
    //loading_view = document.getElementById('loading_view');
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if(this.status == 200 && this.responseText != ''){
                showPost(this.responseText);
            }else{
                show_not_found();
                console.log('ce');
            }
        }
    }
    xhttp.open('get',main_url+'api/my_posts.php',true);
    xhttp.send();
}
function showPost(j){
    var arr = JSON.parse(j);
    console.log(arr);
    if(arr['status']=='200'){
        var post = arr['post'];
        hide_loading();
        var mylist = document.getElementById('mylist');
        mylist.setAttribute('class','');
        mylist.innerHTML = '';
        for(var i=0;i<post.length;i++){
            var mylist_item = document.createElement('div');
            mylist_item.setAttribute('class','mylist_item');
            var image_status = '<i class="icon-camera-off"></i>';
            if(post[i]['src'] != ''){
                image_status = '<img src="'+post[i]['src']+'">';
            }

            mylist_item.innerHTML = '<a code="'+post[i]['code']+'" href="'+post[i]['url']+'"><div class="mylist_item_content"><div class="image_holder">'+image_status+'</div><div class="about_post"><div class="item_post_title"><h2>'+post[i]['title']+'</h2></div><div class="item_post_status"><span>وضعیت : منتشر شده</span></div></div> </div></a>';
            mylist.appendChild(mylist_item); 
            mylist_item.children[0].onclick = showMyPost;
        }
    }else{
        show_not_found();
    }
}
function reloadMyPost(){
    ed = 0;
    il = 0;
    ps = 0;
    var id = showedPost.code;
    show_loading();
    document.getElementById('mylist').setAttribute('class','display_none');
    document.getElementById('empty_error').setAttribute('class','display_none');

    document.getElementById('page_title2').innerHTML = 'جزییات آگهی';
    if(xhttp != null){ xhttp.abort(); }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if(this.status == 200 && this.responseText){
                console.log(this.responseText);
                var j = JSON.parse(this.responseText);
                show_post_for_user(j);
            }else{
                show_not_found();
            }
        }
    }
    xhttp.open('get',main_url+'api/load_product.php?c=igi&id='+id,true);
    xhttp.send();
}

function showMyPost(e){
    e.preventDefault();
    window.history.pushState({id:this.getAttribute('code')},'',main_url+'user/mypost/'+this.getAttribute('code'));
    ed = 0;
    il = 0;
    ps = 0;
    // show_Detail_post();
    var id = this.getAttribute('code');
    show_loading();
    document.getElementById('mylist').setAttribute('class','display_none');
    document.getElementById('page_title2').innerHTML = 'جزییات آگهی';
    if(xhttp != null){ xhttp.abort(); }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if(this.status == 200 && this.responseText){
                console.log(this.responseText);
                var j = JSON.parse(this.responseText);
                show_post_for_user(j);
            }else{
                show_not_found();
            }
        }
    }
    xhttp.open('get',main_url+'api/load_product.php?c=igi&id='+id,true);
    xhttp.send();
    //
    //initial_image_slider();
}

function  show_post_for_user(j){
    console.log(j);
    if(j['status']!='200'){
        show_not_found();
        return;
    }
    j = j['data'];
    document.getElementById('delete_post_button').setAttribute('code',j['post']['uniccode']);
    
    document.getElementById('category_h3').innerHTML = 'دسته بندی : '+j['category']['name'];
    document.getElementById('location_h3').innerHTML = 'موقعیت : '+j['location']['name'];
    document.getElementById('type_h3').innerHTML = 'نوع آگهی : '+j['post']['type'];
    document.getElementById('status_h3').innerHTML = 'وضعیت کالا : '+j['post']['status'];
    document.getElementById('time_h3').innerHTML = 'تاریخ آگهی : '+j['post']['timed'];
    document.getElementById('code_h3').innerHTML = 'کد آگهی : '+j['post']['uniccode'];
    document.getElementById('image_input').setAttribute('token',j['token']);
    
    document.getElementById('post_title_edit').value = j['post']['title'];
    document.getElementById('post_body_edit').value = j['post']['body'];
   if(j['post']['video'] != ''){
        document.getElementById('post_video_edit').value = 'https://aparat.com/v/' + j['post']['video'];
   }
    
   if(j['type']== 'توافقی' && j['category']['id']=='1'){
       document.getElementById('editPrice').innerHTML = '<h3>ودیعه : </h3><input type="text" placeholder="ودیعه" id="price_2_edit"  value="'+j['post']['price_1']+'"><span>ودیعه را به تومان وارد کنید</span><h3>اجاره : </h3><input  value="'+j['post']['price_2']+'" type="text" placeholder="اجاره" id="price_3_edit"><span>اجاره را به تومان وارد کنید</span>';

       document.getElementById('price_2_edit').onkeypress = volvorin;
       document.getElementById('price_3_edit').onkeypress = volvorin;
   
    }else{
       document.getElementById('editPrice').innerHTML = '<h3>قیمت : </h3><input type="text" id="price_1_edit" placeholder="قیمت" value="'+j['post']['price_1']+'"><span>قیمت را به تومان وارد کنید</span>';
       document.getElementById('price_1_edit').onkeypress = volvorin;
       
    }

    document.getElementById('buttonHolder').innerHTML = '<button id="setPostUpdateButton">ذخیره تغییرات</button>';
    document.getElementById('setPostUpdateButton').onclick = doupdatepost;
    showedPost = {
    id:j['post']['id'],
    title:j['post']['title'],
    body:j['post']['body'],
    p1:j['post']['price_1'],
    p2:j['post']['price_2'],
    video:j['post']['video'],
    code:j['post']['uniccode'],
    token:j['token']
}
console.log(showedPost)
    var imgs = j['images'];
    images_array = [];
    for(var i=0;i<imgs.length;i++){
        images_array.push({id:'0',src:imgs[i]});
    }

    initial_image_slider();
    
    
    hide_loading();
    document.getElementById('post_managment').setAttribute('class','');


    document.getElementById('delete_post_button').onclick = showRemoveLayout;


    document.getElementById('btn_menu_mobile').innerHTML = '<i class="icon-arrow-thin-right"></i>';
    document.getElementById('btn_menu_mobile').style.fontSize = '18px';
    document.getElementById('btn_menu_mobile').onclick = function (){
        window.history.back();
    }

}



function showRemoveLayout(){
    var alert_delete = document.createElement('div');
    alert_delete.setAttribute('id','alert_delete');
    alert_delete.innerHTML = '<div id="alert_delete_container"><p>آیا از حذف آگهی خود مطمین هستید؟</p><span>پس از حذف آگهی امکان بازیابی آگهی وجود نخواهد داشت</span><div class="button_holder"><button id="cancel_exit">انصراف</button><button id="ok_delete_post">حذف آگهی</button></div></div>';
    document.body.appendChild(alert_delete);
    document.getElementById('cancel_exit').onclick = exitAlertDelete;
    document.getElementById('ok_delete_post').onclick = delet_post;
}

function exitAlertDelete(){
    document.body.removeChild(alert_delete);
}


function delet_post(){
    document.getElementById('alert_delete_container').innerHTML = '<img src="'+window.localStorage.getItem('loading')+'" >';
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4){
            if(this.responseText =='OK' && this.status == 200){
                
                exitAlertDelete();

                window.history.back();
            }else{
                exitAlertDelete();
                alert('مشکلی در اتصال به سرور رخ داد');
                
            }
        }
    }
    xhttp.open('GET',main_url+'ajax/remove_post.php?t='+showedPost.token+'&p='+showedPost.code);
    xhttp.send();
}





function show_loading(){
    if(loading_view == null){
        loading_view = document.getElementById('loading_view');
    }
    loading_view.setAttribute('class','');
}
function hide_loading(){
    loading_view.setAttribute('class','display_none');
}

function load_my_bookmark_menu(){
    if(this.getAttribute('class') == 'selected'){
        return;
    }else{
        var userpanel_maenu = document.getElementById('userpanel_maenu');
        for(var i=0;i<userpanel_maenu.children.length;i++){
            userpanel_maenu.children[i].setAttribute('class','');
        }
        this.setAttribute('class','selected');
    }
    window.history.pushState({page:'mypost'},null,main_url+'user/bookmark')
    load_marks();
}




function load_my_history(){
    document.getElementById('empty_error').setAttribute('class','display_none');

    document.getElementById('mylist').setAttribute('class','display_none');
    document.getElementById('post_managment').setAttribute('class','display_none');
    show_loading();


    document.getElementById('page_title2').innerHTML = 'بازدیدهای اخیر';
    if(xhttp != null  ){
        xhttp.abort();
    }
    var items = window.localStorage.getItem('history');
    if(!items){
        
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 ){
            if(this.responseText!=''  && this.status == 200){
                show_marks_view(this.responseText)
            }else{
                show_not_found();
            }
        }
    }
    xhttp.open('GET',main_url+'api/history.php?items='+items,true);
    xhttp.send();
}





function load_marks(){
    document.getElementById('btn_menu_mobile').innerHTML = '<i class="icon-menu"></i>';
    document.getElementById('btn_menu_mobile').style.fontSize = '24px';
    document.getElementById('btn_menu_mobile').onclick = showMoreMenu;
    
    document.getElementById('empty_error').setAttribute('class','display_none');

    document.getElementById('mylist').setAttribute('class','display_none');
    document.getElementById('post_managment').setAttribute('class','display_none');

    show_loading();


    document.getElementById('page_title2').innerHTML = 'آگهی های نشانه گذاری شده';
    if(xhttp != null  ){
        xhttp.abort();
    }
    
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 ){
            if(this.responseText!=''  && this.status == 200){
                show_marks_view(this.responseText)
            }else{
                show_not_found();
            }
        }
    }
    xhttp.open('GET',main_url+'api/bookmarks.php',true);
    xhttp.send();
}

function show_marks_view(j){

    document.getElementById('mylist').innerHTML = '';
    var posts = JSON.parse(j)
    console.log(posts);
    if(posts['status'] != '200'){
        show_not_found();
    }else{
        posts = posts['post'];
        for(var k=0;k<posts.length;k++){
            var post = posts[k];
            var mylist_item = document.createElement('div');
            mylist_item.setAttribute('class','mylist_item');
            var a = document.createElement('a');
            a.setAttribute('href',post['url']);
            mylist_item.appendChild(a);
            var img = '<i class="icon-camera-off"></i>';
            if(post['sumbnail']!= ''){
                img = '<img src="'+post['sumbnail']+'">';
            }
            a.innerHTML = '<div class="mylist_item_content"><div class="image_holder">'+img+'</div><div class="about_post"><h3 class="title">'+post['title']+'</h3><span>'+post['p1']+'</span><span>'+post['p2']+'</span><span>'+post['time']+' در '+post['location']+'</span></div></div>';
            document.getElementById('mylist').appendChild(mylist_item);
        }
        hide_loading();
        document.getElementById('mylist').setAttribute('class','');
    }
}




                                

var slider_image_count = 0;
var slider = null;
var slider_current_item = 0;
function initial_image_slider(){
    slider_current_item=0;
    slider =  document.getElementById('slider_holder');
    slider.innerHTML = '';
    for(var i=0;i<images_array.length;i++){
        slider.innerHTML += '<div class="slide"><img src="'+images_array[i].src+'"></div>';
    }
    slider_image_count = images_array.length;
    if(slider_image_count == 0){
        slider.innerHTML = '<div class="slide"><i class="icon-camera-off"></i></div>';
        document.getElementById('remove_image').setAttribute('style','display:none;');
    }else{
        document.getElementById('remove_image').setAttribute('style','');
    }

    document.getElementById('image_input').onchange = add_image;
    document.getElementById('remove_image').onclick = remove_image_itemi;

    document.getElementById('slide_go_left_button').onclick = go_left_slide ;
    document.getElementById('slide_go_right_button').onclick = go_right_slide ;
    document.getElementById('slide_controller').ontouchstart = start_touch_slide;
    document.getElementById('slide_controller').ontouchmove = move_touch_slide;
    document.getElementById('slide_controller').ontouchend = end_touch_slide;
    document.getElementById('slide_controller').ontouchcancel = cancel_touch_slide;
    slider.setAttribute('style','right:0%');
}

function add_image(e){
    if(this.files[0]==null){
        return;
    }
    if(images_array.length >= 10){
        this.value = null;
        return;

    }
    var newImage = this.files[0];
    if(newImage.size > 10000*1024){
        this.value = null;
        alert('تصویر انتخاب شده سنگینتر از 10 مگابایت است.');
        return;
    }
    var data = new FileReader();
    data.readAsDataURL(newImage);
    
    data.image = newImage;
    data.token = this.getAttribute('token');
    data.onload = function(){
        images_array.push({id:'-1',src:this.result});
        document.getElementById('slide_controller').innerHTML += '<div id="update_image_loading" class="image_loading"><img src="'+window.localStorage.getItem('loading')+'"></div>';
        var form = new FormData();
        form.append('image',this.image);
        form.append('token',this.token);

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 ){
                
                if(this.responseText!=''  && this.status == 200){
                    il = 1;
                    images_array[images_array.length-1].id = this.responseText;
                    initial_image_slider();
                    document.getElementById('slide_controller').removeChild(document.getElementById('update_image_loading'));
                }else{
                    images_array.pop();
                    initial_image_slider();
                    document.getElementById('slide_controller').removeChild(document.getElementById('update_image_loading'));
                    alert('مشکلی در آپلود تصویر بوجود آمد.');
                }
            }
        }
        xhttp.open('POST',main_url+'ajax/update_image.php',true);
        xhttp.send(form);

    }

}

function remove_image_itemi(){
    document.getElementById('slide_controller').innerHTML += '<div id="update_image_loading" class="image_loading"><img src="'+window.localStorage.getItem('loading')+'"></div>';
    var current_image = images_array[slider_current_item];
    var it = 0;
    if(current_image.id=='0'){
        it = current_image.src.replace(main_url,'');
        it= it.replace('assets/image/post/','');
    }else{
        it = current_image.id;
    }
    
    
    var token = document.getElementById('image_input').getAttribute('token');
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 ){
            il = 1;
            if(this.responseText=='ok'  && this.status == 200){
                images_array.splice(slider_current_item,1);
                initial_image_slider();
                document.getElementById('slide_controller').removeChild(document.getElementById('update_image_loading'));
            }else{
                console.log(this.responseText);
                document.getElementById('slide_controller').removeChild(document.getElementById('update_image_loading'));
                alert('مشکلی در اتصال به سرور بوجود آمد.');
            }
        }
    }
    xhttp.open('GET',main_url+'ajax/remove_update_image.php?token='+token+'&img='+it,true);
    xhttp.send();
}

function go_left_slide(){
    if(slider_current_item < slider_image_count-1){
        slider_current_item++;
    }else{
        slider_current_item = 0;
        
    }
    slider.setAttribute('style','right:-'+slider_current_item*100+'%');
    
}

function go_right_slide(){
    if(slider_current_item > 0){
        slider_current_item--;
    }else{
        slider_current_item = slider_image_count-1;
        
    }
    slider.setAttribute('style','right:-'+slider_current_item*100+'%');
}

var start_touch = 0;
var end_touch = 0;
function start_touch_slide(e){
    start_touch = e.changedTouches[0].clientX;
    
}
function move_touch_slide(e){
    var current_touch = e.changedTouches[0].clientX;
    var width = this.offsetWidth;
    console.log(width)
    var changed = current_touch - start_touch;
    if(changed < 0 ){
        slider.setAttribute('style','right:'+(-(slider_current_item+(changed/width))*100)+'%');
    }else if(changed > 0 ){
        slider.setAttribute('style','right:'+(-(slider_current_item+(changed/width))*100)+'%');
    }
}
function end_touch_slide(e){
    end_touch = e.changedTouches[0].clientX
    var changed =end_touch - start_touch;
    if(changed > 100 && slider_current_item < slider_image_count-1){
        go_left_slide();
    }else if(changed < -100 && slider_current_item > 0){
        go_right_slide();
    }else{
        slider.setAttribute('style','right:-'+(slider_current_item)*100+'%');
        console.log(changed);
    }
}
function cancel_touch_slide(e){
    //console.log(e);
}


//initial_image_slider();


function checkEditable(){
    var inp = 0;
    var txa = 0;
    if(document.getElementById('post_title_edit').value.length < 25){
        inp = 0;
        document.getElementById('post_title_edit').setAttribute('class','error');
    }else {
        inp = 1;
        document.getElementById('post_title_edit').setAttribute('class','');
    }
    if(document.getElementById('post_body_edit').value.length < 45){
        txa = 0;
        document.getElementById('post_body_edit').setAttribute('class','error');
    }else {
        txa = 1;
        document.getElementById('post_body_edit').setAttribute('class','');
    }
    if(inp+txa == 2){
        ed = 1;
    }else{
        ed= 0;
    }
}




function volvorin(evt){
    if(evt.charCode>47 && evt.charCode < 58){
        ps = 1;
        return true;
        
    }
    return false;
}


function messageSuccus(){
    var message = document.createElement('div');
    message.setAttribute('id','message_succus');
    message.innerHTML = 'با موفقیت انجام شد.';
    document.body.appendChild(message);
    setTimeout(()=>{
        document.body.removeChild(message);
    },5000);
}


function show_not_found(){
    document.getElementById('empty_error').setAttribute('class','');
    document.getElementById('mylist').setAttribute('class','display_none');
    document.getElementById('loading_view').setAttribute('class','display_none');
    document.getElementById('post_managment').setAttribute('class','display_none');
}

function doupdatepost(){
    var newTitle = document.getElementById('post_title_edit').value;
    if(newTitle.length < 25){
        alert('لطفا ورودی عنوان آگهی را کامل وارد کنید')
        return;
    }
    var newBody = document.getElementById('post_body_edit').value;
    if(newBody.length < 45){
        alert('لطفا ورودی توضیحات آگهی را کامل وارد کنید')
        return;                                              
    }
    var newVideo = document.getElementById('post_video_edit').value;

    newPrice_1 = '0';
    newPrice_2 = '0';
    if(document.getElementById('price_1_edit') != null){
        newPrice_2 = document.getElementById('price_1_edit').value;
    }else{
        newPrice_1 = document.getElementById('price_2_edit').value;
        newPrice_2 = document.getElementById('price_3_edit').value;
    }

    if(ed==0 && il == 0 && ps==0){
            alert('چیزی برای تغییر وجود ندارد');
            return;
        }
        else{
            
        }
        document.getElementById('buttonHolder').innerHTML = '<div class="loading"><img src="'+window.localStorage.getItem('loading')+'"><span>در حال بارگذاری اطلاعات ...</span></div>';

        var form = new FormData();
        form.append('tl',newTitle);
        form.append('bd',newBody);
        form.append('vd',newVideo);
        form.append('p1',newPrice_1);
        form.append('p2',newPrice_2);
        form.append('id',showedPost.id);
        form.append('tk',showedPost.token);


        xhttp.abort();
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4){
                if(this.status == 200 && this.responseText == 'OK'){
                    reloadMyPost();
                    messageSuccus();
                }else{
                    alert('متاسفانه مشکلی رخ داد');
                    document.getElementById('buttonHolder').innerHTML = '<button id="setPostUpdateButton">ذخیره تغییرات</button>';
                    document.getElementById('setPostUpdateButton').onclick = doupdatepost;
                }
                
            }
        }
        
        xhttp.open('POST',main_url+'ajax/do_update.php',true);
        xhttp.send(form);


}


window.onpopstate = function(e){
    var myhref = window.location.href;
    myhref = myhref.replace(main_url+'user/','');
    myhref = myhref.replace(main_url+'user','');
    if(myhref == '' || myhref == 'mypost' || myhref == 'mypost/'){
        var userpanel_maenu = document.getElementById('userpanel_maenu');
        for(var i=0;i<userpanel_maenu.children.length;i++){
            userpanel_maenu.children[i].setAttribute('class','');
        }
        document.getElementById('menu_mypost_button').setAttribute('class','selected');
        load_my_post_list();
        return false;
    }
    if(myhref == 'bookmark' || myhref == 'bookmark/'){
        var userpanel_maenu = document.getElementById('userpanel_maenu');
        for(var i=0;i<userpanel_maenu.children.length;i++){
            userpanel_maenu.children[i].setAttribute('class','');
        }
        document.getElementById('menu_bookmark_button').setAttribute('class','selected');
        load_marks();
        return false;
    }
    if(myhref == 'history' || myhref == 'history/'){
        var userpanel_maenu = document.getElementById('userpanel_maenu');
        for(var i=0;i<userpanel_maenu.children.length;i++){
            userpanel_maenu.children[i].setAttribute('class','');
        }
        document.getElementById('menu_history_button').setAttribute('class','selected');
        load_my_history();
        return false;
    }
    var regex = /^mypost\/[0-9a-zA-Z]{8,64}\/?$/;
    if(regex.exec(myhref)){
        var a = myhref.split('/');
        var url_code = a[1];
        showedPost = {code:url_code}
        reloadMyPost();
        return;
    }
    
    
    
   /* if(e.state.id != null){
        showedPost.id = e.state.id;
        reloadMyPost();
        return;
    }else{
        window.history.replaceState(null,null,main_url+'user/');
    }*/
}

window.onhashchange = function(e){
    console.log(window.location.hash);
}