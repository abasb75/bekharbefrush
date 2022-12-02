$(function(){
    $('#loading_viewer').remove();
    $('#bottom_menu').remove();
    $('.formHeader button').on('click',function(e){
        e.preventDefault();
        window.history.back();
    })
})