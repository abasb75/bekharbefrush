function exitMobileCategory(){
    document.getElementById('main_content_sidebar').setAttribute('class','');
        document.getElementById('category_name_title').innerHTML = 'دسته بندی : '+currentCategoryName;
        document.body.setAttribute('class','');
}

function showMobileCategoryButton(){
    document.getElementById('main_content_sidebar').setAttribute('class','show');
    document.body.setAttribute('class','hidden');
}


function go_home(){
    exitMobileCategory();
}

document.getElementById('show_category_on_mobile').onclick = showMobileCategoryButton;

document.getElementById('go_home_bottom_menu').onclick = go_home;