var selectedCategory = null;
var aside_cateory_list = document.getElementById('aside_cateory_list');
var select_category = document.getElementById('select_category');
var return_back = document.getElementById('return_back');
var category_name = document.getElementById('category_name');
var product_detail = document.getElementById('product_detail');
var add_main_layout =document.getElementById('add_main_layout');


function loadCategories(){
    
    var aside_cateory_list = document.getElementById('aside_cateory_list');
    if(aside_cateory_list == null){
        return;
    }
    for(var i=0;i<cat_names.length;i++){
        var newCategory = document.createElement('li');
        newCategory.setAttribute('idc','c_'+(i+1));
        newCategory.setAttribute('category_name',cat_names[i]);
        newCategory.setAttribute('slug',cat_title[i]);
        newCategory.onclick = setCategory;
        newCategory.innerHTML = '<i class="icon-'+cat_icons[i]+'"></i><span>'+cat_names[i]+'</span><i class="icon-angle-left"></i>';
        if(aside_cateory_list != null){
            aside_cateory_list.appendChild(newCategory);
        }
        
    }
}

document.body.onload = function(){
    loadCategories();
    if(add_main_layout!=null){add_main_layout.setAttribute('style','height:'+select_category.offsetHeight+'px')};
    document.getElementById('buttonMenu').onclick = function(){
        document.body.setAttribute('style','overflow:hidden;');
        document.getElementById('mobile_menu').setAttribute('class','show');
    }

    document.getElementById('exit_menu_mobile_show').onclick = function(){
        document.body.setAttribute('style','');
        document.getElementById('mobile_menu').setAttribute('class','');
    }
    
    document.body.setAttribute('style','');
    document.body.removeChild(document.getElementById('loading_box'));
    
    
    document.getElementById('video_upload_input').onchange = upload_video;
    
    
} 

function setCategory(){
    selectedCategory = {
        idc : this.getAttribute('idc'),
        slug : this.getAttribute('slug'),
        nam : this.getAttribute('category_name')
    }
    for(var i=0;i<aside_cateory_list.children.length;i++){
        if(selectedCategory.idc == 'c_'+(i+1)){
            aside_cateory_list.children[i].setAttribute('class','selected')
        }else{
            aside_cateory_list.children[i].setAttribute('class','')
        }
        
    }
    select_category.setAttribute('class','hidden');
    product_detail.setAttribute('class','');
    
    add_main_layout.setAttribute('style','height:'+product_detail.offsetHeight+'px');
    
    window.scrollTo(0,0);
    category_name.innerHTML = 'ثبت آگهی در دسته '+selectedCategory.nam;
    set_price_layout();
}

if(return_back != null){
    return_back.onclick = function(){
        select_category.setAttribute('class','');
        product_detail.setAttribute('class','hidden');
        window.scrollTo(0,0);

        add_main_layout.setAttribute('style','height:'+select_category.offsetHeight+'px');
    
    }
}

/* set city on add page */

var selectedLocation = {
    city_id : "c_300",
    city_name : 'تهران',
    state_name : 'تهران'
}

var set_city_load = document.getElementById('set_city_load');

if(set_city_load!=null){set_city_load.onclick = function(){
    document.body.setAttribute('class','blur');
    document.getElementById('select_city').setAttribute('class','show');
    showStates();
    
}}

