var positi = document.getElementById('main_header').currentStyle || getComputedStyle(document.getElementById('main_header'));

var loadpermission = true;



var current_scroll_on_post = 0;
window.onscroll = function(){
    var scrollpos = document.body.scrollTop || document.documentElement.scrollTop || window.pageYOffset;
    
    if( positi.position != 'sticky'){
        //console.log(positi.position + scrollpos);
        if(document.getElementById('main_header').classList){
            if(scrollpos>=40){
                document.getElementById('main_header').classList.add('posifixed');
            }else{
                document.getElementById('main_header').classList.remove('posifixed');
            }
        }else{
            if(scrollpos>=40){
                document.getElementById('main_header').setAttribute('class','posifixed');
            }else{
                document.getElementById('main_header').setAttribute('class','') ;
            }
        }
        
    }
    var bottomPage = document.body.offsetHeight - window.innerHeight - 60;
    //console.log(scrollpos);
    //console.log(bottomPage);
    if(loadpermission ==  true){
        current_scroll_on_post = scrollpos;
    }
    if(scrollpos >= bottomPage && loadpermission==true){
        if(document.getElementById('productHolder') != null){
            initial_load_product();
        }
    }


    if(document.getElementById('show_category_on_mobile') != null){
        document.getElementById('show_category_on_mobile').onclick = showMobileCategoryButton;
    }
}



document.body.onresize = setSearchWidth;
function setSearchWidth(){
    var searchBar = document.getElementById('searchBar');
    var main_header_container = document.getElementById('main_header_container');
    
    var header_add_post = document.getElementById('header_add_post') || document.getElementById('header_add_post_new') ;
    var header_menu = document.getElementById('header_menu');
    var header_h1 = document.getElementById('header_h1');
    if(header_h1 != null){
        var searchBarWidth = main_header_container.offsetWidth - (header_add_post.offsetWidth + header_menu.offsetWidth + header_h1.offsetWidth + 30);
        searchBar.setAttribute('style','width:'+searchBarWidth+'px !important;max-width:500px;');
    }
    
}

var main_content = document.getElementById('main_content');
document.body.onload = function(){
    main_content = document.getElementById('main_content');


    setallTopMenu();
    setSearchWidth();
    
    if(document.getElementById('heading_title')){
        setInfoHeader();
        loadCategories();
        document.getElementById('loading_viewer').children[0].children[0].src = window.localStorage.getItem('loading');
    }
    if(document.getElementById('main_image_shower')){
        loadImagesSlider();
    }
    
    if(document.getElementById('productHolder') != null && defalt_layout == '0'){
        initial_load_product();
    }else{
        seb=1;
    
        loadpermission = false;
        document.getElementById('loading_viewer').setAttribute('class','');
        document.getElementById('main_content').setAttribute('class','display_none');
        load_post_data(defalt_layout);
    }
    
    
    document.getElementById('nav_titles').onclick = function(e){
        if(e.target.id == 'post_city_v1' || e.target.id == 'post_state_v1'){
            e.preventDefault();
            setLocation(e.target);
            window.history.back();
        }else if(e.target.id == 'post_category_v1'){
            e.preventDefault();
            setCategory(e.target);
            window.history.back();
        } 

    }
    
    document.getElementById('category_button_v1').onclick = function(e){
        e.preventDefault();
        setCategory(e.target);
        window.history.back();
    }
    
    document.getElementById('searchInput').onkeypress = searchController;
    document.getElementById('searchInput').value = currentQuery;


    document.getElementById('most_search').onclick = searchThis;
    
    
    document.getElementById('refresh_button').onclick = refresh_page;
    
    document.getElementById('clear_search_input').onclick = clear_search;
    document.getElementById('searchInput').oninput = detect_searchbar_value_change;
    
    
    
    
}




document.getElementById('header_set_location_button').onclick = function(){
    document.body.setAttribute('class','blur');
    document.getElementById('select_city').setAttribute('class','show');
    showStates();
    
}

function exitFromSelectCity(){
    document.body.setAttribute('class','');
    document.getElementById('select_city').setAttribute('class','');
    document.getElementById('select_state_selector').innerHTML='';
    
}

