document.getElementById('searchInput').setAttribute('value','جستجو کنید ...');
document.getElementById('searchInput').onfocus = function focusinput(){
    this.setAttribute('value','');
}