function showStates(){
    document.getElementById('select_city_title').innerHTML = 'انتخاب استان';
    document.getElementById('select_city_back_button').onclick = exitFromSelectCity;
    var select_state_selector = document.getElementById('select_state_selector');
    select_state_selector.innerHTML= '';
    var state_array = JSON.parse(states);
    for(var i=0;i<state_array.length;i++){
        var newState = document.createElement('li');
        newState.setAttribute('ids',state_array[i]['id']);
        newState.setAttribute('slug',state_array[i]['slug']);
        newState.setAttribute('state_name',state_array[i]['name']);
        newState.innerHTML = '<span>'+state_array[i]['name']+'</span><i class="icon-angle-left"></i>';
        newState.onclick = showStateCities;
        select_state_selector.appendChild(newState);
    }
}
function showStateCities(){
    document.getElementById('select_city_title').innerHTML = 'انتخاب شهر';

    document.getElementById('select_city_back_button').onclick = showStates;
    var ids = this.getAttribute('ids');
    var slug = this.getAttribute('slug');
    var state_name = this.getAttribute('state_name');
    selectedLocation.state_name = state_name;
    var select_state_selector = document.getElementById('select_state_selector');
    select_state_selector.innerHTML = '';
    var city_array = JSON.parse(citys);
    for(var i=0;i<city_array.length;i++){
        if(city_array[i]['province_id'] == ids){
            var newState = document.createElement('li');
            newState.setAttribute('ids','c_'+city_array[i]['id']);
            newState.setAttribute('slug',city_array[i]['slug']);
            newState.setAttribute('state_name',city_array[i]['name']);
            newState.innerHTML = '<span>'+city_array[i]['name']+'</span><i class="icon-check-square"></i>';
            newState.onclick = setLocation;
            select_state_selector.appendChild(newState);
        }
    }

}

function exitFromSelectCity(){
    document.body.setAttribute('class','');
    document.getElementById('select_city').setAttribute('class','');
    document.getElementById('select_state_selector').innerHTML='';
    
}

function setLocation(){
    selectedLocation.city_id = this.getAttribute('ids');
    selectedLocation.city_name = this.getAttribute('state_name');
    exitFromSelectCity();
    document.getElementById('city_name').innerHTML = 'موقعیت : استان '+selectedLocation.state_name+' ، شهر ' + selectedLocation.city_name;

}


/* alert viwer */
var avableTypes = [
    'فروشی','فروش یا معاوضه','معاوضه','اجاره ای','درخواستی','خدمات'
]
var avableStatus = [
    'نو','در حد نو','دست دوم','نیازمند تعمییر'
]

var set_status = document.getElementById('set_status');
var selectedStatus = {
    id:1,
    title:'نو'
}

if(set_status!=null){set_status.onclick = function(){
   var type = 'list';
    var content = avableStatus;
    creatAlert('لطفا وضعیت کالای خود را انتخاب کنید',content,type,'setStatus');
}}

var set_type = document.getElementById('set_type');
var selectedType = {
    id:1,
    title:'فروشی'
}

if(set_type!=null){
    set_type.onclick = function(){
        //var ct = '<ul class="status_list"><li onclick="setType(this);" status_title="فروشی" ids="1"><span>فروشی</span><i class="icon-check"></i></li><li onclick="setType(this);" status_title="درخواستی" ids="2"><span>درخواستی</span><i class="icon-check"></i></li><li onclick="setType(this);" status_title="خدمات" ids="3"><span>خدمات</span><i class="icon-check"></i></li><li onclick="setType(this);" status_title="اجاره ای" ids="4"><span>اجاره ای</span><i class="icon-check"></i></li><li onclick="setType(this);" status_title="معاوضه" ids="5"><span>معاوضه</span><i class="icon-check"></i></li></ul>';
        creatAlert('لطفا نوع آگهی خود را انتخاب کنید',avableTypes,'list','setType');
}
                  }

var alert_selector = null;
function creatAlert(title,content,type,fn){
    
    alert_selector = document.createElement('div');
    alert_selector.setAttribute('id','alert_selector');
    alert_selector.setAttribute('class','show');
    alert_selector.innerHTML = '<div id="alert_container"><header><button id="exitAlertButton"><i class="icon-arrow-thin-right"></i></button><h3 id="alert_title"></h3></header><div id="alert_content"></div></div>';
    document.body.appendChild(alert_selector);
    var alert_content = document.getElementById('alert_content');
    var alert_title = document.getElementById('alert_title');
    alert_title.innerHTML = title;

    if(type == 'list'){
        
        var p = '<ul class="status_list">'
        for(var i=0;i<content.length;i++){
            p += '<li onclick="'+fn+'(this);" status_title="'+content[i]+'" ids="'+(i+1)+'"><span>'+content[i]+'</span><i class="icon-check"></i></li>';
        }
        p += '</ul>';
        alert_content.innerHTML = p;
    }
    else if(type = 'body'){
        alert_content.innerHTML = content;
    }
    
    var exitAlertButton = document.getElementById('exitAlertButton');
    exitAlertButton.onclick = function(){
        document.body.removeChild(document.getElementById('alert_selector'));
        document.body.setAttribute('class','');
    }
    
    if(fn == null){
        exitAlertButton.setAttribute('style','display:none');
    }
    document.body.setAttribute('class','alert_show');
}
function exitAlert(){
    if (alert_selector != null) {
        document.body.removeChild(document.getElementById('alert_selector'));
        document.body.setAttribute('class','');
    }
}