function showStates(){
    document.getElementById('select_city_title').innerHTML = 'انتخاب استان';
    document.getElementById('select_city_back_button').onclick = exitFromSelectCity;
    var select_state_selector = document.getElementById('select_state_selector');
    select_state_selector.innerHTML = '<li ids="i_0" slug="ایران" state_name="ایران"><i class="icon-check-square"></i><span>همه ایران</span></li>';
    select_state_selector.children[0].onclick = setLocation;
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
    var select_state_selector = document.getElementById('select_state_selector');
    select_state_selector.innerHTML = '<li ids="s_'+ids+'" state_name="'+state_name+'" slug="استان-'+slug+'"><i class="icon-check-square"></i><span>همه آگهی های استان '+state_name+'</span></li>';
    select_state_selector.children[0].onclick = setLocation;
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


function setallTopMenu(){
    var top_menus = document.getElementsByClassName('topmenu');
    for(var j=0;j < top_menus.length ;j++){
        var topmenu = top_menus[j];
        topmenu.onclick = fixSubmenu;
    }
}
function fixSubmenu(){
    var topmenus = document.querySelectorAll('.topmenu');
    for(var t=0;t<topmenus.length;t++){
        topmenus[t].setAttribute('class','topmenus');
    }
    this.setAttribute('class','topmenu set');
    document.body.onclick = exitSubMenu;
}



function exitSubMenu(evnt){
    var top_mens = document.querySelectorAll('.set *');
    var p = false;
    for(var t=0;t<top_mens.length;t++){
        if(top_mens[t] == evnt.target && p==false){
            p=true;
        }
    }
    if(p == true){
    }else{
        var topmenus = document.querySelectorAll('.topmenu');
        for(var t=0;t<topmenus.length;t++){
            topmenus[t].setAttribute('class','topmenu');
        }
        document.body.onclick = null;
        console.log(false)
    }
}


var searchBarInputHolder = document.getElementById('searchBarInputHolder');
var searchInput = document.getElementById('searchInput');

searchInput.onfocus = function(evt){
    if(evt.target){
        searchBarInputHolder.setAttribute('class','inputHolder focus');
        document.body.onclick = on_focus_out_search_bar;
        document.getElementById('exitSearchTool').onclick = function(){
            searchBarInputHolder.setAttribute('class','inputHolder');
            document.body.onclick = null;
        };
    }
    
}







function on_focus_out_search_bar(evnt){
    var top_mens = document.querySelectorAll('.focus * , .focus');
    var p = false;
    if(evnt.target){
        for(var t=0;t<top_mens.length;t++){
            if(top_mens[t] == evnt.target && p==false){
                p=true;
            }
        }
        if(p == true){
            console.log(true)
        }else{
            searchBarInputHolder.setAttribute('class','inputHolder');
            document.body.onclick = null;
        }
    }
    
}





/*
searchInput.addEventListener('focusout', function(evt){
    
    var rts = document.querySelectorAll('#searchBarInputHolder ,#searchBarInputHolder *');
    p = false;
    for(var t=0;t<rts.length;t++){
        if(rts[t] == evt.relatedTarget && p==false){
            p=true;
        }
        console.log(evt);
    }
    if(p==false){
        searchBarInputHolder.classList.remove('focus');
    }
    
});

*/



function clickEffect(e){
    var d=document.createElement("div");
    d.className="clickEffect";
    d.style.top=e.clientY +"px";d.style.left=e.clientX  +"px";
    document.body.appendChild(d);
    d.addEventListener('animationend',function(){d.parentElement.removeChild(d);}.bind(this));
}
document.addEventListener('click',clickEffect);










function searchController(e){
    if(e.key == 'Enter' && this.value.length > 1){
        currentQuery = this.value;
        this.blur();
        searchBarInputHolder.setAttribute('class','inputHolder');
        resetPosts();
        close_product_view();
        setInfoHeader();
        window.history.replaceState(null,'',createHref());
        initial_load_product();
    }else if(e.key == '=' || e.key == '?'){
        return false;
    }
}


function searchThis(e){
    currentQuery = e.target.innerHTML;
    if(currentQuery == ''){
        return ;
    }
    document.getElementById('searchInput').value = e.target.innerHTML;
    document.getElementById('searchInput').blur();
    searchBarInputHolder.setAttribute('class','inputHolder');
    
    resetPosts();
    setInfoHeader();
    close_product_view();
    window.history.replaceState(null,null,createHref());
      //  history.pushState(null,'',window.location.href +'?q='+currentQuery);
    initial_load_product();
    document.getElementById('clear_search_input').setAttribute('style','');
}

function clear_search(){
    var searchInput = document.getElementById('searchInput');
    if(searchInput.value != '' && currentQuery == ''){
        searchInput.value = '';
        this.setAttribute('style','display:none');
    }else if(searchInput.value == '' && currentQuery != ''){
        currentQuery = '';
        close_product_view();
        resetPosts();
        initial_load_product();
        setInfoHeader();
        window.history.replaceState(null,null,createHref());
        this.setAttribute('style','display:none');
    }else if(searchInput.value != '' && currentQuery != ''){
        searchInput.value = '';
        currentQuery = '';
        close_product_view();
        resetPosts();
        initial_load_product();
        setInfoHeader();
        window.history.replaceState(null,null,createHref());
        this.setAttribute('style','display:none');
    }else{
        this.setAttribute('style','display:none');
    }
}
function detect_searchbar_value_change(){
    var clear_search_input = document.getElementById('clear_search_input');
    if(this.value == '' && currentCategory == ''){
        clear_search_input.setAttribute('style','display:none');
    }else{
       
        clear_search_input.setAttribute('style','');
    }

    if(document.getElementById('curren_most_search') != null){
        document.getElementById('curren_most_search').innerHTML = this.value;
    }
}



window.onpopstate = function(e){
    if(e.state == null){
        close_product_view();
        return false;
    }
    
    if(e.state.post != null){
        loadpermission = false;
        loadDataXHR.abort();
        document.getElementById('loading_viewer').setAttribute('class','');
        document.getElementById('main_content').setAttribute('class','display_none');
        load_post_data(e.state.post);
        return;
    }
}


function createHref(){
    var url = main_url ;
    url = url + currentlocationSlug;
    
    if(currentCategory != 'c_0'){
        url = url + currentCategorySlug;
    }
    if(currentQuery != ''){
        url = url +'?q='+currentQuery;
    }
    console.log(url)
    return url;
    
}



