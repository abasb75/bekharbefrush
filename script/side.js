

function loadCategories(){
    var aside_cateory_list = document.getElementById('aside_cateory_list');
    var newCategory = document.createElement('li');
        newCategory.setAttribute('idc','c_0');
        newCategory.setAttribute('slug','all');
        newCategory.setAttribute('category_name','همه دسته ها');
        if(currentCategory == 'c_0' || currentCategory[0]!='c'){
            newCategory.setAttribute('class','selected');
            currentCategory = 'c_0';
        }
        newCategory.onclick = setCategory;
        newCategory.innerHTML = '<i class="icon-shop"></i><span>همه موارد</span><i class="icon-angle-left"></i>';
        if(aside_cateory_list){aside_cateory_list.appendChild(newCategory)};
        
    for(var i=0;i<cat_names.length;i++){
        var newCategory = document.createElement('li');
        newCategory.setAttribute('idc','c_'+(i+1));
        newCategory.setAttribute('category_name',cat_names[i]);
        newCategory.setAttribute('slug',cat_title[i]);
        if(currentCategory == 'c_'+(i+1)){
            newCategory.setAttribute('class','selected');
        }
        newCategory.onclick = setCategory;
        newCategory.innerHTML = '<i class="icon-'+cat_icons[i]+'"></i><span>'+cat_names[i]+'</span><i class="icon-angle-left"></i>';
        if(aside_cateory_list){ aside_cateory_list.appendChild(newCategory); }
    }
}