function setStatus(el){
    if(el!=null){
        selectedStatus.id= parseInt(el.getAttribute('ids'));
        selectedStatus.title = el.getAttribute('status_title');
        document.getElementById('product_status').innerHTML = 'وضعیت کالا : '+selectedStatus.title;
    }

    exitAlert();
}
/* */
function setType(el){
    if(el!=null){
        selectedType.id = parseInt(el.getAttribute('ids'));
        selectedType.title = el.getAttribute('status_title');
        document.getElementById('product_type').innerHTML = 'نوع آگهی : '+selectedType.title;
        set_price_layout();
    
    }



    exitAlert();
}


function set_price_layout(){
    if(selectedType.id==4 && selectedCategory.idc=='c_1'){
        document.getElementById('set_ads_price').innerHTML='<h3>قیمت</h3><span>قیمت را به تومان وارد کنید. خالی گذاشتن قیمت به معنای قیمت توافقی می باشد.</span><div class="inputHolder"><label>میزان ودیعه</label><input inputmode="numeric" onkeypress="return volvorin(event)" oninput="isdigit(this);" class="price_input" maxlength="12" type="tel" placeholder="" id="title_ads_price_2"><label>تومان</label></div><div class="inputHolder"><label>میزان اجاره</label><input inputmode="numeric" onkeypress="return volvorin(event)" oninput="isdigit(this);" class="price_input" maxlength="12" type="tel" placeholder="" id="title_ads_price_3"><label>تومان</label></div>';
    }else{
        document.getElementById('set_ads_price').innerHTML='<h3>قیمت</h3><span>قیمت را به تومان وارد کنید. خالی گذاشتن قیمت به معنای قیمت توافقی می باشد.</span><div class="inputHolder"><input class="price_input" maxlength="12" type="tel" placeholder="قیمت به تومان" id="title_ads_price_1" inputmode="numeric" onkeypress="return volvorin(event)" oninput="isdigit(this);"><label>تومان</label></div>';
    }
}

var alcheck = null;

function allawysCheck(url){
    url = url + 'ajax/checkuser.php';
    alcheck = setInterval(function(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState==4){
                if(this.status == 200 && this.responseText== 'VOID'){
                    location.reload();
                }
            }
        }
        xhttp.open('GET',url,true);
        xhttp.send();
    },5000);
}





        
                    

function checkTitleInput(evt,min){
    checkSendCat();
    
    if(evt.value.length < min){
        evt.setAttribute('class','alert_input');
    }else{
        evt.setAttribute('class','');
    }
}

function checkSendCat(){
    var buttonHolder = document.getElementById('button_send_categry');
    var title_ads_input = document.getElementById('title_ads_input');
    var body_ads_input = document.getElementById('body_ads_input');
    
    if(title_ads_input.value.length < 25 || body_ads_input.value.length < 40){
        buttonHolder.innerHTML = '<a href="<?php echo $_MAIN_URL; ?>"><button class="right"><i class="icon-angle-right"></i><span>انصراف</span></button></a>';
    }else{
        buttonHolder.innerHTML = '<a href="<?php echo $_MAIN_URL; ?>"><button class="right"><i class="icon-angle-right"></i><span>انصراف</span></button></a><button class="left" onclick="sendpost();">ثبت آگهی</button>';
    }
}

function volvorin(evt){
        if(evt.charCode>47 && evt.charCode < 58){
            return true;
        }
        return false;
    }
    
function checkMail(email){
        return String(email)
        .toLowerCase()
        .match(
          /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    }
function checkemail(el){
        if(el.value==''){
            checkSendCat();
            el.setAttribute('class','price_input');
        }else if(checkMail(el.value)){
            checkSendCat();
             el.setAttribute('class','price_input');
        }else{
            el.setAttribute('class','price_input alert_input');
            var buttonHolder = document.getElementById('button_send_categry');
            buttonHolder.innerHTML = '<a href="<?php echo $_MAIN_URL; ?>"><button class="right"><i class="icon-angle-right"></i><span>انصراف</span></button></a>';
        }
    }


function isdigit(el){
    if(el.value.match(/^[0-9]+$/) == null){
        el.value = '';
        console.log('ft');
    }else{
        console.log('fl');
    }
}




function sendpost(){
    for(var i=0;i<imgArrays.length;i++){
        if(imgArrays[i].status != 1){
            alert('هنوز پردازش تصاویر به اتمام نرسیده است.');
            return;
        }
    }
    var alertbody = '<div class="loading_viewr"><div class="lodingHolder"><img src="'+window.localStorage.getItem('loading')+'"></div><h4 class="showAlert">لطفا تا پایان ارسال اطلاعات به سرور صبر کنید</h4></div>';
    creatAlert('در حال ارسال اطلاعات به سرور',alertbody,'body',null);
    var data = new FormData();
    data.append('ca',selectedCategory.idc);
    data.append('lc',selectedLocation.city_id);
    data.append('st',selectedStatus.id);
    data.append('tp',selectedType.id);
    data.append('tk',tokenId);
    data.append('tl',document.getElementById('title_ads_input').value);   data.append('bd',document.getElementById('body_ads_input').value);   
    if(document.getElementById('title_ads_price_1')!=null){
        data.append('p1',document.getElementById('title_ads_price_1').value); 
    }else{
         data.append('p1','-1'); 
    }
    if(document.getElementById('title_ads_price_2')!=null){
        data.append('p2',document.getElementById('title_ads_price_2').value); 
    }else{
         data.append('p2','-1'); 
    }
    if(document.getElementById('title_ads_price_3')!=null){
        data.append('p3',document.getElementById('title_ads_price_3').value); 
    } else{
         data.append('p3','-1'); 
    }
    data.append('nm',document.getElementById('adser_name_input').value); 
    data.append('em',document.getElementById('mail_input').value); 
    data.append('ln',document.getElementById('link_input').value); 
    data.append('ad',document.getElementById('address_input').value); 
    data.append('vd',document.getElementById('video_ads_input').value); 
    
    if(mainIdr != null){
        data.append('idr',mainIdr);
    }else{
        data.append('idr','1000');
    }
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange =function(){
        if(this.readyState == 4){
            if(this.status == 200 && this.responseText == 'OK'){
                console.log(this.responseText);
                showSuccusMassage();
            }else{
                console.log(this.responseText);
                showAlertCancel();
            }
        }
    }
    xhttp.open('POST',main_url+'ajax/load_post.php',true);
    xhttp.send(data);
    
    
}





                
                   

function showAlertCancel(){
    document.getElementById('alert_container').children[0].children[1].innerHTML = 'خطا در انجام عملیات';
    document.getElementById('alert_content').innerHTML = '<div class="loading_viewr"><div class="lodingHolder"><i class="icon-signal_cellular_connected_no_internet_4_bar"></i></div><h4 class="showAlert">بنظر میرسد مشکلی در ارتباط با سرورهای ما پیدا کردید</h4><button onclick="exitAlert();sendpost();"><i class="icon-refresh"></i>تلاش مجدد</button><button onclick="exitAlert();"></i>ویرایش آگهی</button></div>';
}

function showSuccusMassage(){
    document.getElementById('alert_container').children[0].children[1].innerHTML = 'مراحل ثبت آگهی به پایان رسید';
    document.getElementById('alert_content').innerHTML = '<div class="loading_viewr"><div class="lodingHolder"><i class="icon-check-square-o" style="color:#26de81;font-size:42px;"></i></div><h4 class="showAlert">آگهی شما پس از تایید مدیر وب سایت در وب سایت منتشر خواهد شد</h4><a href="'+main_url+'user/mypost"><button onclick=""><i></i>مدیریت آگهی</button></a></div>';
}


